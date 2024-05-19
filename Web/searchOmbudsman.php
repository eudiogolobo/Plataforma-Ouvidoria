<?php
include_once __DIR__."/../configuration/connect.php";

session_start();

if(isset($_GET['textSearch']))
{
    $text = $_GET['textSearch'];

    $dataBase = new Database();
    $dataBase->connection();
    $result = $dataBase->pdo->prepare('SELECT * FROM ombudsman WHERE user_id = :user_id AND ( description LIKE :text OR service_type LIKE :text ) ');
    $result->bindValue(':user_id', $_SESSION['id']);
    $result->bindValue(':text',"%$text%");
    $result->execute();

    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('data'=>$result->fetchAll(PDO::FETCH_ASSOC))));
    //return var_dump($result->fetchAll(PDO::FETCH_ASSOC));
    
}


?>