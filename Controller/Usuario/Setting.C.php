<?php
include_once("../../Model/Usuario/Usuario.M.php");
include_once("../../Model/Usuario/Usuario.D.php");

if(!isset($_SESSION)) {
    session_start();
}

$usuarioM = new UsuarioM();
$data;

if(!isset($_POST['claveActual'])){
  $data = $usuarioM->datos($_SESSION['id']);

}else{
  //print($_SESSION['id']." ".$_POST['claveActual']." ".$_POST['claveNueva']);
  $usuaioD = new UsuarioD();
  $usuaioD->cambiarClave($_SESSION['id'],$_POST['claveActual'], $_POST['claveNueva']);

  $data = $usuarioM->cambiarClave($usuaioD);
}


print json_encode($data);
?>
