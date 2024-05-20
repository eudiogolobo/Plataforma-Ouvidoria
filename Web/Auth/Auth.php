<?php
include_once __DIR__."/../../configuration/connect.php";
// Inicia a sessão para utilizar variáveis de sessão
class Auth{
    // Variáveis privadas
    private $banco;
    private  $statement;
    private $result;

    function __construct()
    {
        session_start();
    }
    public function login($email, $password)
    {
      

        try{
            // Conecta ao Database
             $this->banco = new Database();

            $this->banco->connection();

            // Faz a pesquisa para ver se exite algum usuário com a senha e e-mail passados e com o status ativo  
            // O status é para controlar usuários que já confirmaram o e-mail ou não...
            $this->statement =  $this->banco->pdo->prepare(" SELECT id, name FROM users WHERE email = :email AND password = :password AND status = 'ATIVO' ");

            $this->statement->bindParam(':email' , $email);
            $this->statement->bindParam(':password' , $password);
           
            $this->statement->execute();
     
            $this->result =  $this->statement->fetchAll(PDO::FETCH_ASSOC);

          
        // Se houver ele inicia as sessões e via JQuery faz o reload da página
             if(count($this->result) > 0)
             {  $_SESSION['id'] =  $this->result[0]['id'];
                $_SESSION['userName'] =  $this->result[0]['name'];
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
              
             } else{ 

                // Caso não exista nenhum registro ele retorna a mensagem de erro com senha ou email inválido...
                header('HTTP/1.1 500 Internal Server');
                header('Content-Type: application/json; charset=UTF-8');
                return die(json_encode(array('title'=>'OPS','message' => 'E-mail ou senha inválido.', 'code' => 1000)));

             }

        }catch(\Exception $exc){

            // Retorna erro caso algo dê errado
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            return die(json_encode(array('title'=>'ERRO','message' => "$exc", 'code' => 1001)));
           
        }

    }

    public function logout()
    {
       // Destroi as sessões existentes
        session_destroy();

        unset($_SESSION['userName']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);

        return;
    }
}
?>