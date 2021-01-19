var cont = 0; /*Contador para que que se envien la peticion con datos y los guarde al mismo tiempo y que no se envie dos peticiones al mismo tiempo*/
//funciones al cargarse la pagina

$(document).ready(function (e){

    Seleccionar();/*Ejecutar la funcion de imprimir todos los daos de la tabla programacion de auditoria*/

    $("#ano").append(FechaValidar());/*Imprime la fecha correspondiente de la programacion de auditoria en el titulo*/

    ConsultarUsuarioArea(null);/*Ejecutar la funcion de imprimir los datos de las tablas usuario y areas, mandando como parametro el formulario*/

    BloquearFechas();/*Ejecutar la funcion de bloquear un determinado rango de meses segun el año*/

    //Funcion para guardar nuevos registros de programacion de auditoria

    $('#form').submit(function(e){
      e.preventDefault();

      cont += 1;

      //condicional para que solo se realize la operacion cuando el contador global es 1
      if(cont==1){
        if($('#id_area').val() != "" && $('#id_auditor').val() != "" && $('#tipo_auditoria').val() != "" && $('#fecha_pro_au').val() != ""){

          var observacion;

          //Condicional para saber si no envia nada de observacion y enviar el dato como null
          if ($('#observacion').val() != "") {
              observacion = $.trim($('#observacion').val());
          } else {
              observacion = null;
          }

          //Arreglo a enviar
          let data = {
              'area':$.trim($('#id_area').val()),
              'auditor':$.trim($('#id_auditor').val()),
              'tipo_auditoria':$.trim($('#tipo_auditoria').val()),
              'fecha_programada':$.trim($('#fecha_pro_au').val()+"-01"),
              'observacion':observacion,
              'accion': "insertar"
          }
          //Enviar los datos al php para ejecutar la operacion
          $.ajax({
              url:"../../Controller/ProgramacionAuditoria/ProgramacionAuditoria.C.php",
              type:"POST",
              datatype:"json",
              data:data,
              success:function(data){
                cont = 0; /*Volver a 0 el contador global*/
                //Respuesta de la operacion 1 = se guardo correctamente, 2 = error al guardar.
                if (data == 1) {
                    $('#modalAgregar').modal('hide');
                    Swal.fire({
                        icon:'success',
                        title:'Datos ingresados correctamente!!',
                    });
                    Seleccionar();
                    Limpiar("Create");
                }else if(data == 2){
                    Swal.fire({
                        icon:'warning',
                        title:'Error al enviar los datos!!',
                    });
                }
                else{
                    Swal.fire({
                        icon:'error',
                        title:'Error del sistema!!\nContactese con el administrador',
                    });
                }
              }
          });

        } else{

            Swal.fire({
                icon:'warning',
                title:'Debe ingresar todos los datos!!',
            });
            return false;
        }
      }
      else{
        $("#btn_agregar").attr("disabled", true);
      }
    });

    //Funcion para editar registros de programacion de auditoria

    $('#form_edit').submit(function(e){
      e.preventDefault();

      cont += 1;

      //condicional para que solo se realize la operacion cuando el contador global es 1
      if(cont==1){

        //Verificar si los datos importantes estan
        if($('#id_area_edit').val() != "" && $('#id_auditor_edit').val() != "" && $('#tipo_auditoria_edit').val() != "" && $('#fecha_pro_au_edit').val() != ""){

            var observacion;

            //Condicional para saber si no envia nada de observacion y enviar el dato como null
            if ($('#observacion_edit').val() != "") {
                observacion = $.trim($('#observacion_edit').val());
            } else {
                observacion = null;
            }

            //Arreglo a enviar
            let data = {
                'area':$.trim($('#id_area_edit').val()),
                'auditor':$.trim($('#id_auditor_edit').val()),
                'tipo_auditoria':$.trim($('#tipo_auditoria_edit').val()),
                'fecha_programada':$.trim($('#fecha_pro_au_edit').val()+"-01"),
                'observacion':observacion,
                'programacion_auditoria':$.trim($('#input_id').val()),
                'accion': "editar"
            }
            //Enviar los datos al php para ejecutar la operacion
            $.ajax({
                url:"../../Controller/ProgramacionAuditoria/ProgramacionAuditoria.C.php",
                type:"POST",
                datatype:"json",
                data:data,
                success:function(data){
                  cont = 0; /*Volver a 0 el contador global*/
                  //Respuesta de la operacion 1 = se modifico correctamente, 2 = error al modificar.
                  if (data == 1) {
                      $('#modalEditar').modal('hide');
                      Swal.fire({
                          icon:'success',
                          title:'Datos modificados correctamente!!',
                      });
                      Seleccionar();
                      Limpiar("Edit");
                  }else if(data == 2){
                      Swal.fire({
                          icon:'warning',
                          title:'Error al modificar los datos los datos!!',
                      });
                  }
                  else{
                      Swal.fire({
                          icon:'error',
                          title:'Error del sistema!!\nContactese con el administrador',
                      });
                  }
                }
            });

        } else{

            Swal.fire({
                icon:'warning',
                title:'Debe ingresar todos los datos!!',
            });
            return false;
        }
      }
      else{
        $("#btn_editar").attr("disabled", true);
      }
    });

    /*
    *Funciones de jQuery

    *Consultar meses disponibles del auditor y del area
    */

    //Validacion del formulario Agregar,
    $('#id_area, #id_auditor, #fecha_pro_au').change(function () {

        //Obtener arreglo
        let validacion = ObternerValidacion("Agregar");

        //Validar si el arreglo viene como false
        if(validacion!=false){
            //Enviar arreglo para realizar la operacion
            Disponibilidad(validacion);
        }

    });

    //Validacion del formulario Editar
    $('#id_area_edit, #id_auditor_edit, #fecha_pro_au_edit').change(function () {

        //Obtener arreglo
        let validacion = ObternerValidacion("Editar");

        //Validar si el arreglo viene como false
        if(validacion!=false){
            //Enviar arreglo para realizar la operacion
            Disponibilidad(validacion);
        }

    });

    $('#agregar').click(function() {
        $("#btn_agregar").removeAttr("disabled");
        ConsultarUsuarioArea("Create");/*Ejecutar la funcion de imprimir los datos de las tablas usuario y areas, mandando como parametro el formulario*/
        $("#alert").alert("close");/*Ocultar el alert de validacion de ocupacion de area y auditor*/
    });

});

