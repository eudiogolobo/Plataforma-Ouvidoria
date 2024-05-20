<?php

// Verifico se existe as sessões, caso não exista vai ser redirecionando para a HOME
if(!isset($_SESSION['id']) || !isset($_SESSION['userName']) || !isset($_SESSION['email']) || !isset($_SESSION['password']))
{
    header('Location: http://localhost/plataforma-ouvidoria/views/home.php');
    exit;
}

?>