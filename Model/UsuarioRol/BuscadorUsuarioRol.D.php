<?php

class BuscarD{
    private $criterio;
    private $texto;

    public function __construct($criterio, $texto){
        $this->criterio = $criterio;
        $this->texto = $texto;
    }

    public function __set($name, $value){
        $this->name=$value;
    }

    public function __get($name){
        return $this->$name;   
    }

    public function __destruct(){
        unset($this->criterio);
        unset($this->texto);
    }
}


?>