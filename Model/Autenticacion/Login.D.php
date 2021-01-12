<?php

class LoginD{
    private $documento;
    private $pass;

    public function __construct(){

    }

    public function ingresar($documento, $pass){
      $this->documento = $documento;
      $this->pass = $pass;
    }

    public function restablecerClave($documento){
      $this->documento = $documento;
      $this->pass = password_hash($documento, PASSWORD_DEFAULT);
    }

    public function __set($nombre, $valor){
        $this->nombre = $valor;
    }

    public function __get($nombre){
        return $this->$nombre;
    }

    public function __destruct(){
        unset($this->documento);
        unset($this->pass);
    }
}

?>
