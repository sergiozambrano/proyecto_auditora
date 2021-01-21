<?php
  class backup_d{
    private $dia_respaldo;
    private $id_usuario_creacion;
    public function insertar($dia_respaldo,$id_usuario_creacion){
        $this->dia_respaldo=$dia_respaldo;
        $this->id_usuario_creacion=$id_usuario_creacion;
      }

  
    public function __set($name, $value){
        $this->name=$value;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __destruct(){
       unset($this->dia_respaldo);
       unset($this->id_usuario_creacion);
    }
  }



?>
