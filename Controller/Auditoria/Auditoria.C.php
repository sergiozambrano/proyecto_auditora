<?php
include_once "../../Model/Auditoria/Auditoria.M.php";
include_once "../../Model/Auditoria/Auditoria.D.php";

if(!isset($_SESSION)) {
  session_start();
}

$data;
$auditoriaM = new AuditoriaM();
$auditoriaD = new AuditoriaD();

if(!isset($_POST['accion'])){
  $auditoriaD->mostrar($_SESSION['id'], $_POST['id_auditoria']);
  $data = $auditoriaM->mostrar($auditoriaD);

}else{
  switch ($_POST['accion']) {
    case 'insertar':
      $direccion = '../../File/'.$_POST['id_auditoria'].'/anexos-auditor/';
      $ruta = $direccion.basename($_FILES['archivo']['name']);
      $validacion = $_FILES['archivo']['tmp_name'];

      $auditoriaD->anexo($_POST['id_auditoria'], $_FILES['archivo']['name'],$ruta,$direccion, $validacion, $_SESSION['id']);
      $data = $auditoriaM->guaAneCar($auditoriaD);
      break;

    case 'observacion':
      $auditoriaD->observacion($_POST['id']);
      $data = $auditoriaM->observacion($auditoriaD);
      break;

    case 'nombreCoordinador':
      $auditoriaD->nombreCoordinador($_POST['idUsuVal']);
      $data = $auditoriaM->nombreCoordinador($auditoriaD);
      break;

    case 'validacion':
      $auditoriaD->validacion($_SESSION['id'],$_POST['id_auditoria'],$_POST['valor']);
      $data = $auditoriaM->validacion($auditoriaD);
      break;

    case 'buscar':
      $_POST['valor']['buscar'] = ($_POST['valor']['buscar'] == '0') ? 'nombre_anexo' : 'id_usuario_validacion';

      $auditoriaD->buscar($_SESSION['id'],$_POST['valor']['id_auditoria'],$_POST['valor']['buscar'],$_POST['valor']['valor'],$_POST['valor']['opcion']);
      $data = $auditoriaM->buscar($auditoriaD);
      break;

    case 'info':
      $data[0] = $auditoriaM->infoAuditoria($_POST['id']);
      $auditoriaD->nombreCoordinador($data[0][2]);
      $data[1] = $auditoriaM->nombreCoordinador($auditoriaD);
      break;

  }
}

print json_encode($data);
?>
