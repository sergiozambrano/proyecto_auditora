<?php
include_once "../../Enviroment/Conexion.php";

class ProgramaM extends Conexion{
  private $sql;
  private $statement;
  private $resultSet;

  public function __construct(){
    parent::__construct();
  }

  public function auditorias($id){
    try {
      $this->sql = "SELECT a_p.id_auditoria, a.nombre_unidad, a_p.id_usu_auditor, MONTH(a_p.fecha_programacion) AS fecha,
                    a_p.estado_auditoria
                    FROM auditoria_programacion AS a_p
                    INNER JOIN areas AS a on a.id_area=a_p.id_area
                    WHERE a_p.id_usu_auditor=? AND a_p.estado_auditoria!='Finalizada'";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($id));

      $this->resultSet = $this->statement->fetchAll(PDO::FETCH_ASSOC);

      return $this->resultSet;

    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function inicioAuditoria($id_auditoria, $id_usuario){
    try {
      $this->sql = "UPDATE auditoria_programacion SET estado_auditoria='En proceso' WHERE id_auditoria=?";

      $this->statement = $this->conexion->prepare($this->sql);
      if($this->statement->execute(array($id_auditoria))){
        $this->sql = "INSERT INTO ejecucion_auditoria(id_auditoria_programada, fecha_inicio, id_usuario_creacion)
                      VALUES (?,current_timestamp(),?)";

        $this->statement = $this->conexion->prepare($this->sql);
        if($this->statement->execute(array($id_auditoria,$id_usuario))){
          $directorio = '../../File/'.$id_auditoria;

          if(mkdir($directorio, 0777, true) == true){
            if (mkdir($directorio.'/anexos-auditor', 0777, true)==true && mkdir($directorio.'/evidencias-hallazgos', 0777, true)==true && mkdir($directorio.'/evidencia-planMejoramiento', 0777, true)==true) {
              return 1;
            }

          }else{
            return 2;
          }

        }else{
          return 2;
        }

      }else{
        return 2;
      }

    } catch (\Throwable $th) {
      return $th;
    }
  }
}
?>
