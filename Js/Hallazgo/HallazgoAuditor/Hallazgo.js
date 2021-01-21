$(document).ready(function(){
  mostrar();
});

function mostrar(obj=null) {
  $('#tbodyHallazgo').empty();

  if (obj == null) {
    $.ajax({
      url: '../../../Controller/Hallazgo/HallazgoAuditor/Hallazgo.C.php',
      type: 'POST',
      datatype: 'JSON',
      data: {'id_auditoria': sessionStorage.Id},
      success: function(data) {
        data = JSON.parse(data);

        var tabla;
        for (let i = 0; i < data.length; i++) {
          tabla += "<tr>"+
              "<td>"+(i+1)+"</td>"+
              "<td><button type='button' class='btn btn-link' onclick='verHallazgo("+data[i][0]+")'>"+data[i][2]+"</button></td>";

          if(data[i][3] != null){
            tabla += "<td>"+data[i][3]+"</td>";

          }else{
            tabla += "<td></td>";
          }

          if (data[i][4] != null) {
            tabla += "<td><a href='"+data[i][4]+"' download='"+NombreArchivo(data[i][4])+"'><i class='fas fa-arrow-down'></i></a></td>";

          }else{
            tabla += "<td></td>";
          }

          if (data[i][5] == 'Abierto') {
            tabla += "<td class='text-center'><span class='badge badge-success'>"+data[i][5]+"</span></td>";

          }else if(data[i][5] == 'Sin avance'){
            tabla += "<td class='text-center'><span class='badge badge-warning'>"+data[i][5]+"</span></td>";

          }else if(data[i][5] == 'Cerrado'){
            tabla += "<td class='text-center'><span class='badge bg-light text-dark'>"+data[i][5]+"</span></td>";

          }else if(data[i][5] == 'Vencido'){
            tabla += "<td class='text-center'><span class='badge badge-dark'>"+data[i][5]+"</span></td>";

          }else{
            tabla += "<td></td>";
          }

          tabla += "<td><button type='button' class='btn btn-primary' onclick='planMejoramiento("+data[i][1]+")'>Validar</button></td>"+
                  "</tr>";

        }
        $('#tbodyHallazgo').html(tabla);
      }
    });
  }else{

    $.ajax({
      url: '../../../Controller/Hallazgo/HallazgoAuditor/Hallazgo.C.php',
      type: 'POST',
      datatype: 'JSON',
      data: obj,
      success: function(data) {
        data = JSON.parse(data);

        var tabla;
        for (let i = 0; i < data.length; i++) {
          tabla += "<tr>"+
              "<td>"+(i+1)+"</td>"+
              "<td><button type='button' class='btn btn-link' onclick='verHallazgo("+data[i][0]+")'>"+data[i][2]+"</button></td>";

          if(data[i][3] != null){
            tabla += "<td>"+data[i][3]+"</td>";

          }else{
            tabla += "<td></td>";
          }

          if (data[i][4] != null) {
            tabla += "<td><a href='"+data[i][4]+"' download='"+NombreArchivo(data[i][4])+"'><i class='fas fa-arrow-down'></i></a></td>";

          }else{
            tabla += "<td></td>";
          }

          if (data[i][5] == 'Abierto') {
            tabla += "<td class='text-center'><span class='badge badge-success'>"+data[i][5]+"</span></td>";

          }else if(data[i][5] == 'Sin avance'){
            tabla += "<td class='text-center'><span class='badge badge-warning'>"+data[i][5]+"</span></td>";

          }else if(data[i][5] == 'Cerrado'){
            tabla += "<td class='text-center'><span class='badge badge-danger'>"+data[i][5]+"</span></td>";

          }else if(data[i][5] == 'Vencido'){
            tabla += "<td class='text-center'><span class='badge badge-dark'>"+data[i][5]+"</span></td>";

          }else{
            tabla += "<td></td>";
          }

          tabla += "<td><button type='button' class='btn btn-primary' onclick='planMejoramiento("+data[i][1]+")'>Validar</button></td>"+
                  "</tr>";
        }
        $('#tbodyHallazgo').html(tabla);
      }
    });
  }
}

function crearHallazgo() {
  data = {
    'temaHallazgo': $('#crearTemaHallazgo').val(),
    'acciones': $('#crearAccionHAllazgo').val(),
    'aspectoMejora': $('#crearAspectoHallazgo').val(),
  }

  if (data['temaHallazgo']!='',data['acciones']!='',data['aspectoMejora']!='') {
    var archivo = $("#evidenciaHallazgo")[0].files[0];
    fileSize = archivo.size;
    fileName = archivo.name;

    var formData = new FormData();
    formData.append('archivo', archivo);
    formData.append('id_auditoria', sessionStorage.Id);
    formData.append('temaHallazgo', data['temaHallazgo']);
    formData.append('acciones', data['acciones']);
    formData.append('aspectoMejora', data['aspectoMejora']);
    formData.append('accion', 'insertar');

    /**
     * Validacion del tipo y tamaño del archivo
     */
    var exten = fileName.substring(fileName.lastIndexOf("."));
    if(exten=='.jpg' || exten=='.jpeg' || exten=='.png' || exten=='.doc' || exten=='.docx' || exten=='.xls' ||
      exten=='.xlsx' || exten=='.ppt' || exten=='.pptx' || exten=='.pptm' || exten=='.pdf' || exten=='.xml' ||
      exten=='.mp4' || exten=='.txt' || exten=='.wmv' || exten=='.zip' || exten=='.rar'){

        if(fileSize < 21000000){  //Valido el tamaño del archivo

          $.ajax({
            url: '../../../Controller/Hallazgo/HallazgoAuditor/Hallazgo.C.php',
            type: 'POST',
            datatype: 'JSON',
            data: formData,
            contentType:false,
            processData:false,
            success: function(data) {
              if (data == 1) {
                cerrarModal();

                Swal.fire({
                  type:'success',
                  title: 'Documento guardado satisfactoriamente',
                });

                mostrar();
              }else if(data == 2){
                Swal.fire({
                  type:'warning',
                  title: 'La evidencia a guardad ya se encuentra guardad',
                });

              }else{
                Swal.fire({
                  type:'error',
                  title:'El documento deseado no se pudo guardar',
                });
              }
            }
          });
        }else{
          Swal.fire({
            type:'error',
            title:'El tamaño del archivo no es valido para ser cargado',
          });
        }
    }else{
      Swal.fire({
        type:'error',
        title:'El tipo de archivo no es valido para ser cargado',
      });
    }
  }else{
    Swal.fire({
      type:'error',
      title:'Todos los campos son requeridos',
    });
  }

}

