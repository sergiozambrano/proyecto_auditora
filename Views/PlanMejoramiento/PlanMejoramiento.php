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
<body onload="seleccionar(null);leer();validarTiempo();">
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>Plan de mejoramiento<button onclick="vProrroga();" type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#staticBackdrop3">Prorrogas</button></h2>

      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-3">
        <form id="form" class="form-inline my-2 my-lg-0">
            <label for='validationDefault01'>Hallazgo</label>
            <select class='form-select'  id='hallazgo' name='hallazgo'>
            </select>
        </form>
      </div>
      <div class="col-md-9">
        <form class="form-inline my-2 my-lg-0" id="buscador">
            <select class="form-control" id="criterio">
              <option value="hallazgo.tema_hallazgo">Hallazgo</option>
              <option value="plan_mejoramiento.estado_plaMejor">Estado</option>
            </select>
            <input class="form-control mr-sm-2 " type="search"  placeholder="Search" id="texto" aria-label="Search">
        </form>
      </div>
    </div>

    <div class="modal fade" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel1">Editar Plan Mejoramiento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formEdit" enctype="multipart/form-data" method="POST">
              <div class="container-fluid">

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationDefault02">Entregable</label>
                          <input type="file"  id="entregable_edit" name="entregable_edit" required>
                      </div>
                      <div class="col-md-6 mb-3">

                      </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationDefault04">Estado</label>
                          <select class="custom-select" id="estado_edit" disabled>
                              <option default selected>Abierto</option>
                              <option >Sin avance</option>
                              <option >Cerrado</option>
                              <option >Vencido</option>
                          </select>
                        </div>
                      <div class="col-md-6 mb-3">
                        <label for="validationDefault02">Fecha Entregable</label>
                        <input type="date" class="form-control" id="fecha_edit" name="fecha_edit">
                        <input type="hidden" id="idAuditoria">
                        <input type="hidden" id="idEjecucion">
                        <input type="hidden" id="idAnexo">
                        <input type="hidden" id="nombreArchivo">
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary" type="submit" id="id" onclick="editar(); evidencia()">Editar</button>
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
  <div class="modal fade" id="staticBackdrop2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel1">Crear Prorroga</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formProrroga">
            <div class="container-fluid">

                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="validationDefault03">Fecha Prorroga</label>
                      <input type="date" class="form-control" id="fechaProrro" value="" required>
                    </div>
                  </div>
                  <div>
                    <label for="validationDefault03">Observacion</label>
                    <textarea class="form-control" id="observacionProrro" value="" required></textarea>
                  </div>
                  <div class="col-md-12 mb-3">
                      <button class="btn btn-primary" type="submit" id="idProrroga" onclick="prorroga();">Extender</button>
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

    <table class="table">
      <thead class="table-dark">
          <tr>
              <th scope="col">#</th>
              <th scope="col">Hallazgo</th>
              <th scope="col">Fecha implementacion</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
          </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>
    <div class="modal fade" id="staticBackdrop3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel1">Prorrogas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form >
              <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Plan Mejoramiento</th>
                        <th scope="col">Fecha Prorroga</th>
                        <th scope="col">Observacion</th>
                    </tr>
                </thead>
                <tbody id="tpro">
                </tbody>
              </table>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </div>

  <div class="modal fade" id="staticBackdrop4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel4">Hallazgos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form >
            <table class="table">
              <thead class="table-dark">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tema </th>
                      <th scope="col">Acciones Plantedas</th>
                      <th scope="col">Aspecto Por Mejorar</th>
                      <th scope="col">Fecha </th>
                      <th scope="col">Evidencia</th>
                  </tr>
              </thead>
              <tbody id="tHallazgo">
              </tbody>
            </table>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
</div>
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
    <script src="../../Js/PlanMejoramiento/PlanMejoramiento.js"></script>
    <script src="../../Js/PlanMejoramiento/BuscadorPlan.js"></script>
</body>
</html>
