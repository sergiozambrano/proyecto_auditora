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
                $this->sql = "SELECT * from backup ORDER BY(id_backup) DESC LIMIT 1";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

            } catch (\Throwable $th) {
                return $th;
            }
        }
        #Con esta función hacemos la consulta para insertar datos desde la vista
        public function insert($backup){
            try{
                $this->sql= "INSERT INTO backup(dia_respaldo, id_usuario_creacion)
                VALUES (?,?)";

                $this->statement= $this->conexion->prepare($this->sql);
                $this->statement->execute(
                    array(
                        $backup->dia_respaldo,
                        $backup->id_usuario_creacion
                    )
                );

                if ($this->statement == true){
                    return 1;
                }else{
                    return 2;
                }

            }catch(Exception $e){
                return $e;
            }
        }
        #Con esta función traemos la ruta, el nombre y peso de la copia de respaldo de la BD
        public function respaldo(){

                $thefolder = "../../File/respaldos/";
                if ($handler = opendir($thefolder)) {

                $i = 0;  
                while (false !== ($file = readdir($handler))) {
                    
                if($file != '.' && $file != '..'){
                    $arr[$i][0] = $file;
                    $arr[$i][1] = round(filesize($thefolder.'/'. $file) / 1024); 
                    $arr[$i][2] = $thefolder.$file;
                    $i++;
                }
            }
                closedir($handler);
        }
                return $arr;
    }
 }

?>
