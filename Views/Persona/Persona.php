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
   <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" id="insertar" data-toggle="modal" data-target="#exampleModal">
      Crear nueva persona
    </button>

    <form class="form-inline my-2 my-lg-0" id="buscador">
      <select class="form-control" id="criterio">
        <option value="persona.nombre_pri_per">Nombre</option>
        <option value="persona.num_documento">Numero de documento</option>
        <option value="persona.genero_per">genero</option>
      </select>

      <input class="form-control mr-sm-2 " type="search"  placeholder="Search" id="texto" aria-label="Search">
    </form>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro de personas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <!--Forulario de insertar personas -->
          <form id="form">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationDefault01">Primer nombre</label>
                <input type="text" class="form-control" id="primer_nombre" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault02">Segundo nombre</label>
                <input type="text" class="form-control" id="segundo_nombre">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationDefault03">Primer apellido</label>
                <input type="text" class="form-control" id="primer_apellido"  required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault04">Segundo apellido</label>
                <input type="text" class="form-control" id="segundo_apellido">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationDefault05">Tipo de documento</label>
                <select class="custom-select" id="tipo" required>
                  <option>Cedula de ciudadania</option>
                  <option>Tarjeta de identidad</option>
                  <option>Cedula de extranjeria</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault06">Numero de documento</label>
                <input type="number" class="form-control" id="documento" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationDefault07">Numero de telefono</label>
                <input type="number" class="form-control" id="telefono" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault08">Correo electronico</label>
                <input type="email" class="form-control" id="correo" required>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationDefault09">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fecha_naciemiento" value="2011-08-19" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault10">Genero</label>
                <select class="custom-select" id="genero" required>
                  <option>Masculino</option>
                  <option>Femenino</option>
                  <option>Otro</option>
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

    </br>
    <!-- tabla para visualizar las personas registradas -->
    <table class="table">
      <thead class="thead-dark">
          <tr>
              <th scope="col">#</th>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Tipo Documento</th>
              <th scope="col">Numero documento</th>
              <th scope="col">Telefono</th>
              <th scope="col">Correo</th>
              <th scope="col">Fecha de nacimiento</th>
              <th scope="col">Genero</th>
              <th scope="col">Opciones</th>
          </tr>
      </thead>
      <tbody id="tbody">

      </tbody>
    </table>

    <!--Modal de edicion de datos personales -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edicion de datos personales</h5>
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
<script src="../../Js/Persona/Persona.js"></script>
<script src="../../Js/Persona/BuscadorPersona.js"></script>

</body>
</html>
