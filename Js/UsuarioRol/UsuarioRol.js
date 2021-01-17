var cont=0;
function seleccionar(id){

    $('#tbody').empty();
    if(id!=null){$('#form').empty();}

    $.ajax({
        url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar"},
        success: function(data){
            data = JSON.parse(data);
 
            for (let index = 0; index < data.length; index++) {
                text_Consul = "<tr>"+
                                "<td>"+(index+1)+"</td>"+
                                "<td>"+data[index][1]+"</td>"+
                                "<td>"+data[index][2]+"</td>"+
                                "<td>"+data[index][3]+"</td>"+
                                "<td>"+
                                "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#staticBackdrop' onclick='seleccionar("+data[index][0]+");'>Asignar usuario</button>"+
                                "</tr>";


                $('#tbody').append(text_Consul);
            }
            
                
            if(id!=null){

                for (let index = 0; index < data.length; index++) {
                    if (data[index][0]==id) {

                        var text = "<p>Se le asignara un usuario a <strong>"+data[index][1]+" "+data[index][2]+"</strong> con numero de documento <strong>"+data[index][3]+"</strong></p>"+
                            "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>Numero de contrato</label>"+
                            "<input type='text' class='form-control' id='numero_contrato' value='' required>"+
                            "</div>"+
                            "</div>"+
                            "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>Contraseña</label>"+
                            "<input type='password' class='form-control' id='contraseña' value='' required>"+
                            "</div>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>verificar contraseña</label>"+
                            "<input type='password' class='form-control' id='verificar_contraseña' value='' required>"+
                            "</div>"+
                            "</div>"+
                            "<button class='btn btn-primary' type='submit' id='boton_asignar' value='"+data[index][0]+"'>Asignar</button>";
                        
                        $('#form').append(text);
                    }
                }

            }
        }
    });

}

$(document).ready(function (e){

    seleccionar(null);

    $('#form').submit(function(e){
        e.preventDefault(); 
      
        let data = {
            'numero_contrato':$.trim($('#numero_contrato').val()),
            'contraseña':$.trim($('#contraseña').val()),
            'verificar_contraseña':$.trim($('#verificar_contraseña').val()),
            'idPersona':$.trim($('#boton_asignar').val()),
            'accion': "insertar"
        }

        console.log(data);
        if (data['contraseña'] == data['verificar_contraseña']) {
             $.ajax({
                url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
                type:"POST",
                datatype:"json",
                data:data,
                success:function(data){
                    if (data) {
                        Swal.fire({
                            type:'success',
                            title:'Datos ingresados correctamente!!',
                        });
                        seleccionar($('#boton_asignar').val());
                    }else{
                        Swal.fire({
                            type:'warning',
                            title:'Error al ingresar los datos!!',
                        });
                    }
                }
            });
        } else {
            Swal.fire({
                type:'warning',
                title:'Error las contraseñas no coinciden!!',
            });
        }
           
    });

    $('#form_edit').submit(function(e){
        e.preventDefault(); 
    
        let data = {
            'numero_contrato':$.trim($('#numero_contrato_edit').val()),
            'contraseña':$.trim($('#contraseña_edit').val()),
            'verificar_contraseña':$.trim($('#verificar_contraseña_edit').val()),
            'idPersona':$.trim($('#boton_edit').val()),
            'accion': "editar"
        }
        console.log(data);
        if (data['contraseña'] == data['verificar_contraseña']) {
            $.ajax({
                url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
                type:"POST",
                datatype:"json",
                data:data,
                success:function(data){
                    if (data) {
                       Swal.fire({
                            type:'success',
                            title:'Datos actualizados correctamente!!',
                        });
                        seleccionar_usuarios_activos();
                    }else{
                        Swal.fire({
                            type:'warning',
                            title:'Error al actualizar los datos!!',
                        });;
                    }
                }
            });
        } else {
            Swal.fire({
                type:'warning',
                title:'Error las contraseñas no coinciden!!',
            });
        }    
    });


    $('#form_roles').submit(function(e){
        e.preventDefault(); 
    
        let data = {
            'idusuario':$.trim($('#boton_rol').val()),
            'idrol':$('select#selectRol option:Selected').val(),
            'accion': "asignarRol"
        }

        var usuario=$('#boton_rol').val();

        $.ajax({
            url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                if (data == 1) {
                    Swal.fire({
                        type:'success',
                        title:'El rol fue asigno correctamente!!',
                    });
                    roles(usuario);
                }else if (data == 2) {
                    Swal.fire({
                        type:'warning',
                        title:'Error el rol ya existe!!',
                    });
                }else{
                    Swal.fire({
                        type:'warning',
                        title:'Error el rol no fue asignado correctamente!!',
                    });
                }
            }
        });
    });
    
});

