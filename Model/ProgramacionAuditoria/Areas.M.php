<?php
  require_once "../../Enviroment/Conexion.php";

  class areaM extends Conexion{

    private $sql;
    private $statement;
    private $resultset;

    public function __construct(){
      parent::__construct();
    }

    public function read(){
      try {
          $this->sql = "SELECT * FROM `areas`";

          $this->statement = $this->conexion->prepare($this->sql);
          $this->statement->execute();

          return $this->resultset = $this->statement->fetchAll(PDO::FETCH_NUM);

      } catch (\Throwable $th) {
          return $th;
      }
    }
  }

?>
