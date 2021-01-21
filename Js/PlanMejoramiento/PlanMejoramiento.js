
function seleccionar(id){
    //guardar funcion upperFirst()
    $('#hallazgo').empty();
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar"},
        success: function(data){
            data = JSON.parse(data);
            $('#hallazgo').append("<option selected disabled>--selecciona--</option>");
            $('#Hallazgo').append("<option selected disabled>--selecciona--</option>");
            for (let index = 0; index < data.length; index++) {
                $('#hallazgo').append(

                    "<option value='"+data[index][0]+"'>"+data[index][1]+"</option>"
                );
                $('#Hallazgo').append(
                    "<option value='"+data[index][0]+"'>"+data[index][1]+"</option>"
                );
            }
        }

    });
    $('#hallazgo').change(function(){
        var data={
            "hallazgo":$('#hallazgo').val(),
            "accion":"seleccionarA"
        }
        $('#boton').empty();

        $.ajax({

            url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                data = JSON.parse(data);

                $('#tbody').empty();

                for (let index = 0; index < data.length; index++) {

                    ruta = nombreArchivo(data[index][3]);
                    text="<tr>"+
                    "<td>"+(index+1)+"</td>"+
                    "<td><a data-toggle='modal' data-target='#staticBackdrop4' onclick='hallazgo("+data[index][0]+")'>"+data[index][2]+"</a></td>"+
                    "<td>"+data[index][4]+"</td>"+
                    "<td>"+data[index][5]+"</td>"+
                    "<td>"+
                    "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#staticBackdrop1' onclick='ValidarEditar("+data[index][0]+");validarEvidencia("+data[index][0]+",`"+ruta+"`)'>Editar</button>"+
                    "<button type='button' class='btn btn-info   btn-sm' data-toggle='modal' data-target='#staticBackdrop2' onclick='validarProrroga("+data[index][0]+");'>Crear Prorroga</button>"+
                    "</tr>";
                     $('#tbody').append(text);

                }


            }
        });
    });
}
function validarEvidencia(id,ruta){

        let data={
            'ruta':ruta,
            'id':id,
            'accion':"validarAuditoria"

        }
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success: function(data){
            data = JSON.parse(data);

            if (data.length >= 1) {
                for (let index = 0; index < data.length; index++) {


                        $('#idAnexo').val(data[2]);
                        $('#nombreArchivo').val(data[3]);
                        $('#idEjecucion').val(data[1]);
                        $('#idAuditoria').val(data[0]);



                }

            } else {
                $('#staticBackdrop1').modal('hide');
            }

        }
    });
}

var cont=0;
function evidencia(){



    $('#formEdit').submit(function(e){

        e.preventDefault();
        cont=cont+1;
        if(cont==1){
            var nombreArchivo = $("#nombreArchivo").val();
            var idAn = $("#idAnexo").val();
            var idE = $("#idEjecucion").val();
            var idA = $("#idAuditoria").val();
            var id = $("#id").val();
            var accion = "Evidencia";
            var formData = new FormData();
            var archivo = $("#entregable_edit")[0].files[0];
            formData.append('archivoSubido',nombreArchivo);
            formData.append('idAnexo',idAn);
            formData.append('entregable_edit',archivo);
            formData.append('idEjecucion',idE);
            formData.append('idAuditoria',idA);
            formData.append('id',id);
            formData.append('accion',accion);



    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:formData,
        contentType:false,
        processData:false,
        success: function(data){
            data = JSON.parse(data);

            if (data===true) {
                Swal.fire({
                    type:'success',
                    title:'Los datos fueron actualizados',
                  });
                $('#staticBackdrop1').modal('hide');

            }else if(data===0){
                Swal.fire({
                    type:'error',
                    title:'No Hay ningun archivo',
                  });

                  $('#staticBackdrop1').modal('hide');


                    }else if(data===1){

                        Swal.fire({
                            type:'error',
                            title:'El archivo es muy pesado',
                          });
                          $('#staticBackdrop1').modal('hide');

                    }else if(data===2){
                        Swal.fire({
                            type:'error',
                            title:'Archivo no valido',
                          });
                          $('#staticBackdrop1').modal('hide');

                    }else if(data===3){
                        Swal.fire({
                            type:'error',
                            title:'Ya hay un archivo subido',
                          });
                          $('#staticBackdrop1').modal('hide');

                    }
                    leer();
                    cont=0;
                    $("#id").attr("disabled", false);
                }




        });
        return false;
        }else{
            $("#id").attr("disabled", true);
        }
    });
}
function ValidarEditar(id){

    $('#staticBackdrop1').modal('show');
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "validarEditar"},
        success: function(data){
            data = JSON.parse(data);

            if (data.length >= 1) {

                for (let index = 0; index < data.length; index++) {

                    if(data[index][0]==id){


                        tiempo(data[index][0],(data[index][2]));
                        $('#fecha_edit').val(data[index][2]);
                        $('#estado_edit').val(data[index][6]);
                        $('#id').val(data[index][0]);

                    }

                }
            } else {
                $('#staticBackdrop1').modal('hide');
            }


        }
    });

}

