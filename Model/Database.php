<?php
class Database{

  public function connection()
  {
    try {
          $pdo = new PDO('mysql:host=localhost;dbname=ouvidoria', 'root', '');
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $pdo;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
  }

}

?>