$(document).ready(function() {
  $.ajax({
    url: "../../../Controller/Hallazgo/HallazgoAuditor/HallazgoProgramada.C.php",
    type: 'POST',
    datatype: 'JSON',
    success: function(data){
      data = JSON.parse(data);

      var table;
      for (let i = 0; i < data.length; i++) {
        table += "<tr>"+
              "<td>"+data[i][1]+"</td>"+
              "<td>"+mes(data[i][3])+"</td>"+
              "<td><button class='btn btn-primary' type='button'  onclick='iniciar("+data[i][0]+");'>Seguir</button></td>"+
            "</tr>";
      }

      $('tbody').append(table);
    }
  });

  function mes(num){
    var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    return meses[num-1];
  }
});

function iniciar(id){
  sessionStorage.Id = id; //identificador de la auditoria para utilizar en los hallazgos

  $(location).attr('href',"Hallazgo.php");
}
