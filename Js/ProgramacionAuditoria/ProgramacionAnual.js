$(document).ready(function (e){

    var string="";
    var fechaMayor;
    //Funciona para solo imprimir las fechas de los registros sin repetirse
    $.ajax({
        url:"../../Controller/ProgramacionAuditoria/ProgramacionAnual.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar"},
        success:function(data){
            data = JSON.parse(data);
            console.log(data);
            if (data.length >= 1) {

                fechaMayor = data[data.length-1]; //Cojer la fecha mayor del arreglo traido de la base de datos

                for (let index = 0; index < data.length; index++) {

                    string += "<button type='button' class='list-group-item list-group-item-action' onclick='Redireccionar("+data[index]+");'>"+data[index]+"</button>";

                }

                //Condicional y funcion para saber si el año mayor del registro es igual o no al año actual, 1 = igual, 2 = no es igual
                if(ObtenerFecha(fechaMayor) == 2){
                    //Si el año mayor del arreglo no es igual a la fecha actual crea un boton con la fecha actual y como si fuese una nueva programacion de auditoria
                    string += "<button type='button' class='list-group-item list-group-item-action' onclick='Redireccionar("+ObtenerFecha()+");'>"+ObtenerFecha()+" <span class='badge badge-secondary'>Nuevo</span></button>"
                }

                $('#contenedor').append(string);

            } else {
                $('#contenedor').append("<button type='button' class='list-group-item list-group-item-action' onclick='Redireccionar("+ObtenerFecha()+");'>"+ObtenerFecha()+" <span class='badge badge-secondary'>Nuevo</span></button>");
            }

        }
    });

});

function Redireccionar(fecha){
    window.location="Programaciones.php?fecha="+fecha;
}
