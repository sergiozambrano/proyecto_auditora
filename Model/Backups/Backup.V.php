<?php
    require_once "../../Enviroment/Conexion.php";

    class area_m extends Conexion{

        private $sql;
        private $statement;
        private $resultset;

        public function __construct(){
            parent::__construct();
        }
        #Con esta función traemos los datos de la BD
        public function read(){
            try {
                $this->sql = "SELECT * FROM usuario AS u
                INNER JOIN usuario_rol AS u_r ON u_r.id_usuario=u.id_usuario
                INNER JOIN rol AS r ON r.id_rol=u_r.id_rol
                WHERE u.id_usuario=? && r.nombre_rol=? ";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

            } catch (\Throwable $th) {
                return $th;
            }
        }
 }

?>
