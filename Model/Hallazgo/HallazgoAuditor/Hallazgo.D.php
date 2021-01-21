<?php

class HallazgoD{
  private $id_hallazgo;
  private $id_planMejoramiento;
  private $id_usuario_creacion;
  private $id_auditoria;
  private $id_prorroga;
  private $estado_planMejoramiento;
  private $tema_hallazgo;
  private $fecha_hallazgo;
  private $aciones_planteadas;
  private $aspecto_mejorar;
  private $ruta_evidencia;

  private $directorio;
  private $validacion;

  private $buscar;
  private $valor;

  public function __construct(){}

  public function hallazgo($id_usuario_creacion){
    $this->id_usuario_creacion = $id_usuario_creacion;

  }

  public function mostrar($id_auditoria,$id_usuario_creacion){
    $this->id_auditoria = $id_auditoria;
    $this->id_usuario_creacion = $id_usuario_creacion;

  }

  public function verHallazgo($id_hallazgo){
    $this->id_hallazgo = $id_hallazgo;
  }

  /**
   * Datos para guardar evidencia
   */
  public function guaAneCar($id_auditoria,$id_usuario_creacion,$tema_hallazgo,$aciones_planteadas,
          $aspecto_mejorar,$ruta_evidencia,$directorio,$validacion){

    $this->id_auditoria = $id_auditoria;
    $this->id_usuario_creacion = $id_usuario_creacion;
    $this->tema_hallazgo = $tema_hallazgo;
    $this->aciones_planteadas = $aciones_planteadas;
    $this->aspecto_mejorar = $aspecto_mejorar;
    $this->ruta_evidencia = $ruta_evidencia;
    $this->directorio = $directorio;
    $this->validacion = $validacion;
  }

  public function buscar($id_auditoria,$id_usuario_creacion,$buscar,$valor){
    $this->id_auditoria = $id_auditoria;
    $this->id_usuario_creacion = $id_usuario_creacion;
    $this->buscar = $buscar;
    $this->valor = $valor;

  }

  public function editarProrroga($id_prorroga,$estado_planMejoramiento,$valor){
    $this->id_prorroga = $id_prorroga;
    $this->estado_planMejoramiento = $estado_planMejoramiento;
    $this->valor = $valor;
  }

  public function __set($name, $value){
    $this->$name = $value;

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

