<?php
  require_once "../../../Model/Hallazgo/HallazgoCoordinador/VistaHallazgo.D.php";
  require_once "../../../Model/Hallazgo/HallazgoCoordinador/VistaHallazgo.M.php";

  $vistaHallazgoM = new VistaHallazgoM();
  $data;
  $accion = $_POST['accion'];
  switch ($accion) {
    case 'leer':
        $data = $vistaHallazgoM->selec();
        break;
    case 'seleccionar':
        $idArea = $_POST['idarea'];//aqui tiene que poner el nombre del parametro que envia
        $vistaHallazgoD = new VistoHallazgoD($idArea);
        $data = $vistaHallazgoM->mostrar($vistaHallazgoD);

        break;
    case 'default':
      $data = $vistaHallazgoM->default();
      break;
    }


  print json_encode($data);
?>
