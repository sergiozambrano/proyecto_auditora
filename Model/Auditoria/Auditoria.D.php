<?php

class AuditoriaD{
  private $id_anexo;
  private $id_auditoria;
  private $nombre_anexo;
  private $estado_anexo;
  private $ruta_anexo;
  private $directorio_anexo;
  private $valida_anexo;
  private $id_usuario_creacion;
  private $id_usuario_validacion;
  private $fecha_validacion;
  private $observa_anexo;

  private $buscar;
  private $valor;

  public function __construct(){
  }

  public function anexo($id_auditoria,$nombre_anexo,$ruta_anexo,$directorio_anexo,$valida_anexo,$id_usuario_creacion){
    $this->id_auditoria = $id_auditoria;
    $this->nombre_anexo = $nombre_anexo;
    $this->estado_anexo = 0;
    $this->ruta_anexo = $ruta_anexo;
    $this->directorio_anexo = $directorio_anexo;
    $this->valida_anexo = $valida_anexo;
    $this->id_usuario_creacion = $id_usuario_creacion;
  }

  public function observacion($observa_anexo){
    $this->observa_anexo = $observa_anexo;

  }

  public function nombreCoordinador($id_usuario_validacion){
    $this->id_usuario_validacion = $id_usuario_validacion;
  }

  public function validacion($id_usuario_creacion,$estado_anexo){
    $this->id_usuario_creacion = $id_usuario_creacion;
    $this->estado_anexo = $estado_anexo;
  }

  public function __set($name, $value){
    $this->name=$value;

  }

  public function __get($name){
    return $this->$name;

  }

  public function __destruct(){
    unset($this->id_anexo);
    unset($this->id_ejecicion_auditoria);
    unset($this->nombre_anexo);
    unset($this->estado_anexo);
    unset($this->ruta_anexo);
    unset($this->directorio_anexo);
    unset($this->id_usuario_creacion);
    unset($this->id_usuario_validacion);
    unset($this->fecha_validacion);
    unset($this->observa_anexo);
  }
}

?>
