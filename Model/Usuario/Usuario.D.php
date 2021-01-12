<?php

class UsuarioD{
  private $id;
  private $claveActual;
  private $claveNueva;

  /* private $cod_contrato_usu;
  private $nombre_pri_per;
  private $nombre_seg_per;
  private $apellido_pri_per;
  private $apellido_seg_per;
  private $tipo_doc_per;
  private $num_documento;
  private $num_celular;
  private $correo;
  private $fecha_nac_per;
  private $genero;
  private $pefil; */

  /* function __construct($id,$cod_contrato_usu,$nombre_pri_per,$nombre_seg_per,$apellido_pri_per,$apellido_seg_per,
                      $tipo_doc_per,$num_documento,$num_celular,$correo,$fecha_nac_per,$genero,$pefil){

    $this->id = $id;
    $this->cod_contrato_usu = $cod_contrato_usu;
    $this->nombre_pri_per = $nombre_pri_per;
    $this->nombre_seg_per = $nombre_seg_per;
    $this->apellido_pri_per = $apellido_pri_per;
    $this->apellido_seg_per = $apellido_seg_per;
    $this->tipo_doc_per = $tipo_doc_per;
    $this->num_documento = $num_documento;
    $this->num_celular = $num_celular;
    $this->correo = $correo;
    $this->fecha_nac_per = $fecha_nac_per;
    $this->genero = $genero;
    $this->pefil = $pefil;
  } */

  public function cambiarClave($id,$claveActual,$claveNueva){
    $this->id = $id;
    $this->claveActual = $claveActual;
    $this->claveNueva = password_hash($claveNueva, PASSWORD_DEFAULT);
  }

  public function __set($nombre, $valor){
    $this->nombre = $valor;
  }

  public function __get($nombre){
      return $this->$nombre;
  }

  function __destruct(){
    unset($this->id);
    unset($this->cod_contrato_usu);
    unset($this->nombre_pri_per);
    unset($this->nombre_seg_per);
    unset($this->apellido_pri_per);
    unset($this->apellido_seg_per);
    unset($this->tipo_doc_per);
    unset($this->num_documento);
    unset($this->num_celular);
    unset($this->correo);
    unset($this->fecha_nac_per);
    unset($this->genero);
    unset($this->pefil);
  }
}
?>
