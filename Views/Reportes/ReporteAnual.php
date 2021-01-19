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
    <title>Reporte</title>
    <link rel="stylesheet" href="../../Library/bootstrap/css/bootstrap.min.css">
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Reportes</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="list-group" id="reporte">
                </div>
            </div>
        </div>
    </div>

    <script src="../../Library/jquery-3.3.1.min.js"></script>
    <script src="../../Library/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../Js/Reportes/ReportesAnual.js"></script>
</body>
</html>