function seleccionar_usuarios_activos(id){

    $('#tbody-activos').empty();
    if(id!=null){$('#form_edit').empty();}

    $.ajax({
        url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar_usuarios_activos"},
        success: function(data){
            data = JSON.parse(data);
 
            for (let index = 0; index < data.length; index++) {
                text_Consul = "<tr>"+
                                "<td>"+(index+1)+"</td>"+
                                "<td>"+data[index][1]+"</td>"+
                                "<td>"+data[index][2]+"</td>"+
                                "<td>"+data[index][3]+"</td>"+
                                "<td>"+data[index][4]+"</td>"+
                                "<td>"+
                                "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editar_usuario' onclick='seleccionar_usuarios_activos("+data[index][0]+");'>Editar</button>"+
                                 "<button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#roles_usuario' onclick='roles("+data[index][5]+");'>Roles</button>"+
                                "<button type='button' class='btn btn-danger btn-sm' id='eliminar' onclick='desactivar("+data[index][0]+");'>Desactivar</button></td>"+
                                "</tr>";


                $('#tbody-activos').append(text_Consul);
            }  

            if(id!=null){

                for (let index = 0; index < data.length; index++) {
                    if (data[index][0]==id) {

                        var text =  "<p>Se le asignara un usuario a <strong>"+data[index][1]+" "+data[index][2]+"</strong> con numero de documento <strong>"+data[index][3]+"</strong></p>"+
                            "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>Numero de contrato</label>"+
                            "<input type='text' class='form-control' id='numero_contrato_edit' value='"+data[index][4]+"' required>"+
                            "</div>"+
                            "</div>"+
                            "<div class='form-row'>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>Contraseña</label>"+
                            "<input type='password' class='form-control' id='contraseña_edit' value='' required>"+
                            "</div>"+
                            "<div class='col-md-6 mb-3'>"+
                            "<label for='validationDefault01'>verificar contraseña</label>"+
                            "<input type='password' class='form-control' id='verificar_contraseña_edit' value='' required>"+
                            "</div>"+
                            "</div>"+
                            "<button class='btn btn-primary' type='submit' id='boton_edit' value='"+data[index][5]+"'>Editar</button>";
                        
                        $('#form_edit').append(text);
                    }
                }

            }



        }
    });

}

function roles(id){

    $('div#asignarRol').html("<button class='btn btn-primary' type='submit' id='boton_rol'  value='"+id+"'>Asignar</button>");

    cont= cont +1;
        let data = {
            'id':id,
            'accion': "roles"
        }

        $('#tbody-roles').empty();

        $.ajax({
            url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success: function(data){
                data = JSON.parse(data);

                for (let index = 0; index < data.length; index++) {
                    text_Consul_roles = "<tr>"+
                                    "<td>"+(index+1)+"</td>"+
                                    "<td>"+data[index][0]+"</td>"+
                                    "<td>"+
                                    "<button type='button' class='btn btn-danger btn-sm' id='eliminar' onclick='eliminar("+data[index][1]+","+data[index][2]+");'>Desactivar</button></td>"+
                                    "</tr>";

                    $('#tbody-roles').append(text_Consul_roles); 

                }  

               
               
            }
        });

        
    if(cont==1){    
        $('#rolAsignado').empty();

        $.ajax({
            url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
            type:"POST",
            datatype:"json",
            data:{'accion': "selectRoles"},
            success: function(data){
                data = JSON.parse(data);
                
                for (let i = 0; i < data.length; i++) {
                    $('select#selectRol').append("<option value="+data[i][0]+">"+data[i][1]+"</option>");
                }
            }
        });
    }
}

function eliminar(id,usuario){
        
    let data = {
        'id':id,
        'accion': "eliminar"
    }

    $.ajax({
        url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
            if (data) {
               Swal.fire({
                    type:'success',
                    title:'El rol fue eliminado correctamente!!',
                });
                roles(usuario);
            }else{
                Swal.fire({
                    type:'warning',
                    title:'Error el rol no fue eliminado correctamente!!',
                });
            }
        }
    });
};


function desactivar(id){

    let data = {
        'id':id,
        'accion': "desactivar"
    }

    $.ajax({
        url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
            if (data) {
                seleccionar_usuarios_activos();
                Swal.fire({
                    type:'success',
                    title:'El usuario se desactivo correctamente!!',
                });
                
            }else{
                Swal.fire({
                    type:'warning',
                    title:'Error el usuario no pudo ser desactivado!!',
                });
            }
        }
    });
}

function seleccionar_usuarios_inactivos(){

     $('#tbody-inactivos').empty();

    $.ajax({
        url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar_usuarios_inactivos"},
        success: function(data){
            data = JSON.parse(data);
 
            for (let index = 0; index < data.length; index++) {
                text_Consul_inactivos = "<tr>"+
                                "<td>"+(index+1)+"</td>"+
                                "<td>"+data[index][1]+"</td>"+
                                "<td>"+data[index][2]+"</td>"+
                                "<td>"+data[index][3]+"</td>"+
                                "<td>"+data[index][4]+"</td>"+
                                "<td>"+
                                "<button type='button' class='btn btn-danger btn-sm' id='eliminar' onclick='activar("+data[index][0]+");'>Activar</button></td>"+
                                "</tr>";


                $('#tbody-inactivos').append(text_Consul_inactivos);
            }  
        }
    });

}

function activar(id){

    let data = {
        'id':id,
        'accion': "activar"
    }

    $.ajax({
        url:"../../Controller/UsuarioRol/UsuarioRol.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
            if (data) {
                seleccionar_usuarios_inactivos()
                Swal.fire({
                    type:'success',
                    title:'El usuario se activo correctamente!!',
                });
            }else{
                Swal.fire({
                    type:'warning',
                    title:'Error el usuario no pudo ser activado!!',
                });
            }
        }
    });
}

