<?php
     require_once "../../Enviroment/Conexion.php";
     
     
   //llama la conexion a la base de datos

    class GraficarM extends Conexion{//se extiende de la clase conexion
    //Se inicializan las variables privadas
        private $sql;
        private $statement;
        private $resultset;
        private $data;

        public function __construct(){
            parent::__construct();
        }
        function grafico($fechaA){
        try{    
            $this->sql="SELECT COUNT(id_auditoria) AS cantidad,estado_auditoria FROM auditoria_programacion WHERE YEAR(fecha_programacion)=? GROUP BY estado_auditoria";
            $this->statement= $this->conexion->prepare($this->sql);
            $this->statement->execute(array($fechaA));
            return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
            
        }catch(Exception $e){
            return $e;
            }
        }
        function filtro(){
            try {
                $this->sql="SELECT YEAR(fecha_programacion) FROM auditoria_programacion WHERE fecha_programacion GROUP BY YEAR(fecha_programacion) DESC";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->statement->execute();
                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
            } catch (Exception $e) {
                return $e;
            }
        }
        function filtroA($fechaA){
            try {
                $this->sql="SELECT COUNT(id_auditoria) AS cantidad,estado_auditoria FROM auditoria_programacion WHERE YEAR(fecha_programacion)=? GROUP BY estado_auditoria";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->statement->execute(array($fechaA));
                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
            } catch (Exception $e) {
                return $e;
            }
        }
    }

?>