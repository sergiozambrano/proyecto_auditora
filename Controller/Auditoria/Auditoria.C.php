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
  $data = $auditoriaM->mostrar($_SESSION['id']);

}else{
  switch ($_POST['accion']) {
    case 'insertar':
      $direccion = '../../File/'.$_POST['id_auditoria'].'/anexos-auditor/';
      $ruta = $direccion.basename($_FILES['archivo']['name']);
      $validacion = $_FILES['archivo']['tmp_name'];

      $auditoriaD->anexo($_POST['id_auditoria'], $_FILES['archivo']['name'],$ruta,$direccion, $validacion, $_SESSION['id']);
      $data = $auditoriaM->guaAneCar($auditoriaD);
      break;
  }
}

print json_encode($data);
?>
