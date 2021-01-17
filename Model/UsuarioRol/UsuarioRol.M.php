<?php
    require_once "../../Enviroment/Conexion.php";

    class usuario_roles_m extends Conexion{

        private $sql;
        private $statement;
        private $resultset;
        

        public function __construct(){
            parent::__construct();
        }

        public function read(){
            try {
                $this->sql = "SELECT persona.id_persona,persona.nombre_pri_per, persona.apellido_pri_per, persona.num_documento FROM persona left join usuario on persona.id_persona =usuario.id_persona where usuario.id_persona is null";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function seleccionar_usuarios_activos(){
            try {
                $this->sql = "SELECT  persona.id_persona,persona.nombre_pri_per, persona.apellido_pri_per, persona.num_documento,usuario.cod_contrato_usu, usuario.id_usuario
                            FROM persona
                            INNER JOIN usuario
                            ON persona.id_persona = usuario.id_persona
                            WHERE usuario.estado_usu = 1";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function seleccionar_usuarios_inactivos(){
            try {
                $this->sql = "SELECT  persona.id_persona,persona.nombre_pri_per, persona.apellido_pri_per, persona.num_documento,usuario.cod_contrato_usu, usuario.id_usuario
                            FROM persona
                            INNER JOIN usuario
                            ON persona.id_persona = usuario.id_persona
                            WHERE usuario.estado_usu = 0";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function activar($id){

            try {
                $this->sql= "UPDATE usuario SET `estado_usu` = 1 WHERE `id_persona` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                    array(
                        $id
                    )
                );

                return $this->resultset;

            } catch (Exception $e) {
                return $e;
            }
        
        }
        public function desactivar($id){

            try {
                $this->sql= "UPDATE usuario SET `estado_usu` = 0 WHERE `id_persona` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                    array(
                        $id
                    )
                );

                return $this->resultset;

            } catch (Exception $e) {
                return $e;
            }
        
        }

        public function insert($usuarios){
            try{
                $this->sql= "INSERT INTO `usuario`(`id_persona`, `cod_contrato_usu`, `pass_usu`, `estado_usu`, `id_usuario_creacion`) 
                VALUES (?,?,?,?,?)";

                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                    array(
                        $usuarios->id_persona,
                        $usuarios->numero_contrato,
                        $usuarios->contraseña_verificada,
                        $usuarios->estado,
                        $usuarios->id_usuario_creacion
                    )
                );

                return $this->resultset;

            }catch(Exception $e){
                return $e;
            }
        }
        
        public function update($usuarios){

            try {
                $this->sql= "UPDATE usuario SET `cod_contrato_usu` = ?, `pass_usu` = ?, `estado_usu` = ?, `id_usuario_creacion` = ? WHERE `id_usuario` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                    array(
                        $usuarios->numero_contrato,
                        $usuarios->contraseña_verificada,
                        $usuarios->estado,
                        $usuarios->id_usuario_creacion,
                        $usuarios->id_persona
                    )
                );

                return $this->resultset;

            } catch (Exception $e) {
                return $e;
            }
        
        }

        public function roles($id_usuario){
            try {
                $this->sql = "SELECT rol.nombre_rol, usuario_rol.id_usuario_rol, usuario_rol.id_usuario FROM usuario_rol INNER join rol on usuario_rol.id_rol = rol.id_rol WHERE usuario_rol.id_usuario = ?";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute(array($id_usuario));

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function selectRoles(){
            try {
                $this->sql = "SELECT id_rol , nombre_rol FROM `rol` WHERE estado_rol = 1";

                $this->statement = $this->conexion->prepare($this->sql);
                $this->statement->execute();

                return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                
            } catch (\Throwable $th) {
                return $th;
            }
        }

        public function asignarRol($id_rol,$id_usuario,$id_usuario_creacion){
           
            try{
                $this->sql= "SELECT * FROM usuario_rol WHERE id_usuario = ? AND id_rol= ?";

                $this->statement= $this->conexion->prepare($this->sql);
                $this->statement->execute(array($id_usuario,$id_rol));

                $this->resulSet =  $this->statement->rowCount();  #Obteniendo el numero de filas afectadas por la consulta

                //validamos si la persona ya existe
                if ($this->resulSet === 1) {
                    $this->resulSet = $this->statement->fetch(PDO::FETCH_ASSOC);  #Obteniendo los campos de la fila en un arreglo asociativo
                    
                    return 2;
                    
                } else {
                    try{
                        $this->sql = "INSERT INTO `usuario_rol`(`id_rol`,`id_usuario`,`id_usuario_creacion`) VALUES (?,?,?)";

                        $this->statement = $this->conexion->prepare($this->sql);
                        $this->statement->execute(
                            array(
                                $id_rol,
                                $id_usuario,
                                $id_usuario_creacion
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

        public function delete($id){
            try {

                $this->sql= "DELETE FROM `usuario_rol` WHERE id_usuario_rol = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(array($id));
                return $this->resultset;
                
            } catch (Exception $e) {
                return $e;
            }
        }
    }

?>