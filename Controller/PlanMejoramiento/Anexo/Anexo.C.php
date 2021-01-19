<?php
  require_once "../../../Model/PlanMejoramiento/Anexo/Anexo.M.php";

    /*if(!isset($_SESSION)) {
        session_start();
        $IdCreatePer = $_SESSION['IdUserCrea'];
    }*/
    $accion = $_POST["accion"];
    $data;
    $anexoM=new Anexom();
    switch ($accion) {
        case 'leer':
            $data = $anexoM->leer();
            break;
        case 'filtro':
            $fecha=$_POST['fechaA'];
            $data = $anexoM->filtroAuditoria($fecha);
            break;
    }

    
    print json_encode($data);
?>
