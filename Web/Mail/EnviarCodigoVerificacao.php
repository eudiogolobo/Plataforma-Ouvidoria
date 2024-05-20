<?php

include_once __DIR__."/EnviarEmail.php";
include_once __DIR__."/../../configuration/Database.php";

// Classe para realizar os envios de código de verificação
class EnviarCodigoVerificacao
{
    private $database;

    // Qunado for instânciada já conecta ao Database
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

    // Função para enviar o código de verificação
    public function EnviarCodigo($email_form_cad, $name)
    {
        // Retoma a sessão
        session_start();

        // Se existir algum e-mail de verificção pendente já vou excluir
        // pois se o usuário se cadastrar num dia e depois de dois dias vir 
        // concluir a verificação de conta, fica mais fácil para ele achar o novo
        // e-mail enviado do que procurar um e-mail de dois dias atrás...
        $resul =  $this->database->pdo->prepare('DELETE FROM email_confirmation WHERE email = :email ');
        $resul->bindValue(":email", $email_form_cad);
        $resul->execute();

        //gero um código
        $cod_verification = rand(100000,999999);

        // Faço a inserção no Database com os valores do e-mail, código gerado e o valor da sessão atual 
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