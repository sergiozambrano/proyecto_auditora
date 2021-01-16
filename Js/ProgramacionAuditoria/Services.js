/*JS para funciones que reutilizo*/

//Funcion para solo obterner el año y el mes de los registros de la BD tipo DATE

function FechaProgramacion(fecha){
    var resultado = fecha.split("-");
    return resultado[0]+"-"+resultado[1];
}

//Funcion para obtener la fecha actual y validar la fecha traida por GET

function ObtenerFecha(fecha){
    var date = new Date();
    var anoAcual = date.getFullYear();
    var resultado;

    if(fecha!="-undefined" && fecha!="" && fecha!=null){
        if(anoAcual==fecha){
            resultado=1;
        }
        else{
            resultado=2;
        }
    }
    else{
        resultado=anoAcual;
    }

    return resultado;
}

//Unir el nombre completo del usuario

function NombreCompleto(primerNombre, segundoNombre, primerApellido, segundoApellido){
    var nombre = "";
    if (segundoNombre == null) {
        nombre = primerNombre+" "+primerApellido+" "+segundoApellido;
    }
    else{
        nombre = primerNombre+" "+segundoNombre+" "+primerApellido+" "+segundoApellido;
    }
    return nombre;
}

//Funcion para traer variables tipo GET

function ObtenerVariableGET(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}