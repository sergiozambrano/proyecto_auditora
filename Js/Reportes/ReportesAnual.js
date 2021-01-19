$(document).ready(function (e){

    var string="";
    var fechaMayor;
    //Funciona para solo imprimir las fechas de los registros sin repetirse
    $.ajax({
        url:"../../Controller/Reportes/Reportes.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "filtro"},
        success:function(data){
            data = JSON.parse(data);

            //Cojer la fecha mayor del arreglo traido de la base de datos
            for (let index = 0; index < data.length; index++) {

                string += "<button type='button' class='list-group-item list-group-item-action' onclick='Redireccionar("+data[index]+");'>"+data[index]+"</button>";
            }

            //Condicional y funcion para saber si el año mayor del registro es igual o no al año actual, 1 = igual, 2 = no es igual
            $('#reporte').append(string);
        }
    });

});

function Redireccionar(fecha){
    window.location="Reportes.php?fecha="+fecha;
}