/*Funciones*/

//Funcion para imprimir los registros de la tabla programacion de auditoria

function Seleccionar(){

    //Declaracion de variables
    var nombre;
    var fecha;
    var string="";

    //Enviar los datos al php para ejecutar la operacion
    $.ajax({
        url:"../../Controller/ProgramacionAuditoria/ProgramacionAuditoria.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar",'where': FechaValidar()},
        success:function(data){
            data = JSON.parse(data);
            if (data.length >= 1) {

                for (let index = 0; index < data.length; index++) {

                    fecha = FechaProgramacion(data[index][6]); /*Funcion par separarme los años-meses de los dias de dotos tipo date*/
                    nombre = NombreCompleto(data[index][1], data[index][2], data[index][3], data[index][4]); /*Funcion para juntarme el nombre, el segundo nombre y el apellido */

                    string += "<tr>";
                    string += "<td>"+(index+1)+"</td>";
                    string += "<td>"+data[index][9]+"</td>";
                    string += "<td>"+nombre+"</td>";
                    string += "<td>"+data[index][5]+"</td>";
                    string += "<td>"+fecha+"</td>";
                    string += "<td>"+data[index][7]+"</td>";
                    string += "<td><a href='#' onclick='ObtenerObsevacion(\""+data[index][8]+"\");'>Ver mas...</a></td>";
                    string += "<td>";
                    //Condicional para desaparecer la opcion de editar cuando los años sean anteriores al actual y cuando un registro esta en estado Finalizado
                    if(FechaValidar() == ObtenerFecha(null) && data[index][7]!="Finalizada"){
                        string += "<button type='button' class='btn btn-primary btn-sm' id='editar' onclick='ObtenerEditar("+data[index][10]+");'>Editar</button>";
                    }
                    else{
                        string += "";
                    }
                    string += "</td>";
                    string += "</tr>";
                }
                $('#tbody').html(string);

            } else {
                $('#tbody').html("<td colspan='8'>No hay registros.</td>");
            }

        }
    });

}

//Funcion para obtener datos de validacion

