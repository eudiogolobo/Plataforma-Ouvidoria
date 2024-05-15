<?
include_once "./configuration/connect.php";

$db = new Database();
$db->__construct();

$name = $_POST['name'];
$dateBirth = $_POST['date-birth'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$whatsapp = $_POST['whatsapp'];
$password = $_POST['password'];
$passwordComnfirm = $_POST['password_comnfirm'];
$city = $_POST['city'];
$fu = $_POST['fu'];

$confirmEmail = $db->connection->query("SELECT * FROM users where email = '$email'");
$data = $confirmEmail->fetchAll(PDO::FETCH_ASSOC);

if((count($data)) > 0)
{
    $result = $db->connection->prepare("INSERT INTO users (name, date_birth, email, telephone, whatsapp, 
    password, password_comnfirmation, city, fu) values (:name, :date_birth, :email, :telephone, :whatsapp, 
    :password, :password_comnfirmation, :city, :fu)");

    $result->bindValue(":name", $name);
    $result->bindValue(":date_birth", $date_birth);
    $result->bindValue(":email", $email);
    $result->bindValue(":telephone", $telephone);
    $result->bindValue(":whatsapp", $whatsapp);
    $result->bindValue(":password", $password);
    $result->bindValue(":password_comnfirmation", $password_comnfirmation);
    $result->bindValue(":city", $city);
    $result->bindValue(":fu", $fu);

    $result->execute();

    echo"Cadastrado com sucesso.";
} else{
    echo"Erro.";
}
?>