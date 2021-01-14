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
                    WHERE a_p.id_usu_auditor=?";

      $this->statement = $this->conexion->prepare($this->sql);
      $this->statement->execute(array($id));

      $this->resultSet = $this->statement->fetchAll(PDO::FETCH_ASSOC);

      return $this->resultSet;

    } catch (\Throwable $th) {
      return $th;
    }
  }
}

?>
