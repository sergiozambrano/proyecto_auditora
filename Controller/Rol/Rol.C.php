<?php
    require_once "../../Model/Rol/Rol.D.php";
    require_once "../../Model/Rol/Rol.M.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $accion = $_POST["accion"];
    $data;
    $rol_m=new rol_m();

    switch ($accion) {
        case 'seleccionar':
            $data = $rol_m->read();
            break;
        case 'insertar':
            $nombre_rol=$_POST['nombre_rol'];
            $estado_rol=$_POST['estado_rol'];
            $id_usuario_creacion=$_SESSION['id'];

            if ($estado_rol === "Activo") {
                $estado_rol = 1;
            }else{
                $estado_rol = 0;
            }

            $rol_d=new rol_d($nombre_rol,$estado_rol,$id_usuario_creacion);

            $data=$rol_m->insert($rol_d);
            break;    
        case 'eliminar':
            $id_rol=$_POST['id'];

            $data=$rol_m->delete($id_rol);
            
            break;
        case 'editar':

            $nombre_rol=$_POST['nombre_rol'];
            $estado_rol=$_POST['estado_rol'];
            $id_usuario_creacion=$_SESSION['id'];

            if ($estado_rol === "Activo") {
                $estado_rol = 1;
            }else{
                $estado_rol = 0;
            }

            $id_rol=$_POST['id'];

            $rol_d=new rol_d($nombre_rol,$estado_rol,$id_usuario_creacion);

            $data=$rol_m->update($rol_d, $id_rol);

            break;
    }
    print json_encode($data);
?>