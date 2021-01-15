
function seleccionar(id){
    //guardar funcion upperFirst()
    $('#hallazgo').empty();
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "seleccionar"},
        success: function(data){
            data = JSON.parse(data);
            console.log(data);
            $('#hallazgo').append("<option selected disabled>--selecciona--</option>");
            $('#Hallazgo').append("<option selected disabled>--selecciona--</option>");
            for (let index = 0; index < data.length; index++) {
                $('#hallazgo').append(
                    
                    "<option value='"+data[index][0]+"'>"+data[index][1]+"</option>"
                );
                $('#Hallazgo').append(
                    "<option value='"+data[index][0]+"'>"+data[index][1]+"</option>"
                );
            }
        }
        
    });
    $('#hallazgo').change(function(){
        var data={
            "hallazgo":$('#hallazgo').val(),
            "accion":"seleccionarA"
        }
        $('#boton').empty();
        
        $.ajax({
            
            url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
            type:"POST",
            datatype:"json",
            data:data,
            success:function(data){
                data = JSON.parse(data);
                $('#tbody').empty();
                console.log(data);
                
                for (let index = 0; index < data.length; index++) {
                    
                    
                    $('#tbody').append("<tr>"+
                                    "<td>"+(index+1)+"</td>"+
                                    "<td><a data-toggle='modal' data-target='#staticBackdrop4' onclick='hallazgo("+data[index][0]+")'>"+data[index][1]+"</a></td>"+
                                    "<td>"+data[index][2]+"</td>"+
                                    "<td>"+data[index][3]+"</td>"+
                                    "<td>"+data[index][4]+"</td>"+
                                    "<td>"+data[index][5]+"</td>"+
                                    "<td>"+data[index][6]+"</td>"+
                                    "<td>"+
                                    "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#staticBackdrop1' onclick='ValidarEditar("+data[index][0]+");'>Editar</button>"+
                                    "<button type='button' class='btn btn-info   btn-sm' data-toggle='modal' data-target='#staticBackdrop2' onclick='validarProrroga("+data[index][0]+");'>Crear Prorroga</button>"+
                                    "</tr>");
                }        
            }          
        });
    });
}
function evidencia(){
    $('#formEdit').submit(function(e){
        e.preventDefault();
            
            var id = $("#id").val();
            var accion = "Evidencia";
            var formData = new FormData();
            var archivo = $("#entregable_edit")[0].files[0];
            formData.append('entregable_edit',archivo);
            formData.append('id',id);
            formData.append('accion',accion);

    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:formData,
        contentType:false,
        processData:false,
        success: function(data){
            console.log(data);
            
            data = JSON.parse(data);
            
            if (data===true) {
                Swal.fire({
                    type:'success',
                    title:'Los datos fueron actualizados',
                  });
                $('#staticBackdrop1').modal('hide');
                $("#hallazgo").change();
            }else if(data===0){
                Swal.fire({
                    type:'error',
                    title:'No Hay ningun archivo',
                  });
                  $('#staticBackdrop1').modal('hide');
                    }else if(data===1){
                        
                        Swal.fire({
                            type:'error',
                            title:'El archivo es muy pesado',
                          });
                          $('#staticBackdrop1').modal('hide');
                    }else if(data===2){
                        Swal.fire({
                            type:'error',
                            title:'Archivo no valido',
                          });
                          $('#staticBackdrop1').modal('hide');
                    }else if(data===3){
                        Swal.fire({
                            type:'error',
                            title:'Ya hay un archivo subido',
                          });
                          $('#staticBackdrop1').modal('hide');
                    } 
            }
        
        
    });
    return false;
});
}
function ValidarEditar(id){
    $('#staticBackdrop1').modal('show');
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "validarEditar"},
        success: function(data){
            data = JSON.parse(data);
            console.log(data);
            if (data.length >= 1) {
            
                for (let index = 0; index < data.length; index++) {

                    if(data[index][0]==id){

                        $('#aspecto_edit').val(data[index][2]);
                        $('#accionesPlan_edit').val(data[index][3]);
                        $('#fecha_edit').val(data[index][4]);
                        $('#estado_edit').val(data[index][8]);
                        $('#id').val(data[index][0]);
                    
                    }

                }

            } else {
                $('#staticBackdrop1').modal('hide');
            }

        }
    });  

}
function editar(){
    $('#formEdit').submit(function(e){
        e.preventDefault();
            let data={
                'aspecto_edit':$.trim($('#aspecto_edit').val()),
                'accionesPlan_edit':$.trim($('#accionesPlan_edit').val()),
                'estado_edit':$.trim($('#estado_edit').val()),
                'id':$.trim($('#id').val()),
                'accion': "editar"
            }
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success: function(data){
            console.log(data);
            data = JSON.parse(data);
            
            if (data) {
                Swal.fire({
                    type:'success',
                    title:'Los datos fueron actualizados',
                  });
                $('#staticBackdrop1').modal('hide');
                $("#hallazgo").change();
            }else{
                Swal.fire({
                    type:'error',
                    title:'Los datos no fueron actualizados',
                  });
                
            }
        }
        
        
    });
});
}
function validarProrroga(id){
    $('#staticBackdrop2').modal('show');
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "validarEditar"},
        success: function(data){
            data = JSON.parse(data);
            console.log(data);
            if (data.length >= 1) {
            
                for (let index = 0; index < data.length; index++) {

                    if(data[index][0]==id){
                        $('#idProrroga').val(data[index][0]);
                    
                    }

                }

            } else {
                $('#staticBackdrop1').modal('hide');
            }

        }
    });  

}
function prorroga(){
    $('#formProrroga').submit(function(e){
        e.preventDefault();
            let data={
                'observacionProrro':$.trim($('#observacionProrro').val()),  
                'fechaProrroga':$.trim($('#fechaProrro').val()),
                'id':$.trim($('#idProrroga').val()),
                'accion': "prorroga"
                
            }
            $.ajax({
                url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
                type:"POST",
                datatype:"json",
                data:data,
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                        debugger
                        if (data===true) {
                            Swal.fire({
                                type:'success',
                                title:'Prorroga actualizada',
                            });
                            $('#staticBackdrop2').modal('hide');
                            $("#hallazgo").change();

                        }else if(data===2){
                           
                            Swal.fire({
                                type:'error',
                                title:'Ya existe una prorroga',
                            });
                            $('#staticBackdrop2').modal('hide');
                            
                        }else if(data===-0){
                            Swal.fire({
                                type:'error',
                                title:'La prorroga excede los 6 meses',
                            });
                        }
                        
                        $('#staticBackdrop2').modal('hide');
                        $("#hallazgo").change();
                    }
                
            });
    })
}
function vProrroga(){
    $('#tpro').empty();
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:{'accion': "vProrroga"},
        success:function(data){
            data = JSON.parse(data);
            
            console.log(data);
            
            for (let index = 0; index < data.length; index++) {
                
                
                $('#tpro').append("<tr>"+
                                "<td>"+(index+1)+"</td>"+
                                "<td>"+data[index][1]+"</td>"+
                                "<td>"+data[index][2]+"</td>"+
                                "<td>"+data[index][3]+"</td>"+
                                "</tr>");
            }        
        }          
    });    
}
function hallazgo(id){
    $('#tHallazgo').empty();
    let data={
        'id':id,
        'accion':'hallazgo'
    }
    $.ajax({
        url:"../../Controller/PlanMejoramiento/PlanMejoramiento.C.php",
        type:"POST",
        datatype:"json",
        data:data,
        success:function(data){
            data = JSON.parse(data);
            for (let index = 0; index < data.length; index++) {
                $('#tHallazgo').append("<tr>"+
                                    "<td>"+(index+1)+"</td>"+
                                    "<td>"+data[index][2]+"</td>"+
                                    "<td>"+data[index][1]+"</td>"+
                                    "<td>"+data[index][3]+"</td>"+
                                    "<td>"+
                                    "</tr>");
            }
        }
    });
}


