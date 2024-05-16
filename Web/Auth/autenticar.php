<?php
// Inicia a sessão para utilizar variáveis de sessão
session_start();

// Inclui o arquivo de conexão ao banco de dados
include_once "../configuration/connect.php";

// Cria uma instância da classe de conexão
$c = new Database();

// Define um limite para tentativas de login malsucedidas
$limiteTentativas = 3;

// Verifica se a variável de sessão para tentativas existe
if (!isset($_SESSION['tentativas'])) {
 $_SESSION['tentativas'] = 0;
}

// Verifica se o usuário está bloqueado
if (isset($_SESSION['bloqueio']) && $_SESSION['bloqueio'] > time()) {
 // Calcula o tempo restante de bloqueio
 $tempoRestante = $_SESSION['bloqueio'] - time();
 $mensagem = "Usuário bloqueado, tente novamente em " . gmdate("H:i:s", $tempoRestante);

 // Exibe uma mensagem de alerta e redireciona para a página de login
 echo "<script language='javascript'>window.alert('$mensagem'); </script>";
 echo "<script language='javascript'>window.location='../views/login.php'; </script>";

 // Encerra a execução do script
 exit();
}

// Verifica se as informações de usuário e senha foram submetidas via POST
if (isset($_POST['usuario'], $_POST['senha'])) {
 // Obtém e sanitiza os dados de usuário e senha
 $email = mysqli_real_escape_string($conexao, strtolower($_POST['usuario']));
 $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

 // Prepara a consulta SQL para buscar o usuário no banco de dados
 $consulta = "SELECT id_usuario, email, nome, id_fil, nivel, senha FROM usuarios WHERE email = ?";
 $stmt = mysqli_prepare($conexao, $consulta);
 mysqli_stmt_bind_param($stmt, "s", $email);
 mysqli_stmt_execute($stmt);
 $resultado = mysqli_stmt_get_result($stmt);

 // Verifica se a consulta foi bem-sucedida e se a senha é válida
 if ($resultado && $dado = mysqli_fetch_array($resultado)) {
     if (password_verify($senha, $dado["senha"])) {
         // Define as variáveis de sessão após o login bem-sucedido
         $_SESSION['id_usuario'] = $dado['id_usuario'];
         $_SESSION['email'] = $email;
         $_SESSION['nome'] = $dado['nome'];
         $_SESSION['id_fil'] = $dado['id_fil'];
         $_SESSION['nivel'] = $dado['nivel'];

         // Redireciona para a página de perfil após o login
         echo "<script language='javascript'>window.location='../views/perfil.php'; </script>";
         exit();
     }
 }

 // Incrementa o contador de tentativas
 $_SESSION['tentativas']++;

 // Verifica se o limite de tentativas foi atingido
 if ($_SESSION['tentativas'] >= $limiteTentativas) {
     // Bloqueia o usuário por 1 hora a partir deste momento
     $_SESSION['bloqueio'] = time() + 3600;
 }
}

// Se o login falhar, redirecione de volta para a página de login com uma mensagem de erro
echo "<script language='javascript'>window.alert('Erro'); </script>";
echo "<script language='javascript'>window.location='../views/login.php'; </script>";
exit();
?>