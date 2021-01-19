<?php

class BuscarD{
    private $texto;

    public function __construct($texto){
        $this->texto = $texto;
    }

    public function __set($name, $value){
        $this->name=$value;
    }

    public function __get($name){
        return $this->$name;   
    }

    public function __destruct(){
        unset($this->texto);
    }
}


?>