function ObternerValidacion(operacion){

    //Obtener la fecha de el input tipo date de cada formulario
    var fechaEdit = $('#fecha_pro_au_edit').val();
    var fechaCreate = $('#fecha_pro_au').val();

    //Verificar si los datos anteriores no vienen vacios
    if((fechaCreate != "-undefined" && fechaCreate != null && fechaCreate != "") || (fechaEdit != "-undefined" && fechaEdit != null && fechaEdit != "")){
        let validacion;

        //Verificar en que formulario necesitan validar la disponibilidad del auditor y el area
        switch (operacion) {
            case "Agregar":

                //Crear el arreglo a enviar
                validacion = {
                    'auditor':$.trim($('#id_auditor').val()),
                    'area':$.trim($('#id_area').val()),
                    'fecha':$.trim(fechaCreate+"-01"),
                    'accion': "disponibilidad",
                    'operacion': "Create"
                }

                break;
            case "Editar":

                //Crear el arreglo a enviar
                validacion = {
                    'auditor':$.trim($('#id_auditor_edit').val()),
                    'area':$.trim($('#id_area_edit').val()),
                    'fecha':$.trim(fechaEdit+"-01"),
                    'accion': "disponibilidad",
                    'id':$.trim($('#input_id').val()),
                    'estado':$.trim($('#estado_auditoria').val()),
                    'operacion': "Edit"
                }

                    break;
            default:
                break;
        }
        //Retornar el arreglo
        return validacion;
    }
    else{
        return false;
    }
}

function ObtenerEditar(idProgramacioAuditoria){

    $("#btn_editar").removeAttr("disabled");

    $("#alert").alert("close");/*Ocultar el alert de validacion de ocupacion de area y auditor*/

    $("#div_estado").css("display", "none"); /*Vuelve invisible el input de estados de auditoria en el formulario de editar*/

    $("#modalEditar").modal("show");/*Muestra el modal solicitado*/

    ConsultarUsuarioArea("Edit");/*Ejecutar la funcion de imprimir los datos de las tablas usuario y areas, mandando como parametro el formulario*/

    //Enviar los datos al php para ejecutar la operacion
    $.ajax({
        url:"../../Controller/ProgramacionAuditoria/ProgramacionAuditoria.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar",'where': FechaValidar()},
        success: function(data){
            data = JSON.parse(data);
            if (data.length >= 1) {

                for (let index = 0; index < data.length; index++) {

                    //Condicional para que solo envie los datos al modal de editar teniendo en cuenta el id recibido desde la funcion onclick de los botones de editar
                    if(data[index][10]==idProgramacioAuditoria){

                        fecha = FechaProgramacion(data[index][6]);
                        nombre = NombreCompleto(data[index][1], data[index][2], data[index][3], data[index][4]);

                        $('#input_id').val(data[index][10]);
                        $('#id_area_edit').val(data[index][11]);
                        $('#id_auditor_edit').val(data[index][12]);
                        $('#tipo_auditoria_edit').val(data[index][5]);
                        $('#estado_auditoria').val(data[index][7]);
                        $('#fecha_pro_au_edit').val(fecha);
                        $('#observacion_edit').val(data[index][8]);

                        BloquearInputs(data[index][7]); /*Funcion que recibe como parametro el estado de la auditoria y segun eso bloquea algunos inputs del formulario editar */

                    }

                }

            } else {
                Limpiar("Edit");
                $('#modalEditar').modal('hide');
            }

        }
    });

}

//Funcion para verificar que el auditor ni el usuario esten ocupados en la fecha especificada por el usuario

