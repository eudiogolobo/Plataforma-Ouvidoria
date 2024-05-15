<?php
class Database{

  public $pdo;

  function __construct(){
      $this->connection();
  }

  public function connection()
  {
    try {
          $this->pdo = new PDO('mysql:host=localhost;dbname=ouvidoria', 'root', '');
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            die();
        }
  }

}
//$test = new Database();
?>