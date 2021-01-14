<?php
include_once '../../Enviroment/Conexion.php';

class UsuarioM extends Conexion{
  private $sql;
  private $statement;
  private $resulSet;

  public function roles($id){
    try {
      $this->sql = "SELECT r.nombre_rol FROM usuario AS u
                    INNER JOIN usuario_rol AS u_r ON u_r.id_usuario=u.id_usuario
                    INNER JOIN rol AS r ON r.id_rol=u_r.id_rol
                    WHERE u.id_usuario=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($id));

      $this->resulSet = $this->statement->fetchAll(PDO::FETCH_ASSOC);
      return $this->resulSet;

    } catch (\Throwable $e) {
        return -1;
    }
  }

  public function datos($id){
    try {
      $this->sql = "SELECT p.id_persona,u.cod_contrato_usu,p.nombre_pri_per,p.nombre_seg_per,p.apellido_pri_per,p.apellido_seg_per,
                    p.tipo_doc_per,p.num_documento,p.num_celular,p.correo,p.fecha_nac_per,p.genero_per,u.perfil_usu
                    FROM persona AS p
                    INNER JOIN usuario AS u ON u.id_persona=p.id_persona
                    WHERE u.id_usuario=?";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($id));

      $this->resulSet = $this->statement->fetchAll(PDO::FETCH_ASSOC);
      return $this->resulSet;

    } catch (\Throwable $e) {
      return -1;
    }
  }

  public function cambiarClave($usuarioD){
    try {
      $this->sql = "SELECT id_usuario, pass_usu
                    FROM usuario
                    WHERE id_usuario=?";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($usuarioD->id));

      $this->resulSet = $this->statement->fetch(PDO::FETCH_ASSOC);

      if (password_verify($usuarioD->claveActual, $this->resulSet['pass_usu'])) {

        if($usuarioD->claveActual =! $usuarioD->claveNueva){
          $this->sql = "UPDATE usuario SET pass_usu=? WHERE id_usuario=?";

          $this->statement = $this->conexion->prepare($this->sql);
          return $this->statement->execute(array($usuarioD->claveNueva, $usuarioD->id))? 1 : 0;

        }else{
          return 2;
        }
      }else{
        return 3;
      }

    } catch (\Throwable $th) {
      return $th;
    }
  }
}
?>
