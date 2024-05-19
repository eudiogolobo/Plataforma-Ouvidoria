<?php
include_once __DIR__."/../configuration/connect.php";

if(isset($_GET['ombudsman_id']))
{

    $dataBase = new Database();
    $dataBase->connection();
    $result = $dataBase->pdo->prepare('SELECT * FROM attachments WHERE ombudsman_id = :ombudsman_id ');
    $result->bindValue(':ombudsman_id', $_GET['ombudsman_id']);
    $result->execute();

    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('data'=>$result->fetchAll(PDO::FETCH_ASSOC))));
    //return var_dump($result->fetchAll(PDO::FETCH_ASSOC));
    
}


?>