<?php
// inclui o database
include_once "../configuration/connect.php";

// instancia uma nova classe
$database = new Database();

try {
    $database->connection();
  } catch(PDOException $e) {
      header('HTTP/1.1 500 Internal Server');
      header('Content-Type: application/json; charset=UTF-8');
      return die(json_encode(array('title'=>'ERRO','message' => 'Erro na conexão do servidor. Tente novamente mais tarde.', 'code' => 1001)));
  }

// pega o valor do email mandado pelo POST 
$email = $_POST['email'];

$emailCod = $database->pdo->prepare("SELECT * FROM email_confirmation WHERE email = :email");
$emailCod->execute();

$dataEmailCod = $emailCod->fetchAll(PDO::FETCH_ASSOC);

if(count($dataEmailCod) > 0)
{
    header('HTTP/1.1 500 Internal Server');
    header('Content-Type: application/json; charset=UTF-8');
    return die(json_encode(array('title'=>'ATENÇÃO','message' => 'Esse e-mail já está em nosso sistema. Deseja ir para etapa de confirmação desse e-mail?', 'code' => 1003)));

}
// prepara e executa a pesquisa (Essa maneira com "prepare()" e "execute()" ajuda a evitar SQL)
$confirmEmail = $database->pdo->prepare("SELECT * FROM users where email = :email ");
$confirmEmail->bindValue(":email", $email);
$confirmEmail->execute();
$data = $confirmEmail->fetchAll(PDO::FETCH_ASSOC);



if((count($data)) > 0)
{
    header('HTTP/1.1 500 Internal Server');
    header('Content-Type: application/json; charset=UTF-8');
    return die(json_encode(array('title'=>'E-mail inválido','message' => 'E-mail já cadastrado em nosso servidor.', 'code' => 1002)));
}

echo"sucesso"

?>