function abrirModalCrearHallazgo() {
  $('#hallazgoModal').modal('show');
}

function verHallazgo(id_hallazgo){
  $('#verHallazgoModal').modal('show');

  data = {
    'accion': 'verHallazgo',
    'id_hallazgo':id_hallazgo
  }

  $.ajax({
    url: '../../../Controller/Hallazgo/HallazgoAuditor/Hallazgo.C.php',
    type: 'POST',
    datatype: 'JSON',
    data: data,
    success: function(data) {
      data = JSON.parse(data);

      $('#temaHallazgo').val(data[3]);
      $('#fecha').val(data[2]);
      $('#aspectoMejora').val(data[4]);
      $('#acciones').val(data[5]);
      $('#ruta').attr('href','../'+data[6]);
      $('#ruta').attr('download', NombreArchivo(data[6]));
    }
  });
}

function planMejoramiento(id_plan){
  $('#planMejoramientoModal').modal('show');

  data = {
    'accion': 'verEstoPlan',
    'id_planMejoramiento': id_plan
  }

  localStorage.Id_planMejoramiento = id_plan;

  $.ajax({
    url: '../../../Controller/Hallazgo/HallazgoAuditor/Hallazgo.C.php',
    type: 'POST',
    datatype: 'JSON',
    data: data,
    success: function(data) {
      data = JSON.parse(data);

      $("select#estadoPlanMejoramiento option[value='"+data+"']").attr("selected",true);

    }
  });
}

function prorrogas(){
  $('#prorrogasModal').modal('show');
  $('#tbodyProrroga').empty();

  data = {
    'id_auditoria': sessionStorage.Id,
    'accion': 'verProrroga'
  }

  $.ajax({
    url: '../../../Controller/Hallazgo/HallazgoAuditor/Hallazgo.C.php',
    type: 'POST',
    datatype: 'JSON',
    data: data,
    success: function(data) {
      data = JSON.parse(data);

      var tabla;
      for (let i = 0; i < data.length; i++) {
        tabla += "<tr>"+
                  "<td>"+(i+1)+"</td>"+
                  "<td>"+data[i][0]+"</td>"+
                  "<td>"+data[i][1]+"</td>"+
                  "<td><select id='selectProrroga'>"+
                        "<option value='0'>No valido</option>"+
                        "<option value='1'>Validado</option>"+
                      "</select>"+
                  "</td>"+
                  "<td><textarea id='observacion' class=form-control>"+data[i][3]+"</textarea></td>"+
                  "<td><button type='button' class='btn btn-primary' onclick='editarProrroga("+data[i][4]+")'>Editar</button></td>"+
                  "</tr>";
      }
      $('#tbodyProrroga').append(tabla);
    }
  });
}

function editarProrroga(id_prorroga){
  data = {
    'accion': 'editarProrroga',
    'id_prorroga': id_prorroga,
    'estado': $('select#selectProrroga option:Selected').val(),
    'obervacion': $('#observacion').val()
  }

  $.ajax({
    url: '../../../Controller/Hallazgo/HallazgoAuditor/Hallazgo.C.php',
    type: 'POST',
    datatype: 'JSON',
    data: data,
    success: function(data) {
      data = JSON.parse(data);

      if(data == 1){
        cerrarModal();

        Swal.fire({
          type:'success',
          title:'Los datos se modificaron correctamente',
        });
      }else if(data == 0){
        Swal.fire({
          type:'error',
          title:'Error al guardar los datos',
        });
      }
    }
  });

}

function cerrarModal() {
  $('.modal').modal('hide');
}

$('select#estadoPlanMejoramiento').change(function() {
  data = {
    'accion': 'cambiarEstadoPlan',
    'estado': $('select#estadoPlanMejoramiento option:selected').val(),
    'id_planMejoramiento': localStorage.Id_planMejoramiento
  };

  $.ajax({
    url: '../../../Controller/Hallazgo/HallazgoAuditor/Hallazgo.C.php',
    type: 'POST',
    datatype: 'JSON',
    data: data,
    success: function(data) {
      data = JSON.parse(data);

      if (data == 1) {
        cerrarModal();

        Swal.fire({
          type:'success',
          title: 'Estado modificado satisfactoriamente',
        });
        mostrar();

      } else if(data == 2){
        Swal.fire({
          type:'error',
          title: 'Error al modificar el estado del plan de mejoramiento',
        });
      }
    }
  });
});

$('#valorBuscador').keyup(function() {
  data = {
    'id_auditoria': sessionStorage.Id,
    'buscar': $('select#selecBuscador option:Selected').val(),
    'valor': $('#valorBuscador').val(),
    'accion': 'buscarHallazgo'
  };

  if(data['valor'] == ''){
    mostrar();

  }else{
    mostrar(data);
  }
});
