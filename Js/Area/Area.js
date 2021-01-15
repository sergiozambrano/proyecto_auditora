//Este arreglo almacena los nombres de las personas, para cargarlos en el modal editar
let arregloSelect = [];

//función para eliminar registros
function eliminar(id){

        let data = {
            'id':id,
            'accion': "eliminar"
            }
            //valida con una alerta si se quiere elimnar un registro
            swal.fire({
            title: '¿Está seguro de borrar el registro?',
            text: "¡Si no lo está, puede cancelar la accíón!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: '¡Si, aceptar!',
            }).then(function(confirmar){
                if(confirmar.isConfirmed){ //Si se confirma accion entra al ajax y elimina
                $.ajax({
                    url:"../../Controller/Area/Area.C.php",
                    type:"POST",
                    datatype:"json",
                    data:data,
                    success:function(data){
                        if (data==1) {
                            Swal.fire({
                                    title: "Dato eliminado correctamente",
                                    icon: "success"
                                    });
                                }
                        else if(data==2){
                            Swal.fire({
                                    title: "Los datos no se eliminaron, contactese con soporte tecnico",
                                    icon: "warning"
                                    });
                                 }
                            seleccionar(null);
                            }
                        });
                    }
                        else{
                            Swal.fire({
                                title: "Los datos no se eliminaron",
                                icon: "error"
                                });
                           }
                    })
                };
//función para listar los datos
function seleccionar(id){

            $('#tbody').empty();
            if(id!=null){$('#form_edit').empty();}

            $.ajax({
                url:"../../Controller/Area/Area.C.php",
                type:"POST",
                datatype:"json",
                data:{'accion': "seleccionar"},
                success: function(data){
                    data = JSON.parse(data);

                    //En este ciclo for se valida para cambiar el estado del certificado de numero a la palabra
                    for (let index=0; index < data.length; index++) {
                        if (data[index][4]=='si certificado') {
                            data[index][4] = '<span class="badge badge-success">Si Certificado</span>';
                        }else{
                            data[index][4] = '<span class="badge badge-danger">No Certificado</span>';
                        }
                    }
                    for (let index = 0; index < data.length; index++) {
                        $('#tbody').append(
                            "<tr>"+
                            "<td>"+(index+1)+"</td>"+
                            "<td>"+data[index][1]+"</td>"+
                            "<td>"+data[index][3]+"</td>"+
                            "<td>"+data[index][4]+"</td>"+
                            "<td>"+
                            "<button type='button' style='margin-top: 0px;' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modelActualizar' data-whatever='@mdo' onclick='seleccionar("+data[index][0]+");'>Editar</button>"+
                            "<button type='button' class='btn btn-danger btn-sm' id='eliminar' onclick='eliminar("+data[index][0]+");'>Eliminar</button></td>"+
                            "</tr>"
                        );
                    }
            //abrimos el modal para cargar los datos al momento de editar
            if(id!=null){
                for (let index = 0; index < data.length; index++) {
                    if (data[index][0]==id) {
                        $('#nombreEditar').val(data[index][3]);
                        if (data[index][4]=='<span class="badge badge-success">Si Certificado</span>') {
                            $('#certificadoEditar').html("<option value='si certificado' selected>Si Certificado</option><option value='no certificado'>No Certificado</option>");
                        }else{
                            $('#certificadoEditar').html("<option value='si certificado'>Si Certificado</option><option value='no certificado' selected>No Certificado</option>");
                        }
                        $('#idArea').val(data[index][0]);
                        let option = '';
                        for (let i = 0; i < arregloSelect.length; i++) {
                            if (arregloSelect[i][0] == data[index][1]) {
                                option += `<option value='${arregloSelect[i][1]}' selected>${arregloSelect[i][0]}</option>`;
                                continue;
                            }
                            option += `<option value='${arregloSelect[i][1]}'>${arregloSelect[i][0]}</option>`;
                        }
                        $('#usuarioEditar').html(option);
                    }
                }
            }
        }
    });
}

$(document).ready(function (e){

    seleccionar(null);

    $('.form').submit(function(e){
        e.preventDefault();

        valor = $(this).attr("id");
        let data = {};

        //Aqui en data con la condicion if preguntamos si la peticion es insetar o editar para realizar la accion
        if ($(this).attr("id")=='Enviar') {
            data = {
                'nombre':$.trim($('#nombre').val().replace(/^\w/, (c) => c.toUpperCase())), //validamos que la primer letra ingresada sea mayuscula
                'certificado':$.trim($('#certificado').val()),
                'usuario':$.trim($('#usuario option:Selected').val()),
                'accion': "insertar"
            }
        }else if ($(this).attr("id")=='Editar'){
            data = {
                'nombre':$.trim($('#nombreEditar').val().replace(/^\w/, (c) => c.toUpperCase())), //validamos que la primer letra ingresada sea mayuscula
                'certificado':$.trim($('#certificadoEditar').val()),
                'usuario':$.trim($('#usuarioEditar').val()),
                'id':$.trim($('#idArea').val()),
                'accion': "editar"
            }
        }
        console.log(data);

            //Se valida para que se ingresen todos los datos al momento de insertarlos
            if(data['nombre'].length == "" || data['certificado'] == "" || data['usuario'] == ""){
                Swal.fire({
                    icon:'warning',
                    title: '¡ATENCIÓN !',
                    text: "¡Debe ingresar todos los datos!",
                });
                return false;
            }

        $.ajax({
            url:"../../Controller/Area/Area.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                if (data == 1) {
                  //Con esto cerramos el modal luego de insertar los datos
                  $('div#exampleModal').modal('hide');
                  $('div#modelActualizar').modal('hide');
                  Swal.fire({
                      title: "Exito!!",
                      icon: "success"
                  });
                }
                else if(data == 2){
                    Swal.fire({
                        title: "Error!!",
                        icon: "error"
                    });
                }
                else{
                    Swal.fire({
                        title: "Advertencia!!",
                        icon: "warning"
                    });
                }
                seleccionar(null);
                limpiar();
                $('#btnFormulario').val('Enviar');
            }
        });
    });

    });

    //Aqui se listan los nombres de las personas, en el select del modal que inserta los datos
            $.ajax({
                url:"../../Controller/Area/Area.C.php",
                type:"POST",
                datatype:"json",
                data:{'accion': "listarSelect"},
                success: function(data){
                data = JSON.parse(data);

                arregloSelect = data;

                    for (let index = 0; index < data.length; index++) {

                        $('#usuario')
                        .append(
                                "<option value='"+data[index][1]+"'>"+data[index][0]+"</option>"+
                                "</select>"
                            );

                    }
                }
            });
        //Con esta función limpiamos los campos
        function limpiar() {
            $('#nombre').val('');
            /* $('#usuario').val('');
            $('#idArea').val(''); */
        }