function Disponibilidad(validacion) {
    //Recibir arreglo y separalos en variables distintas, operacion = tipo de operacion a realizar *crear* o *editar*, estado = el estado de la auditoria *Programada, *En proceso*, *Finalizado*
    var estado = validacion['estado'];
    var operacion = validacion['operacion'];

    //Variable para almacenar el mensaje que aparecera en la alerta
    var mensaje="";

    //Enviar los datos al php para ejecutar la operacion
    $.ajax({
        url:"../../Controller/ProgramacionAuditoria/ProgramacionAuditoria.C.php",
        type:"POST",
        datatype:"json",
        data:validacion,
        success:function(validacion){
            validacion = JSON.parse(validacion);

            //switch para especificarle al usuario si el auditor y/o el area estan ocupados en la fecha especificada, 1 = los dos estan ocupados, 2 = el area esta ocupada, 3 = el auditor esta ocupado
            switch (validacion) {
                case 1:

                    mensaje += "<div id='alert' class='alert alert-warning alert-dismissible fade show' role='alert'>";
                    mensaje += "El auditor y el area ya estan programados para esta fecha!!<br>Porfavor escoja otra area, auditor y/o fecha";
                    mensaje += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    mensaje += "<span aria-hidden='true'>&times;</span>";
                    mensaje += "</button>";
                    mensaje += "</div>";

                    break;
                case 2:
                    mensaje += "<div id='alert' class='alert alert-warning alert-dismissible fade show' role='alert'>";
                    mensaje += "El area ya esta programada para auditoria en esta fecha!!<br>Porfavor escoja otra area y/o fecha";
                    mensaje += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    mensaje += "<span aria-hidden='true'>&times;</span>";
                    mensaje += "</button>";
                    mensaje += "</div>";

                    break;
                case 3:

                    mensaje += "<div id='alert' class='alert alert-warning alert-dismissible fade show' role='alert'>";
                    mensaje += "El usuario ya esta programado a realizar auditoria en esta fecha!!<br>Porfavor escoja otro auditor y/o fecha";
                    mensaje += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    mensaje += "<span aria-hidden='true'>&times;</span>";
                    mensaje += "</button>";
                    mensaje += "</div>";

                    break;
                default:

                    mensaje = null;

                    break;
            }

            if(mensaje!=null){
                if(operacion == "Create"){
                    $('#alertCreate').append(mensaje);
                    $('#fecha_pro_au').val('');
                }
                else if(operacion == "Edit"){
                    $('#alertEdit').append(mensaje);
                    if(estado=="En proceso"){
                        $('#id_auditor_edit').val('');
                    }
                    else if(estado=="Programada"){
                        $('#fecha_pro_au_edit').val('');
                    }
                }
                $("#alert").alert("");
                window.setTimeout(function() {
                    $("#alert").fadeTo(500, 0).slideUp(500, function(){
                        $("#alert").alert("close");
                    });
                }, 5000);

            }
        }

    });

}

/*Algunos servicios*/

//Funcion para bloquear los años anteriores y posteriores al actual de los inputs tipo date

function BloquearFechas(){
    $("#fecha_pro_au, #fecha_pro_au_edit").attr("min",FechaValidar()+"-01");
    $("#fecha_pro_au, #fecha_pro_au_edit").attr("max",FechaValidar()+"-12");
}

//Funcion que muestra los usuarios y las areas en los inputs tipo select de los formularios de agregar y editar

function ConsultarUsuarioArea(formulario){

    var auditor = "";
    var area = "";

    //Traer el Id, nombre y ocupacion de los usuarios de la BD y crear una etiqueta Option con esta informacion

    $.ajax({
        url:"../../Controller/ProgramacionAuditoria/Auditores.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar"},
        success: function(data){
            data = JSON.parse(data);

            $('#id_auditor').empty();

            for (let index = 0; index < data.length; index++) {

                nombre = NombreCompleto(data[index][2], data[index][3], data[index][4], data[index][5]);

                auditor += "<option value='"+data[index][0]+"'>"+nombre+" - "+data[index][1]+"</option>";

            }
            //Condicional para saber a que formulario se enviara los auditores en el imput tipo select
            if(formulario=="Create"){
                $('#id_auditor').html(auditor);
            }
            if(formulario=="Edit"){
                $('#id_auditor_edit').html(auditor);
            }
        }
    });

    //Traer el Id y el nombre de las areas de la BD y crear una etiqueta Option con esta informacion

    $.ajax({
        url:"../../Controller/ProgramacionAuditoria/Areas.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar"},
        success: function(data){
            data = JSON.parse(data);

            $('#id_area').empty();

            for (let index = 0; index < data.length; index++) {

                area += "<option value='"+data[index][0]+"'>"+data[index][2]+"</option>";

            }
            //Condicional para saber a que formulario se enviara los areas en el imput tipo select
            if(formulario=="Create"){
                $('#id_area').html(area);
            }
            if(formulario=="Edit"){
                $('#id_area_edit').html(area);
            }
        }
    });
}

//Funcion para obtener la variable tipo GET año del registro

function FechaValidar(){
    //Condicional que verifica si la variable tipo GET existe y si no, utiliza el año actual
    if(ObtenerVariableGET('fecha')!="-undefined" && ObtenerVariableGET('fecha')!="" && ObtenerVariableGET('fecha')!=null){

        //Condicional para saber si la variable tipo GET es mayor al año actual lo cual procede a cambiarlo por el año actual
        if (ObtenerVariableGET('fecha')<ObtenerFecha(null)){
            fecha = ObtenerVariableGET('fecha');
            BloquearInputs("fecha");
        }
        else{
            fecha = ObtenerFecha(null);
        }
    }
    else{
        fecha = ObtenerFecha(null);
    }
    return fecha;
}

