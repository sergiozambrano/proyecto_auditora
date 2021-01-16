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
  <link rel="stylesheet" type="text/css" href="../../Library/fonts/iconic/css/material-design-iconic-font.min.css">

  <!-- Custom styles for this template-->
  <link rel="stylesheet" href="../../Library/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Css/estilos.css">
  <link rel="stylesheet" href="../../Library/sweetalert2/sweetalert2.min.css">

</head>
<body>
  <section class="container-fluid">
    <article class="row align-items-start">
      <div class="col my-2">
        <a class='btn btn-primary' href="ProgramaAuditoria.php">Volver</a>
      </div>
      <div class="d-flex justify-content-end">
        <div class="d-inline p-2 col">
          <button type="button" class="btn btn-primary">Subir</button>
        </div>
        <form class="form-inline my-2 my-lg-0">
          <div class="">
            <select class="form-control" id="selecBuscador">
              <option value="0">Documento</option>
              <option value="1">Estado</option>
              <option value=""></option>
            </select>
          </div>
          <div class="">
            <input class="form-control" id="valorBuscador">
          </div>
        </form>
      </div>
    </article>
    <article>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Documento</th>
            <th scope="col">Estado</th>
            <th scope="col">Validación</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </article>
  </section>

  <!-- Código JavaScript-->
  <script src="../../Library/jquery-3.3.1.min.js"></script>
  <script src="../../Library/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../Library/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Código propio JavaScript-->
  <script src="../../Js/Auditoria/Auditoria.js"></script>
</body>
</html>
