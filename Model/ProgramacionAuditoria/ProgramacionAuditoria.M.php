<?php
  require_once "../../Enviroment/Conexion.php";

  class programacionAuditoriaM extends Conexion{

    private $sql;
    private $statement;
    private $resultset;

    public function __construct(){
      parent::__construct();
    }

    //Metodo para imprimir todo los registros de la table de programacion de auditoria
    public function read($programacionAuditoria, $where){
      try {

        //Verifica si llego el arreglo del flitro como no null
        if($programacionAuditoria!=null){

          //Consulta con filtro
          $this->sql = "SELECT u.`id_persona`, p.`nombre_pri_per`, p.`nombre_seg_per`, p.`apellido_pri_per`, p.`apellido_seg_per`, pa.`tipo_auditoria`,pa.`fecha_programacion`, pa.`estado_auditoria`, pa.`observacion`, a.`nombre_unidad`, pa.`id_auditoria`, pa.`id_area`, pa.`id_usu_auditor`
                        FROM `auditoria_programacion` AS pa
                        INNER JOIN `usuario` AS u
                        ON pa.`id_usu_auditor`= u.`id_usuario`
                        INNER JOIN `persona` AS p
                        ON u.`id_persona`= p.`id_persona`
                        INNER JOIN `areas` AS a
                        ON pa.`id_area` = a.`id_area` 
                        WHERE pa.`id_usu_auditor` LIKE ?
                        AND pa.`id_area` LIKE ?
                        AND pa.`tipo_auditoria` LIKE ?
                        AND YEAR(pa.`fecha_programacion`) = ?";

          $this->statement = $this->conexion->prepare($this->sql);
          $this->resultset = $this->statement->execute(
            array(
              $programacionAuditoria->idUsuarioAuditor,
              $programacionAuditoria->idArea,
              $programacionAuditoria->tipoAuditoria,
              $where
            )
          );

        }
        else{
          //Consulta sin filtro
          $this->sql = "SELECT u.`id_persona`, p.`nombre_pri_per`, p.`nombre_seg_per`, p.`apellido_pri_per`, p.`apellido_seg_per`, pa.`tipo_auditoria`,pa.`fecha_programacion`, pa.`estado_auditoria`, pa.`observacion`, a.`nombre_unidad`, pa.`id_auditoria`, pa.`id_area`, pa.`id_usu_auditor`
                        FROM `auditoria_programacion` AS pa
                        INNER JOIN `usuario` AS u
                        ON pa.`id_usu_auditor`= u.`id_usuario`
                        INNER JOIN `persona` AS p
                        ON u.`id_persona`= p.`id_persona`
                        INNER JOIN `areas` AS a
                        ON pa.`id_area` = a.`id_area`
                        WHERE YEAR(pa.`fecha_programacion`) = ?";
          $this->statement = $this->conexion->prepare($this->sql);
          $this->resultset=$this->statement->execute(array($where));
        }

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
          return $th;
      }
    }
    //Metodo para guardar informacion en la tabla programaion de auditoria
    public function insert($programacionAuditoria){
      try{
          $this->sql= "INSERT INTO `auditoria_programacion`(`id_area`, `id_usu_auditor`,	`tipo_auditoria`,	`fecha_programacion`,	`estado_auditoria`,	`observacion`,	`id_usuario_creacion`)
          VALUES (?,?,?,?,?,?,?)";

          $this->statement= $this->conexion->prepare($this->sql);
          $this->resultset=$this->statement->execute(
              array(
                  $programacionAuditoria->idArea,
                  $programacionAuditoria->idUsuarioAuditor,
                  $programacionAuditoria->tipoAuditoria,
                  $programacionAuditoria->fechaProgramacion,
                  $programacionAuditoria->estadoAuditoria,
                  $programacionAuditoria->observacion,
                  $programacionAuditoria->idUsuarioCreacion
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
    //Metodo para editar informacion de la tabla programaion de auditoria
    public function update($programacionAuditoria, $where){
      try {
          $this->sql= "UPDATE `auditoria_programacion` SET `id_area` = ?, `id_usu_auditor` = ?, `tipo_auditoria` = ?, `fecha_programacion` = ?, `observacion` = ? WHERE `id_auditoria` = ?";

          $this->statement= $this->conexion->prepare($this->sql);
          $this->resultset=$this->statement->execute(
              array(
                $programacionAuditoria->idArea,
                $programacionAuditoria->idUsuarioAuditor,
                $programacionAuditoria->tipoAuditoria,
                $programacionAuditoria->fechaProgramacion,
                $programacionAuditoria->observacion,
                $where
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
    //Metodo para validar si el auditor esta ocupado
    public function AvailabilityUser($programacionAuditoria, $where, $operacion){
      try{

        //Condicional para saber a que formulario esta haciendo la validacion
        if($operacion=="Create"){
          $this->sql= "SELECT `fecha_programacion` 
                      FROM `auditoria_programacion` 
                      WHERE `id_usu_auditor` = ?
                      AND `fecha_programacion` = ?";

          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($programacionAuditoria->idUsuarioAuditor, $programacionAuditoria->fechaProgramacion));
                      
        }
        else if($operacion=="Edit"){
          $this->sql= "SELECT `fecha_programacion` 
                      FROM `auditoria_programacion` 
                      WHERE `id_usu_auditor` = ? 
                      AND `fecha_programacion` = ? 
                      AND `id_auditoria` != ?";

          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($programacionAuditoria->idUsuarioAuditor, $programacionAuditoria->fechaProgramacion, $where));
        }

        $this->resulSet = $this->statement->rowCount();  #Obteniendo el numero de filas afectadas por la consulta

        if ($this->resulSet === 1) {
          return 1;
        }
        else{
          return 2;
        }

      }catch (Exception $e){
        return 0;
      }
    }
    //Metodo para validar si el area esta ocupado
    public function AvailabilityArea($programacionAuditoria, $where, $operacion){
      try{

        //Condicional para saber a que formulario esta haciendo la validacion
        if($operacion=="Create"){
          $this->sql= "SELECT `fecha_programacion` 
                    FROM `auditoria_programacion` 
                    WHERE `id_area` = ?
                    AND `fecha_programacion` = ?";
          
          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($programacionAuditoria->idArea, $programacionAuditoria->fechaProgramacion));
        }
        else if($operacion=="Edit"){
          $this->sql= "SELECT `fecha_programacion` 
                    FROM `auditoria_programacion` 
                    WHERE `id_area` = ?
                    AND `fecha_programacion` = ?
                    AND `id_auditoria` != ?";
          
          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($programacionAuditoria->idArea, $programacionAuditoria->fechaProgramacion, $where));

        }

        $this->resulSet = $this->statement->rowCount();  #Obteniendo el numero de filas afectadas por la consulta

        if ($this->resulSet === 1) {
          return 1;
        }
        else{
          return 2;
        }

      }catch (Exception $e){
        return 0;
      }
    }
  }

?>
