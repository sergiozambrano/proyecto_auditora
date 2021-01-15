<?php
  class area_d{
    private $id_unidad;
    private $id_usuario_encargado;
    private $nombre_unidad;
    private $certificado;
    private $id_usuario_creacion;

    public function insertar($id_usuario_encargado,$nombre_unidad,$certificado,$id_usuario_creacion){
      $this->id_usuario_encargado = $id_usuario_encargado;
      $this->nombre_unidad=$nombre_unidad;
      $this->certificado=$certificado;
      $this->id_usuario_creacion=$id_usuario_creacion;
    }

    public function editar($id_unidad,$id_usuario_encargado,$nombre_unidad,$certificado,$id_usuario_creacion){
      $this->id_unidad = $id_unidad;
      $this->id_usuario_encargado = $id_usuario_encargado;
      $this->nombre_unidad=$nombre_unidad;
      $this->certificado=$certificado;
      $this->id_usuario_creacion=$id_usuario_creacion;
    }

    public function __set($name, $value){
        $this->name=$value;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __destruct(){
      unset($this->id_usuario_encargado);
      unset($this->nombre_unidad);
      unset($this->certificado);
      unset($this->id_usuario_creacion);
    }
  }




?>
