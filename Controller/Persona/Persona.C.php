<?php
    require_once "../../Model/Persona/Persona.D.php";
    require_once "../../Model/Persona/Persona.M.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $accion = $_POST["accion"];
    $data;
    $persona_m=new persona_m();

    switch ($accion) {
        case 'seleccionar':
            $data = $persona_m->read();
            break;
        case 'insertar':
            $primer_nombre_per=$_POST['primer_nombre'];
            $segundo_nombre_per=$_POST['segundo_nombre'];
            $primer_apellido_per=$_POST['primer_apellido'];
            $segundo_apellido_per=$_POST['segundo_apellido'];
            $tipo_doc_per=$_POST['tipo'];
            $num_doc_per=$_POST['documento'];
            $num_cel_per=$_POST['telefono'];
            $corre_per=$_POST['correo'];
            $fecha_nacimiento_per=$_POST['fecha_naciemiento'];
            $genero_per=$_POST['genero'];

            $id_usuario_creacion=$_SESSION['id'];

            $persona_d=new persona_d($primer_nombre_per,$segundo_nombre_per,$primer_apellido_per,$segundo_apellido_per,$tipo_doc_per, $num_doc_per,$num_cel_per,$corre_per,$fecha_nacimiento_per,$genero_per,$id_usuario_creacion);

            $data=$persona_m->insert($persona_d);
            break;    
        case 'eliminar':
            $id_per=$_POST['id'];

            $data=$persona_m->delete($id_per);
            
            break;
        case 'editar':

            $primer_nombre_per=$_POST['primer_nombre'];
            $segundo_nombre_per=$_POST['segundo_nombre'];
            $primer_apellido_per=$_POST['primer_apellido'];
            $segundo_apellido_per=$_POST['segundo_apellido'];
            $tipo_doc_per=$_POST['tipo'];
            $num_doc_per=$_POST['documento'];
            $num_cel_per=$_POST['telefono'];
            $corre_per=$_POST['correo'];
            $fecha_nacimiento_per=$_POST['fecha_naciemiento'];
            $genero_per=$_POST['genero'];
            $id_usuario_creacion=$_SESSION['id'];

            $id_per=$_POST['id'];

            $persona_d=new persona_d($primer_nombre_per,$segundo_nombre_per,$primer_apellido_per,$segundo_apellido_per,$tipo_doc_per, $num_doc_per,$num_cel_per,$corre_per,$fecha_nacimiento_per,$genero_per,$id_usuario_creacion);

            $data=$persona_m->update($persona_d, $id_per);

            break;
    }
    print json_encode($data);
?>