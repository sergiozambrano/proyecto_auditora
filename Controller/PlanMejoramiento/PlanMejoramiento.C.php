<?php
  require_once "../../Model/PlanMejoramiento/PlanMejoramiento.D.php";
  require_once "../../Model/PlanMejoramiento/PlanMejoramiento.M.php";

    if(!isset($_SESSION)) {
        session_start();
        
    }
    $accion = $_POST["accion"];
    $data;
    $planMejoramientom=new PlanMejoramientom();
    switch ($accion) {
        case 'seleccionarA':
            $nombreHallazgo=$_POST['hallazgo'];
            $data = $planMejoramientom->readA($nombreHallazgo);
            break;
        case 'seleccionar':
            $data = $planMejoramientom->read();
            break;
        case 'validarEditar':
            $data = $planMejoramientom->vEdit();
            break;
        case 'editar':
            $aspectoMejorar=$_POST['aspecto_edit'];
            $accionesPlan=$_POST['accionesPlan_edit'];
            $estado=$_POST['estado_edit'];

            $idPlanMejoramiento=$_POST['id'];

            $planMejoramientod = new PlanMejoramientod(null,$aspectoMejorar,$accionesPlan,null,null,$estado,$idUsuarioCrea = $_SESSION['id']);

            $data=$planMejoramientom->update($planMejoramientod, $idPlanMejoramiento);

            break;
        case 'prorroga':
            $estado="No valido";
            $fechaImplementacion=$_POST['fechaProrroga'];
            $fechaActual = date("y-m-d");
            $fecha= strtotime($fechaActual."+ 6 month");
            $fechaImplemen = strtotime($fechaImplementacion); 
            if($fechaImplemen>$fecha){
                $data=-0;
            }else{
                $observacion=$_POST['observacionProrro'];
                $idPlanMejoramiento=$_POST['id'];
                $planMejoramientod = new PlanMejoramientod(null,null,null,null,$fechaImplementacion,null,$idUsuarioCrea = $_SESSION['id']);
            
                $data=$planMejoramientom->prorroga($planMejoramientod,$observacion,$estado,$idPlanMejoramiento);
            }
            break;
        case 'vProrroga':
            $data =$planMejoramientom->vProrroga();
            break;
        case 'Evidencia':
            $idAnexo = $_POST['idAnexo'];
            $idAuditoria = $_POST['idAuditoria'];
            $copia = $_POST['archivoSubido'];
            $directorio = "../../File/".$idAuditoria."/evidencia-planMejoramiento/";
            $archivo = $directorio.basename($_FILES['entregable_edit']['name']);
            $nombreArchivo = basename($_FILES['entregable_edit']['name']);
            $tipoArchivo = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
            $validaArchivo = isset($_FILES['entregable_edit']['tmp_name']);
            $valida = $_FILES['entregable_edit']['tmp_name'];
            $size = $_FILES['entregable_edit']['size'];
            $idEjecucion = $_POST['idEjecucion'];
            $idPlanMejoramiento=$_POST['id'];
            $planMejoramientod = new PlanMejoramientod(null,null,null,null,null,null,$idUsuarioCrea = $_SESSION['id']);
            $data=$planMejoramientom->evidencia($idAnexo,$copia,$planMejoramientod,$archivo,$tipoArchivo,$validaArchivo,$nombreArchivo,$valida,$size,$idPlanMejoramiento,$idEjecucion);
            break;
        case 'validarAuditoria':
            $ruta=$_POST['ruta'];
            $id=$_POST['id'];
            $data=$planMejoramientom->vAuditoria($id,$ruta);
            break;
        case 'hallazgo':
            $idHallazgo=$_POST['id'];
            $data=$planMejoramientom->hallazgo($idHallazgo);
            break;
        case 'leer':
            $data=$planMejoramientom->leer();
            break;
        case 'fecha':
           
            $id=$_POST['id'];
           
            
            $data=$planMejoramientom->vFecha($id);
            
            break;
        case 'fechaProrroga':
            $id_plan_mejoramiento = $_POST['idPlan'];
            $data=$planMejoramientom->fechaProrroga($id_plan_mejoramiento);
            break;
    }
    
    print json_encode($data);
?>
