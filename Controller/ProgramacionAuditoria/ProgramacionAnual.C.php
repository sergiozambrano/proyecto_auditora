<?php
    require_once "../../Model/ProgramacionAuditoria/ProgramacionAnual.M.php";
    $programacionAnualM=new programacionAnualM();

    $accion = $_POST["accion"];

    //Validar que procedimiendo necesita el usuario
    switch ($accion) {
        case 'seleccionar':
            $data = $programacionAnualM->read();
            break;
    }

    print json_encode($data);
?>