//bloquear input o desaparecer input segun la fecha y el estado de la auditoria

function BloquearInputs(tipo){
    if(tipo=="fecha"){
        $("#modalAgregar").remove();
        $("#modalEditar").remove();
        $("#agregar").remove();
    }
    else{
        switch (tipo) {
            case "Programada":
                $('#id_auditor_edit').removeAttr("disabled");
                $('#id_area_edit').removeAttr("disabled");
                $('#tipo_auditoria_edit').removeAttr("disabled");
                $('#fecha_pro_au_edit').removeAttr("disabled");
                $('#observacion_edit').removeAttr("disabled");
                break;
            case "En proceso":
                $('#id_auditor_edit').removeAttr("disabled");
                $('#id_area_edit').attr("disabled", "");
                $('#tipo_auditoria_edit').attr("disabled", "");
                $('#fecha_pro_au_edit').attr("disabled", "");
                $('#observacion_edit').removeAttr("disabled");
                break;
            case "Finalizada":
                $('#id_auditor_edit').attr("disabled", "");
                $('#id_area_edit').attr("disabled", "");
                $('#tipo_auditoria_edit').attr("disabled", "");
                $('#fecha_pro_au_edit').attr("disabled", "");
                $('#observacion_edit').attr("disabled", "");
                break;
            default:
                break;
        }
    }
}

//Funcion para limpiar inputs y etiquetas html

function Limpiar(formulario){
    if(formulario=="Create"){
        //Inputs Create
        $('#tipo_auditoria').val('Auditoria de aseguramiento');
        $('#fecha_pro_au').val('');
        $('#observacion').val('');
    }
    else if(formulario=="Edit"){
        //Inputs Edit
        $('#tipo_auditoria_edit').val('Auditoria de aseguramiento');
        $('#fecha_pro_au_edit').val('');
        $('#observacion_edit').val('');
    }
}

$('#buscador').keyup(function (e) {
  e.preventDefault();

  if($('#texto').val()!="" && $('#texto').val()!=null){
    var string = "";

    // En data se trae el valor ingresado en la visa
    let data = {
        'criterio': $('#criterio').val(),
        'texto': $('#texto').val(),
        'accion':"buscar",
        'where': FechaValidar()
    };

    $.ajax({
        url:"../../Controller/ProgramacionAuditoria/ProgramacionAuditoria.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
            data = JSON.parse(data);
            if (data.length >= 1) {

                for (let index = 0; index < data.length; index++) {

                  fecha = FechaProgramacion(data[index][3]); /*Funcion par separarme los años-meses de los dias de dotos tipo date*/

                  string += "<tr>";
                  string += "<td>"+(index+1)+"</td>";
                  string += "<td>"+data[index][6]+"</td>";
                  string += "<td>"+data[index][1]+"</td>";
                  string += "<td>"+data[index][2]+"</td>";
                  string += "<td>"+fecha+"</td>";
                  string += "<td>"+data[index][4]+"</td>";
                  string += "<td><a href='#' onclick='ObtenerObsevacion(\""+data[index][5]+"\");'>Ver mas...</a></td>";
                  string += "<td>";
                  //Condicional para desaparecer la opcion de editar cuando los años sean anteriores al actual y cuando un registro esta en estado Finalizado
                  if(FechaValidar() == ObtenerFecha(null) && data[index][4]!="Finalizada"){
                      string += "<button type='button' class='btn btn-primary btn-sm' id='editar' onclick='ObtenerEditar("+data[index][7]+");'>Editar</button>";
                  }
                  else{
                      string += "";
                  }
                  string += "</td>";
                  string += "</tr>";

                }
                $('#tbody').html(string);

            } else {
                $('#tbody').html("<td colspan='8'>No hay registros.</td>");
            }

        }
    });
  }
  else{
    Seleccionar();
  }
});

function ObtenerObsevacion(anexo){
  if(anexo!=null && anexo!="" && anexo!="null"){
    $("#imprimir_observacion").html(anexo);
  }
  else{
    $("#imprimir_observacion").html("La programacion de auditoria no tiene observaciones.");
  }

  $('#modalObsevacion').modal("show");
}
