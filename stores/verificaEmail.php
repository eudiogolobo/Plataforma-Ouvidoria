<?php
include_once "../configuration/connect.php";

$database = new Database();

$name = $_POST['name'];
$dateBirth = $_POST['date-birth'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$whatsapp = $_POST['whatsapp'];
$password = $_POST['password'];
$passwordComnfirm = $_POST['password_comnfirm'];
$city = $_POST['city'];
$fu = $_POST['fu'];


$confirmEmail = $database->pdo->query("SELECT * FROM users where email = '$email'");
$data = $confirmEmail->fetchAll(PDO::FETCH_ASSOC);



if((count($data)) > 0)
{
    header('HTTP/1.1 500 Internal Server');
    header('Content-Type: application/json; charset=UTF-8');
    return die(json_encode(array('title'=>'E-mail inválido','message' => 'E-mail já cadastrado em nosso servidor.', 'code' => 1337)));
}

echo"sucesso"

?>