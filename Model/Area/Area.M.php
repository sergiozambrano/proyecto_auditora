<?php
    require_once "../../Enviroment/Conexion.php";

    class area_m extends Conexion{

        private $sql;
        private $statement;
        private $resultset;
        private $nombre_unidad;

        public function __construct(){
            parent::__construct();
        }
        #Con esta función traemos los datos de la BD que vamos a mostrar en la vista
        public function read(){
            try {
                $this->sql = "SELECT areas.id_area , concat(persona.nombre_pri_per,' ',persona.apellido_pri_per)persona,
                persona.id_persona, areas.nombre_unidad, areas.certificado from areas
                inner join persona on areas.id_usuario_encargado = persona.id_persona";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

            } catch (\Throwable $th) {
                return $th;
            }
        }
        #Con esta función hacemos la consulta para insertar datos desde la vista
        public function insert($area){
            try{
                $this->sql= "INSERT INTO areas(id_usuario_encargado, nombre_unidad, certificado,id_usuario_creacion)
                VALUES (?,?,?,?)";

                $this->statement= $this->conexion->prepare($this->sql);
                $this->statement->execute(
                    array(
                        $area->id_usuario_encargado,
                        $area->nombre_unidad,
                        $area->certificado,
                        $area->id_usuario_creacion
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
        #Con esta función hacemos la consulta para elimar datos desde la vista
        public function delete($id){
            try {

                $this->sql= "DELETE FROM areas WHERE id_area= ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(array($id));
                if ( $this->resultset==true) {
                    return 1;
                }
                else{
                    return 2;
                }

            } catch (Exception $e) {
                return $e;
            }
        }
         #Con esta función hacemos la consulta para editar datos desde la vista
        public function update($area){

            try {
                $this->sql= "UPDATE areas SET `nombre_unidad` = ?, `certificado` = ? , `id_usuario_encargado` = ?
                            WHERE `id_area` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->statement->execute(
                    array(
                        $area->nombre_unidad,
                        $area->certificado,
                        $area->id_usuario_encargado,
                        $area->id_unidad
                    )
                );

                return $this->statement = (true) ? 1 : 0;

            } catch (Exception $e) {
                return $e;
            }

        }
         #Con esta función hacemos la consulta para listar los nombres de las personas en el select del modal insetar
        public function readSelect(){
            try {
                $this->sql = "SELECT concat(persona.nombre_pri_per,' ',persona.apellido_pri_per)persona, persona.id_persona
                FROM `persona` inner JOIN usuario_rol on usuario_rol.id_usuario = persona.id_persona
                INNER JOIN rol on usuario_rol.id_rol = rol.id_rol WHERE rol.id_rol=3";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

            } catch (\Throwable $th) {
                return $th;
            }
        }
    }

?>
