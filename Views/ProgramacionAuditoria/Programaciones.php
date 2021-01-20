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
  <title>Programacion de auditoria</title>
  <link href="../../Library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Library/sweetalert2/sweetalert2.min.css">

  <link rel="stylesheet" href="../../Css/estiloH.css">
</head>
<body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h2>
            <a href="ProgramacionAnual.php" class="text-decoration-none">
              <svg xmlns="../../img/undraw_posting_photo.svg" width="40" height="40" class="bi bi-arrow-left-square-fill" viewBox="0 0 18 18">
                <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
              </svg>
            </a>
            Programacion de auditoria
            <span class="badge badge-secondary" id="ano"></span>
          </h2>
        </div>
      </div>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregar" id="agregar">Agregar nuevo</button>
      <form class="form-inline my-2 my-lg-0" id="buscador">
            <select class="form-control" id="criterio">
              <option value="a.`nombre_unidad`">Area</option>
              <option value="concat(p.`nombre_pri_per`,' ', p.`apellido_pri_per`)" title="Solo escribir el primer nombre y el primer apellido">Auditor</option>
              <option value="pa.`tipo_auditoria`">Tipo Auditoria</option>
              <option value="pa.`estado_auditoria`">Estado de la auditoria</option>
            </select>
            <input class="form-control mr-sm-2" type="search"  placeholder="Buscar" id="texto" aria-label="Search">
      </form>
      <div class="table-responsive">
        <table class="table">
          <thead class="thead-dark">
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Area</th>
                  <th scope="col">Auditor a cargo</th>
                  <th scope="col">Tipo Auditoria</th>
                  <th scope="col">Mes a realizar la auditoria</th>
                  <th scope="col">Estado de la auditoria</th>
                  <th scope="col">Observaciones</th>
                  <th scope="col">Opciones</th>
              </tr>
          </thead>
          <tbody id="tbody">
          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal agregar -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAgregarLabel">Creacion de programacion de auditoria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="alertCreate"></div>
            <form id="form">
              <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="id_area">Area</label>
                    <select class="custom-select" id="id_area" required>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="id_auditor">Auditor a cargo</label>
                  <select class="custom-select" id="id_auditor" required>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="tipo_auditoria">Tipo Auditoria</label>
                  <select class="custom-select" id="tipo_auditoria" required>
                    <option>Auditoria de aseguramiento</option>
                    <option>Auditoria de calidad</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="fecha_pro_au">Mes a realizar la auditoria</label>
                  <input class="form-control" type="month" id="fecha_pro_au" required>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="observacion">Observaciones</label>
                  <textarea class="form-control" id="observacion" rows="5" placeholder="Escriba sus observaciones"></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <button class="btn btn-primary" id="btn_agregar" type="submit">Enviar</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarLabel">Editar informacion de programacion de auditoria #<input id="input_id" type="text" style="border: 0;height: 20px; width: 25px;" disabled></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="alertEdit"></div>
            <form id="form_edit">
              <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="id_area_edit">Area</label>
                    <select class="custom-select" id="id_area_edit" required>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="id_auditor_edit">Auditor a cargo</label>
                  <select class="custom-select" id="id_auditor_edit" required>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="tipo_auditoria_edit">Tipo Auditoria</label>
                  <select class="custom-select" id="tipo_auditoria_edit" required>
                    <option>Auditoria de aseguramiento</option>
                    <option>Auditoria de calidad</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="fecha_pro_au_edit">Mes a realizar la auditoria</label>
                  <input class="form-control" type="month" id="fecha_pro_au_edit" required>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3" id="div_estado">
                  <label for="estado_auditoria">Estado auditoria</label>
                  <input class="form-control" type="text" id="estado_auditoria" required>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <label for="observacion_edit">Observaciones</label>
                  <textarea class="form-control" id="observacion_edit" rows="5" placeholder="Escriba sus observaciones"></textarea>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3">
                  <button class="btn btn-primary" id="btn_editar" type="submit">Enviar</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal observacion -->
  <div class="modal fade" id="modalObsevacion" tabindex="-1" aria-labelledby="modalObsevacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalObsevacionLabel">Observaciones</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="text-justify" id="imprimir_observacion">
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../../Library/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="../../Library/sweetalert2/sweetalert2.min.js"></script>

  <script src="../../Js/ProgramacionAuditoria/ProgramacionAuditoria.js"></script>
  <script src="../../Js/ProgramacionAuditoria/Services.js"></script>
</body>
</html>
