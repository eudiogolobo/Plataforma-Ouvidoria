<?php

include_once __DIR__."/Mail/EnviarEmail.php";
include_once __DIR__."/../configuration/connect.php";

class EnviarCodigoVerificacao
{
    private $database;

 

    public function __construct()
    {
        $this->database = new Database();

        try {
            $this->database->connection();
          } catch(PDOException $e) {
              header('HTTP/1.1 500 Internal Server');
              header('Content-Type: application/json; charset=UTF-8');
              return die(json_encode(array('title'=>'ERRO','message' => 'Erro na conexão do servidor. Tente novamente mais tarde.', 'code' => 1001)));
          }
    }

    public function EnviarCodigo($email_form_cad, $name)
    {
        session_start();
        $resul =  $this->database->pdo->prepare('DELETE FROM email_confirmation WHERE email = :email ');
        $resul->bindValue(":email", $email_form_cad);
        $resul->execute();

        echo var_dump($resul);
        //gero um código
        $cod_verification = rand(100000,999999);

        // gravo o id da sessao caso o usuario ja va colocar o codigo, caso ele perca a sessao ele pode ativar a conta atraves do email e do codigo...
        $result = $this->database->pdo->prepare('INSERT INTO email_confirmation (session_id, code_verification, email) values (:session_id, :code_verification, :email)');
        $result->bindValue(":session_id", session_id());
        $result->bindValue(":code_verification",  $cod_verification);
        $result->bindValue(":email",  $email_form_cad);
        $result->execute();

        // instacio a classe EnviarEmail para realizar o envio...
        $emailNew = new EnviarEmail();
        $emailNew->sendEmails($email_form_cad,$name, $cod_verification);

    }
 

}


?>