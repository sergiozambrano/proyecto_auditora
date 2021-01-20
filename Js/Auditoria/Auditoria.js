$(document).ready(function() {
  mostrar();

});

function mostrar(obj=null, buscar=null){
  $('#tbody').empty();

  if(obj == null){
    $.ajax({
      url: '../../Controller/Auditoria/Auditoria.C.php',
      type: 'POST',
      datatype: 'JSON',
      success: function(data) {
        data = JSON.parse(data);

        var tabla;
        for (let i = 0; i < data.length; i++) {
          tabla +=
            "<tr>"+
            "<td>"+(i+1)+"</td>"+
            "<td>"+data[i][1]+"</td>";

            if(data[i][2] == 1){
              tabla += "<td><span class='badge badge-success'>Validado</span></td>";

            }else{
              tabla += "<td><span class='badge badge-danger'>No validado</span></td>";
            }

            if (data[i][4] != null) {
              coordinador(data[i][4], (i+1));
              tabla += "<td id='"+(i+1)+"'></td>";

            }else{
              tabla += "<td></td>";
            }

            if (data[i][5] != null) {
              tabla += "<td>"+data[i][5]+"</td>";

            }else{
              tabla += "<td></td>";
            }

            if (data[i][6] != null) {
              tabla += "<td><button type='button' class='btn btn-link' onclick='observacion("+data[i][0]+")'>"+
                          "Ver más..."+
                        "</button></td>";

            }else{
              tabla += "<td></td>";
            }

            tabla += "<td class='text-center'><a href='"+data[i][3]+"' download='"+data[i][1]+"'>"+
                        "<i class='fas fa-arrow-down'></i></a></td>"+
                    "</tr>";
        }
        $('#tbody').append(tabla);
      }
    });
  }else{
    if (buscar == 'validar') {
      data = {
        'valor': parseInt(obj),
        'accion': 'validacion'
      }

      $.ajax({
        url: '../../Controller/Auditoria/Auditoria.C.php',
        type: 'POST',
        datatype: 'JSON',
        data: data,
        success: function(data) {
          data = JSON.parse(data);

          var tabla;
          for (let i = 0; i < data.length; i++) {
            tabla +=
              "<tr>"+
                "<td>"+(i+1)+"</td>"+
                "<td>"+data[i][1]+"</td>";

              if(data[i][2] == 1){
                tabla += "<td><span class='badge badge-success'>Validado</span></td>";

              }else{
                tabla += "<td><span class='badge badge-danger'>No validado</span></td>";
              }

              if (data[i][4] != null) {
                coordinador(data[i][4], (i+1));
                tabla += "<td id='"+(i+1)+"'></td>";

              }else{
                tabla += "<td></td>";
              }

              if (data[i][5] != null) {
                tabla += "<td>"+data[i][5]+"</td>";

              }else{
                tabla += "<td></td>";
              }

              if (data[i][6] != null) {
                tabla += "<td><button type='button' class='btn btn-link' onclick='observacion("+data[i][0]+")'>"+
                            "Ver más..."+
                          "</button></td>";

              }else{
                tabla += "<td></td>";
              }

            tabla += "<td class='text-center'><a href='"+data[i][3]+"' download='"+data[i][1]+"'>"+
                        "<i class='fas fa-arrow-down'></i></a></td>"+
                    "</tr>";
          }
          $('#tbody').append(tabla);
        }
      });

    }else if(buscar == 'buscador'){
      data = {
        'valor': obj,
        'accion': 'buscar'
      }

      $.ajax({
        url: '../../Controller/Auditoria/Auditoria.C.php',
        type: 'POST',
        datatype: 'JSON',
        data: data,
        success: function(data) {
          data = JSON.parse(data);

          var tabla;
          for (let i = 0; i < data.length; i++) {
            tabla +=
              "<tr>"+
                "<td>"+(i+1)+"</td>"+
                "<td>"+data[i][1]+"</td>";

              if(data[i][2] == 1){
                tabla += "<td><span class='badge badge-success'>Validado</span></td>";

              }else{
                tabla += "<td><span class='badge badge-danger'>No validado</span></td>";
              }

              if (data[i][4] != null) {
                coordinador(data[i][4], (i+1));
                tabla += "<td id='"+(i+1)+"'></td>";

              }else{
                tabla += "<td></td>";
              }

              if (data[i][5] != null) {
                tabla += "<td>"+data[i][5]+"</td>";

              }else{
                tabla += "<td></td>";
              }

              if (data[i][6] != null) {
                tabla += "<td><button type='button' class='btn btn-link' onclick='observacion("+data[i][0]+")'>"+
                            "Ver más..."+
                          "</button></td>";

              }else{
                tabla += "<td></td>";
              }

            tabla += "<td class='text-center'><a href='"+data[i][3]+"' download='"+data[i][1]+"'>"+
                        "<i class='fas fa-arrow-down'></i></a></td>"+
                    "</tr>";
          }
          $('#tbody').append(tabla);
        }
      });
    }

  }
}

