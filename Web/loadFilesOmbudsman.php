<?php

// Verifico se existe a requisiçao via GET
if(isset($_GET['ombudsman_id']))
{
    // Incluo meu arquivo para acessar o Database
    include_once __DIR__."/../configuration/connect.php";

    // Intâncio o Database
    $database = new Database();

    // Faço a conexão ao Database
    try {
        $database->connection();
    } catch(PDOException $e) {
        header('HTTP/1.1 500 Internal Server');
        header('Content-Type: application/json; charset=UTF-8');
        return die(json_encode(array('title'=>'ERRO','message' => 'Erro na conexão do servidor. Tente novamente mais tarde.', 'code' => 1001)));
    }

    // Faço a pesquisa para trazer todos os arquivos onde o ombudsman_id seja igual ao id passado via GET
    $result = $database->pdo->prepare('SELECT * FROM attachments WHERE ombudsman_id = :ombudsman_id ');
    $result->bindValue(':ombudsman_id', $_GET['ombudsman_id']);
    $result->execute();

    // Retorno os valor da pesquisa em um array
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('data'=>$result->fetchAll(PDO::FETCH_ASSOC))));
    
}


?>