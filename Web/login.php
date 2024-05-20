<?php

// Verifico se realmente veio uma requisição POST com os valores
if(isset( $_POST['email']) && isset($_POST['password']))
{
    // Incluo meu arquivo responsável pela autenticação
    include_once __DIR__."/Auth/Auth.php";

    // Instâncio a classe Auth
    $auth = new Auth();
    
    // Executo a função de validação para o login
    $auth->login($_POST['email'], hash('sha256', $_POST['password']));

}


?>