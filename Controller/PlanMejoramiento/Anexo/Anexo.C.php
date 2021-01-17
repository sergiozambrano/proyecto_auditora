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
    }
    
    print json_encode($data);
?>
