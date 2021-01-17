<?php
    require_once "../../Model/UsuarioRol/UsuarioRol.D.php";
    require_once "../../Model/UsuarioRol/UsuarioRol.M.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $accion = $_POST["accion"];
    $data;
    $usuario_roles_m=new usuario_roles_m();

    switch ($accion) {
        case 'seleccionar':
            $data = $usuario_roles_m->read();
            break;
        case 'seleccionar_usuarios_activos':
            $data = $usuario_roles_m->seleccionar_usuarios_activos();
            break;
        case 'seleccionar_usuarios_inactivos':
            $data = $usuario_roles_m->seleccionar_usuarios_inactivos();
            break;
        case 'activar':
            $id_per=$_POST['id'];

            $data=$usuario_roles_m->activar($id_per);
            
            break;
        case 'desactivar':
            $id_per=$_POST['id'];

            $data=$usuario_roles_m->desactivar($id_per);
            
            break;
        case 'insertar':
            $numero_contrato=$_POST['numero_contrato'];
            $contraseña=$_POST['contraseña'];
            $contraseña_verificada = password_hash($contraseña, PASSWORD_DEFAULT);
            $id_persona=$_POST['idPersona'];

            $id_usuario_creacion=$_SESSION['id'];
            
            $usuarios=new usuario_roles_d($numero_contrato,$contraseña_verificada,$id_persona,$id_usuario_creacion);

            $data=$usuario_roles_m->insert($usuarios);
            break;    
        case 'editar':

            $numero_contrato=$_POST['numero_contrato'];
            $contraseña=$_POST['contraseña'];
            $contraseña_verificada = password_hash($contraseña, PASSWORD_DEFAULT);
            $id_persona=$_POST['idPersona'];

            $id_usuario_creacion=$_SESSION['id'];
            
            $usuarios=new usuario_roles_d($numero_contrato,$contraseña_verificada,$id_persona,$id_usuario_creacion);

            $data=$usuario_roles_m->update($usuarios);
            break;    

        case 'roles':
            $id_usuario=$_POST['id'];

            $data=$usuario_roles_m->roles($id_usuario);
            
            break;
        case 'selectRoles':

            $data=$usuario_roles_m->selectRoles();
            
            break;
        case 'asignarRol':

            $id_rol=$_POST['idrol'];
            $id_usuario=$_POST['idusuario'];

            $id_usuario_creacion=$_SESSION['id'];

            $data=$usuario_roles_m->asignarRol($id_rol, $id_usuario,$id_usuario_creacion);
            
            break;
        case 'eliminar':
            $id_usuario_rol=$_POST['id'];

            $data=$usuario_roles_m->delete($id_usuario_rol);
            
            break;
    }
    print json_encode($data);
?>