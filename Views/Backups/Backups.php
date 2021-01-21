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
    <button type="button" class="btn btn-primary my-2" id="btnBackup">Agregar día de respaldo</button>
      <div class="modal fade" id="modelInsertar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                </div>
                  <div class="modal-body">
                    <form class="form" method="post">
                      <div class="input-group mb-3">
                        <label for="validationDefault03">Ingrese cada cuantos <b>Día</b> quiere hacer el respaldo</label>
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        </div>
                        <input type="number" min="1" class="form-control" id="tiempo" required="">
                        </div>
                        </div>
                        <div class="section1 text-right">
                        <button type="button" class="btn btn-secondary" id="cerrarModal" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit"  class="btn btn-primary" id="btnFormulario" value="Enviar" id="inserEnviar">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <br>
      <!--Tabla donde de listan los datos-->
      <div class="container">
         <div class="row table-responsive">
             <table class="table text-center" id="Tbackup">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Peso (KB)</th>
                      <th scope="col">Descargar</th>
                    </tr>
                  </thead>
                <tbody id="tbody">
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <script src="../../Library/jquery-3.3.1.min.js"></script>
      <script src="../../Library/bootstrap/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

      <!-- Script propios -->
      <script src="../../Js/Backups/backup.js"></script>

</body>
</html>
