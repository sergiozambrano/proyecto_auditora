<?php

class HallazgoD{
  private $id_usuario_creacion;

  public function hallazgo($id_usuario_creacion){
    $this->id_usuario_creacion = $id_usuario_creacion;

  }

  public function __set($name, $value){
    $this->name=$value;

  }

  public function __get($name){
    return $this->$name;

  }

  public function __destruct(){
    unset($this->id_usuario_creacion);
  }
}

?>
