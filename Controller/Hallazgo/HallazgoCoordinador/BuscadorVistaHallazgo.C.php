<?php
    require_once "../../../Model/Hallazgo/HallazgoCoordinador/BuscadorVistaHallazgo.D.php";
    require_once "../../../Model/Hallazgo/HallazgoCoordinador/BuscadorVistaHallazgo.M.php";


    $texto = $_POST['texto'];

    $buscarD = new BuscarD($texto);

    $buscarM = new BuscarM();
    $data = $buscarM->buscar($buscarD);



    print json_encode($data);
?>
