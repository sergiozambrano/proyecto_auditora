<?php 
    class persona_d{

        //atributos   
        private $primer_nombre_per;
        private $segundo_nombre_per;
        private $primer_apellido_per;
        private $segundo_apellido_per;
        private $tipo_doc_per;
        private $num_doc_per;
        private $num_cel_per;
        private $corre_per;
        private $fecha_nacimiento_per;
        private $genero_per;
        private $id_usuario_creacion;

        // constructor
        public function __construct($primer_nombre_per,$segundo_nombre_per,$primer_apellido_per,$segundo_apellido_per,$tipo_doc_per,$num_doc_per,$num_cel_per,$corre_per,$fecha_nacimiento_per,$genero_per,$id_usuario_creacion){
            $this->primer_nombre_per=$primer_nombre_per;
            $this->segundo_nombre_per=$segundo_nombre_per;
            $this->primer_apellido_per=$primer_apellido_per;
            $this->segundo_apellido_per=$segundo_apellido_per;
            $this->tipo_doc_per=$tipo_doc_per;
            $this->num_doc_per=$num_doc_per;
            $this->num_cel_per=$num_cel_per;
            $this->corre_per=$corre_per;
            $this->fecha_nacimiento_per=$fecha_nacimiento_per;
            $this->genero_per=$genero_per;
            $this->id_usuario_creacion=$id_usuario_creacion;      
        }

        //metodos magicos
        public function __set($name, $value){
            $this->name=$value;
        }

        public function __get($name){
            return $this->$name;   
        }

        //destructor
        public function __destruct(){
            unset($this->primer_nombre_per);
            unset($this->segundo_nombre_per);
            unset($this->primer_apellido_per);
            unset($this->segundo_apellido_per);
            unset($this->tipo_doc_per);
            unset($this->num_doc_per);
            unset($this->num_cel_per);
            unset($this->corre_per);
            unset($this->fecha_nacimiento_per);
            unset($this->genero_per);
            unset($this->id_usuario_creacion);
        }

    }




?>