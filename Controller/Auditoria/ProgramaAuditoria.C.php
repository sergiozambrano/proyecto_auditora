<?php
include_once "../../Model/Auditoria/ProgramaAuditoria.M.php";

if(!isset($_SESSION)) {
  session_start();
}

$ProgrmaM = new ProgramaM();
$data;

$data = $ProgrmaM->auditorias($_SESSION['id']);

print json_encode($data);

?>
