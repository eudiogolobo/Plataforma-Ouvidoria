<?php


// Vejo se tem uma requisição GET em conformes
if(isset($_GET['textSearch']))
{
    // Incluo meu arquivo responsável da coneção com o Database
    include_once __DIR__."/../configuration/Database.php";

    // Retomo a sessão
    session_start();

    // Passo o valor que veio da requisição para a variável
    $text = htmlspecialchars($_GET['textSearch']);


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

    // Realizo a pesquisa para retornar todas as ouvidorias abertas do usuário de acordo com o 
    // texto passado via GET pesquisando tanto pela descrição quanto pelo tipo de serviço afetado
    $result = $database->pdo->prepare('SELECT * FROM ombudsman WHERE user_id = :user_id AND ( description LIKE :text OR service_type LIKE :text ) ');
    $result->bindValue(':user_id', $_SESSION['id']);
    $result->bindValue(':text',"%$text%");
    $result->execute();

    // Retorno o array do resultado da pesquisa
    header('Content-Type: application/json; charset=UTF-8');
    return die(json_encode(array('data'=>$result->fetchAll(PDO::FETCH_ASSOC))));
    
}


?>