<?php

include_once __DIR__."/enviarCodigoVerificacao.php";


$enviar = new EnviarCodigoVerificacao();

$enviar->EnviarCodigo($_POST['email'], $_POST['name']);
echo "reenviado";
?>