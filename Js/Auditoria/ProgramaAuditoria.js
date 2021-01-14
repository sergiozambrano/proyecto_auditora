$(document).ready(function(){
  $.ajax({
    url: "../../Controller/Auditoria/ProgramaAuditoria.C.php",
    type: 'POST',
    datatype: 'JSON',
    success: function(data){
      data = JSON.parse(data);

      var d = new Date();
      var mesActual = d.getMonth()+1;

      var conts;
      for (let i = 0; i < data.length; i++) {
        conts += "<tr>"+
                    "<td>"+
                      "<p>"+data[i]['nombre_unidad']+"</p>"+
                    "</td>"+
                    "<td>"+mes(data[i]['fecha'])+"</td>"+
                    "<td>";

        if (data[i]['fecha'] != mesActual && data[i]['estado_auditoria'] == 'Programada') {
          conts += "<a class='btn btn-secondary' href=''>Inicializar</a>";

        }else if(data[i]['fecha'] == mesActual && data[i]['estado_auditoria'] == 'Programada'){
          conts += "<a class='btn btn-success' href='Auditoria.html?"+data[i]['id_auditoria']+"'>Inicializar</a>";

        }else if(data[i]['fecha'] == mesActual && data[i]['estado_auditoria'] == 'En proceso'){
          conts += "<a class='btn btn-primary' href='Auditoria.html?"+data[i]['id_auditoria']+"'>seguir</a>";
        }

        conts +=    "</td>"+
                  "</tr>";

      }

      $('tbody').append(conts);

    }
  });

  function mes(num){
    var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    return meses[num-1];
  }
});
