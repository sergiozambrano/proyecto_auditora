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
  <link rel="stylesheet"  type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">

  <!--Css propios-->
  <link href="../../../Css/estiloP.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../Library/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="../../../Css/style.css">
  
</head>
<body onload="leer()">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>
            Plan de Mejoramiento de auditorias
          </h2>
        </div>
      </div>
      <br>
    <form class="col-md-2" style="position:absolute;right: 0;">
      <div class="row g-3 align-items-center">  
        <div  class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filtroA" onclick="filtrarAuditoria();">
          <label class="form-check-label" for="flexCheckDefault" >
            Año Actual
          </label>
        </div>
      </div> 
    </form>
    <br>
    <br>
      <div class="table-responsive">
        <table class="table">
          <thead class="thead-dark">
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre del anexo</th>
                  <th scope="col">Descargar anexo</th>
              </tr>
          </thead>
          <tbody id="datos">
          </tbody>
        </table>
      </div>
  </div>
  
    <!-- Código JavaScript-->
    <script src="../../../Library/vendor/jquery/jquery.min.js"></script>
  <script src="../../../Library/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../Library/sweetalert2/sweetalert2.all.min.js"></script>


  <script src="../../../Library/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../../Js/sb-admin-2.min.js"></script>

  <!-- datatables JS -->
  <script src="../../../Library/vendor/datatables/datatables.min.js"></script>
  
  <script src="../../../Js/PlanMejoramiento/Anexo/Anexo.js"></script>
</body>
</html>