$(document).ready(function() {
  mostrar();

});

function mostrar(){
  $('tbody').empty();

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
            tabla += "<td>Validado</td>";

          }else{
            tabla += "<td>No Validado</td>";
          }

          if (data[i][4] != null) {
            tabla += "<td>"+data[i][4]+"</td>";

          }else{
            tabla += "<td></td>";
          }

          if (data[i][5] != null) {
            tabla += "<td>"+data[i][5]+"</td>";

          }else{
            tabla += "<td></td>";
          }

          if (data[i][6] != null) {
            tabla += "<td><a href=''>Ver mas...</a></td>";

          }else{
            tabla += "<td></td>";
          }

        tabla +="</tr>";

      }
      $('tbody').append(tabla);
    }
  });
}

$('#formArchivo').submit(function (e) {
  e.preventDefault();

  var archivo = $("#subirArchivo")[0].files[0];
  fileType =  archivo.type;
  fileSize =  archivo.size;

  var formData = new FormData();
  formData.append('archivo', archivo);
  formData.append('id_auditoria',sessionStorage.Id);
  formData.append('accion', 'insertar');

  /**
   * Valido la extencion del archivo
   */
  var exten = fileType.substring(fileType.lastIndexOf("/"));
  if(exten=='/jpg' || exten=='/jpeg' || exten=='/png' || exten=='/doc' || exten=='/docx' || exten=='/xls' ||
    exten=='/xlsx' || exten=='/ppt' || exten=='/pptx' || exten=='/pptm' || exten=='/pdf' || exten=='/xml' ||
    exten=='/mp4' || exten=='/txt' || exten=='/wmv' || exten=='/zip' || exten=='/rar'){

      if(fileSize < 21000000){  //Valido el tamaño del archivo

        $.ajax({
          url: '../../Controller/Auditoria/Auditoria.C.php',
          type: 'POST',
          datatype: 'JSON',
          data: formData,
          contentType:false,
          processData:false,
          success: function(data) {
            console.log(data);
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

$('#subirArchivoModal').on('click', function() {
  $('.modal').modal('show');
})

$('#cerrarModal').on('click', function() {
  $('.modal').modal('hide');
})

$('#desactivar').on('click', function () {
  document.querySelectorAll('[name=validacion]').forEach((x) => x.checked=false);
});
