var cont = 0;//contador global para que solo se realize una vez la operacion de validacion tras undir varias veces seuido el boton de enviar

$(document).ready(function (e){

  Seleccionar();

  //Poner en obligatorio el input de observaciones
  $("#check_validar").on('change', function() {
    if( $(this).is(':checked') ) {
      $("#observacion").prop('required',false);
    } else {
      $("#observacion").prop('required',true);
    }
  });

  //Imprimir los registros ya validados
  $("#validados").click(function(){

    var string = "";


    $.ajax({
      url:"../../Controller/ProgramacionAuditoria/Anexo.C.php",
      type:"POST",
      datatype:"json",
      data:{'accion': "seleccionarValidados"},
      success:function(data){
          data = JSON.parse(data);

          if (data.length >= 1) {;

            for (let index = 0; index < data.length; index++) {
              ObtenerObsevacion(data[index][0],index);

              string += "<tr>";
              string += "<td>"+(index+1)+"</td>";
              string += "<td>"+data[index][2]+"</td>";
              string += "<td><a href='#' onclick='ObtenerInfo("+data[index][1]+",1)'>";
              string += "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-arrow-up-square-fill' viewBox='0 0 17 17'>";
              string += "<path fill-rule='evenodd' d='M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z'/>";
              string += "</svg>";
              string += " Informacion de la auditoria";
              string += "</a></td>";
              string += "<td>";
              string += "<span class='badge badge-success'><b>VALIDADO</b></span>";
              string += "</td>";
              string += "<td><a href='"+data[index][4]+"' download='"+NombreArchivo(data[index][4])+"'>";
              string += "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-download' viewBox='0 0 17 17'>";
              string += "<path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>";
              string += "<path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>";
              string += "</svg>";
              string += "</a></td>";
              string += "<td id='imprimir_observacion"+index+"'></td>";
              string += "</tr>";
            }

            $('#modal_validados').html(string);

          } else {
            $('#modal_validados').html("<td colspan='5'>No hay registros.</td>");
          }

        }
      });

      $('#modalValidados').modal('show');


  });

  //Recibe la informacion para crear observaciones y/o validar el anexo
  $('#form_validacion').submit(function(e){
    e.preventDefault();

    cont += 1;

    if(cont==1){

      var id_anexo = $.trim($("#btn_validar").val());

      if ($('#observacion').val() != "") {
        observacion = $.trim($('#observacion').val());
      } else {
        observacion = null;
      }

      let data = {
        'id_anexo':id_anexo,
        'observacion':observacion,
        'accion':"insertar"
      }

      $.ajax({
        url:"../../Controller/ProgramacionAuditoria/Anexo.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
            data = JSON.parse(data);

            if(data==1){
              if( $("#check_validar").is(':checked') ) {
                Validar(id_anexo);
              }
              else{
                Swal.fire({
                  icon:'success',
                  title:'Operacion realizada correctamente!!',
                });
                Limpiar();
                cont = 0;
              }
            }
            else{
              Swal.fire({
                icon:'warning',
                title:'Error en la operacion!!',
              });
            }
        }
      });
    }
    else{
      $("#btn_validar").attr("disabled", true);
    }

  });

});

//Imprimir todos los registros de la tabla anexo
function Seleccionar(){

  var string = "";

  $.ajax({
      url:"../../Controller/ProgramacionAuditoria/Anexo.C.php",
      type:"POST",
      datatype:"json",
      data:{'accion': "seleccionar"},
      success:function(data){
          data = JSON.parse(data);
          if (data.length >= 1) {

              for (let index = 0; index < data.length; index++) {
                  string += "<tr>";
                  string += "<td>"+(index+1)+"</td>";
                  string += "<td>"+data[index][2]+"</td>";
                  string += "<td><a href='#' onclick='ObtenerInfo("+data[index][1]+",0)'>";
                  string += "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-arrow-up-square-fill' viewBox='0 0 17 17'>";
                  string += "<path fill-rule='evenodd' d='M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z'/>";
                  string += "</svg>";
                  string += " Informacion de la auditoria";
                  string += "</a></td>";
                  string += "<td>";
                  if(data[index][3]==0){
                    string += "<span class='badge badge-secondary'><b>SIN VALIDAR</b></span>";
                  }
                  else if(data[index][3]==1){
                    string += "<span class='badge badge-success'><b>VALIDADO</b></span>";
                  }
                  string += "</td>";
                  string += "<td><a href='"+data[index][4]+"' download='"+NombreArchivo(data[index][4])+"'>";
                  string += "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-download' viewBox='0 0 17 17'>";
                  string += "<path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>";
                  string += "<path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>";
                  string += "</svg>";
                  string += "</a></td>";
                  string += "<td>";
                  string += "<button type='button' class='btn btn-primary btn-sm' id='validacion' onclick='ObtenerValidacion("+data[index][0]+");'>Validar</button>";
                  string += "</td>";
                  string += "</tr>";
              }
              $('#tbody').html(string);

          } else {
              $('#tbody').html("<td colspan='8'>No hay registros.</td>");
          }

      }
  });

}

//Funcion para sacar el nombre del archivo del link enviado por parametros
function NombreArchivo(link){
  var array = link.split('/');//Crea un arreglo separandolo por /
  var img = array[array.length - 1];//Obtiene el ultimo campo del arreglo donde esta el nombre del archivo
  return img;
}

