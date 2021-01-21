<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Custom fonts for this template-->
  <link href="../../../Library/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../../../Library/fonts/iconic/css/material-design-iconic-font.min.css">

  <!-- Custom styles for this template-->
  <link href="../../../Library/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../Css/estilos.css">
  <link rel="stylesheet" href="../../../Library/sweetalert2/sweetalert2.min.css">
</head>
<body>
  <section class="container-fluid">
    <article class="row align-items-center my-2">
      <div class="col ">
        <a class='btn btn-outline-primary' href="HallazgoProgramada.php">Volver</a>
      </div>

      <div class="col">
        <button type="button" class="btn btn-info" onclick="prorrogas()">
          Prorrogas
        </button>
      </div>

      <div class="d-flex justify-content-end col">
        <div class="d-inline">
          <button type="button" class="btn btn-primary" onclick="abrirModalCrearHallazgo()">Crear Hallazgo</button>
        </div>
      </div>

      <!-- <div class="d-flex justify-content-end ">
        <form class="form-inline mx-2">
          <div>
            <select class="form-control" id="selecBuscador">
              <option value="0">Fecha</option>
              <option value="1">Estado</option>
            </select>
          </div>
          <div>
            <input class="form-control" id="valorBuscador">
          </div>
        </form>
      </div> -->
    </article>

    <article>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Hallazgo</th>
            <th scope="col">Fecha</th>
            <th scope="col">Evidencia</th>
            <th scope="col">Estado</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody id="tbodyHallazgo">
        </tbody>
      </table>
    </article>
  </section>

  <!-- Modal ver Hallazgo-->
  <div class="modal fade" id="verHallazgoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hallazgo</h5>
        </div>
        <div class="modal-body">
          <table class="table">
            <tbody id="verHallazgo">
              <tr class="row">
                <td class="col-6 my-2">
                  <label class="form-label" for="temaHallazgo">Tema</label>
                  <textarea class="form-control" id="temaHallazgo"></textarea>
                </td>
                <td class="col-6 my-2">
                  <label class="form-label" for="fecha">Fecha</label>
                  <textarea class="form-control" id="fecha"></textarea>
                </td>
                <td class="col-6 my-2">
                  <label class="form-label" for="aspectoMejora">Observación</label>
                  <textarea class="form-control" id="aspectoMejora"></textarea>
                </td>
                <td class="col-6 my-2">
                  <label class="form-label" for="acciones">Accion planeada</label>
                  <textarea class="form-control" id="acciones"></textarea>
                </td>
                <td class="col-12 my-2">
                <label class="form-label" for="">Evidencia</label>
                  <a href="" download="" id="ruta"><i class='fas fa-arrow-down'></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal validar Plan mejoramiento-->
  <div class="modal fade" id="planMejoramientoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Valida plan mejoramiento</h5>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead class="thead-dark">
            </thead>
            <tbody id="planMejoramiento">
              <tr>
                <td><select id="estadoPlanMejoramiento" class="form-control col-12">
                  <option value="Abierto">Abierto</option>
                  <option value="Sin avance">Sin avance</option>
                  <option value="Cerrado">Cerrado</option>
                  <option value="Vencido">Vencido</option>
                </select></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Prorrogas-->
  <div class="modal fade" id="prorrogasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Prorrogas</h5>
        </div>
        <div class="modal-body">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tema hallazgo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Observacion</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody id="tbodyProrroga">

            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de crear hallazgos-->
  <div class="modal fade" id="hallazgoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Crear Hallazgo</h5>
        </div>
        <div class="modal-body">
          <form class="row"  enctype="multipart/form-data">
            <div class="col-6 my-2">
              <label class="form-label" for="crearTemaHallazgo">Tema</label>
              <textarea class="form-control" id="crearTemaHallazgo"></textarea>
            </div>
            <div class="col-6 my-2">
              <label class="form-label" for="crearAspectoHallazgo">Aspecto a mejorar</label>
              <textarea class="form-control" id="crearAspectoHallazgo"></textarea>
            </div>
            <div class="col-6 my-2">
              <label class="form-label" for="crearAccionHAllazgo">Accion planeada</label>
              <textarea class="form-control" id="crearAccionHAllazgo"></textarea>
            </div>
            <div class="col-12 my-2">
              <label class="form-label" for="">Evidencia</label>
              <input class="form-control" type="file" id="evidenciaHallazgo">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="crearHallazgo()">Crear</button>
          <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Código JavaScript-->
  <script src="../../../Library/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="../../../Library/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Código propio JavaScript-->
  <script src="../../../Js/Hallazgo/HallazgoAuditor/Hallazgo.js"></script>
  <script src="../../../Js/ProgramacionAuditoria/Services.js"></script>
</body>
</html>
