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

          tabla += "<td><a href='"+data[i][4]+"' download='"+data[i]+"'><i class='fas fa-arrow-down'></i></a></td>"+
                    "<td><button type='button' class='btn btn-primary' onclick='planMejoramiento("+data[i][1]+")'>Validar</button></td>"+
              "</tr>";

        }
        $('#tbodyHallazgo').append(tabla);
      }
    });
  }
}

function verHallazgo(){
  $('#verHallazgoModal').modal('show');
}

function planMejoramiento(){
  $('#planMejoramientoModal').modal('show');
}

function prorrogas(){
  $('#prorrogasModal').modal('show');
}

function crearHallazgo() {
  $('#hallazgoModal').modal('show');
}

function cerrarModal() {
  $('.modal').modal('hide');
}
