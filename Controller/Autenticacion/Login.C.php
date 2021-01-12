<?php
include_once("../../Model/Autenticacion/Login.D.php");
include_once("../../Model/Autenticacion/Login.M.php");

$loginM = new LoginM();
$loginD = new LoginD();
$data;

$documento = $_POST['usuario'];

if (isset($_POST['password'])) {
  $pass = $_POST['password'];

  $loginD->ingresar($documento,$pass);
  $data = $loginM->login($loginD);

} else {
  $data = $loginM->limiteIntento($documento);
}

print json_encode($data);
?>
