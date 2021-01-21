<?php
    require_once "../../Model/Backups/backups.D.php";
    require_once "../../Model/Backups/backups.M.php";

    if(!isset($_SESSION)) {
        session_start();
    }
    $accion = $_POST["accion"];
    $data;

    $backup_m = new backup_m();
    $backup_d=new backup_d();

    switch ($accion) {
        case 'seleccionar':
            $data = $backup_m->read();
            break;

        case 'insertar':
            $backup_d->insertar($_POST['dia'],$_SESSION['id']);
            $data=$backup_m->insert($backup_d);
            break;
        case 'respaldo': 
            $data = $backup_m->respaldo();
            break;   
    }
    if (isset($_POST["validar"])) {
        $cantidad = $backup_m->validarUsuario($_SESSION['id']); 
        $data[0] = $data;
        $data[1] = $cantidad;
    }
    print json_encode($data);

?>
