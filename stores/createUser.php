<?php
include_once "../configuration/connect.php";

$name = $_POST['name'];
$dateBirth = $_POST['date-birth'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$whatsapp = $_POST['whatsapp'];
$password = $_POST['password'];
$passwordComnfirm = $_POST['password_comnfirm'];
$city = $_POST['city'];
$fu = $_POST['fu'];

echo "oi 1";
$confirmEmail = $connection->query("SELECT * FROM users where email = '$email'");
$data = $confirmEmail->fetchAll(PDO::FETCH_ASSOC);

echo "oi 2";

if((count($data)) <= 0)
{
    $result = $connection->prepare('INSERT INTO users (date_birth, email, telephone, whatsapp, 
    password, password_confirmation,name, city, fu) values ( :date_birth, :email, :telephone, :whatsapp, 
    :password, :password_comnfirmation, :name , :city, :fu)');
echo "oi 3";

    $result->bindValue(":date_birth", $dateBirth);
    $result->bindValue(":email", $email);
    $result->bindValue(":telephone", $telephone);
    $result->bindValue(":whatsapp", $whatsapp);
    $result->bindValue(":password", $password);
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