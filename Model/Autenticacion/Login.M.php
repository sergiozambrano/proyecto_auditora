<?php
include_once '../../Enviroment/Conexion.php';

if(!isset($_SESSION)) {
  session_start();
}

class LoginM extends Conexion{
  private $sql;
  private $statement;
  private $resulSet;

  public function __construct(){
    parent::__construct();
  }

  public function login($loginD){
    try {
      $this->sql = "SELECT p.nombre_pri_per, p.apellido_pri_per, u.id_usuario, u.pass_usu, u.estado_usu
                    FROM persona AS p
                    INNER JOIN usuario AS u ON u.id_persona=p.id_persona
                    WHERE p.num_documento=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($loginD->documento));

      $this->resulSet =  $this->statement->rowCount();  #Obteniendo el numero de filas afectadas por la consulta

      if ($this->resulSet === 1) {
        $this->resulSet = $this->statement->fetch(PDO::FETCH_ASSOC);  #Obteniendo los campos de la fila en un arreglo asociativo

        if ($this->resulSet['estado_usu'] == 1) {
          if (password_verify($loginD->pass, $this->resulSet['pass_usu'])) {
            $_SESSION['nombre'] = $this->resulSet['nombre_pri_per']." ".$this->resulSet['apellido_pri_per'];
            $_SESSION['id'] = $this->resulSet['id_usuario'];
            return 1;
          }
          else{
            return 2;
          }

        } else {
          return 3;
        }
      } else {
          return 0;
      }
    } catch (\Throwable $e) {
        return -1;
    }
  }

  public function limiteIntento($documento){
    try {
      $this->sql = "UPDATE usuario SET estado_usu='0'
                    WHERE id_persona = (SELECT id_persona FROM persona WHERE num_documento=?)";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($documento));

      return $this->statement = (true) ? 1 : 0;

    } catch (\Throwable $th) {
      return -1;
    }
  }

  /**
   * Validar si el documento existe en la base de datos
   * valPerClave = validar persona clave.
   */
  public function valPerClave($documento){
    try {
      $this->sql = "SELECT nombre_pri_per, apellido_pri_per, correo
                    FROM persona
                    WHERE num_documento=?";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($documento));

      return $this->resulSet = $this->statement->fetch(PDO::FETCH_ASSOC);

    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function restablecerClave($loginD){
    $this->sql = "UPDATE usuario SET pass_usu=?
                  WHERE id_persona = (SELECT id_persona FROM persona WHERE num_documento=?)";

    $this->statement = $this->conexion->prepare($this->sql);
    $this->statement->execute(array($loginD->pass, $loginD->documento));

    return $this->statement = (true) ? 1 : 0;
  }
}
?>
