<?php
class Database{

  public $connection;

  function __construct(){
      $this->connection();
  }
  public function connection()
  {
    try {
          $this->connection = new PDO('mysql:host=localhost;dbname=ouvidoria', 'root', '');
         
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            die();
        }
  }



}
//$test = new Database();
?>