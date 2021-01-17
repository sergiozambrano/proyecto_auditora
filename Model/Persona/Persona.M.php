<?php
    require_once "../../Enviroment/Conexion.php";

    class persona_m extends Conexion{

        private $sql;
        private $statement;
        private $resultset;

        public function __construct(){
            parent::__construct();
        }

        //consultamos todas las personas registradas
        public function read(){
            try {
                $this->sql = "SELECT * FROM persona";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                
            } catch (\Throwable $th) {
                return $th;
            }
        }

        //funcion para insertar personas
        public function insert($persona){
            try{
                $this->sql= "SELECT * FROM `persona` WHERE num_documento = ? OR correo = ?";

                $this->statement= $this->conexion->prepare($this->sql);
                $this->statement->execute(array($persona->num_doc_per,$persona->corre_per));

                $this->resulSet =  $this->statement->rowCount();  #Obteniendo el numero de filas afectadas por la consulta

                //validamos si la persona ya existe
                if ($this->resulSet === 1) {
                    $this->resulSet = $this->statement->fetch(PDO::FETCH_ASSOC);  #Obteniendo los campos de la fila en un arreglo asociativo
                    
                    return 2;
                    
                } else {
                    try{
                        //ejecutamos el insert para registra una persona
                        $this->sql= "INSERT INTO `persona`(`nombre_pri_per`, `nombre_seg_per`, `apellido_pri_per`,`apellido_seg_per`, `tipo_doc_per`, `num_documento`, `num_celular`, `correo`, `fecha_nac_per`,`genero_per`, `id_usuario_creacion`)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        
                        $this->statement= $this->conexion->prepare($this->sql);
                        $this->resultset=$this->statement->execute(
                            array(
                                $persona->primer_nombre_per,
                                $persona->segundo_nombre_per,
                                $persona->primer_apellido_per,
                                $persona->segundo_apellido_per,
                                $persona->tipo_doc_per,
                                $persona->num_doc_per,
                                $persona->num_cel_per,
                                $persona->corre_per,
                                $persona->fecha_nacimiento_per,
                                $persona->genero_per,
                                $persona->id_usuario_creacion
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
        
        //funcion para eliminar personas
        public function delete($id){
            try {

                $this->sql= "DELETE FROM persona WHERE id_persona= ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(array($id));
                return $this->resultset;
                
            } catch (Exception $e) {
                return $e;
            }
        }
        
        //funcion para editar datos personales
        public function update($persona, $id){

            try {
                $this->sql= "UPDATE persona SET `nombre_pri_per` = ?, `nombre_seg_per` = ?, `apellido_pri_per` = ?, `apellido_seg_per` = ?, `tipo_doc_per` = ?, `num_documento` = ?, `num_celular` = ?, `correo` = ?, `fecha_nac_per` = ?,`genero_per` = ?, `id_usuario_creacion` = ? WHERE `id_persona` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                    array(
                        $persona->primer_nombre_per,
                        $persona->segundo_nombre_per,
                        $persona->primer_apellido_per,
                        $persona->segundo_apellido_per,
                        $persona->tipo_doc_per,
                        $persona->num_doc_per,
                        $persona->num_cel_per,
                        $persona->corre_per,
                        $persona->fecha_nacimiento_per,
                        $persona->genero_per,
                        $persona->id_usuario_creacion,
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