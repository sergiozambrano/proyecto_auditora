//aqui en el ajax hacemos la validacion para crear la copia de seguridad
    $.ajax({
        url:"../../Controller/Backups/backups.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar", 'validar':"validarU"},
        success: function(data){
        data = JSON.parse(data);

            for (let index=0; index < data[0].length; index++) {
                var respaldo = 86400000; //instaciamos esta variable que equivale a los milisegundos que hay en 24 horas
                var tiempo = Number (respaldo) + Number (data[0][index][1]);

                if (data[1]>0) {
                    setInterval(saludar, tiempo);

                    function saludar(){ window.location.href = '../../Model/Backups/backup.php';
                    alert('Se ha hecho la copia de seguridad');
                    window.location.href = '../../Views/Plantilla/Plantilla.php'; }
                }

            }
        },
});

var cont = 0;
    $(document).ready(function (e){

         $('.form').submit(function(e){
            e.preventDefault();
            cont += 1;
            if (cont == 1) {
            //aqui en data traemos la accion de insetar junto con el dato que se ingresa
            let data = {
            'dia':$.trim($('#tiempo').val()),
            'accion': "insertar"
            };

        $.ajax({
            url:"../../Controller/Backups/backups.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                if (data == 1) {
                    //Con esto cerramos el modal luego de insertar los datos
                    $('div#modelInsertar').modal('hide');
                    Swal.fire({
                        title: "Exito!!",
                        icon: "success"
                    });
                }
                else if(data == 2){
                    Swal.fire({
                        title: "Error!!",
                        icon: "error"
                    });
                }
                else{
                    Swal.fire({
                        title: "Advertencia!!",
                        icon: "warning"
                    });
                }
                cont = 0;
                $("#inserEnviar").attr("disabled", false);
                limpiar();
                $('#btnFormulario').val('Enviar');
            }
        });
        }else{
            $("#inserEnviar").attr("disabled", true);
        };
    });
});


    let data = {
        'accion': "respaldo"
    }
    //listamos las copias de respaldo
    $.ajax({
        url:"../../Controller/Backups/backups.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
        data = JSON.parse(data);

        for (let index = 0; index < data.length; index++) {
            $('#tbody').append(
            "<tr>"+
                "<td>"+(index+1)+"</td>"+
                "<td>"+data[index][0]+"</td>"+
                "<td>"+data[index][1]+"</td>"+
                "<td><a href='"+data[index][2]+"' download='"+nombreArchivo(data[index][2])+"'>"+
                "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-download' viewBox='0 0 17 17'>"+
                "<path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>"+
                "<path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>"+
                "</svg>"+
                "</a></td>"+
            "</tr>");
            }
        }
    });

function nombreArchivo(link){
    var array = link.split('/');
    var img = array[array.length - 1];
    return img;
}
$("#btnBackup").click(function(){
    $("#modelInsertar").modal('show');
});

$('#cerrarModal').click(function(){
    $('#modelInsertar').modal('hide');
});
function limpiar(){
    $("#tiempo").val("");
}
