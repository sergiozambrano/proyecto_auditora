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
          $this->sql = "SELECT hallazgo.id_hallazgo,plan_mejoramiento.id_plan_mejoramiento,hallazgo.tema_hallazgo,plan_mejoramiento.ruta_evidencia,plan_mejoramiento.fecha_evidencia,plan_mejoramiento.estado_plaMejor
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
    public function evidencia($idAnexo,$copia,$planMejoramiento,$archivo,$tipoArchivo,$validaArchivo,$nombreArchivo,$valida,$size,$id,$idEjecucion){
      try {
        $this->sql="SELECT COUNT(ruta_evidencia) FROM plan_mejoramiento WHERE id_plan_mejoramiento=?";
        $this->statement= $this->conexion->prepare($this->sql);
        $this->resultset=$this->statement->execute(array($id));
        $data=$this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
        $cont=$data[0][0];
        
        if($cont>0){
          if($copia==$nombreArchivo){
            if($tipoArchivo=="jpg" || $tipoArchivo=="jpeg" || $tipoArchivo=="png" || $tipoArchivo=="doc" || $tipoArchivo=="docx" || $tipoArchivo=="xls" ||
            $tipoArchivo=="xlsx" || $tipoArchivo=="ppt" || $tipoArchivo=="pptx" || $tipoArchivo=="pptm" || $tipoArchivo=="pdf" || $tipoArchivo=="xml" ||
            $tipoArchivo=="mp4" || $tipoArchivo=="txt" || $tipoArchivo=="wmv" || $tipoArchivo=="zip" || $tipoArchivo=="rar"){
              $this->sql="UPDATE plan_mejoramiento SET `ruta_evidencia`=? WHERE `id_plan_mejoramiento` = ?";
              $this->statement= $this->conexion->prepare($this->sql);
              $this->resultset=$this->statement->execute(
                array(
                    $archivo,
                    $id
                )
              );
              $anexos= new PlanMejoramientom();
              $data = $anexos->uAnexos($idAnexo,$archivo);
              if(move_uploaded_file($valida,$archivo)){
                return $this->resultset;
              }
            }  
            }else{
              return 3;
            }
          
        }else{
          if($validaArchivo != false){
              $size = $size;
            if($size > 21000000){
                return 1;
            }else{
              if($tipoArchivo=="jpg" || $tipoArchivo=="jpeg" || $tipoArchivo=="png" || $tipoArchivo=="doc" || $tipoArchivo=="docx" || $tipoArchivo=="xls" ||
              $tipoArchivo=="xlsx" || $tipoArchivo=="ppt" || $tipoArchivo=="pptx" || $tipoArchivo=="pptm" || $tipoArchivo=="pdf" || $tipoArchivo=="xml" ||
              $tipoArchivo=="mp4" || $tipoArchivo=="txt" || $tipoArchivo=="wmv" || $tipoArchivo=="zip" || $tipoArchivo=="rar"){
                $this->sql="UPDATE plan_mejoramiento SET `ruta_evidencia`=? WHERE `id_plan_mejoramiento` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                  array(
                      $archivo,
                      $id
                  )
                );
                $anexos= new PlanMejoramientom();
                $data=$anexos->anexos($planMejoramiento,$idEjecucion,$nombreArchivo,$archivo);
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
         $this->sql="SELECT prorroga_mejoramiento.id_prorroga_mejoramiento,prorroga_mejoramiento.fecha_adicional,prorroga_mejoramiento.observacion,prorroga_mejoramiento.estado_prorroga 
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
        $this->sql="SELECT id_hallazgo,fecha_hallazgo,tema_hallazgo,acciones_planteadas,aspecto_mejora,ruta_evidencia
                    FROM hallazgo  
                    WHERE id_hallazgo=?";
        $this->statement = $this->conexion->prepare($this->sql);
        $this->statement->execute(array($id));

        return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

    }
    public function leer(){
        try {
            $this->sql="SELECT hallazgo.id_hallazgo,plan_mejoramiento.id_plan_mejoramiento,hallazgo.tema_hallazgo,plan_mejoramiento.ruta_evidencia,plan_mejoramiento.fecha_evidencia,plan_mejoramiento.estado_plaMejor
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
          $this->sql="SELECT auditoria_programacion.id_auditoria,ejecucion_auditoria.id_ejecucion_auditoria 
          FROM ejecucion_auditoria 
          INNER JOIN auditoria_programacion 
          ON ejecucion_auditoria.id_auditoria_programada=auditoria_programacion.id_auditoria 
          INNER JOIN hallazgo 
          ON ejecucion_auditoria.id_ejecucion_auditoria=hallazgo.id_ejecucion_auditoria 
          INNER JOIN plan_mejoramiento 
          ON hallazgo.id_hallazgo=plan_mejoramiento.id_hallazgo 
          WHERE plan_mejoramiento.id_plan_mejoramiento= ?";
          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($id));

          $date=$this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
          $auditoriaProgamacion=$date[0][0];
          $ejecucionAuditoria=$date[0][1];
          $this->sql="SELECT anexos.id_anexo,anexos.nombre_anexo 
          FROM anexos 
          INNER JOIN ejecucion_auditoria 
          ON anexos.id_ejecucion_auditoria=ejecucion_auditoria.id_ejecucion_auditoria 
          INNER JOIN auditoria_programacion 
          ON ejecucion_auditoria.id_auditoria_programada=auditoria_programacion.id_auditoria 
          WHERE auditoria_programacion.id_auditoria=?";
          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute(array($auditoriaProgamacion));

          $data=$this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
          if($data==true){
            $idAnexo=$data[0][0];
            $nombreAnexo=$data[0][1];
            return array($auditoriaProgamacion,$ejecucionAuditoria,$idAnexo,$nombreAnexo);
          }else{
          return array($auditoriaProgamacion,$ejecucionAuditoria);
          }
          
        } catch (Exception $e) {
          return $e;
        }
    }
    public function uAnexos($id,$archivo){
              try{
                $this->sql="UPDATE anexos SET `ruta_anexo`=? WHERE `id_anexo` = ?";
                $this->statement= $this->conexion->prepare($this->sql);
                $this->resultset=$this->statement->execute(
                  array(
                      $archivo,
                      $id
                  )
                );
                return $this->resultset;
              }catch(Exception $e){
                return $e;
              }
    }
    public function anexos($planMejoramiento,$idEjecucion,$nombreArchivo,$archivo){
     try {
       $this->sql="INSERT INTO `Anexos` (`id_ejecucion_auditoria`, `nombre_anexo`,`estado_anexo`,`ruta_anexo`,`id_usuario_creacion`)
       VALUES (?,?,?,?,?)";
       $this->statement= $this->conexion->prepare($this->sql);
       $this->resultset=$this->statement->execute(
           array(
               $idEjecucion,
               $nombreArchivo,
               $estado="0",
               $archivo,
               $planMejoramiento->idUsuarioCrea
               
           )
       );
       return $this->resultset;
     } catch (Exception $e) {
       return $e;
     }
    }
    public function vFecha($id){
      try{
        $this->sql="SELECT COUNT(ruta_evidencia) FROM plan_mejoramiento WHERE id_plan_mejoramiento=?";
        $this->statement= $this->conexion->prepare($this->sql);
        $this->resultset=$this->statement->execute(array($id));
        $data=$this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);
        $cont=$data[0][0];
        if($cont>0){
          return 0;
        }else{
          $abierto= new PlanMejoramientom();
          $data=$abierto->fechaVencido($id);
          return 1;

        }
      }catch(Exception $e){
        return $e;
      }
    }
    public function fechaVencido($id){
      try {
        $this->sql="UPDATE `plan_mejoramiento` SET `estado_plaMejor` = 'Vencido' WHERE `id_plan_mejoramiento` = ?";
        $this->statament= $this->conexion->prepare($this->sql);
        $this->resultset=$this->statament->execute(array($id));
        return $this->resultset;
      } catch (Exception $e) {
        return $e;
      }
    }
  }
    

?>