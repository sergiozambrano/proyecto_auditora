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
  $hallazgoD->mostrar($_POST['id_auditoria'], $_SESSION['id']);
  $data = $hallazgoM->mostrar($hallazgoD);

} else {
  switch ($_POST['accion']) {
    case 'insertar':
      $direccion = '../../File/'.$_POST['id_auditoria'].'/evidencias-hallazgos/';
      $ruta = $direccion.basename($_FILES['archivo']['name']);
      $validacion = $_FILES['archivo']['tmp_name'];

      $hallazgoD->guaAneCar($_POST['id_auditoria'],$_SESSION['id'],$_POST['temaHallazgo'],
                            $_POST['acciones'],$_POST['aspectoMejora'],$ruta,$direccion,$validacion);
      $data = $hallazgoM->guaAneCar($hallazgoD);
      break;
    case 'verHallazgo':
      $hallazgoD->verHallazgo($_POST['id_hallazgo']);
      $data = $hallazgoM->verHallazgo($hallazgoD);
      break;

    case 'verEstoPlan':
      $hallazgoD->id_planMejoramiento = $_POST['id_planMejoramiento'];
      $data = $hallazgoM->verEstoPlan($hallazgoD);
      break;

    case 'cambiarEstadoPlan':
      $hallazgoD->estado_planMejoramiento = $_POST['estado'];
      $hallazgoD->id_planMejoramiento = $_POST['id_planMejoramiento'];
      $data = $hallazgoM->cambioEstadoPlan($hallazgoD);
      break;

    case 'buscarHallazgo':
      $_POST['buscar'] = ($_POST['buscar'] == '0') ? 'fecha_evidencia' : 'estado_plaMejor';

      $hallazgoD->buscar($_POST['id_auditoria'],$_SESSION['id'],$_POST['buscar'],$_POST['valor']);
      $data = $hallazgoM->buscar($hallazgoD);
      break;

    case 'verProrroga':
      $hallazgoD->id_usuario_creacion = $_SESSION['id'];
      $hallazgoD->id_auditoria = $_POST['id_auditoria'];
      $data = $hallazgoM->verProrroga($hallazgoD);
      break;

    case 'editarProrroga':
      $hallazgoD->editarProrroga($_POST['id_prorroga'], $_POST['estado'], $_POST['obervacion']);
      $data = $hallazgoM->editarProrroga($hallazgoD);
      break;

  }
}

print json_encode($data);
?>
