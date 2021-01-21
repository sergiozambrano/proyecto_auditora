<?php
  include_once('../../Enviroment/Autenticacion.php');
  $sesion = new Sesion();
  $sesion->autenticacion();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Css/style.css">
</head>
<body>
  <section class="container-fluid">
    <!--Ventada Modal-->
    <button type="button" class="btn btn-primary" id="btnArea" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Agregar área
    </button>

      <!-- Modal enviar-->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Agregar Área</h5>
            </div>
            <div class="modal-body">
              <form class="form" id="Enviar">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Encargado</label>
                  </div>
                  <select class="custom-select" id="usuario">
                    <option selected>Elegir encargado...</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  </div>
                  <input type="text" class="form-control" placeholder="Area" id="nombre" aria-label="Username" aria-describedby="basic-addon1" required="">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Certificación</label>
                </div>
                <select class="custom-select" id="certificado" required="">
                  <option selected>Elegir estado...</option>
                  <option value="si certificado">Si certificada</option>
                  <option value="no certificado">No certificada</option>
                </select>
                </div>
                  <div class="section1 text-right">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <input type="submit"  class="btn btn-primary" value="Enviar" id="inserEnviar">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Editar-->
      <div class="modal fade" id="modelActualizar">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Área</h5>
            </div>
            <div class="modal-body">
              <form class="form" id="Editar">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Encargado</label>
                    </div>
                    <select class="custom-select" id="usuarioEditar">

                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    </div>
                    <input type="text" class="form-control" placeholder="Area" id="nombreEditar" aria-label="Username" aria-describedby="basic-addon1"  required="">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Certificación</label>
                  </div>
                  <select class="custom-select" id="certificadoEditar" required="">
            
                  </select>
                  <input type='hidden' id='idArea'>
                  </div>
                  <div class="section1 text-right">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar">Cerrar</button>
                  <input type="submit"  class="btn btn-primary" value="Editar" id="editEnviar">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

  
      <!--Buscador-->
      <form class="form-inline my-2 my-lg-0" id="buscador">
        <select class="form-control" id="criterio">
          <option value="areas.nombre_unidad">Nombre Unidad</option>
          <option value="persona.nombre_pri_per">Usuario</option>
          <option value="areas.certificado">Certificado</option>
        </select>
        <input class="form-control mr-sm-2 " type="search"  placeholder="Search" id="texto" aria-label="Search">
      </form>
      </br>

      <!--Tabla donde de listan los datos-->
      <table class="table" id="tablaAreas">
          <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Nombre Unidad</th>
                <th scope="col">Certificado</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
          <tbody id="tbody">
        </tbody>
      </table>
  </section>
  <div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

      <script src="../../Library/jquery-3.3.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
      <script src="../../Js/Area/Area.js"></script>
      <script src="../../Js/Area/Buscador.js"></script>
      <script src="../../Library/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
