<?php
  require_once "../../Model/PlanMejoramiento/Buscar.D.php";
  require_once "../../Model/PlanMejoramiento/Buscar.M.php";

  $criterio = $_POST['criterio'];
  $texto = $_POST['texto'];

  $buscarD = new BuscarD($criterio, $texto);

  $buscarM = new BuscarM();
  $data = $buscarM->buscar($buscarD);

  print json_encode($data);
?>
