<?php
 require_once "../../../Enviroment/Conexion.php";

class  BuscarM extends Conexion{
    private $sql;
    private $statement;
    private $resultSet;


    public function __construct(){
        parent::__construct();
    }
     #Con esta función hacemos la consulta para hacer las busquedas de datos desde la vista
    public function buscar($obj){

        $t = $obj->texto;

        $this->sql = "SELECT * FROM `hallazgo` WHERE YEAR(fecha_hallazgo) LIKE '%$t%'";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(
            array(
                $obj->texto
            )
        );
       return $this->resultset = $this->statement->fetchAll(PDO::FETCH_ASSOC);

    }

}


?>
