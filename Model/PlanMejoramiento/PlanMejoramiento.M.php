<?php
  require_once "../../Enviroment/Conexion.php";//llama la conexion a la base de datos

  class PlanMejoramientom extends Conexion{//se extiende de la clase conexion
    //Se inicializan las variables privadas
    private $sql;
    private $statement;
    private $resultset;

    public function __construct(){
      parent::__construct();
    }
    public function read(){
      try {
        $this->sql = "SELECT id_hallazgo,tema_hallazgo 
        FROM hallazgo GROUP BY hallazgo.id_hallazgo";

        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute();

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
        return $th;
      }
    }
    public function readA($nombreHallazgo){
      try {
          $this->sql = "SELECT plan_mejoramiento.id_plan_mejoramiento,hallazgo.tema_hallazgo,plan_mejoramiento.aspecto_mejora,plan_mejoramiento.acciones_planteadas,plan_mejoramiento.ruta_evidencia,plan_mejoramiento.fecha_evidencia,plan_mejoramiento.estado_plaMejor
            FROM hallazgo 
            INNER JOIN plan_mejoramiento
            ON plan_mejoramiento.id_hallazgo=hallazgo.id_hallazgo
            WHERE hallazgo.id_hallazgo= ?";

          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($nombreHallazgo));

          return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
          return $th;
      }
    }
    public function vEdit(){
      try {
        $this->sql="SELECT * FROM plan_mejoramiento";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute();

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
      } catch (\Throwable $th) {
        return $th;
      }
    }

    public function evidencia($archivo,$tipoArchivo,$tamanoArchivo,$valida,$size,$id){
      try {
        $this->sql="SELECT COUNT(ruta_evidencia) FROM plan_mejoramiento WHERE id_plan_mejoramiento=?";
        $this->statement= $this->conexion->prepare($this->sql);
        $this->resultset=$this->statement->execute(array($id));
        $data=$this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
        $cont=$data[0][0];
        if($cont>0){
          return 3;
        }else{
          if($tamanoArchivo != false){
              $size = $size;
            if($size > 20000000){
                return 1;
            }else{
              if($tipoArchivo=="png"||$tipoArchivo=="jpg"||$tipoArchivo=="docx"||$tipoArchivo=="zip"||$tipoArchivo=="rar"||$tipoArchivo=="jpeg"||$tipoArchivo=="pdf"){
                $this->sql="UPDATE plan_mejoramiento SET `ruta_evidencia`=? WHERE `id_plan_mejoramiento` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                  array(
                      $archivo,
                      $id
                  )
                );
                if(move_uploaded_file($valida,$archivo)){
                  return $this->resultset;
                }
              }else{
               return 2;
              }
            }
          }else{
            return 0;
          }
        }
      } catch (Exception $e) {
        return $e;
      }
    }

    public function update($planMejoramiento, $id){
      try {
          $this->sql= "UPDATE plan_mejoramiento SET `aspecto_mejora` = ?, `acciones_planteadas` = ?,`estado_plaMejor` = ?, `id_usuario_creacion` = ? WHERE `id_plan_mejoramiento` = ?";
          $this->statement= $this->conexion->prepare($this->sql);
          $this->resultset=$this->statement->execute(
              array(
                  $planMejoramiento->aspectoMejorar,
                  $planMejoramiento->accionesPlan,
                  $planMejoramiento->estado,
                  $planMejoramiento->idUsuarioCrea,
                  $id
              )
          );

          return $this->resultset;

      }catch (Exception $e) {
        return $e;
      }
    }
    public function vProrroga(){
       try {
         $this->sql="SELECT prorroga_mejoramiento.id_prorroga_mejoramiento,plan_mejoramiento.aspecto_mejora,prorroga_mejoramiento.fecha_adicional,prorroga_mejoramiento.observacion,prorroga_mejoramiento.estado_prorroga 
                      FROM plan_mejoramiento 
                      INNER JOIN prorroga_mejoramiento 
                      ON plan_mejoramiento.id_plan_mejoramiento=prorroga_mejoramiento.id_plan_mejoramiento";
         $this->statement=$this->conexion->prepare($this->sql);
         $this->resultset=$this->statement->execute();
         return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
       } catch (Exception $e) {
          return $e;
       }
    }
    public function prorroga($planMejoramiento,$observacion,$estado,$id){
      try {
          $this->sql="SELECT COUNT(id_plan_mejoramiento) FROM prorroga_mejoramiento WHERE id_plan_mejoramiento=?";
          $this->statement= $this->conexion->prepare($this->sql);
          $this->resultset=$this->statement->execute(array($id));
          $data=$this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
                      
          $cont=$data[0][0];
          
          if($cont>0){
          return 2;
          }else{
            $this->sql= "INSERT INTO `prorroga_mejoramiento` (`id_plan_mejoramiento`, `fecha_adicional`,`estado_prorroga`,`observacion`,`id_usuario_creacion`)
            VALUES (?,?,?,?,?)";
            $this->statement= $this->conexion->prepare($this->sql);
            $this->resultset=$this->statement->execute(
                array(
                    $id,
                    $planMejoramiento->fechaImplementacion,
                    $estado,
                    $observacion,
                    $planMejoramiento->idUsuarioCrea
                    
                )
            );
            return $this->resultset;
          }

      }catch (Exception $e) {
        return $e;
      }
    }
    public function hallazgo($id){
        $this->sql="SELECT id_hallazgo,fecha_hallazgo,tema_hallazgo,ruta_evidencia 
                    FROM hallazgo  
                    WHERE id_hallazgo=?";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(array($id));

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

    }
    public function leer(){
        try {
            $this->sql="SELECT hallazgo.id_hallazgo,plan_mejoramiento.id_plan_mejoramiento,hallazgo.tema_hallazgo,plan_mejoramiento.aspecto_mejora,plan_mejoramiento.acciones_planteadas,plan_mejoramiento.ruta_evidencia,plan_mejoramiento.fecha_evidencia,plan_mejoramiento.estado_plaMejor
            FROM hallazgo 
            INNER JOIN plan_mejoramiento
            ON plan_mejoramiento.id_hallazgo=hallazgo.id_hallazgo";
            $this->statement = $this->conexion->prepare($this->sql);
            $this->statement->execute();
  
            return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
          return  $e;
        } 
    }
    public function vAuditoria($id){
        try {
          $this->sql="SELECT auditoria_programacion.id_auditoria 
                      FROM auditoria_programacion 
                      INNER JOIN ejecucion_auditoria 
                      ON auditoria_programacion.id_auditoria=ejecucion_auditoria.id_auditoria_programada 
                      INNER JOIN hallazgo 
                      ON ejecucion_auditoria.id_ejecucion_auditoria=hallazgo.id_ejecucion_auditoria 
                      INNER JOIN plan_mejoramiento 
                      ON hallazgo.id_hallazgo=plan_mejoramiento.id_hallazgo
                      WHERE plan_mejoramiento.id_plan_mejoramiento= ?";
          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($id));

          return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
        } catch (Exception $e) {
          return $e;
        }
    }
  }
    

?>