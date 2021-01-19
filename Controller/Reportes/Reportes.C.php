<?php
  require_once "../../Model/Reportes/Reportes.D.php";
  require_once "../../Model/Reportes/Reportes.M.php";

    $accion = $_POST["accion"];
    $data;
    $pedidoE = new Reporte();
    $graficarM= new GraficarM();
    switch ($accion) {
        case 'graficar':
            $fecha=$_POST['fechaA'];
            $data = $graficarM->grafico($fecha);
            break;
        case 'filtro':
            $data = $graficarM->filtro();
            break;
        case 'filtroA':
            $fechaA=$_POST['fechaA'];
            $data = $graficarM->filtroA($fechaA);
            break;
    }

    
    print json_encode($data);
?>