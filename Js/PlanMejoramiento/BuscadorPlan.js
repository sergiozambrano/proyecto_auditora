$('#buscador').keyup(function (e) {
    e.preventDefault();

    // En data se trae el valor ingresado en la visa
    var data = {
        criterio: $('#criterio').val(),
        texto: $('#texto').val()
    };

    $.post('../../Controller/PlanMejoramiento/Buscar.C.php', data, function (respuesta) {
        
        let datos = JSON.parse(respuesta);
        let tabla = '';
        datos.forEach((dato,i) => { //Si se encuentra un dato de la busqueda se carga la tabla con sus respectivos campos
            tabla += `<tr>
                <td>${i+1}</td>
                <td><a data-toggle='modal' data-target='#staticBackdrop4' onclick='hallazgo(${dato.id_hallazgo})'>${dato.tema_hallazgo}</a></td>
                <td>${dato.fecha_evidencia}</td>
                <td>${dato.estado_plaMejor}</td>
                <td>
                <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#staticBackdrop1' onclick='ValidarEditar(${dato.id_plan_mejoramiento});validarEvidencia(${dato.id_plan_mejoramiento})'>Editar</button>
                <button type='button' class='btn btn-info   btn-sm' data-toggle='modal' data-target='#staticBackdrop2' onclick='validarProrroga(${dato.id_plan_mejoramiento});'>Crear Prorroga</button></td>
            </tr>`;
        });
        $("#tbody").html(tabla);
    });
});