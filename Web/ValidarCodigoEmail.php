<?php

 include_once "../configuration/connect.php";
session_start();
$database = new Database();

try {
    $database->connection();
  } catch(PDOException $e) {
      header('HTTP/1.1 500 Internal Server');
      header('Content-Type: application/json; charset=UTF-8');
      return die(json_encode(array('title'=>'ERRO','message' => 'Erro na conexão do servidor. Tente novamente mais tarde.')));
  }

 $result = $database->pdo->prepare('SELECT a.id, a.session_id , a.code_verification , a.email, b.email , b.password, b.name FROM email_confirmation AS a , users AS b WHERE a.session_id = :sessionn AND a.email = b.email AND a.code_verification = :code ');
$result->bindValue(":sessionn",session_id());
$result->bindValue(":code",$_GET['code']);
$result->execute();

 $data = $result->fetchAll(PDO::FETCH_ASSOC);

 if(count($data) > 0)
 {
    $_SESSION['userName'] = $data[0]['name'];
    $_SESSION['email'] = $data[0]['email'];
    $_SESSION['password'] = $data[0]['password'];

    $result = $database->pdo->prepare('DELETE FROM email_confirmation WHERE id = :id ');
    $result->bindValue(":id",$data[0]['id']);
    $result->execute();

    $result = $database->pdo->prepare('UPDATE users SET status = :status WHERE email = :email ');
    $result->bindValue(":status","ATIVO");
    $result->bindValue(":email",$data[0]['email']);
    $result->execute();



 } else{
    header('HTTP/1.1 500 Internal Server');
    header('Content-Type: application/json; charset=UTF-8');
    return die(json_encode(array('title'=>'Código Inválido','message' => 'Esse código é inválido. Tente novamente!')));
 }
 
?>