//Obtener mas informacion del anexo con su id

function ObtenerInfo(idAuditoria, tipo){

  var string = "";
  var nombre = "";

  $.ajax({
    url:"../../Controller/ProgramacionAuditoria/Anexo.C.php",
    type:"POST",
    datatype:"json",
    data:{'id':idAuditoria,'accion':"seleccionarInformacion"},
    success:function(data){
        data = JSON.parse(data);

        for (let index = 0; index < data.length; index++) {

          nombre = NombreCompleto(data[index][0], data[index][1], data[index][2], data[index][3]);

          string += "<td>"+nombre+"</td>";
          string += "<td>"+data[index][4]+"</td>";
          string += "<td>"+data[index][5]+"</td>";

        }
      if(tipo==1){
        $('#modalValidados').modal('hide');
      }
      $('#modal_Informacion').html(string);

    }
  });

  $('#modalInformacion').modal('show');

}

//abrir el modal de la validacion
function ObtenerValidacion(anexo){

  $('#modalValidacion').modal('show');
  $('#btn_validar').attr("value",anexo);

}

//Funcion para validar el anexo
function Validar(anexo){
  Swal.fire({
    title: '¿Está seguro de validar este anexo?',
    text: "¡Si no lo está, puede cancelar la accíón!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: '¡Si, aceptar!'
  }).then((result) => {
    if (result.isConfirmed){//confirmacion para proceder a la validacion
      $.ajax({
        url:"../../Controller/ProgramacionAuditoria/Anexo.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion':"editar",'id_anexo':anexo},
        success:function(data){
            data = JSON.parse(data);

            if(data==1){
              Limpiar();
              Seleccionar();
              Swal.fire({
                icon:'success',
                title:'Operacion realizada correctamente!!',
              });
              cont = 0;
            }
            else{
              Swal.fire({
                icon:'warning',
                title:'Error en la operacion!!',
              });
            }
        }

      });
    }
    else{
      Swal.fire({
        icon:'warning',
        title:'No se realizo la operacion!!',
      });
    }
  });
}


//Obtener las observaciones de los anexos validados
function ObtenerObsevacion(anexo,cont){

  var string = "";
  var etiqueta = '#imprimir_observacion'+cont;

  $.ajax({
    url:"../../Controller/ProgramacionAuditoria/Anexo.C.php",
    type:"POST",
    datatype:"json",
    data:{'accion': "seleccionarObservacion", 'id_anexo':anexo},
    success:function(data){
      data = JSON.parse(data);

      for (let index = 0; index < data.length; index++) {

        string += (index+1)+". "+data[index][0]+"<br>";

      }

      $(etiqueta).html(string);

    }
  });

}

//Funcion para limpiar los inputs despues de ralizar una accion
function Limpiar(){

  $("#modalValidacion").modal('hide');
  $("#check_validar").prop("checked",false);
  $("#observacion").val("");

}

//Buscador por nombre de anexo
$('#buscador').keyup(function (e) {
  e.preventDefault();

  if($('#texto').val()!="" && $('#texto').val()!=null){
    var string = "";

    // En data se trae el valor ingresado en la visa
    let data = {
        'texto': $('#texto').val(),
        'accion':"buscar"
    };

    $.ajax({
        url:"../../Controller/ProgramacionAuditoria/Anexo.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
            data = JSON.parse(data);
            if (data.length >= 1) {

                for (let index = 0; index < data.length; index++) {
                    string += "<tr>";
                    string += "<td>"+(index+1)+"</td>";
                    string += "<td>"+data[index][2]+"</td>";
                    string += "<td><a href='#' onclick='ObtenerInfo("+data[index][1]+",0)'>";
                    string += "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-arrow-up-square-fill' viewBox='0 0 17 17'>";
                    string += "<path fill-rule='evenodd' d='M8 10a.5.5 0 0 0 .5-.5V3.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 3.707V9.5a.5.5 0 0 0 .5.5zm-7 2.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z'/>";
                    string += "</svg>";
                    string += " Informacion de la auditoria";
                    string += "</a></td>";
                    string += "<td>";
                    if(data[index][3]==0){
                      string += "<span class='badge badge-secondary'><b>SIN VALIDAR</b></span>";
                    }
                    else if(data[index][3]==1){
                      string += "<span class='badge badge-success'><b>VALIDADO</b></span>";
                    }
                    string += "</td>";
                    string += "<td><a href='"+data[index][4]+"' download='"+NombreArchivo(data[index][4])+"'>";
                    string += "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-download' viewBox='0 0 17 17'>";
                    string += "<path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>";
                    string += "<path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>";
                    string += "</svg>";
                    string += "</a></td>";
                    string += "<td>";
                    string += "<button type='button' class='btn btn-primary btn-sm' id='validacion' onclick='ObtenerValidacion("+data[index][0]+");'>Validar</button>";
                    string += "</td>";
                    string += "</tr>";
                }
                $('#tbody').html(string);

            } else {
                $('#tbody').html("<td colspan='8'>No hay registros.</td>");
            }

        }
    });
  }
  else{
    Seleccionar();
  }
});

