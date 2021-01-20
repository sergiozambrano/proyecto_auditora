<?php
include_once('../../Enviroment/Autenticacion.php');
$sesion = new Sesion();
$sesion->autenticacion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Custom styles for this template-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="../../Css/estilos.css">
  <link rel="stylesheet" href="../../Library/sweetalert2/sweetalert2.min.css">
</head>
<body>
  <div class="container">
    <section>
      <div>
        <h2>Mis datos</h2>
      </div>
      <form id="datos">
        <div class="row">
          <div class="col-md-3 form-group">
            <label class="form-label" for="codigo_contrato">Código de Contrato</label>
            <input class="form-control"  type="text" id="codigo_contrato" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="primer_nombre">Primer Nombre</label>
            <input class="form-control"  type="text" id="primer_nombre" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="segundo_nombre">Segundo Nombre</label>
            <input class="form-control"  type="text" id="segundo_nombre" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="primer_apellido">Primer Apellido</label>
            <input class="form-control"  type="text" id="primer_apellido" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="segundo_apellido">Segundo Apellido</label>
            <input class="form-control"  type="text" id="segundo_apellido" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="tipo_documento">Tipo de Documento</label>
            <input class="form-control"  type="text" id="tipo_documento" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="numero_documento">Número de Documento</label>
            <input class="form-control"  type="text" id="numero_documento" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="numero_celular">Número Celular</label>
            <input class="form-control"  type="text" id="numero_celular" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="correo">Correo</label>
            <input class="form-control"  type="text" id="correo" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="fecha_nacimiento">Fecha de Nacimineto</label>
            <input class="form-control"  type="text" id="fecha_nacimiento" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="genero">Genero</label>
            <input class="form-control"  type="text" id="genero" value="" disabled>
          </div>
          <div class="col-md-3 form-group">
            <label class="form-label" for="perfil_laboral">Perfil laboral</label>
            <input class="form-control"  type="text" id="perfil_laboral" value="" disabled>
          </div>
      </form>
    </section>
    <br>
    <section>
      <div>
        <h2>Cambiar contraseña</h2>
      </div>
      <form id="clave">
        <div class="row">
          <div class="form-group col-md-4">
            <label class="form-label" for="claveActual">Contraseña Actual</label>
            <input class="form-control" type="password" id="claveActual" name="claveActual">
          </div>
          <div class="form-group col-md-4">
            <label class="form-label" for="claveNueva">Contraseña Nueva</label>
            <input class="form-control" type="password" id="claveNueva" name="claveNueva">
          </div>
          <div class="form-group col-md-4">
            <label class="form-label" for="repetirClaveNueva">Repetir Contraseña</label>
            <input class="form-control" type="password" id="repetirClaveNueva" name="repetirClaveNueva">
          </div>
        </div>
        <div id="alerta"></div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit" name="btnClave">Cambiar</button>
        </div>
      </form>
    </section>
  </div>

  <!-- Código JavaScript-->
  <script src="../../Library/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="../../Library/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Código propio JS -->
  <script src="../../Js/Usuario/Setting.js"></script>
</body>
</html>
