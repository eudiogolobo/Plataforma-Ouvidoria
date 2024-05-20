<?php

if(isset($_GET['code']))
{
   // Incluo meus arquivos para conectar ao Db e fazer o login
   // quando válidar o código
      include_once "../configuration/Database.php";
      include_once __DIR__."/Auth/Auth.php";
      
      // retomo a sessão
      session_start();

       // Intâncio o Database
      $database = new Database();

      // Faço a conexão ao Database
      try {
         $database->connection();
      } catch(PDOException $e) {
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            return die(json_encode(array('title'=>'ERRO','message' => 'Erro na conexão do servidor. Tente novamente mais tarde.')));
      }

      // Faço uma pesquisa para válidar o código
      // (A sessão atual do usuário deve ser igual à que tá cadastrada no Database para uma maior segurança)
      $result = $database->pdo->prepare('SELECT a.id, a.session_id , a.code_verification , a.email, b.email , b.password, b.name FROM email_confirmation AS a , users AS b WHERE a.session_id = :sessionn AND a.email = b.email AND a.code_verification = :code ');
      $result->bindValue(":sessionn",session_id());
      $result->bindValue(":code",$_GET['code']);
      $result->execute();

      // Destruo a sessão para não dar conflito com a que vai existir no arquivo que vai ser chamado 
      session_destroy();

      // retorna array com as linhas da pesquisa
      $data = $result->fetchAll(PDO::FETCH_ASSOC);

      // Verifica se retornou algo
   
      if(count($data) > 0)
      {
         // Se houve retorno ele deleta esse código
         $result = $database->pdo->prepare('DELETE FROM email_confirmation WHERE id = :id ');
         $result->bindValue(":id",$data[0]['id']);
         $result->execute();

         // Atualiza o status do usuário para ativo
         // (Usuário não consegue logar se status estuver inativo)
         $result = $database->pdo->prepare('UPDATE users SET status = :status WHERE email = :email ');
         $result->bindValue(":status","ATIVO");
         $result->bindValue(":email",$data[0]['email']);
         $result->execute();

         // Instância a classe Auth 
         $auth = new Auth();

         // Realiza o login automático com as informações 
         // da pesquisa
         $auth->login($data[0]['email'], $data[0]['password']);

      } else{

         // Se cair aqui é porque não houve resulta para da pesquisa
         // Retorna um array dizendo que o código é inválido
         header('HTTP/1.1 500 Internal Server');
         header('Content-Type: application/json; charset=UTF-8');
         return die(json_encode(array('title'=>'Código Inválido','message' => 'Esse código é inválido. Tente novamente!')));
      }

}
 
 
?>