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
  public function mostrar($auditoriaD){
    try {
      $this->sql = "SELECT a.id_anexo,a.nombre_anexo,a.estado_anexo,a.ruta_anexo,t_a.id_usuario_validacion,t_a.fecha_validacion,t_a.observa_anexo
                    FROM anexos AS a
                    INNER JOIN ejecucion_auditoria AS e_a ON e_a.id_ejecucion_auditoria=a.id_ejecucion_auditoria
                    LEFT JOIN trasa_anexos AS t_a ON t_a.id_anexo=a.id_anexo
                    WHERE a.id_usuario_creacion=? AND e_a.id_auditoria_programada=?
                    ORDER BY a.fecha_creacion DESC";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $auditoriaD->id_usuario_creacion,
        $auditoriaD->id_auditoria
      ));

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
      $this->sql = "SELECT a.id_anexo, a.nombre_anexo, a.ruta_anexo
                    FROM anexos AS a
                    INNER JOIN ejecucion_auditoria AS e_a ON e_a.id_ejecucion_auditoria=a.id_ejecucion_auditoria
                    WHERE nombre_anexo=? AND e_a.id_auditoria_programada=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($auditoriaD->nombre_anexo, $auditoriaD->id_auditoria));

      /**
       * Valido si el archivo ya existe para cambiar su nombre
       */
      $this->resulSet = $this->statement->rowCount();
      if($this->resulSet == 1){
        $this->resulSet = $this->statement->fetch(PDO::FETCH_NUM);

        $temp = explode(".", $auditoriaD->nombre_anexo);
        $nuevoNombre = reset($temp).round(microtime(true)). '.' . end($temp);
        $rutaNueva = $auditoriaD->directorio_anexo.$nuevoNombre;

        if(rename($this->resulSet[2],$rutaNueva)){
          $this->sql = "UPDATE anexos SET ruta_anexo=?
                        WHERE id_anexo=?";
          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($rutaNueva,$this->resulSet[0]));
        }
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
                    VALUES ((SELECT e_a.id_ejecucion_auditoria FROM auditoria_programacion AS a_p
                    INNER JOIN ejecucion_auditoria AS e_a ON e_a.id_auditoria_programada=a_p.id_auditoria
                    WHERE a_p.id_auditoria=?),?,?,?,?)";
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

  public function observacion($auditoriaD){
    try {
      $this->sql = "SELECT  observa_anexo
                  FROM trasa_anexos
                  WHERE id_anexo=?";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($auditoriaD->observa_anexo));

      return $this->resulSet = $this->statement->fetch(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  /**
   * Obtiene el nombre completo del coordinado que valido los anexos mostrador
   */
  public function nombreCoordinador($auditoriaD){
    try {
      $this->sql = "SELECT nombre_pri_per,apellido_pri_per
                    FROM persona AS p
                    INNER JOIN usuario AS u ON u.id_persona=p.id_persona
                    WHERE u.id_usuario=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($auditoriaD->id_usuario_validacion));

      return $this->resulSet = $this->statement->fetch(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  /**
   * Mostrar los datos validados / No validados
   */
  public function validacion($auditoriaD){
    try {
      $this->sql = "SELECT a.id_anexo,a.nombre_anexo,a.estado_anexo,a.ruta_anexo,t_a.id_usuario_validacion,t_a.fecha_validacion,t_a.observa_anexo
                    FROM anexos AS a
                    INNER JOIN ejecucion_auditoria AS e_a ON e_a.id_ejecucion_auditoria=a.id_ejecucion_auditoria
                    LEFT JOIN trasa_anexos AS t_a ON t_a.id_anexo=a.id_anexo
                    WHERE a.id_usuario_creacion=? AND e_a.id_auditoria_programada=? AND a.estado_anexo=?
                    ORDER BY a.fecha_creacion DESC";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $auditoriaD->id_usuario_creacion,
        $auditoriaD->id_auditoria,
        $auditoriaD->estado_anexo
      ));

      return $this->resulSet = $this->statement->fetchAll(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function buscar($auditoriaD){
    try {
      if ($auditoriaD->estado_anexo == '') {
        $this->sql = "SELECT a.id_anexo, a.nombre_anexo,a.estado_anexo,a.ruta_anexo,t_a.id_usuario_validacion,t_a.fecha_validacion,t_a.observa_anexo
              FROM anexos AS a
              INNER JOIN ejecucion_auditoria AS e_a ON e_a.id_ejecucion_auditoria=a.id_ejecucion_auditoria
              LEFT JOIN trasa_anexos AS t_a ON t_a.id_anexo=a.id_anexo
              WHERE a.id_usuario_creacion=? AND e_a.id_auditoria_programada=? AND a.".$auditoriaD->buscar." LIKE '%".$auditoriaD->valor."%'
              ORDER BY a.fecha_creacion DESC";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(array(
          $auditoriaD->id_usuario_creacion,
          $auditoriaD->id_auditoria,
        ));

      } else if ($auditoriaD->estado_anexo != ''){
        $this->sql = "SELECT a.id_anexo, a.nombre_anexo,a.estado_anexo,a.ruta_anexo,t_a.id_usuario_validacion,t_a.fecha_validacion,t_a.observa_anexo
              FROM anexos AS a
              INNER JOIN ejecucion_auditoria AS e_a ON e_a.id_ejecucion_auditoria=a.id_ejecucion_auditoria
              LEFT JOIN trasa_anexos AS t_a ON t_a.id_anexo=a.id_anexo
              WHERE a.id_usuario_creacion=? AND e_a.id_auditoria_programada=? AND a.estado_anexo=? AND a.".$auditoriaD->buscar." LIKE '%".$auditoriaD->valor."%'
              ORDER BY a.fecha_creacion DESC";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(array(
          $auditoriaD->id_usuario_creacion,
          $auditoriaD->id_auditoria,
          $auditoriaD->estado_anexo
        ));

      }
      return $this->resulSet = $this->statement->fetchAll(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function infoAuditoria($id){
    try {
      $this->sql = "SELECT a_p.tipo_auditoria,a_p.fecha_programacion,(SELECT id_usuario_encargado FROM areas WHERE id_area=a.id_area) AS Encargado,a_p.estado_auditoria,a_p.observacion
                    FROM auditoria_programacion AS a_p
                    INNER JOIN areas AS a ON a.id_area=a_p.id_area
                    WHERE id_auditoria=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($id));

      return $this->resulSet = $this->statement->fetch(PDO::FETCH_NUM);
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
?>
