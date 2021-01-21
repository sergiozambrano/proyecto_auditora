<?php
include_once('../../Enviroment/Autenticacion.php');
$sesion = new Sesion();
$sesion->autenticacion();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Custom fonts for this template-->
  <link href="../../Library/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../Css/sb-admin-2.min.css" rel="stylesheet">

  <!--datables CSS básico-->
  <link rel="stylesheet" type="text/css" href="../../Library/vendor/datatables/datatables.min.css"/>

  <!--datables estilo bootstrap 4 CSS-->
  <link rel="stylesheet"  type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

  <!--Css propios-->
  <link href="../../Css/estiloP.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Library/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="../../Css/style.css">

    <title>Plan de Mejoramiento</title>
</head>
<body onload="filtroAno()">
    <!-- charts -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> 
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>
            Reportes
          </h2>
        </div>
      </div>
      <a href="ReporteAnual.php" class="text-decoration-none">
                <svg xmlns="../../img/volver.svg" width="40" height="40" class="bi bi-arrow-left-square-fill" viewBox="0 0 18 18">
                  <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
            </a>
    <canvas id="chart_div" style="width: 300px; height: 100px;"></canvas>
    
         
    <!-- Código JavaScript-->
  <script src="../../Library/vendor/jquery/jquery.min.js"></script>
  <script src="../../Library/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../Library/sweetalert2/sweetalert2.all.min.js"></script>


  <script src="../../Library/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../Js/sb-admin-2.min.js"></script>

  <!-- datatables JS -->
  <script src="../../Library/vendor/datatables/datatables.min.js"></script>

  <!-- código propio JS -->
    <script src="../../Js/Reportes/Reportes.js"></script>
</body>
</html>
