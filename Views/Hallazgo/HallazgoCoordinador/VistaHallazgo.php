<?php
include_once('../../../Enviroment/Autenticacion.php');
$sesion = new Sesion();
$sesion->autenticacion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Custom fonts for this template-->
  <link href="../../../Library/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../../Css/sb-admin-2.min.css" rel="stylesheet">

  <!--datables CSS básico-->
  <link rel="stylesheet" type="text/css" href="../../../Library/vendor/datatables/datatables.min.css"/>

  <!--datables estilo bootstrap 4 CSS-->
  <link rel="stylesheet"  type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

  <!--Css propios-->
  <link href="../../../Css/estiloP.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../Library/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="../../../Css/style.css">

</head>
<body onload="leer();inicio()">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>
            Hallazgos
          </h2>
        </div>
      </div>
      <br>
    <div class="d-flex align-items-center">
      <form class="form-inline my-2 my-lg-0">
              <select class="form-control"name="hallazgo" id="hallazgo">

              </select>
      </form>

      <form class="form-inline my-2 my-lg-0" id="buscador">
        <input class="form-control mr-sm-2 " type="search"  placeholder="Buscar por año" id="texto" aria-label="Search">
      </form>
    </div>
    </br>
    <table class="table">
      <thead class="thead-dark">
          <tr>
              <th scope="col">#</th>
              <th scope="col">Fecha</th>
              <th scope="col">Temas</th>
              <th scope="col">Acciones planteadas</th>
              <th scope="col">Aspectos a mejorar</th>
              <th scope="col">Evidencias</th>
          </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>

  <!-- Código JavaScript-->
  <script src="../../../Library/vendor/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="../../../Library/sweetalert2/sweetalert2.all.min.js"></script>


  <script src="../../../Library/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../../Js/sb-admin-2.min.js"></script>

  <!-- datatables JS -->
  <script src="../../../Library/vendor/datatables/datatables.min.js"></script>

  <script src="../../../Js/Hallazgo/HallazgoCoodinador/VistaHallazgo.js"></script>
  <script src="../../../Js/Hallazgo/HallazgoCoodinador/BuscadorVistaHallazgo.js"></script>
</body>
</html>
