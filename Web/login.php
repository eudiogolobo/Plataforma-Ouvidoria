<?php

include_once __DIR__."/Auth/Auth.php";

$auth = new Auth();

$email = $_POST['email'];
$password = hash('sha256', $_POST['password']);

$auth->login($email, $password);

?>