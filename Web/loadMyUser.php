<?php

    // Arquivo de conexão ao Database 
    require_once __DIR__."/../configuration/Database.php";

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

    // Retomo sessão
    session_start();

    // Pego as informações do usuário pelo id da sessão criada quando fez o login
    $dataUser = $database->pdo->prepare("SELECT date_birth, telephone, whatsapp, city, fu FROM users WHERE id = :id ");
    $dataUser->bindValue(':id', intval($_SESSION['id']) );
    $dataUser->execute();


    // Retorno os valor da pesquisa em um array
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('data'=>$dataUser->fetchAll(PDO::FETCH_ASSOC))));

?>