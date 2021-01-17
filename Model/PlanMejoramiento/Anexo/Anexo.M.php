<?php
    require_once "../../../Enviroment/Conexion.php";
    class Anexom extends Conexion{
        private $sql;
        private $statement;
        private $resultset;

        public function __construct(){
            parent::__construct();
        }
        public function leer(){
            $this->sql="SELECT * FROM anexos WHERE estado_anexo=1";
            $this->statement = $this->conexion->prepare($this->sql);
            $this->statement->execute();
    
            return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
        }
    }

?>