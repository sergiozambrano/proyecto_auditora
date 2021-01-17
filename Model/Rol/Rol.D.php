<?php 
    class rol_d{

        //atributos   
        private $nombre_rol;
        private $estado_rol;
    
        private $id_usuario_creacion;

        //contructor
        public function __construct($nombre_rol,$estado_rol,$id_usuario_creacion){
            $this->nombre_rol=$nombre_rol;
            $this->estado_rol=$estado_rol;    
            $this->id_usuario_creacion=$id_usuario_creacion;
        }
        
        //Metodos magicos
        public function __set($name, $value){
            $this->name=$value;
        }

        public function __get($name){
            return $this->$name;   
        }

        //destructor
        public function __destruct(){
            unset($this->nombre_rol);
            unset($this->estado_rol);
           
            unset($this->id_usuario_creacion);
        }

    }




?>