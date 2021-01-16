<?php
  require_once "../../Model/ProgramacionAuditoria/Auditores.M.php";

    $accion = $_POST["accion"];
    $data;
    $auditorM=new auditorM();
    switch ($accion) {
        case 'seleccionar':
            $data = $auditorM->read();
            break;
    }
    print json_encode($data);
?>
