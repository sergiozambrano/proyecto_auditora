<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid">
   </br>
   <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Crear nuevo rol
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Creacion de roles</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <!-- Formulario de insertar-->
            <form id="form">
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationDefault01">Nombre del rol</label>
                  <select class="custom-select" id="nombre_rol" required>
                    <option>Administrador</option>
                    <option>Coordinador de auditoría</option>
                    <option>Auditor</option>
                    <option>Coordinador de área</option>
                  </select>	
                </div>
                <div class="col-md-3 mb-3">
                  <label for="validationDefault04">Estado del rol</label>
                  <select class="custom-select" id="estado_rol" required>
                    <option>Activo</option>
                    <option>Inactivo</option>
                  </select>	
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Enviar</button> 
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>  

    </br></br>
    <!--Listado de roles -->
    <table class="table">
      <thead class="thead-dark">
          <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Estado</th>
              <th scope="col">Opciones</th>
          </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>
    <!--Modal para editar los roles -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar rol</h5>
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

<script src="../../Library/popper.min.js"></script>
<script src="../../Library/sweetalert2/sweetalert2.all.min.js"></script>

<script src="../../Library/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="../../Js/Rol/Rol.js"></script>

</body>
</html>