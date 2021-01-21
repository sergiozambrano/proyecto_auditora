<?php
include_once '../../../Enviroment/Conexion.php';

class HallazgoM extends Conexion{
  private $sql;
  private $statement;
  private $resulSet;

  public function __construct(){
    parent::__construct();
  }

  public function mostrarAuditorias($hallazgoD){
    try {
      $this->sql = "SELECT a_p.id_auditoria, a.nombre_unidad, a_p.id_usu_auditor, MONTH(a_p.fecha_programacion) AS fecha,
                      a_p.estado_auditoria
                    FROM auditoria_programacion AS a_p
                    INNER JOIN areas AS a on a.id_area=a_p.id_area
                    WHERE a_p.id_usu_auditor=? AND a_p.estado_auditoria='En proceso'";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($hallazgoD->id_usuario_creacion));

      return $this->resulSet = $this->statement->fetchAll(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function mostrar($hallazgoD){
    try {
      $this->sql = "SELECT h.id_hallazgo,p_m.id_plan_mejoramiento,h.tema_hallazgo,p_m.fecha_evidencia,p_m.ruta_evidencia,p_m.estado_plaMejor
                    FROM hallazgo AS h
                    INNER JOIN ejecucion_auditoria AS e_a ON e_a.id_ejecucion_auditoria=h.id_ejecucion_auditoria
                    LEFT JOIN plan_mejoramiento AS p_m ON p_m.id_hallazgo=h.id_hallazgo
                    WHERE h.id_usuario_creacion=? AND e_a.id_auditoria_programada=?
                    ORDER BY p_m.fecha_creacion DESC";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $hallazgoD->id_auditoria,
        $hallazgoD->id_usuario_creacion
      ));

      return $this->resulSet = $this->statement->fetchAll(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function verHallazgo($hallazgoD){
    try {
      $this->sql = "SELECT * FROM hallazgo WHERE id_hallazgo=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
          $hallazgoD->id_hallazgo
        ));

      return $this->resulSet = $this->statement->fetch(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  /**
   * Guardar el anexo a la carpeta correspondiente
   */
  public function guaAneCar($hallazgoD){
    try {
      $this->sql = "SELECT * FROM hallazgo AS h
                    INNER JOIN ejecucion_auditoria AS e_a on e_a.id_ejecucion_auditoria=h.id_ejecucion_auditoria
                    WHERE h.ruta_evidencia=? AND h.id_usuario_creacion=? AND e_a.id_auditoria_programada=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $hallazgoD->ruta_evidencia,
        $hallazgoD->id_usuario_creacion,
        $hallazgoD->id_auditoria
      ));

      /**
       * Valido si el archivo ya existe para cambiar su nombre
       */
      $this->resulSet = $this->statement->rowCount();
      if($this->resulSet <= 0){

        if(file_exists('../'.$hallazgoD->directorio) == true){
          opendir('../'.$hallazgoD->directorio);

          if(move_uploaded_file($hallazgoD->validacion,'../'.$hallazgoD->ruta_evidencia) == true){
            return self::guaAneBd($hallazgoD);

          }else{
            return 0;
          }
        }else{
          return 0;
        }

      }else{
        return 2;
      }



    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function guaAneBd($hallazgoD){
    try {
      $this->sql = "INSERT INTO hallazgo(id_ejecucion_auditoria, fecha_hallazgo, tema_hallazgo,
                    acciones_planteadas, aspecto_mejora, ruta_evidencia, id_usuario_creacion)
                    VALUES ((SELECT e_a.id_ejecucion_auditoria FROM ejecucion_auditoria AS e_a
                    INNER JOIN auditoria_programacion AS a_p ON a_p.id_auditoria=e_a.id_auditoria_programada
                    WHERE a_p.id_auditoria=?),	current_timestamp()	,?,?,?,?,?)";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $hallazgoD->id_auditoria,
        $hallazgoD->tema_hallazgo,
        $hallazgoD->aciones_planteadas,
        $hallazgoD->aspecto_mejorar,
        $hallazgoD->ruta_evidencia,
        $hallazgoD->id_usuario_creacion
      ));

      if ($this->statement == true) {
        $this->sql = "INSERT INTO plan_mejoramiento(id_hallazgo, estado_plaMejor)
                      VALUES ((SELECT id_hallazgo FROM hallazgo ORDER BY id_hallazgo DESC LIMIT 1),?)";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(array('Abierto'));

        return $this->statement = (true) ? 1 : 0;

      } else {
        return 0;
      }


      //return $this->statement = (true) ? 1 : 0;

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function verEstoPlan($hallazgoD){
    try {
      $this->sql = "SELECT estado_plaMejor FROM plan_mejoramiento WHERE id_plan_mejoramiento=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $hallazgoD->id_planMejoramiento
      ));

      return $this->resulSet = $this->statement->fetch(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function cambioEstadoPlan($hallazgoD){
    try {
      $this->sql = "UPDATE plan_mejoramiento SET estado_plaMejor=? WHERE id_plan_mejoramiento=?";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
          $hallazgoD->estado_planMejoramiento,
          $hallazgoD->id_planMejoramiento
        ));

        return $this->statement = (true) ? 1 : 0;

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function buscar($hallazgoD){
    try {
      $this->sql = "SELECT h.id_hallazgo,p_m.id_plan_mejoramiento,h.tema_hallazgo,p_m.fecha_evidencia,p_m.ruta_evidencia,p_m.estado_plaMejor
      FROM hallazgo AS h
      INNER JOIN ejecucion_auditoria AS e_a ON e_a.id_ejecucion_auditoria=h.id_ejecucion_auditoria
      LEFT JOIN plan_mejoramiento AS p_m ON p_m.id_hallazgo=h.id_hallazgo
      WHERE h.id_usuario_creacion=? AND e_a.id_auditoria_programada=? AND p_m.".$hallazgoD->buscar." LIKE '%".$hallazgoD->valor."%'
      ORDER BY p_m.fecha_creacion DESC";
      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $hallazgoD->id_usuario_creacion,
        $hallazgoD->id_auditoria
      ));

      return $this->resulSet = $this->statement->fetchAll(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  } //Areglar

  public function verProrroga($hallazgoD){
    try {
      $this->sql = "SELECT h.tema_hallazgo,pr_m.fecha_adicional,pr_m.estado_prorroga,pr_m.observacion,pr_m.id_prorroga_mejoramiento,pr_m.id_plan_mejoramiento
                  FROM prorroga_mejoramiento AS pr_m
                  LEFT JOIN plan_mejoramiento AS p_m ON p_m.id_plan_mejoramiento=pr_m.id_plan_mejoramiento
                  LEFT JOIN hallazgo AS h ON h.id_hallazgo=p_m.id_hallazgo
                  LEFT JOIN ejecucion_auditoria AS e_a ON e_a.id_ejecucion_auditoria=h.id_ejecucion_auditoria
                  WHERE h.id_usuario_creacion=? AND e_a.id_auditoria_programada=? AND pr_m.estado_prorroga=0";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $hallazgoD->id_usuario_creacion,
        $hallazgoD->id_auditoria
      ));

      return $this->resulSet = $this->statement->fetchAll(PDO::FETCH_NUM);

    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function editarProrroga($hallazgoD){
    try {
      $this->sql = "UPDATE prorroga_mejoramiento SET estado_prorroga=?,observacion=?
                    WHERE id_prorroga_mejoramiento=?";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array(
        $hallazgoD->estado_planMejoramiento,
        $hallazgoD->valor,
        $hallazgoD->id_prorroga
      ));

      return $this->statement = (true) ? 1 : 0;

    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
?>
