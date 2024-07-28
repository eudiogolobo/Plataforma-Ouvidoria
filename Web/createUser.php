
<?php

 if(isset($_POST['name']) && isset($_POST['date-birth']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['whatsapp']) && isset($_POST['password']) && isset($_POST['password_comnfirm']) && isset($_POST['city']) && isset($_POST['fu']))
 {
    // Incluo meus arquivos
    include_once "../configuration/Database.php";
    include_once __DIR__."/Mail/EnviarCodigoVerificacao.php";

    // Retomo sessão
    session_start();


    // Passo os valores que veio do POST as variáveis
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $dateBirth = $_POST['date-birth'];
    $email_form_cad = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $telephone = htmlspecialchars($_POST['telephone'], ENT_QUOTES, 'UTF-8');
    $whatsapp = htmlspecialchars($_POST['whatsapp'], ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'];
    $passwordComnfirm = $_POST['password_comnfirm'];
    $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
    $fu = htmlspecialchars($_POST['fu'], ENT_QUOTES, 'UTF-8');

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
   
      try{
        // Prepara e insere no Database as informações do novo usuário
        $result = $database->pdo->prepare('INSERT INTO users (status, date_birth, email, telephone, whatsapp, 
        password, password_confirmation,name, city, fu) values (:status, :date_birth, :email, :telephone, :whatsapp, 
        :password, :password_confirmation, :name , :city, :fu)');
        $result->bindValue(":date_birth", $dateBirth);
        $result->bindValue(":email", $email_form_cad);
        $result->bindValue(":telephone", $telephone);
        $result->bindValue(":whatsapp", $whatsapp);
        $result->bindValue(":password", hash('sha256', $password));
        $result->bindValue(":password_confirmation", hash('sha256', $passwordComnfirm));
        $result->bindValue(":name", $name);
        $result->bindValue(":status", 'INATIVO');
        $result->bindValue(":city", $city);
        $result->bindValue(":fu", $fu);
        $result->execute();

        // Instâncio a classe EnviarCodigoVerificacao
        $enviarCodVerif = new EnviarCodigoVerificacao();

        // Faço o envio do código de verificação para o e-mail cadastrado
        $enviarCodVerif->EnviarCodigo($email_form_cad, $name);

      } catch (Exception $e)
      {
        header('HTTP/1.1 500 Internal Server');
        header('Content-Type: application/json; charset=UTF-8');
        return die(json_encode(array('title'=>'ERRO','message' => 'Error: '+$e, 'code' => 1001)));

      }
      
    



 }

   

?>