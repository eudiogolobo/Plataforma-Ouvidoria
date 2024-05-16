<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'Mail/src/Exception.php';
require_once 'Mail/src/PHPMailer.php';
require_once 'Mail/src/SMTP.php';

try{
    $mail = new PHPMailer();

    $mail->Debugoutput = true;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'mail.labsmaker.com.br';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = 'recuperarsenha@labsmaker.com.br';
$mail->Password = 'G2kANv772kpVbST';

$mail->setFrom('recuperarsenha@labsmaker.com.br', 'Prefa');
$mail->addAddress('diogolobo444@gmail.com', 'Diogo');
$mail->isHTML(true);
$mail->Subject = 'TESTE';
$mail->Body = 'Corpo da Mensagem em <b>html</b>';
$mail->send();

} catch(Exception $e){
    echo $e;
}





?>