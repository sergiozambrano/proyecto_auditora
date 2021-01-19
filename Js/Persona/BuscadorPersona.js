$('#buscador').keyup(function (e) {
    e.preventDefault();

    // En data se trae el valor ingresado en la visa
    var data = {
        criterio: $('#criterio').val(),
        texto: $('#texto').val()
    };

    $.post('../../Controller/Persona/BuscadorPersona.C.php', data, function (respuesta) {
        let datos = JSON.parse(respuesta);
        let tabla = '';
        datos.forEach((dato,i) => { //Si se encuentra un dato de la busqueda se carga la tabla con sus respectivos campos
            tabla += `<tr>
                <td>${i+1}</td>
                <td>
                    ${dato.nombre_pri_per}
                    ${dato.nombre_seg_per}
                </td>
                <td>
                    ${dato.apellido_pri_per}
                    ${dato.apellido_seg_per}
                </td>
                <td>${dato.tipo_doc_per}</td>
                <td>${dato.num_documento}</td>
                <td>${dato.num_celular}</td>
                <td>${dato.correo}</td>
                <td>${dato.fecha_nac_per}</td>
                <td>${dato.genero_per}</td>
                <td>
                    <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#staticBackdrop' onclick='seleccionar("${dato.id_persona}");'>Editar</button>
                    <button type='button' class='btn btn-danger btn-sm' id='eliminar' onclick='eliminar("${dato.id_persona}");'>Eliminar</button></td>
                </td>
            </tr>`;
        });
        $("#tbody").html(tabla);
    });

});




