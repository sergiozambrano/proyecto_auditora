<?php
 require_once "../../Enviroment/Conexion.php";

class  BuscarM extends Conexion{
    private $sql;
    private $statement;
    private $resultSet;


    public function __construct(){
        parent::__construct();
    }
     #Con esta función hacemos la consulta para hacer las busquedas de datos desde la vista
    public function buscar($obj){

        $c = $obj->criterio;
        $t = $obj->texto;

        $this->sql = "SELECT hallazgo.id_hallazgo,plan_mejoramiento.id_plan_mejoramiento,hallazgo.tema_hallazgo,plan_mejoramiento.aspecto_mejora,plan_mejoramiento.acciones_planteadas,plan_mejoramiento.ruta_evidencia,plan_mejoramiento.fecha_evidencia,plan_mejoramiento.estado_plaMejor
        FROM hallazgo 
        INNER JOIN plan_mejoramiento
        ON plan_mejoramiento.id_hallazgo=hallazgo.id_hallazgo 
        WHERE $c LIKE '%$t%'";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(
            array(
                $obj->criterio,
                $obj->texto
            )
        );
       return $this->resultset = $this->statement->fetchAll(PDO::FETCH_ASSOC);

    }

}


?>
