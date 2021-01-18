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
    <article class="row align-items-center">
      <div class="col">
        <a class='btn btn-outline-primary' href="ProgramaAuditoria.php">Volver</a>
      </div>

      <div class="form-check col d-flex">
        <div class="mx-2">
          <button class="btn btn-secondary" type="button" id="desactivar">Desactivar</button>
        </div>
        <div class="form-check form-check-inline ">
          <input class="form-check-input" id="validado" type="radio" name="validacion" value="1">
          <label class="form-check-label" for="validado">Validado</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" id="noValidado" type="radio" name="validacion" value="0">
          <label class="form-check-label" for="noValidado" checked>No Validado</label>
        </div>
      </div>

      <div class="d-flex justify-content-end">
        <div class="d-inline py-2">
          <button type="button" class="btn btn-primary" id="subirArchivoModal">Subir</button>
        </div>
        <form class="form-inline mx-2">
          <div>
            <select class="form-control" id="selecBuscador">
              <option value="0">Documento</option>
              <option value="1">Coordinador</option>
            </select>
          </div>
          <div>
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
            <th scope="col">Fecha</th>
            <th scope="col">Observación</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </article>
  </section>

  <!-- Modal subir anexos -->
  <div class="modal fade" id="subirArchivoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subir archivo</h5>
        </div>
        <div class="modal-body">
          <form id="formArchivo" enctype="multipart/form-data">
            <div>
              <label clas="form-label my-2" for="subirArchivo"></label>
              <input class="form-control my-2" type="file" id="subirArchivo">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="cerrarModal">Cerrar</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Código JavaScript-->
  <script src="../../Library/jquery-3.3.1.min.js"></script>
  <script src="../../Library/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../Library/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Código propio JavaScript-->
  <script src="../../Js/Auditoria/Auditoria.js"></script>
</body>
</html>
