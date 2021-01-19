$('#buscador').keyup(function (e) {
    e.preventDefault();

    // En data se trae el valor ingresado en la visa
    var data = {
        texto: $('#texto').val()
    };

    $.post('../../../Controller/Hallazgo/HallazgoCoordinador/BuscadorVistaHallazgo.C.php', data, function (respuesta) {

        let datos = JSON.parse(respuesta);
        let tabla = '';
        datos.forEach((dato,i) => { //Si se encuentra un dato de la busqueda se carga la tabla con sus respectivos campos
            tabla += `<tr>
                <td>${i+1}</td>
                <td>${dato.fecha_hallazgo}</td>
                <td>${dato.tema_hallazgo}</td>
                <td>${dato.acciones_planteadas}</td>
                <td>${dato.aspecto_mejora}</td>
                <td><a href='${dato.ruta_evidencia}' download='${nombreArchivo(dato.ruta_evidencia)}'>
                <svg xmlns='../../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-download' viewBox='0 0 17 17'>
                <path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>
                <path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>
                </svg>
                </a></td>
                </tr>`;
        });
        $("#tbody").html(tabla);
    });

});




