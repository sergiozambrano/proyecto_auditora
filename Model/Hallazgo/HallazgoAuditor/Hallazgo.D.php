<?php

class HallazgoD{
  private $id_hallazgo;
  private $id_usuario_creacion;
  private $id_auditoria;

  public function hallazgo($id_usuario_creacion){
    $this->id_usuario_creacion = $id_usuario_creacion;

  }

  public function mostrar($id_auditoria,$id_usuario_creacion){
    $this->id_auditoria = $id_auditoria;
    $this->id_usuario_creacion = $id_usuario_creacion;

  }

  public function __set($name, $value){
    $this->name=$value;

  }

  public function __get($name){
    return $this->$name;

  }

  public function __destruct(){
    unset($this->id_auditoria);
    unset($this->id_hallazgo);
    unset($this->id_usuario_creacion);

  }
}

?>
