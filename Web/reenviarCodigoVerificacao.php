<?php

// Verifico se realmente tem requisições POST com os valores adquados
if(isset($_POST['email']) && isset($_POST['name']))
{

// Incluo meu arquivo para Reenviar o código de verificação para o e-mail do usuário
include_once __DIR__."/enviarCodigoVerificacao.php";

// Instâncio a classe EnviarCodigoVerificacao
$enviar = new EnviarCodigoVerificacao();

// Realizo o envio do código de verificação
$enviar->EnviarCodigo($_POST['email'], $_POST['name']);

}

?>