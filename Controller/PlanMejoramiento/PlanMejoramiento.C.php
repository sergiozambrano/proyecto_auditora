<?php
  require_once "../../Model/PlanMejoramiento/PlanMejoramiento.D.php";
  require_once "../../Model/PlanMejoramiento/PlanMejoramiento.M.php";

    /*if(!isset($_SESSION)) {
        session_start();
        $IdCreatePer = $_SESSION['IdUserCrea'];
    }*/
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

            $planMejoramientod = new PlanMejoramientod(null,$aspectoMejorar,$accionesPlan,null,null,$estado);

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
                $planMejoramientod = new PlanMejoramientod(null,null,null,null,$fechaImplementacion,null);
            
                $data=$planMejoramientom->prorroga($planMejoramientod,$observacion,$estado,$idPlanMejoramiento);
            }
            break;
        case 'vProrroga':
            $data =$planMejoramientom->vProrroga();
            break;
        case 'Evidencia':
            $idAuditoria = $_POST['idAuditoria'];
            $directorio = "../File/".$idAuditoria."/evidencia-planMejoramiento/";
            $archivo = $directorio.basename($_FILES['entregable_edit']['name']);
            $tipoArchivo = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
            $tamanoArchivo = isset($_FILES['entregable_edit']['tmp_name']);
            $valida = $_FILES['entregable_edit']['tmp_name'];
            $size = $_FILES['entregable_edit']['size'];
            
            $idPlanMejoramiento=$_POST['id'];
            $data=$planMejoramientom->evidencia($archivo,$tipoArchivo,$tamanoArchivo,$valida,$size,$idPlanMejoramiento);
            break;
        case 'validarAuditoria':
            $id=$_POST['id'];
            $data=$planMejoramientom->vAuditoria($id);
            break;
        case 'hallazgo':
            $idHallazgo=$_POST['id'];
            $data=$planMejoramientom->hallazgo($idHallazgo);
            break;
        case 'leer':
            $data=$planMejoramientom->leer();
            break;
    }
    
    print json_encode($data);
?>
