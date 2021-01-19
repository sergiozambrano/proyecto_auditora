function ObtenerVariableGET(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function filtroAno(){
        $("#chart_div").empty();
        var fecha=ObtenerVariableGET("fecha");

        var oilCanvas = document.getElementById("chart_div");
        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 18;
        let data={
            'fechaA':fecha,
            'accion':'filtroA'
        }
        $.ajax({
            url: "../../Controller/Reportes/Reportes.C.php",
            type:"POST",
            dataType:"json",
            data:data,
            success:function(data){
                
                programaEn=null;
                enProcesoFin=null;
                programadaFin=null;
                programada=null;
                enProceso=null;
                finalizada=null;
                
                for (let index = 0; index < data.length; index++) {
                       if(data[0]!=null && data[1]!=null && data[2]!=null){
                            if (data[0][1]=="Programada" && data[1][1]=="En proceso" && data[2][1]=="Finalizada") {
                                var todas = 1;//todas validas
                            }
                       }else if(data[0]!=null && data[1]!=null && data[2]==null){
                            if((programaEn=(data[0][1]=="Programada" && data[1][1]=="En proceso")) || (enProcesoFin=(data[0][1]=="En proceso" && data[1][1]=="Finalizada")) || (programadaFin=(data[0][1]=="Programada" && data[1][1]=="Finalizada"))){
                                if(programaEn!=null){
                                    var todas = 2;//Programada y en proceso
                                }
                                if(enProcesoFin!=null){
                                    var todas = 3;//En proceso y finalizada
                                }
                                if(programadaFin!=null){
                                    var todas = 4;//programada y finalizada
                                }
                            }
                       }else if(data[0]!=null && data[1]==null && data[2]==null){
                            if (programada=(data[0][1]=="Programada")){
                                    if(programada!=null){
                                        var todas = 5;//Programada
                                    }
                                }else if(enProceso=(data[0][1]=="En proceso")){
                                        if(enProceso!=null){
                                            var todas = 6;//En proceso
                                        }
                                    
                                    }else if(finalizada=(data[0][1]=="Finalizada")){
                                        if(finalizada!=null){
                                            var todas = 7;//finalizada
                                        }
                                    }
                                }
                       
                   
                        
                        
                    if (todas==1){
                        var oilData ={
                            labels : [
                                "Programada",
                                "En proceso",
                                "Finalizada"
                            ],
                            datasets: [
                                {
                                    data:[data[0][0],data[1][0],data[2][0]],
                                    backgroundColor: [
                                        "#FF0000",
                                        "#0027FF",
                                        "#3EFF00"
                                    ]
                                }
                            ]
                        }
                    
                    
                    var pieChart = new Chart(oilCanvas, {
                        type: 'pie',
                        data: oilData
                    });
                    $("#chart_div").append(pieChart);
                    }else if(todas==2){
                        var oilData ={
                            labels : [
                                "Programada",
                                "En proceso",
                                "Finalizada"
                            ],
                            datasets: [
                                {
                                    data:[data[0][0],data[1][0]],
                                    backgroundColor: [
                                        "#FF0000",
                                        "#0027FF",
                                        "#3EFF00"
                                    ]
                                }
                            ]
                        }
                    
                    
                    var pieChart = new Chart(oilCanvas, {
                        type: 'pie',
                        data: oilData
                    });
                    $("#chart_div").append(pieChart);
                    }else if(todas==3){
                        var oilData ={
                            labels : [
                                "En Proceso",
                                "Finalizada",
                                "Programada"
                            ],
                            datasets: [
                                {
                                    data:[data[0][0],data[1][0]],
                                    backgroundColor: [
                                        "#0027FF",
                                        "#3EFF00",
                                        "#FF0000"
                                    ]
                                }
                            ]
                        }
                    
                    
                    var pieChart = new Chart(oilCanvas, {
                        type: 'pie',
                        data: oilData
                    });
                    $("#chart_div").append(pieChart);

                    }else if(todas==4){
                        var oilData ={
                            labels : [
                                "Programada",
                                "Finalizada",
                                "En Proceso"
                                
                            ],
                            datasets: [
                                {
                                    data:[data[0][0],daya[1][0]],
                                    backgroundColor: [
                                        "#FF0000",
                                        "#3EFF00",
                                        "#0027FF"
                                    ]
                                }
                            ]
                        }
                    
                    
                    var pieChart = new Chart(oilCanvas, {
                        type: 'pie',
                        data: oilData
                    });
                    $("#chart_div").append(pieChart);
                    }else if(todas==5){
                        var oilData ={
                            labels : [
                                "Programada",
                                "Finalizada",
                                "En Proceso"
                                
                                
                            ],
                            datasets: [
                                {
                                    data:[data[0][0]],
                                    backgroundColor: [
                                        "#FF0000",
                                        "#3EFF00",
                                        "#0027FF"
                                        
                                    ]
                                }
                            ]
                        }
                    
                    
                    var pieChart = new Chart(oilCanvas, {
                        type: 'pie',
                        data: oilData
                    });
                    $("#chart_div").append(pieChart);
                    }else if(todas==6){
                        var oilData ={
                            labels : [
                                "En Proceso",
                                "Finalizada",
                                "Programada"
                                
                                
                            ],
                            datasets: [
                                {
                                    data:[data[0][0]],
                                    backgroundColor: [
                                        "#0027FF",
                                        "#3EFF00",
                                        "#FF0000"
                                    ]
                                }
                            ]
                        }
                    
                    
                    var pieChart = new Chart(oilCanvas, {
                        type: 'pie',
                        data: oilData
                    });
                    }else if(todas==7){
                        var oilData ={
                            labels : [
                                
                                "Finalizada",
                                "En proceso",
                                "Programada"
                                
                            ],
                            datasets: [
                                {
                                    data:[data[0][0]],
                                    backgroundColor: [
                                        "#3EFF00",
                                        "#0027FF",
                                        "#FF0000"
                                    ]
                                }
                            ]
                        }
                    
                    
                    var pieChart = new Chart(oilCanvas, {
                        type: 'pie',
                        data: oilData
                    });
                    }   
                }
            }
        });
    
}