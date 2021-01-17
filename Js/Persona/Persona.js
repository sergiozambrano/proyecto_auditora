function eliminar(id){
        
    let data = {
        'id':id,
        'accion': "eliminar"
    }

    $.ajax({
        url:"../../Controller/Persona/Persona.C.php",
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
                    title:'Error los datos no fueron eliminados correctamente!!',
                });
            }
        }
    });
};

function seleccionar(id){

    $('#tbody').empty();
    if(id!=null){$('#form_edit').empty();}

    $.ajax({
        url:"../../Controller/Persona/Persona.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar"},
        success: function(data){
            data = JSON.parse(data);
            //al traer los datos del Modelo.M los organizamos en una tabla
            for (let index = 0; index < data.length; index++) {
                text_Consul = "<tr>"+
                                "<td>"+(index+1)+"</td>"+
                                "<td>"+data[index][1];
                                //validamos si la persona tiene un segundo nombre
                                if (data[index][2] == null) {
                                    text_Consul += " "+"</td>";
                                }else{
                                    text_Consul += " "+data[index][2]+"</td>";
                                }
                                
                                text_Consul += "<td>"+data[index][3];
                                //validamos si la persona tiene un segundo apellido
                                 if (data[index][4] == null) {
                                    text_Consul += " "+"</td>";
                                }else{
                                    text_Consul += " "+data[index][4]+"</td>";
                                }
                                text_Consul += "<td>"+data[index][5]+"</td>"+
                                "<td>"+data[index][6]+"</td>"+
                                "<td>"+data[index][7]+"</td>"+
                                "<td>"+data[index][8]+"</td>"+
                                "<td>"+data[index][9]+"</td>"+
                                "<td>"+data[index][10]+"</td>"+
                                "<td>"+
                                "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#staticBackdrop' onclick='seleccionar("+data[index][0]+");'>Editar</button>"+
                                "<button type='button' class='btn btn-danger btn-sm' id='eliminar' onclick='eliminar("+data[index][0]+");'>Eliminar</button></td>"+
                                "</tr>";


                $('#tbody').append(text_Consul);
            }
            
               
            if(id!=null){

                for (let index = 0; index < data.length; index++) {
                    if (data[index][0]==id) {

                        var text = "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>Primer nombre</label>"+
                            "<input type='text' class='form-control' id='primer_nombre_edit' value='"+data[index][1]+"' required>"+
                            "</div>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault02'>Segundo nombre</label>";
                            if (data[index][2] == null) {
                                text += "<input type='text' class='form-control' id='segundo_nombre_edit' >";
                            }else{
                                text +="<input type='text' class='form-control' id='segundo_nombre_edit' value='"+data[index][2]+"' >";
                            }

                            text += "</div>"+
                            "</div>"+
                            "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>Primer apellido</label>"+
                            "<input type='text' class='form-control' id='primer_apellido_edit' value='"+data[index][3]+"' required>"+
                            "</div>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault02'>Segundo apellido</label>";

                            if (data[index][4] == null) {
                                text += "<input type='text' class='form-control' id='segundo_apellido_edit'>";
                            }else{
                                text +="<input type='text' class='form-control' id='segundo_apellido_edit' value='"+data[index][4]+"'>";
                            }

                            text += "</div>"+
                            "</div>"+
                            "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault04'>Tipo de documento</label>"+
                            "<select class='custom-select' id='tipo_edit' required>";
                            if (data[index][5]=="Cedula de ciudadania") {
                                text += "<option selected>Cedula de ciudadania</option>"+
                                "<option>Tarjeta de identidad</option>"+
                                "<option>Cedula de extranjeria</option>";
                            }
                            else if (data[index][5]=="Tarjeta de identidad"){
                                text += "<option>Cedula de ciudadania</option>"+
                                "<option selected>Tarjeta de identidad</option>"+
                                "<option>Cedula de extranjeria</option>";
                            }
                            else{
                                text += "<option>Cedula de ciudadania</option>"+
                                "<option>Tarjeta de identidad</option>"+
                                "<option selected>Cedula de extranjeria</option>";
                            }
                            
                            text +="</select>"+
                            "</div>"+
                            "<div class='col-md-6 mb-3'>"+
                            " <label for='validationDefault03'>Numero de documento</label>"+
                            "<input type='text' class='form-control' id='documento_edit' value='"+data[index][6]+"' disabled>"+
                            "</div>"+
                            "</div>"+
                            "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            " <label for='validationDefault04'>Numero de telefono</label>"+
                            " <input type='text' class='form-control' id='telefono_edit' value='"+data[index][7]+"' required>"+
                            "</div>"+   
                            " <div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault03'>Correo electronico</label>"+
                            " <input type='email' class='form-control' id='correo_edit' value='"+data[index][8]+"' disabled>"+
                            "</div>"+
                            "</div>"+
                            "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault03'>Fecha de nacimiento</label>"+
                            "<input type='date' class='form-control' id='fecha_naciemiento_edit' value='"+data[index][9]+"' disabled>"+
                            "</div>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault04'>Genero</label>"+
                            "<select class='custom-select' id='genero_edit' required>";
                            if (data[index][10]=="Masculino") {
                                text += "<option selected>Masculino</option>"+
                                "<option>Femenino</option>"+
                                "<option>Otro</option>";
                            }
                            else if (data[index][10]=="Femenino"){
                                text += "<option>Masculino</option>"+
                                "<option selected>Femenino</option>"+
                                "<option>Otro</option>";
                            }
                            else{
                                text += "<option>Masculino</option>"+
                                "<option>Femenino</option>"+
                                "<option selected>Otro</option>";
                            }
                            
                            text +="</select>"+
                            "</div>"+
                            "</div>"+
                            "<button class='btn btn-primary' type='submit' id='boton_edit' value='"+data[index][0]+"'>Editar</button>";
                        
                        $('#form_edit').append(text);
                    }
                }

            }
        }
    });

}

