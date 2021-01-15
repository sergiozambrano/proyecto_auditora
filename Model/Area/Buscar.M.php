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

        $this->sql = "SELECT areas.id_area , concat(persona.nombre_pri_per,' ',persona.apellido_pri_per)persona, persona.id_persona, areas.nombre_unidad, areas.certificado FROM areas INNER JOIN persona on areas.id_usuario_encargado=persona.id_persona WHERE $c LIKE '%$t%'";
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
