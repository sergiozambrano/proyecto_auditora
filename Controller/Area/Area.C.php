<?php
    require_once "../../Model/Area/Area.D.php";
    require_once "../../Model/Area/Area.M.php";

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
            $area_d->insertar($_POST['usuario'],$_POST['nombre'],$_POST['certificado'],$_SESSION['id']);
            $data=$area_m->insert($area_d);
            break;

        case 'eliminar':
            $data=$area_m->delete($_POST['id']);
            break;

        case 'editar':
            $area_d->editar($_POST['id'],$_POST['usuario'],$_POST['nombre'],$_POST['certificado'],$_SESSION['id']);
            $data=$area_m->update($area_d);
            break;

        case 'listarSelect':
            $data = $area_m->readSelect();
            break;
    }

    print json_encode($data);

?>