$(document).ready(function (e){

    seleccionar(null);
    //insercion de personas
    $('#form').submit(function(e){
        e.preventDefault(); 
    
        let data = {
            'primer_nombre':$.trim($('#primer_nombre').val().replace(/^\w/, (c) => c.toUpperCase())),  
            'segundo_nombre':$.trim($('#segundo_nombre').val().replace(/^\w/, (c) => c.toUpperCase())),     
            'primer_apellido':$.trim($('#primer_apellido').val().replace(/^\w/, (c) => c.toUpperCase())),
            'segundo_apellido':$.trim($('#segundo_apellido').val().replace(/^\w/, (c) => c.toUpperCase())),
            'tipo':$.trim($('#tipo').val()),
            'documento':$.trim($('#documento').val()),
            'telefono':$.trim($('#telefono').val()),
            'correo':$.trim($('#correo').val()),
            'fecha_naciemiento':$.trim($('#fecha_naciemiento').val()),
            'genero':$.trim($('#genero').val()),
            'accion': "insertar"
        }
    
        $.ajax({
            url:"../../Controller/Persona/Persona.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                if (data == 1) {
                    Swal.fire({
                        type:'success',
                        title:'Los datos fueron registrados correctamente!!',
                    });
                    seleccionar(null);
                }else if (data == 2) {
                    Swal.fire({
                        type:'warning',
                        title:'Error la personas que quieres registrar ya existe!!',
                    });
                }else{
                    Swal.fire({
                        type:'warning',
                        title:'Error los datos no se registraron correctamente!!',
                    });
                }
            }
        });
    });
    //edicion de personas
    $('#form_edit').submit(function(e){
        e.preventDefault(); 
    
        let data = {
            'primer_nombre':$.trim($('#primer_nombre_edit').val().replace(/^\w/, (c) => c.toUpperCase())),  
            'segundo_nombre':$.trim($('#segundo_nombre_edit').val().replace(/^\w/, (c) => c.toUpperCase())),     
            'primer_apellido':$.trim($('#primer_apellido_edit').val().replace(/^\w/, (c) => c.toUpperCase())),
            'segundo_apellido':$.trim($('#segundo_apellido_edit').val().replace(/^\w/, (c) => c.toUpperCase())),
            'tipo':$.trim($('#tipo_edit').val()),
            'documento':$.trim($('#documento_edit').val()),
            'telefono':$.trim($('#telefono_edit').val()),
            'correo':$.trim($('#correo_edit').val()),
            'fecha_naciemiento':$.trim($('#fecha_naciemiento_edit').val()),
            'genero':$.trim($('#genero_edit').val()),
            'id':$.trim($('#boton_edit').val()),
            'accion': "editar"
        }
        console.log(data);
        $.ajax({
            url:"../../Controller/Persona/Persona.C.php",
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
                }else{
                    Swal.fire({
                        type:'warning',
                        title:'Error los datos no fueron actualizados correctamente!!',
                    });
                }
            }
        });
    });
    
});