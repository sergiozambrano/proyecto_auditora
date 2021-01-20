<?php
include_once "../../../Model/Hallazgo/HallazgoAuditor/Hallazgo.D.php";
include_once "../../../Model/Hallazgo/HallazgoAuditor/Hallazgo.M.php";

if(!isset($_SESSION)) {
  session_start();
}

$data;

$hallazgoD = new HallazgoD();
$hallazgoM = new HallazgoM();

if (!isset($_POST['accion'])) {
  $hallazgoD->hallazgo($_SESSION['id']);
  $data = $hallazgoM->mostrar($hallazgoD);

} else {
  # code...
}

print json_encode($data);
?>
