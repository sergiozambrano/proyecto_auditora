<?php
    require_once "../../Model/Backups/Backup.V.php";

    if(!isset($_SESSION)) {
        session_start();
    }
    
    $data;

    $area_m = new area_m();

    switch ($accion) {
        case 'seleccionar':
            $data = $area_m->read($_SESSION['id']);
            break;  
    }

    print json_encode($data);

?>
