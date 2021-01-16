<?php
  require_once "../../Enviroment/Conexion.php";

    class programacionAnualM extends Conexion{

        private $sql;
        private $statement;
        private $resultset;

        public function __construct(){
        parent::__construct();
        }

        public function read(){
            try {
                $this->sql = "SELECT YEAR(`fecha_programacion`) 
                            FROM `auditoria_programacion` 
                            GROUP BY YEAR(`fecha_programacion`)";
                $this->statement = $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
            } catch (\Throwable $th) {
                return $th;
            }
        }
    }

?>