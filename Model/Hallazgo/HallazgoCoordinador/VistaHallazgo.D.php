<?php

class VistoHallazgoD{
    private $idArea;

    public function __construct($idArea){
        $this->idArea = $idArea;
    }

    public function __set($name, $value){
        $this->name=$value;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __destruct(){
        unset($this->idArea);
    }
}


?>
