<?php
include_once '../../../Enviroment/Conexion.php';

class HallazgoM extends Conexion{
  private $sql;
  private $statement;
  private $resulSet;

  public function __construct(){
    parent::__construct();
  }

  public function mostrar($hallazgoD){
    $this->sql = "SELECT a_p.id_auditoria, a.nombre_unidad, a_p.id_usu_auditor, MONTH(a_p.fecha_programacion) AS fecha,
                    a_p.estado_auditoria
                  FROM auditoria_programacion AS a_p
                  INNER JOIN areas AS a on a.id_area=a_p.id_area
                  WHERE a_p.id_usu_auditor=? AND a_p.estado_auditoria='En proceso'";
    $this->statement = $this->conexion->prepare($this->sql);
    $this->statement->execute(array($hallazgoD->id_usuario_creacion));

    return $this->resulSet = $this->statement->fetchAll(PDO::FETCH_NUM);
  }
}
?>
