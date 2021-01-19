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
            try{
            $this->sql="SELECT * FROM anexos WHERE estado_anexo=1";
            $this->statement = $this->conexion->prepare($this->sql);
            $this->statement->execute();
    
            return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
            }catch(Exception $e){
                return $e;
            }
        }
        public function filtroAuditoria($fecha){
            try {
                $this->sql="SELECT anexos.id_anexo,anexos.id_ejecucion_auditoria,anexos.nombre_anexo,anexos.estado_anexo,ruta_anexo 
                FROM anexos 
                INNER JOIN ejecucion_auditoria 
                ON anexos.id_ejecucion_auditoria=ejecucion_auditoria.id_ejecucion_auditoria 
                INNER JOIN auditoria_programacion 
                ON ejecucion_auditoria.id_auditoria_programada=auditoria_programacion.id_auditoria 
                WHERE YEAR(auditoria_programacion.fecha_programacion)= ? AND anexos.estado_anexo=1";
                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute(array($fecha));
                
                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                
        
            } catch (Exception $e) {
                return $e;
            }
            
        }


    }

?>