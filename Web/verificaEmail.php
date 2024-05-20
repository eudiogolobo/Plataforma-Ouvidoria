<?php

// Verifica se realmente foi feita a requisição corretamente
if(isset($_POST['email']))
{

        // Inclúi o arquivo do Database
        include_once "../configuration/Database.php";

        // Instância uma nova classe para conectar o Database
        $database = new Database();

        // Se conectar n acontece nada, caso contrário ele retorna erro
        try {
            $database->connection();
        } catch(PDOException $e) {
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            return die(json_encode(array('title'=>'ERRO','message' => 'Erro na conexão do servidor. Tente novamente mais tarde.', 'code' => 1001)));
        }

        // Pega o valor do email passado pelo POST 
        $email = $_POST['email'];

        // FAZ UMA PESQUISA PARA VER SE ESSE EMAIL ESTÁ NA TABELA DE CONFIRMAÇÃO DE EMAIL (Essa maneira com "prepare()" e "execute()" ajuda a evitar SQL Injection)
        $emailCod = $database->pdo->prepare("SELECT * FROM email_confirmation WHERE email = :email ");
        $emailCod->bindValue(':email',$email);
        $emailCod->execute();
        $dataEmailCod = $emailCod->fetchAll(PDO::FETCH_ASSOC);

        // SE EXISTER ALGUM REGISTRO RETORNA UM AVISO DIZENDO QUE JÁ TEM UM CADASTRO COM ESSE E-MAIL, E
        // PERGUTA SE QUER IR PARA PARTE DE CONFIRMAÇÃO DO E-MAIL OU SE 
        // QUER CANCELAR E CONTINUAR COM OUTRO E-MAIL
        // SE NÃO TIVER NENHUM RESITRO SEGUE O CÓDIGO ADIANTE
        if(count($dataEmailCod) > 0)
        {
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            return die(json_encode(array('title'=>'ATENÇÃO','message' => 'Verificamos que existe um cadastro não finalizado em nosso sistema com esse endereço de e-mail. Deseja ir para etapa de confirmação desse e-mail?', 'code' => 1003)));

        }

        // Prepara e executa a pesquisa (Essa maneira com "prepare()" e "execute()" ajuda a evitar SQL Injection)
        $confirmEmail = $database->pdo->prepare("SELECT * FROM users where email = :email ");
        $confirmEmail->bindValue(":email", $email);
        $confirmEmail->execute();
        $data = $confirmEmail->fetchAll(PDO::FETCH_ASSOC);


        // SE TIVER ALGUM REGISTRO COM ESSE E-MAIL QUER DIZER QUE JÁ EXISTE UM USUÁRIO ATIVO COM O E-MAIL
        // ENTÃO RETORNA UM ERRO DIZENDO QUE ESSE E-MAIL É INVÁLIDO...
        if((count($data)) > 0)
        {
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
            return die(json_encode(array('title'=>'E-mail inválido','message' => 'E-mail já cadastrado em nosso servidor.', 'code' => 1002)));
        }
}


?>