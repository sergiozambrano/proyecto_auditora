<?php
include_once "../../Model/Auditoria/ProgramaAuditoria.M.php";

if(!isset($_SESSION)) {
  session_start();
}

$ProgrmaM = new ProgramaM();
$data;

if(!isset($_POST['id'])){
  $data = $ProgrmaM->auditorias($_SESSION['id']);

}else{
  $data = $ProgrmaM->inicioAuditoria($_POST['id'], $_SESSION['id']);
}

print json_encode($data);

?>
