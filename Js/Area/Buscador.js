$('#buscador').keyup(function (e) {
    e.preventDefault();

    // En data se trae el valor ingresado en la visa
    var data = {
        criterio: $('#criterio').val(),
        texto: $('#texto').val()
    };

    $.post('../../Controller/Area/Buscar.C.php', data, function (respuesta) {
        console.log(respuesta);
        let datos = JSON.parse(respuesta);
        let tabla = '';
        datos.forEach((dato,i) => { //Si se encuentra un dato de la busqueda se carga la tabla con sus respectivos campos
            tabla += `<tr>
                <td>${i+1}</td>
                <td>${dato.persona}</td>
                <td>${dato.nombre_unidad}</td>
                <td>${dato.certificado=='si certificado' ? '<span class="badge badge-success">Si Certificado</span>' : '<span class="badge badge-danger">No Certificado</span>'}</td>
                <td>
                    <button type='button' style='margin-top: 0px;' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#modelActualizar' data-whatever='@mdo' onclick='seleccionar(${dato.id_area});'>Editar</button>
                    <button type='button' class='btn btn-danger btn-sm' id='eliminar' onclick='eliminar(${dato.id_area});'>Eliminar</button></td>
                </td>
            </tr>`;
        });
        $("#tbody").html(tabla);
    });
});
