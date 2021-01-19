<?php
 require_once "../../../Enviroment/Conexion.php";

class  VistaHallazgoM extends Conexion{
    private $sql;
    private $statement;
    private $resultSet;


    public function __construct(){
        parent::__construct();
    }
     #Con esta función hacemos la consulta para hacer las busquedas de datos desde la vista
    public function mostrar($idArea){

        $this->sql = "SELECT hallazgo.id_hallazgo,hallazgo.fecha_hallazgo,hallazgo.tema_hallazgo,hallazgo.acciones_planteadas,hallazgo.aspecto_mejora,hallazgo.ruta_evidencia
        FROM areas INNER JOIN auditoria_programacion
        ON areas.id_area=auditoria_programacion.id_area
        INNER JOIN ejecucion_auditoria
        ON auditoria_programacion.id_auditoria=ejecucion_auditoria.id_auditoria_programada
        INNER JOIN  hallazgo
        ON hallazgo.id_ejecucion_auditoria=ejecucion_auditoria.id_ejecucion_auditoria
        WHERE areas.id_area=?";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(
            array(
                $idArea->idArea
            )
        );
        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

    }
    public function selec(){
        $this->sql = "SELECT id_area,nombre_unidad FROM `areas`";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute();
        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
    }
    public function default(){
        $this->sql = "SELECT * FROM `hallazgo`";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute();
        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
    }

}


?>
