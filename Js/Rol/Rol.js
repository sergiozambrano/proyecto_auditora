function eliminar(id){

    let data = {
        'id':id,
        'accion': "eliminar"
    }

    $.ajax({
        url:"../../Controller/Rol/Rol.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
            if (data) {
                Swal.fire({
                    type:'success',
                    title:'Los datos fueron eliminados correctamente!!',
                });
                seleccionar(null);
            }else{
                 Swal.fire({
                    type:'warning',
                    title:'Error los datos no fueron elimindos correctamente!!',
                });
            }
        }
    });
};
//consulta que trae todos los roles
function seleccionar(id){

    $('#tbody').empty();
    if(id!=null){$('#form_edit').empty();}

    $.ajax({
        url:"../../Controller/Rol/Rol.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar"},
        success: function(data){
            data = JSON.parse(data);

            for (let index = 0; index < data.length; index++) {
                //tabla con los tados consultados (roles)
                var text1 ="<tr>"+
                            "<td>"+(index+1)+"</td>"+
                            "<td>"+data[index][1]+"</td>";
                            if (data[index][2] == 1) {
                                text1+="<td>Activo</td>";
                            } else {
                                text1+="<td>Inactivo</td>";
                            }
                            text1+= "<td>"+
                            "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#staticBackdrop' onclick='seleccionar("+data[index][0]+");'>Editar</button>"+
                            "<button type='button' class='btn btn-danger btn-sm' id='eliminar' onclick='eliminar("+data[index][0]+");'>Eliminar</button></td>"+
                            "</tr>";
                //id de la tabla
                $('#tbody').append(text1);
            }

            //verificamos si el id ya existe esto lo hacemos para editar los datos
            if(id!=null){

                for (let index = 0; index < data.length; index++) {
                    if (data[index][0]==id) {

                        // formulario de edicion

                        var text = "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>Nombres del rol</label>"+
                            "<select class='custom-select' id='nombre_rol_edit' disabled>";
                            if (data[index][1]== "Administrador") {
                                text += "<option selected>Administrador</option>"+
                                "<option>Coordinador de auditoría</option>"+
                                "<option>Auditor</option>"+
                                "<option>Coordinador de área</option>";
                            }
                            else if (data[index][1]== "Coordinador de auditoría") {
                                text += "<option>Administrador</option>"+
                                "<option selected>Coordinador de auditoría</option>"+
                                "<option>Auditor</option>"+
                                "<option>Coordinador de área</option>";
                            }
                            else if (data[index][1]== "Auditor") {
                                text += "<option>Administrador</option>"+
                                "<option>Coordinador de auditoría</option>"+
                                "<option selected>Auditor</option>"+
                                "<option>Coordinador de área</option>";
                            }
                            else{
                                text += "<option>Administrador</option>"+
                                "<option>Coordinador de auditoría</option>"+
                                "<option>Auditor</option>"+
                                "<option selected>Coordinador de área</option>";
                            }

                            text +="</select>"+
                            "</div>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault04'>Estado del rol</label>"+
                            "<select class='custom-select' id='estado_rol_edit' required>";
                            if (data[index][2]== 1) {
                                text += "<option selected>Activo</option>"+
                                "<option>Inactivo</option>";
                            }
                            else{
                                text += "<option>Activo</option>"+
                                "<option selected>Inactivo</option>";
                            }

                            text +="</select>"+
                            "</div>"+
                            "</div>"+
                            "<button class='btn btn-primary' type='submit' id='boton_edit' value='"+data[index][0]+"'>Editar</button>";
                        //id del forulario editar
                        $('#form_edit').append(text);
                    }
                }

            }
        }
    });

}

$(document).ready(function (e){

    seleccionar(null);
    //insercion de datos
    $('#form').submit(function(e){
        e.preventDefault();

        let data = {
            'nombre_rol':$.trim($('#nombre_rol').val()),
            'estado_rol':$.trim($('#estado_rol').val()),
            'accion': "insertar"
        }

        $.ajax({
            url:"../../Controller/Rol/Rol.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                //validamos si la insercion fue correcta
                if (data == 1) {
                    Swal.fire({
                        type:'success',
                        title:'Los datos fueron registrados correctamente!!',
                    });
                    seleccionar(null);
                }else if (data == 2) {
                    Swal.fire({
                        type:'warning',
                        title:'Error el rol ya existe!!',
                    });
                }else {
                    Swal.fire({
                        type:'warning',
                        title:'Error los datos no fueron registrados correctamente!!',
                    });
                }
            }
        });
    });

    $('#form_edit').submit(function(e){
        e.preventDefault();

        let data = {
            'nombre_rol':$.trim($('#nombre_rol_edit').val()),
            'estado_rol':$.trim($('#estado_rol_edit').val()),
            'id':$.trim($('#boton_edit').val()),
            'accion': "editar"
        }
        $.ajax({
            url:"../../Controller/Rol/Rol.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                if (data) {
                    Swal.fire({
                        type:'success',
                        title:'Los datos fueron actualizados correctamente!!',
                    });
                    seleccionar($('#boton_edit').val());
                }else {
                    Swal.fire({
                        type:'warning',
                        title:'Error los datos no fueron actualizados correctamente!!',
                    });
                }
            }
        });
    });

});
