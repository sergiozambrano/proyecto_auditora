<?php
  require_once "../../Model/ProgramacionAuditoria/ProgramacionAuditoria.D.php";
  require_once "../../Model/ProgramacionAuditoria/ProgramacionAuditoria.M.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $validacionUsuario;
    $validacionArea;
    $idUserCrea = $_SESSION['id'];
    $accion = $_POST["accion"];
    $data;
    $programacionAuditoriaM=new programacionAuditoriaM();

    //Validar que procedimiendo necesita el usuario
    switch ($accion) {
        case 'seleccionar':
            $where=$_POST['where'];
            $data = $programacionAuditoriaM->read(null,$where);
            break;
        case 'insertar':
            $idArea=$_POST['area'];
            $idAuditor=$_POST['auditor'];
            $tipoAuditoria=$_POST['tipo_auditoria'];
            $fechaProgramacion=$_POST['fecha_programada'];
            $estadoAuditoria="Programada";
            $observacion=$_POST['observacion'];

            $programacionAuditoriaD=new programacionAuditoriaD($idArea,$idAuditor,$tipoAuditoria,$fechaProgramacion,$estadoAuditoria,$observacion,$idUserCrea);

            $data=$programacionAuditoriaM->insert($programacionAuditoriaD);
            break;
        case 'editar':

            $idArea=$_POST['area'];
            $idAuditor=$_POST['auditor'];
            $tipoAuditoria=$_POST['tipo_auditoria'];
            $fechaProgramacion=$_POST['fecha_programada'];
            $observacion=$_POST['observacion'];

            $idProgramacionAuditoria=$_POST['programacion_auditoria'];

            $programacionAuditoriaD=new programacionAuditoriaD($idArea,$idAuditor,$tipoAuditoria,$fechaProgramacion,null,$observacion,null);

            $data=$programacionAuditoriaM->update($programacionAuditoriaD,$idProgramacionAuditoria);

            break;

        case 'disponibilidad':

            $idAuditor=$_POST['auditor'];
            $idArea=$_POST['area'];
            $fechaProgramacion=$_POST['fecha'];
            $operacion=$_POST['operacion'];

            //Recibir el id de la auditoria solo si la validacion de hace en el formulario de edit
            if($operacion=="Edit"){
                $idProgramacion=$_POST['id'];
            }

            //Hacer la validacion al area segun la fecha especificada por el usuario
            
            $programacionAuditoriaD=new programacionAuditoriaD($idArea,null,null,$fechaProgramacion,null,null,null);

            //Vericar el formulario en donde hicieron la validacion
            if($operacion=="Create"){
                $validacionArea=$programacionAuditoriaM->AvailabilityArea($programacionAuditoriaD,null,$operacion);
            }
            else if($operacion=="Edit"){
                $validacionArea=$programacionAuditoriaM->AvailabilityArea($programacionAuditoriaD,$idProgramacion,$operacion);
            }

            //Hacer la validacion al auditor segun la fecha especificada por el usuario

            $programacionAuditoriaD=new programacionAuditoriaD(null,$idAuditor,null,$fechaProgramacion,null,null,null);

            //Vericar el formulario en donde hicieron la validacion
            if($operacion=="Create"){
                $validacionUsuario=$programacionAuditoriaM->AvailabilityUser($programacionAuditoriaD,null,$operacion);
            }
            else if($operacion=="Edit"){
                $validacionUsuario=$programacionAuditoriaM->AvailabilityUser($programacionAuditoriaD,$idProgramacion,$operacion);
            }

            //Condicional que verificar si 1 = el area y el auditor estan ocupados en la fecha especificada, 2 = solo esta ocupado el area, 3 = solo esta ocupado el auditor

            if($validacionArea == 1 && $validacionUsuario == 1){
                $data=1;
            }
            else if($validacionArea == 1 && $validacionUsuario == 2){
                $data=2;
            }
            else if($validacionArea == 2 && $validacionUsuario == 1){
                $data=3;
            }
            else{
                $data=0;
            }

            break;
        case 'buscar':

            $idAuditor="%".$_POST['auditor_buscar']."%";
            $idArea="%".$_POST['area_buscar']."%";
            $tipoAuditoria="%".$_POST['tipo_buscar']."%";
            $where=$_POST['where'];
            
            $programacionAuditoriaD=new programacionAuditoriaD($idArea,$idAuditor,$tipoAuditoria,null,null,null,null);

            $data = $programacionAuditoriaM->read($programacionAuditoriaD, $where);

            break;
    }
    print json_encode($data);
?>
