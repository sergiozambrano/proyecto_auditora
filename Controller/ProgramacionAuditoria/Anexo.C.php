<?php
  require_once "../../Model/ProgramacionAuditoria/Anexo/Anexo.D.php";
  require_once "../../Model/ProgramacionAuditoria/Anexo/Anexo.M.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $idUserValida = $_SESSION['id'];
    $accion = $_POST["accion"];
    $data;
    $anexoM=new anexoM();

    //Validar que procedimiendo necesita el usuario
    switch ($accion) {
        case 'seleccionar':
            $data = $anexoM->read();
            break;
        case 'seleccionarInformacion':
            $idAuditoria = $_POST['id'];
            $data = $anexoM->readInformation($idAuditoria);
            break;
        case 'seleccionarValidados':
            $data = $anexoM->readValidated();
            break;
        case 'seleccionarObservacion':
            $idAnexo=$_POST['id_anexo'];
            $data = $anexoM->readObservation($idAnexo);
            break;
        case 'insertar':
            $idAnexo=$_POST['id_anexo'];
            $observacion=$_POST['observacion'];

            $anexoD=new anexoD($idAnexo,$idUserValida,$observacion);

            $data=$anexoM->insert($anexoD);
            break;
        case 'editar':
            $idAnexo=$_POST['id_anexo'];

            $data=$anexoM->edit($idAnexo);
            break;
        case 'buscar':
            $texto = "%".$_POST['texto']."%";

            $data = $anexoM->Search($texto);
            break;
    }
    print json_encode($data);
?>