function observacion(id) {
  $('#observacionModal').modal('show');

  data = {
    'id': id,
    'accion': 'observacion'
  }

  $.ajax({
    url:'../../Controller/Auditoria/Auditoria.C.php',
    type:'POST',
    datatype:'JSON',
    data: data,
    success: function(data){
      data = JSON.parse(data);

      $('#observacionBody').text(data[0]);
    }
  });

}

function cerrarModal() {
  $('.modal').modal('hide');
}

function subirArchivo() {
  $('#subirArchivoModal').modal('show');
}

function coordinador(id, idTd){
  data = {
    'idUsuVal': id,
    'accion': 'nombreCoordinador'
  }

  $.ajax({
    url: '../../Controller/Auditoria/Auditoria.C.php',
    type: 'POST',
    datatype: 'JSON',
    data: data,
    success: function(data) {
      data = JSON.parse(data);

      for (let i = 0; i < data.length; i++) {
        var td = "#"+idTd;
        $(td).append(data[i]+' ');
      }
    }
  });
}

$('#formArchivo').submit(function (e) {
  e.preventDefault();

  var archivo = $("#subirArchivo")[0].files[0];
  fileType = archivo.type;
  fileSize = archivo.size;
  fileName = archivo.name;

  var formData = new FormData();
  formData.append('archivo', archivo);
  formData.append('id_auditoria',sessionStorage.Id);
  formData.append('accion', 'insertar');

  /**
   * Valido la extencion del archivo
   */

  var exten = fileName.substring(fileName.lastIndexOf("."));
  if(exten=='.jpg' || exten=='.jpeg' || exten=='.png' || exten=='.doc' || exten=='.docx' || exten=='.xls' ||
    exten=='.xlsx' || exten=='.ppt' || exten=='.pptx' || exten=='.pptm' || exten=='.pdf' || exten=='.xml' ||
    exten=='.mp4' || exten=='.txt' || exten=='.wmv' || exten=='.zip' || exten=='.rar'){

      if(fileSize < 21000000){  //Valido el tamaño del archivo

        $.ajax({
          url: '../../Controller/Auditoria/Auditoria.C.php',
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
});

$('#desactivar').on('click', function () {
  document.querySelectorAll('[name=validacion]').forEach((x) => x.checked=false);
  mostrar();
});

$('input:radio[name=validacion]').change(function() {
  $('#valorBuscador').empty();
  mostrar($('input:radio[name=validacion]:checked').val(), 'validar');
});

$('#valorBuscador').keyup(function() {
  data = {
    'buscar': $('select#selecBuscador option:Selected').val(),
    'valor': $('#valorBuscador').val(),
    'opcion': $('input:radio[name=validacion]:checked').val() || null
  };

  if(data['valor'] == ''){

    if ($('input:radio[name=validacion]:checked').val() != null) {
      mostrar($('input:radio[name=validacion]:checked').val(), 'validar');

    }else{
      mostrar();
    }
  }else{
    mostrar(data, 'buscador');
  }
});

function info(){
  $('#info').modal('show');

  data = {
    'id': sessionStorage.Id,
    'accion': 'info'
  }

  $.ajax({
    url: '../../Controller/Auditoria/Auditoria.C.php',
    type: 'POST',
    datatype: 'JSON',
    data: data,
    success: function(data) {
      data = JSON.parse(data);

      console.log(data);

      $('#tipoAuditoria').val(data[0][0]);
      $('#fecha').val(data[0][1]);
      $('#encargadoArea').val(data[1][0]+" "+data[1][1]);
      $('#observacion').val(data[0][3]);
    }
  });
}
