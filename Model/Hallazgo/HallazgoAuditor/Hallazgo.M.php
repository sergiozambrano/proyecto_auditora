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
}
?>
