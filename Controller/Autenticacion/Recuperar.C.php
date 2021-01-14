<?php
include_once("../../Model/Autenticacion/Login.M.php");
include_once("../../Model/Autenticacion/Login.D.php");
if(!isset($_SESSION)) {
  session_start();
}

$loginM = new LoginM();
$loginD = new LoginD();
$data;

if (isset($_POST['accion'])) {

  switch ($_POST['accion']) {
    case 'codigo':
      $_SESSION['documento'] = $_POST['documento'];

      $datos = $loginM->valPerClave($_SESSION['documento']);

      /**
       * Validacion para enviar el correo
       */
      if ($datos != null) {

        $_SESSION['codigo'] = rand(1000,9999);

        $asunto = utf8_decode("Recuperación de contraseña software auditoría");
        $mensaje =  utf8_decode("Hola, \n".$datos['nombre_pri_per']." ".$datos['apellido_pri_per'].". \n\n".
        "Este es el código que necesitas para restablecer tu contraseña ".$_SESSION['codigo']);

        if (mail($datos['correo'], $asunto, $mensaje)) {
          $data = 1;

        } else {
          $data = 0;
        }
      }else{
        $data = 2;
      }
      break;

    case 'validar':
      if($_SESSION['codigo'] == $_POST['codigoDigitado']){

        $loginD->restablecerClave($_SESSION['documento']);

        if ($loginM->restablecerClave($loginD)) {
          $data = 1;

        }else{
          $data = 0;

        }
      }else{
        $data = 2;

      }

      unset($_SESSION['codigo']);
      unset($_SESSION['documento']);
      break;
  }
}

print json_encode($data);
?>
