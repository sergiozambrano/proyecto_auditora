<?php
  class programacionAuditoriaD{			
    private $idArea;
    private $idUsuarioAuditor;
    private $tipoAuditoria;
    private $fechaProgramacion;
    private $estadoAuditoria;
    private $observacion;
    private $idUsuarioCreacion;

    public function __construct($idArea,$idUsuarioAuditor,$tipoAuditoria,$fechaProgramacion,$estadoAuditoria,$observacion,$idUsuarioCreacion){
      $this->idArea=$idArea;
      $this->idUsuarioAuditor=$idUsuarioAuditor;
      $this->tipoAuditoria=$tipoAuditoria;
      $this->fechaProgramacion=$fechaProgramacion;
      $this->estadoAuditoria=$estadoAuditoria;
      $this->observacion=$observacion;
      $this->idUsuarioCreacion=$idUsuarioCreacion;
    }

    public function __set($name, $value){
      $this->name=$value;
    }

    public function __get($name){
      return $this->$name;
    }

    public function __destruct(){
      unset($this->idArea);
      unset($this->idUsuarioAuditor);
      unset($this->tipoAuditoria);
      unset($this->fechaProgramacion);
      unset($this->estadoAuditoria);
      unset($this->observacion);
      unset($this->idUsuarioCreacion);
    }

  }
?>
