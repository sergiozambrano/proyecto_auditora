<?php
include_once '../../Enviroment/Conexion.php';

class AuditoriaM extends Conexion{
  private $sql;
  private $statement;
  private $resulSet;

  public function __construct(){
    parent::__construct();
  }

  /**
   * Mostrar los anexos vinculados a un auditor
   */
  public function mostrar($id){
    try {
      $this->sql = "SELECT a.id_anexo,a.nombre_anexo,a.estado_anexo,a.ruta_anexo,t_a.id_usuario_validacion,t_a.fecha_validacion,t_a.observa_anexo
                    FROM anexos AS a
                    LEFT JOIN trasa_anexos AS t_a ON t_a.id_anexo=a.id_anexo
                    WHERE a.id_usuario_creacion=?
                    ORDER BY a.fecha_creacion DESC";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($id));

      return $this->resulSet = $this->statement->fetchAll(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      return $th;
    }
  }

  /**
   * Guardar el anexo a la carpeta correspondiente
   */
  public function guaAneCar($auditoriaD){
    try {
      $this->sql = "SELECT nombre_anexo FROM anexos WHERE nombre_anexo=? AND id_ejecucion_auditoria=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($auditoriaD->nombre_anexo, $auditoriaD->id_auditoria));

      /**
       * Valido si el archivo ya existe para cambiar su nombre
       */
      $this->resulSet = $this->statement->rowCount();
      if($this->resulSet == 1){
        $temp = explode(".", $auditoriaD->nombre_anexo);
        $nuevoNombre = reset($temp).round(microtime(true)). '.' . end($temp);

        $auditoriaD->valida_anexo = rename($auditoriaD->nombre_anexo,$nuevoNombre);
      }

      if(file_exists($auditoriaD->directorio_anexo) == true){
        opendir($auditoriaD->directorio_anexo);

        if(move_uploaded_file($auditoriaD->valida_anexo,$auditoriaD->ruta_anexo) == true){
          return self::guaAneBd($auditoriaD);

        }else{
          return 0;
        }
      }else{
        return 0;
      }

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  /**
   * Guardar anexo en la BD
   */
  public function guaAneBd($auditoriaD){
    try {
      $this->sql = "INSERT INTO anexos(id_ejecucion_auditoria,nombre_anexo,estado_anexo,ruta_anexo,id_usuario_creacion)
                    VALUES (?,?,?,?,?)";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $auditoriaD->id_auditoria,
        $auditoriaD->nombre_anexo,
        $auditoriaD->estado_anexo,
        $auditoriaD->ruta_anexo,
        $auditoriaD->id_usuario_creacion
      ));

      return $this->statement = (true) ? 1 : 0;

    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
?>
