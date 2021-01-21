<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Css/style.css">
</head>
<body>
  <div class="container-fluid">

  </br>

    <!-- boton de usuarios activos -->
    <button type="button" class="btn btn-primary" id="activos" data-toggle="modal" data-target="#modal_usuarios_activos" onclick="seleccionar_usuarios_activos();">
        usuarios activos
    </button>

    <!-- boton de usuarios inactivos -->
    <button type="button" class="btn btn-danger" id="inactivos" data-toggle="modal" data-target="#modal_usuarios_inactivos" onclick="seleccionar_usuarios_inactivos();">
        usuarios inactivos
    </button>

    <form class="form-inline my-2 my-lg-0" id="buscador">
      <select class="form-control" id="criterio">
        <option value="persona.nombre_pri_per">Nombre</option>
        <option value="persona.num_documento">Numero de documento</option>
      </select>

      <input class="form-control mr-sm-2 " type="search"  placeholder="Search" id="texto" aria-label="Search">
    </form>

    <table class="table">
      <thead class="thead-dark">
          <tr>
              <th scope="col">#</th>
              <th scope="col">Primer nombre</th>
              <th scope="col">Primer apellido</th>
              <th scope="col">Numero documento</th>
              <th scope="col">Opciones</th>
          </tr>
      </thead>
      <tbody id="tbody">

      </tbody>
    </table>

    <!--comienzo del modal para usuarios activos -->
    <div class="modal fade" id="modal_usuarios_activos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Usuarios activos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Primer nombre</th>
                    <th scope="col">Primer apellido</th>
                    <th scope="col">Numero documento</th>
                    <th scope="col">Codigo del contrato</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="tbody-activos">

            </tbody>
            </table>

    </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- final del modal de usuarios activos -->

    <!--comienzo del modal para usuarios inactivos -->
    <div class="modal fade" id="modal_usuarios_inactivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Usuarios inactivos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Primer nombre</th>
                    <th scope="col">Primer apellido</th>
                    <th scope="col">Numero documento</th>
                    <th scope="col">Codigo del contrato</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="tbody-inactivos">

            </tbody>
            </table>

    </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- final del modal de usuarios inactivos -->

    <!-- modal de asignar usuario -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Asignacion de usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--modal de editar usuario-->
  <div class="modal fade" id="editar_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form_edit">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--modal de roles de usuario-->
  <div class="modal fade" id="roles_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Roles</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form id="form_roles">
                <div class='form-row'>
                  <div class='col-md-3 mb-3'>
                    <select class='custom-select' id='selectRol' required>

                    </select>
                  </div>
                  <div class='col-md-3 mb-3' id='asignarRol'>

                  </div>
                </div>
              </form>

            <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
              <tbody id="tbody-roles">

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="../../Library/popper.min.js"></script>
<script src="../../Library/sweetalert2/sweetalert2.all.min.js"></script>


<script src="../../Library/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="../../Js/UsuarioRol/UsuarioRol.js"></script>
<script src="../../Js/UsuarioRol/BuscadorUsuarioRol.js"></script>


</body>
</html>
