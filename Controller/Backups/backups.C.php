<?php
    require_once "../../Model/Backups/backups.D.php";
    require_once "../../Model/Backups/backups.M.php";

    if(!isset($_SESSION)) {
        session_start();
    }
    $accion = $_POST["accion"];
    $data;

    $area_m = new area_m();
    $area_d=new area_d();

    switch ($accion) {
        case 'seleccionar':
            $data = $area_m->read();
            break;

        case 'insertar':
            $area_d->insertar($_POST['dia'],$_SESSION['id']);
            $data=$area_m->insert($area_d);
            break;
        case 'respaldo': 
            $data = $area_m->respaldo();
            break;   
    }

    print json_encode($data);

?>
