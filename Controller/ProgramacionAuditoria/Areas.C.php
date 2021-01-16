<?php
  require_once "../../Model/ProgramacionAuditoria/Areas.M.php";

    $accion = $_POST["accion"];
    $data;
    $areaM=new areaM();
    switch ($accion) {
        case 'seleccionar':
            $data = $areaM->read();
            break;
    }
    print json_encode($data);
?>
