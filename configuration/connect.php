<?php


    try {
          $connection = new PDO('mysql:host=localhost;dbname=ouvidoria', 'root', '');
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            die();
        }
  




//$test = new Database();
?>