
<?php

 
include_once "../configuration/connect.php";
include_once "./Mail/EnviarEmail.php";
 session_start();


$name = $_POST['name'];
$dateBirth = $_POST['date-birth'];
$email_form_cad = $_POST['email'];
$telephone = $_POST['telephone'];
$whatsapp = $_POST['whatsapp'];
$password = $_POST['password'];
$passwordComnfirm = $_POST['password_comnfirm'];
$city = $_POST['city'];
$fu = $_POST['fu'];

// prepara e executa o cadastro (Essa maneira com "prepare()" e "execute()" ajuda a evitar SQL Injection)

    $database = new Database();

    try {
        $database->connection();
      } catch(PDOException $e) {
          header('HTTP/1.1 500 Internal Server');
          header('Content-Type: application/json; charset=UTF-8');
          return die(json_encode(array('title'=>'ERRO','message' => 'Erro na conexão do servidor. Tente novamente mais tarde.', 'code' => 1001)));
      }
   
      
    
    $result = $database->pdo->prepare('INSERT INTO users (date_birth, email, telephone, whatsapp, 
    password, password_confirmation,name, city, fu) values ( :date_birth, :email, :telephone, :whatsapp, 
    :password, :password_confirmation, :name , :city, :fu)');
  
    $result->bindValue(":date_birth", $dateBirth);
    $result->bindValue(":email", $email_form_cad);
    $result->bindValue(":telephone", $telephone);
    $result->bindValue(":whatsapp", $whatsapp);
    $result->bindValue(":password", hash('sha256', $password));
    $result->bindValue(":password_confirmation", $passwordComnfirm);
    $result->bindValue(":name", $name);
    $result->bindValue(":city", $city);
    $result->bindValue(":fu", $fu);
    $result->execute();

    //gero um código
    $cod_verification = rand(100000,999999);

    // gravo o id da sessao caso o usuario ja va colocar o codigo, caso ele perca a sessao ele pode ativar a conta atraves do email e do codigo...
    $result = $database->pdo->prepare('INSERT INTO email_confirmation (session_id, code_verification, email) values (:session_id, :code_verification, :email)');
    $result->bindValue(":session_id", session_id());
    $result->bindValue(":code_verification",  $cod_verification);
    $result->bindValue(":email",  $email_form_cad);
    $result->execute();

    // instacio a classe EnviarEmail para realizar o envio...
    $email = new EnviarEmail();
    $email->sendEmail($email_form_cad,$name, $cod_verification);

    echo "ok";

 


    


   

?>