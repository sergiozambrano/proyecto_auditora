<?php
include_once "../../../Model/Hallazgo/HallazgoAuditor/Hallazgo.D.php";
include_once "../../../Model/Hallazgo/HallazgoAuditor/Hallazgo.M.php";

if(!isset($_SESSION)) {
  session_start();
}

$data;

$hallazgoD = new HallazgoD();
$hallazgoM = new HallazgoM();

$hallazgoD->hallazgo($_SESSION['id']);
$data = $hallazgoM->mostrarAuditorias($hallazgoD);

print json_encode($data);
?>
