<?php
// Inicia a sessão para utilizar variáveis de sessão
class Auth{

    function __construct()
    {
        session_start();
    }
    public function login()
    {
        session_destroy();

        unset($_SESSION['userName']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);

        return;
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