<?php
  require_once "../../Enviroment/Conexion.php";

  class anexoM extends Conexion{

    private $sql;
    private $statement;
    private $resultset;

    public function __construct(){
      parent::__construct();
    }

    public function read(){
      try {

        $this->sql = "SELECT * FROM `anexos`
                      WHERE `id_usuario_creacion`=(SELECT u.`id_usuario`
                      FROM `usuario` AS u
                      INNER JOIN `usuario_rol` AS u_r
                      ON u_r.`id_usuario`=u.`id_usuario`
                      WHERE u_r.`id_usuario_rol`=2)
                      AND `estado_anexo` = 0";

        $this->statement = $this->conexion->prepare($this->sql);
        $this->resultset=$this->statement->execute();

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
          return $th;
      }
    }

    public function readInformation($idAuditoria){
      try {

        $this->sql = "SELECT p.`nombre_pri_per`, p.`nombre_seg_per`, p.`apellido_pri_per`, p.`apellido_seg_per`, a.`nombre_unidad`, pa.`fecha_programacion`
                      FROM `ejecucion_auditoria` AS ae
                      INNER JOIN `auditoria_programacion` AS pa
                      ON ae.`id_auditoria_programada` = pa.`id_auditoria`
                      INNER JOIN `usuario` AS u
                      ON pa.`id_usu_auditor` = u.`id_usuario`
                      INNER JOIN `persona` AS p
                      ON u.`id_persona` = p.`id_persona`
                      INNER JOIN `areas` AS a
                      ON pa.`id_area` = a.`id_area`
                      WHERE ae.`id_ejecucion_auditoria` = ?";

        $this->statement = $this->conexion->prepare($this->sql);
        $this->resultset=$this->statement->execute(array($idAuditoria));

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
          return $th;
      }
    }

    public function readValidated(){
      try {

        $this->sql = "SELECT * FROM `anexos`
                      WHERE `id_usuario_creacion`=(SELECT u.`id_usuario`
                      FROM `usuario` AS u
                      INNER JOIN `usuario_rol` AS u_r
                      ON u_r.`id_usuario`=u.`id_usuario`
                      WHERE u_r.`id_usuario_rol`=2)
                      AND `estado_anexo` = 1";

        $this->statement = $this->conexion->prepare($this->sql);
        $this->resultset=$this->statement->execute();

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
          return $th;
      }
    }

    public function readObservation($idAnexo){
      try {

        $this->sql = "SELECT ta.`observa_anexo`
                      FROM `trasa_anexos` AS ta
                      INNER JOIN `anexos` AS a
                      ON ta.`id_anexo` = a.`id_anexo`
                      WHERE a.`id_anexo` = ?";

        $this->statement = $this->conexion->prepare($this->sql);
        $this->resultset=$this->statement->execute(array($idAnexo));

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
          return $th;
      }
    }

    public function insert($anexo){
      try{
          $this->sql= "INSERT INTO `trasa_anexos`(`id_anexo`, `id_usuario_validacion`, `observa_anexo`)
          VALUES (?,?,?)";

          $this->statement= $this->conexion->prepare($this->sql);
          $this->resultset=$this->statement->execute(
              array(
                $anexo->idAnexo,
                $anexo->idUsuarioValidacion,
                $anexo->observacion
              )
          );

          if($this->resultset){
            return 1;
          }
          else{
            return 2;
          }

      }catch(Exception $e){
        return 0;
      }
    }

    public function edit($idAnexo){
      try {
          $this->sql= "UPDATE `anexos` SET `estado_anexo` = 1 WHERE `id_anexo` = ?";

          $this->statement= $this->conexion->prepare($this->sql);
          $this->resultset=$this->statement->execute(
            array(
              $idAnexo
            )
          );

          if($this->resultset){
            return 1;
          }
          else{
            return 2;
          }

      }catch (Exception $e) {
        return 0;
      }
    }

    public function Search($texto){
      $this->sql = "SELECT * FROM `anexos`
                    WHERE `id_usuario_creacion`=(SELECT u.`id_usuario`
                    FROM `usuario` AS u
                    INNER JOIN `usuario_rol` AS u_r
                    ON u_r.`id_usuario`=u.`id_usuario`
                    WHERE u_r.`id_usuario_rol`=2)
                    AND `estado_anexo` = 0
                    AND `nombre_anexo` LIKE ?";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(
            array(
                $texto
            )
        );
        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
    }
  }

?>
