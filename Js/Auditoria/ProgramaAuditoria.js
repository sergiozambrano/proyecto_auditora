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
          conts += "<button class='btn btn-secondary' value='' type='button' disabled>Iniciar</button>";

        }else if(data[i]['fecha'] == mesActual && data[i]['estado_auditoria'] == 'Programada'){
          conts += "<button class='btn btn-success' type='button' onclick='btn("+data[i]['id_auditoria']+",1);'>Iniciar</button>";

        }else if(data[i]['fecha'] == mesActual && data[i]['estado_auditoria'] == 'En proceso'){
          conts += "<button class='btn btn-primary' type='button'  onclick='btn("+data[i]['id_auditoria']+",2);'>Seguir</button>";
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

function btn(id, estado){
  sessionStorage.Id = id;

  if (estado == 1) {
    $.ajax({
      url: "../../Controller/Auditoria/ProgramaAuditoria.C.php",
      type: 'POST',
      data: {id: id},
      datatype: 'JSON',
      success: function(data){
        data = JSON.parse(data);

        if(data == 1){
          $(location).attr('href',"Auditoria.php");

        }else if(data == 2){
          Swal.fire({
            type:'error',
            title:'Error. Contacte al administrador',
          });
        }
      }
    });

  }else {
    $(location).attr('href',"Auditoria.php");
  }
}
