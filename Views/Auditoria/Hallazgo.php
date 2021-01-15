<?php
include_once('../../Enviroment/Autenticacion.php');
$sesion = new Sesion();
$sesion->autenticacion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Custom styles for this template-->
  <link rel="stylesheet" href="../../Library/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Css/estilos.css">
  <link rel="stylesheet" href="../../Library/sweetalert2/sweetalert2.min.css">
</head>
<body>
  <section>
    <article>
      <form class="container">
        <div class="form-group">
          <select class="form-control col-4">
            <option value="0">Seleccione un área...</option>
          </select>
        </div>
      </form>
    </article>
    <article id="tabla">
      <div>
        <button>Crear hallazgo</button>
      </div>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Tema</th>
            <th>evidencia</th>
          </tr>
        </thead>
      </table>
    </article>
  </section>

  <!-- Código JavaScript-->
  <script src="../../Library/jquery-3.3.1.min.js"></script>
  <script src="../../Library/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../Library/sweetalert2/sweetalert2.all.min.js"></script>
</body>
</html>