function validarProrroga(id){

    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "validarEditar"},
        success: function(data){
            data = JSON.parse(data);

            if (data.length >= 1) {

                for (let index = 0; index < data.length; index++) {

                    if(data[index][0]==id){
                        $('#idProrroga').val(data[index][0]);

                    }

                }

            } else {
                $('#staticBackdrop1').modal('hide');

            }


        }
    });

}
var conta=0;
function prorroga(){
    $('#formProrroga').submit(function(e){

        e.preventDefault();

        conta=conta+1;
        if(conta==1){
            let data={
                'observacionProrro':$('#observacionProrro').val(),
                'fechaProrroga':$('#fechaProrro').val(),
                'id':$('#idProrroga').val(),
                'accion': "prorroga"

            }
            $.ajax({
                url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
                type:"POST",
                datatype:"json",
                data:data,
                success: function(data){

                    data = JSON.parse(data);

                        if (data===true) {
                            Swal.fire({
                                type:'success',
                                title:'Prorroga actualizada',
                            });
                            $('#staticBackdrop2').modal('hide');


                        }else if(data===2){

                            Swal.fire({
                                type:'error',
                                title:'Ya existe una prorroga',
                            });
                            $('#staticBackdrop2').modal('hide');


                        }else if(data===-0){
                            Swal.fire({
                                type:'error',
                                title:'La prorroga excede los 6 meses',
                            });
                        }
                        $('#fechaProrro').val("");
                        $('#observacionProrro').val("");
                        $('#staticBackdrop2').modal('hide');
                        $("#idProrroga").attr("disabled", false);
                        conta=0;
                    }


            });
        }else{
            $("#idProrroga").attr("disabled", true);
        }
    })
}
function vProrroga(){
    $('#tpro').empty();
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "vProrroga"},
        success:function(data){
            data = JSON.parse(data);


            for (let index = 0; index < data.length; index++) {

                if(data[index][4]=="Valido"){

                $('#tpro').append("<tr>"+
                                "<td>"+(index+1)+"</td>"+
                                "<td>"+data[index][1]+"</td>"+
                                "<td>"+data[index][2]+"</td>"+
                                "<td>"+data[index][3]+"</td>"+
                                "</tr>");
                }
            }
        }
    });
}
function hallazgo(id){
    $('#tHallazgo').empty();
    let data={
        'id':id,
        'accion':'hallazgo'
    }
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){

            data = JSON.parse(data);
            for (let index = 0; index < data.length; index++) {
                $('#tHallazgo').append("<tr>"+
                                    "<td>"+(index+1)+"</td>"+
                                    "<td>"+data[index][2]+"</td>"+
                                    "<td>"+data[index][3]+"</td>"+
                                    "<td>"+data[index][4]+"</td>"+
                                    "<td>"+data[index][1]+"</td>"+
                                    "<td>"+data[index][5]+"</td>"+
                                    "<td>"+
                                    "</tr>");
            }
        }
    });
}

function leer(){

    $('#tbody').empty();
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion':"leer"},
        success:function(data){
            data = JSON.parse(data);


            for (let index = 0; index < data.length; index++) {

                ruta = nombreArchivo(data[index][3]);
                $('#tbody').append("<tr>"+
                                "<td>"+(index+1)+"</td>"+
                                "<td><a data-toggle='modal' data-target='#staticBackdrop4' onclick='hallazgo("+data[index][0]+")'>"+data[index][2]+"</a></td>"+
                                "<td>"+data[index][4]+"</td>"+
                                "<td>"+data[index][5]+"</td>"+
                                "<td>"+
                                "<button type='button'  data-toggle='modal' data-target='#staticBackdrop1'  onclick='ValidarEditar("+data[index][1]+");validarEvidencia("+data[index][1]+",`"+ruta+"`)' class='btn btn-primary btn-sm'>Editar</button>"+
                                "<button type='button' class='btn btn-info   btn-sm' data-toggle='modal' data-target='#staticBackdrop2' onclick='validarProrroga("+data[index][1]+");'>Crear Prorroga</button>"+
                                "</tr>"
                                );
                    fechaProrroga(data[index][0]);
            }


        }
    });

}
function nombreArchivo(link){
    if(link!=null){
    var array = link.split('/');
    var img = array[array.length - 1];
    return img;
    }else{
        return null;
    }
}
function validarTiempo(){
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "validarEditar"},
        success: function(data){
            data = JSON.parse(data);
                for (let index = 0; index < data.length; index++) {
                    if(data[index][6]=="Abierto"){
                    tiempo(data[index][0],data[index][2]);
                    }
                }
        }
    });
}
function tiempo(id,fecha){

    var fechaActual = new Date();
    fechaActual=(fechaActual.getFullYear()+"-"+ (fechaActual.getMonth() +1) +"-"+fechaActual.getDate());

    if (Date.parse(fechaActual)>Date.parse(fecha)) {
        let data={
            'id':id,
            'accion':"fecha"
        }
        $.ajax({
            url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                data = JSON.parse(data);

                if(data==0){
                    Swal.fire({
                        type:'success',
                        title:'Se ha termiando el plazo de la evidencia'+fecha,
                      });

                }else if(data==1){
                   Swal.fire({
                    type:'success',
                    title:'Se ha vencido su evidencia para la fecha '+fecha,
                  });
                }
                $('#tbody').empty();
                leer();
            }
        });
    }

}
function fechaProrroga(id){
    let data={
        "idPlan":id,
        'accion':"fechaProrroga"
    }
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success: function(data){
            data = JSON.parse(data);
                for (let index = 0; index < data.length; index++) {

                    if (data[index][0]=="1") {
                        var fechaActual = new Date();
                        fechaActual=(fechaActual.getFullYear()+"-"+ (fechaActual.getMonth() +1) +"-"+fechaActual.getDate());
                        if (Date.parse(fechaActual)>Date.parse(data[index][1])) {
                            Swal.fire({
                                type:'error',
                                title:'Se ha vencido la prorroga para la fecha '+date[index][1],
                              });
                        }
                    }
                }
        }
    });
}



