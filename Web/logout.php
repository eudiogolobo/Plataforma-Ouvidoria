<?php
require_once "Auth/Auth.php";
// Instâncio a classe Auth
$user = new Auth();
// Executo a função para sair, destruindo as sessões ativas
$user->logout();

?>