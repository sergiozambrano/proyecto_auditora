<?php 
    class usuario_roles_d{

          
        private $numero_contrato;
        private $contraseña_verificada;
        private $id_persona;
        private $estado;
        private $id_usuario_creacion;

        public function __construct($numero_contrato,$contraseña_verificada,$id_persona,$id_usuario_creacion){
            $this->numero_contrato=$numero_contrato;
            $this->contraseña_verificada=$contraseña_verificada;
            $this->id_persona=$id_persona;
            $this->estado=1;   
            $this->id_usuario_creacion=$id_usuario_creacion;      
        }

        public function __set($name, $value){
            $this->name=$value;
        }

        public function __get($name){
            return $this->$name;   
        }

        public function __destruct(){
            unset($this->numero_contrato);
            unset($this->contraseña_verificada);
            unset($this->id_persona);
            unset($this->estado);
            unset($this->id_usuario_creacion);
        }

    }




?>