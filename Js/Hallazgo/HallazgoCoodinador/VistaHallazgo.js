function leer(){
    $("#hallazgo").empty();
    $.ajax({
        url:"../../../Controller/Hallazgo/HallazgoCoordinador/VistaHallazgo.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion':'leer'},
        success:function(data){
            data=JSON.parse(data);
            $("#hallazgo").append("<option disabled selected>--seleccionar--</option>")
            for (let index = 0; index < data.length; index++) {
                $("#hallazgo").append(
                            "<option value="+data[index][0]+">"+data[index][1]+"</option>"
                );

            }
        }

    })
    $("#hallazgo").change(function(){
        //aqui hace la tabla que muestra :VVVVVV

        $('#tbody').empty();

        let data = {
            'idarea':$('select#hallazgo option:Selected').val(),
            'accion': "seleccionar"
        }

        $.ajax({
            url:"../../../Controller/Hallazgo/HallazgoCoordinador/VistaHallazgo.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success: function(data){
                data = JSON.parse(data);

                for (let index = 0; index < data.length; index++) {
                    //tabla con los tados consultados (roles)
                    var text1 ="<tr>"+
                                "<td>"+(index+1)+"</td>"+
                                "<td>"+data[index][1]+"</td>"+
                                "<td>"+data[index][2]+"</td>"+
                                "<td>"+data[index][3]+"</td>"+
                                "<td>"+data[index][4]+"</td>"+
                                "<td><a href='"+data[index][5]+"' download='"+nombreArchivo(data[index][5])+"'>"+
                                "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-download' viewBox='0 0 17 17'>"+
                                "<path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>"+
                                "<path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>"+
                                "</svg>"+
                                "</a></td>"+
                                "</tr>";
                    //id de la tabla
                    $('#tbody').append(text1);
                }
            }
        });
    });
}

function nombreArchivo(link){
    var array = link.split('/');
    var img = array[array.length - 1];
    return img;
}

function inicio(){
   $('#tbody').empty();

    $.ajax({
        url:"../../../Controller/Hallazgo/HallazgoCoordinador/VistaHallazgo.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion':'default'},
        success: function(data){
            data = JSON.parse(data);

            for (let index = 0; index < data.length; index++) {
                //tabla con los tados consultados (roles)
                var text1 ="<tr>"+
                            "<td>"+(index+1)+"</td>"+
                            "<td>"+data[index][2]+"</td>"+
                            "<td>"+data[index][3]+"</td>"+
                            "<td>"+data[index][4]+"</td>"+
                            "<td>"+data[index][5]+"</td>"+
                            "<td><a href='"+data[index][6]+"' download='"+nombreArchivo(data[index][6])+"'>"+
                            "<svg xmlns='../../img/undraw_posting_photo.svg' width='30' height='30' fill='currentColor' class='bi bi-download' viewBox='0 0 17 17'>"+
                            "<path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>"+
                            "<path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>"+
                            "</svg>"+
                            "</a></td>"+
                            "</tr>";
                //id de la tabla
                $('#tbody').append(text1);
            }
        }
    });
}
