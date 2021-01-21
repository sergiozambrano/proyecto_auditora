<?php
  class PlanMejoramientod{
    private $hallazgo;
    private $entregable;
    private $fechaImplementacion;
    private $estado;
    private $idUsuarioCrea;

    public function __construct($hallazgo,$entregable,$fechaImplementacion,$estado,$idUsuarioCrea){
      $this->hallazgo=$hallazgo;
      $this->entregable=$entregable;
      $this->fechaImplementacion=$fechaImplementacion;
      $this->estado=$estado;
      $this->idUsuarioCrea=$idUsuarioCrea;
    }

    public function __set($name, $value){
      $this->name=$value;
    }

    public function __get($name){
      return $this->$name;
    }

    public function __destruct(){
      unset($this->hallazgo);
      unset($this->entregable);
      unset($this->fechaImplementacion);
      unset($this->estado);
      unset($this->idUsuarioCrea);
    }

  }

?>
