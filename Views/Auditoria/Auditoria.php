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
  <link rel="stylesheet" type="text/css" href="../../Library/fonts/iconic/css/material-design-iconic-font.min.css">

  <!-- Custom styles for this template-->
  <link href="../../Library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Css/estilos.css">
  <link rel="stylesheet" href="../../Library/sweetalert2/sweetalert2.min.css">

</head>
<body>
  <section class="container-fluid">
    <article class="row align-items-center">
      <div class="col">
        <a class='btn btn-outline-primary' href="ProgramaAuditoria.php">Volver</a>
      </div>

      <div class="col">
        <button type="button" class="btn btn-info" onclick="info()">
          Información
        </button>
      </div>

      <div class="form-check col d-flex">
        <div class="mx-2">
          <button class="btn btn-secondary my-2" type="button" id="desactivar">Desactivar</button>
        </div>
        <div class="form-check form-check-inline ">
          <input class="form-check-input" id="validado" type="radio" name="validacion" value="1">
          <label class="form-check-label" for="validado">Validado</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" id="noValidado" type="radio" name="validacion" value="0">
          <label class="form-check-label" for="noValidado">No Validado</label>
        </div>
      </div>

      <div class="d-flex justify-content-end">
        <div class="d-inline py-2">
          <button type="button" class="btn btn-primary" onclick="subirArchivo()">Subir</button>
        </div>
        <form class="form-inline mx-2">
          <div>
            <select class="form-control " id="selecBuscador">
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
            <th scope="col">Descargar</th>
          </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
      </table>
    </article>
  </section>

  <!-- Modal informacion auditoria -->
  <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Infromación Auditoría</h5>
      </div>
      <div class="modal-body">
        <table>
          <tdoby>
            <tr class="row">
              <td class="col-7 my-2">
                <label class="form-label" for="tipoAuditoria">Tipo Auditoria</label>
                <input class="form-control" type="text" id="tipoAuditoria" disabled>
              </td>
              <td class="col-5 my-2">
                <label class="form-label" for="fecha">Fecha</label>
                <input class="form-control" type="text" id="fecha" disabled>
              </td>
              <td class="col-6 my-2">
                <label class="form-label" for="encargadoArea">Encargado del área</label>
                <input class="form-control" type="text" id="encargadoArea" disabled>
              </td>
              <td class="col-6 my-2">
                <label class="form-label" for="observacion">Observación</label>
                <input class="form-control" type="text" id="observacion" disabled>
              </td>
            </tr>
          </tdoby>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
      </div>
    </div>
  </div>
</div>

  <!-- Modal subir anexos -->
  <div class="modal fade" id="subirArchivoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subir archivo</h5>
        </div>
        <div class="modal-body">
          <form id="formArchivo" enctype="multipart/form-data">
            <div class="mb-3">
              <input class="form-control" type="file" id="subirArchivo">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal observaciones -->
  <div class="modal fade" id="observacionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Observación</h5>
        </div>
        <div class="modal-body">
          <p  id="observacionBody"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Código JavaScript-->
  <script src="../../Library/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="../../Library/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Código propio JavaScript-->
  <script src="../../Js/Auditoria/Auditoria.js"></script>
</body>
</html>
