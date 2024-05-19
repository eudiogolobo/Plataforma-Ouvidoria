<?php
include_once __DIR__."/../../configuration/connect.php";
// Inicia a sessão para utilizar variáveis de sessão
class Auth{
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
             $this->banco = new Database();

            $this->banco->connection();

            $this->statement =  $this->banco->pdo->prepare(" SELECT name FROM users WHERE email = :email AND password = :password AND status = 'ATIVO' ");

            $this->statement->bindParam(':email' , $email);
            $this->statement->bindParam(':password' , $password);
           
            $this->statement->execute();
     
            $this->result =  $this->statement->fetchAll(PDO::FETCH_ASSOC);

          
             if(count($this->result) > 0)
             {
                $_SESSION['userName'] =  $this->result[0]['name'];
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
              
             } else{ 
                header('HTTP/1.1 500 Internal Server');
                header('Content-Type: application/json; charset=UTF-8');
                return die(json_encode(array('title'=>'OPS','message' => 'E-mail ou senha inválido.', 'code' => 1000)));

             }

        }catch(\Exception $exc){
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            return die(json_encode(array('title'=>'ERRO','message' => "$exc", 'code' => 1001)));
           
        }

    }

    public function logout()
    {
       
        session_destroy();

        unset($_SESSION['userName']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);

        return;
    }
}
?>