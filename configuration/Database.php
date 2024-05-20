<?php
class Database{

  public $pdo;

  public function connection()
  {
  
      $this->pdo = new PDO('mysql:host=localhost;dbname=ouvidoria', 'root', '');
       
  }

}
//$test = new Database();
?>