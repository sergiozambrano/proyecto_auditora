<?php
  require_once "../../Enviroment/Conexion.php";

  class auditorM extends Conexion{

    private $sql;
    private $statement;
    private $resultset;

    public function __construct(){
      parent::__construct();
    }

    public function read(){
      try {
          $this->sql = "SELECT u.`id_usuario`, p.`nombre_pri_per`, p.`nombre_seg_per`, p.`apellido_pri_per`, p.`apellido_seg_per`
                        FROM `usuario` AS u
                        INNER JOIN `persona` AS p
                        ON u.`id_persona`= p.`id_persona`
                        INNER JOIN `usuario_rol` AS ur
                        ON u.`id_usuario`= ur.`id_usuario`
                        INNER JOIN `rol` AS r
                        ON ur.`id_rol`= r.`id_rol`
                        WHERE r.`id_rol` = 2
                        AND u.`estado_usu` = 1";

          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute();

          return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
          return $th;
      }
    }
  }

?>
