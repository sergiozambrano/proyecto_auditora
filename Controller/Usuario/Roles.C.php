<?php
include_once "../../Model/Usuario/Usuario.M.php";

if(!isset($_SESSION)) {
  session_start();
}

$usuarioM = new UsuarioM();
$data;

$data = $usuarioM->roles($_SESSION['id']);

print json_encode($data);
?>
