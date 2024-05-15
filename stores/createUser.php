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



if((count($data)) <= 0)
{
    $result = $database->pdo->prepare('INSERT INTO users (date_birth, email, telephone, whatsapp, 
    password, password_confirmation,name, city, fu) values ( :date_birth, :email, :telephone, :whatsapp, 
    :password, :password_comnfirmation, :name , :city, :fu)');

    $result->bindValue(":date_birth", $dateBirth);
    $result->bindValue(":email", $email);
    $result->bindValue(":telephone", $telephone);
    $result->bindValue(":whatsapp", $whatsapp);
    $result->bindValue(":password", hash('sha256', $password));
    $result->bindValue(":password_comnfirmation", $passwordComnfirm);
    $result->bindValue(":name", $name);
    $result->bindValue(":city", $city);
    $result->bindValue(":fu", $fu);

    $result->execute();

    echo"Cadastrado com sucesso.";
} else{
    echo"Erro.";
}
?>