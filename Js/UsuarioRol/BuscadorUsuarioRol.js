$('#buscador').keyup(function (e) {
    e.preventDefault();
    
    // En data se trae el valor ingresado en la visa 
    var data = {
        criterio: $('#criterio').val(),
        texto: $('#texto').val()
    };
    console.log(data);

    $.post('../../Controller/UsuarioRol/BuscadorUsuarioRol.C.php', data, function (respuesta) {
        console.log(respuesta);
        let datos = JSON.parse(respuesta);
        let tabla = '';
        datos.forEach((dato,i) => { //Si se encuentra un dato de la busqueda se carga la tabla con sus respectivos campos
            tabla += `<tr>
                <td>${i+1}</td>
                <td>${dato.nombre_pri_per}</td>
                <td>${dato.apellido_pri_per}</td>
                <td>${dato.num_documento}</td>
                <td>
                    <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#staticBackdrop' onclick='seleccionar("${dato.id_persona}");'>Asignar usuario</button>
                </td>
            </tr>`;
        });
        $("#tbody").html(tabla);
    });

});


    
    
