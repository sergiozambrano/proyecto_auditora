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
  <title>Hallazgos de auditorias</title>
  <link rel="stylesheet" href="../../Library/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../Library/sweetalert2/sweetalert2.min.css">

  <link rel="stylesheet" href="../../Css/estiloH.css">
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>
          Anexos de las auditorias
        </h2>
      </div>
    </div>
    <div class="row justify-content-between">
      <div class="col-8">
        <button type="button" id="validados" class="btn btn-primary">Anexos validados</button>
      </div>
      <div class="col-3">
        <form id="buscador">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <input class="form-control" type="search"  placeholder="Buscar por nombre anexo" id="texto" aria-label="Search">
            </div>
          </div>
        </form>
      </div>
    </div>
    <br>
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del anexo</th>
                <th scope="col">Auditoria</th>
                <th scope="col">Estado del anexo</th>
                <th scope="col">Descargar anexo</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal informacion auditoria -->
  <div class="modal fade" id="modalInformacion" tabindex="-1" aria-labelledby="modalInformacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalInformacionLabel">Informacion de auditoria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">Nombre del auditor</th>
                  <th scope="col">Nombre del area</th>
                  <th scope="col">Fecha de la auditoria</th>
                </tr>
              </thead>
              <tbody>
                <tr id="modal_Informacion">
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal validacion -->
  <div class="modal fade" id="modalValidacion" tabindex="-1" aria-labelledby="modalValidacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalValidacionLabel">Validar anexo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_validacion">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <textarea class="form-control" aria-label="With textarea" id="observacion" rows="5" placeholder="Escriba sus observaciones del anexo" required></textarea>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 mb-3 ">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="check_validar">
                  <label class="custom-control-label" for="check_validar">¿Desea validar el anexo?</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12 mb-3">
                <button type="submit" id="btn_validar" class="btn btn-primary">Enviar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal validados -->
  <div class="modal fade" id="modalValidados" tabindex="-1" aria-labelledby="modalValidadosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalValidadosLabel">Anexos validados</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre del anexo</th>
                  <th scope="col">Auditoria</th>
                  <th scope="col">Estado del anexo</th>
                  <th scope="col">Descargar anexo</th>
                  <th scope="col">Observaciones</th>
                </tr>
              </thead>
              <tbody id="modal_validados">

              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script src="../../Library/jquery-3.3.1.min.js"></script>
  <script src="../../Library/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../Library/popper.min.js"></script>
  <script src="../../Library/sweetalert2/sweetalert2.min.js"></script>

  <script src="../../Js/ProgramacionAuditoria/Anexo.js"></script>
  <script src="../../Js/ProgramacionAuditoria/Services.js"></script>
</body>
</html>
