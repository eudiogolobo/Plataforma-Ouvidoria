<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class EnviarEmail
{
    public $mail;

    function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    function sendEmail($email, $name, $codigo_verificacao)
    {
        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->mail->isSMTP();           
            $this->mail->CharSet = "UTF-8";                                 //Send using SMTP
            $this->mail->Host       = 'mail.labsmaker.com.br';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = 'recuperarsenha@labsmaker.com.br';                     //SMTP username
            $this->mail->Password   = 'G2kANv772kpVbST';                               //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
            $this->mail->setFrom('recuperarsenha@labsmaker.com.br', 'Ouvidoria de Criciúma');
            $this->mail->addAddress($email, $name);     //Add a recipient        
    
    
        //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = 'Código de Verificação';
            $this->mail->Body    = "<p>Olá $name. Seu código de verificação é: </p><h1 style='text-align: center;letter-spacing:1rem;font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;'>$codigo_verificacao</h1>.";
            $this->mail->AltBody = "Seu código de verificação é: $codigo_verificacao";
    
            $this->mail->send();
            echo "EMAIL OK";
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {  $this->mail->ErrorInfo}";
            return false;
        }

    }
}




?>