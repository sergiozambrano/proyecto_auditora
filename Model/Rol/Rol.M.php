<?php
    require_once "../../Enviroment/Conexion.php";

    class rol_m extends Conexion{

        private $sql;
        private $statement;
        private $resultset;

        public function __construct(){
            parent::__construct();
        }

        //funcion para consultar todos los roles 
        public function read(){
            try {
                $this->sql = "SELECT * FROM rol";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                
            } catch (\Throwable $th) {
                return $th;
            }
        }
        //funcion para insertar un nuevo rol 
        public function insert($rol){
            try{
                //consultamos si existe algun rol con el nombre que queremos insertar
                $this->sql= "SELECT * FROM `rol` WHERE nombre_rol = ?";

                $this->statement= $this->conexion->prepare($this->sql);
                $this->statement->execute(array($rol->nombre_rol));

                $this->resulSet =  $this->statement->rowCount();  #Obteniendo el numero de filas afectadas por la consulta
                
                //condicional verificar si la consulta sql encontro un rol existente
                if ($this->resulSet === 1) {
                    $this->resulSet = $this->statement->fetch(PDO::FETCH_ASSOC);  #Obteniendo los campos de la fila en un arreglo asociativo
                    
                    return 2;
                    
                } else {
                    //insertamos los datos ya que no existe el rol
                    try{
                        $this->sql= "INSERT INTO `rol`(`nombre_rol`, `estado_rol`, `id_usuario_creacion`)
                        VALUES (?,?,?)";
        
                        $this->statement= $this->conexion->prepare($this->sql);
                        $this->resultset=$this->statement->execute(
                            array(
                                $rol->nombre_rol,
                                $rol->estado_rol,
                                $rol->id_usuario_creacion
                            )
                        );
        
                        return 1;
        
                    }catch(Exception $e){
                        return $e;
                    }
                }

            }catch(Exception $e){
                return $e;
            }
        }
        //funcion para eliminar un rol
        public function delete($id){
            try {

                $this->sql= "DELETE FROM rol WHERE id_rol= ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(array($id));
                return $this->resultset;
                
            } catch (Exception $e) {
                return $e;
            }
        }
        //funcion para actualizar un rol (estado)
        public function update($rol, $id){

            try {
                $this->sql= "UPDATE rol SET `nombre_rol` = ?, `estado_rol` = ?, `id_usuario_creacion` = ? WHERE `id_rol` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                    array(
                        $rol->nombre_rol,
                        $rol->estado_rol,       
                        $rol->id_usuario_creacion,
                        $id
                    )
                );

                return $this->resultset;

            } catch (Exception $e) {
                return $e;
            }
        
        }

        
    }

?>