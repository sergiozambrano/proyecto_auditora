<?php
  class anexoD{
    private $idAnexo;
    private $idUsuarioValidacion;
    private $observacion;

    public function __construct($idAnexo,$idUsuarioValidacion,$observacion){
      $this->idAnexo=$idAnexo;
      $this->idUsuarioValidacion=$idUsuarioValidacion;
      $this->observacion=$observacion;
    }

    public function __set($name, $value){
      $this->name=$value;
    }

    public function __get($name){
      return $this->$name;
    }

    public function __destruct(){
      unset($this->idAnexo);
      unset($this->idUsuarioValidacion);
      unset($this->observacion);
    }
  }
?>
