<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
include  __DIR__. "/../phpmailer/src/Exception.php";

/* The main PHPMailer class. */

include  __DIR__. "/../phpmailer/src/PHPMailer.php";

/* SMTP class, needed if you want to use SMTP. */
include  __DIR__. "/../phpmailer/src/SMTP.php";

$email = new PHPMailer();


function phpmailer($to, $from, $from_name, $subject, $body, $path)
{
    $from = 'balan.claudiu@gmail.com';
    $name = 'Parohia Sf. Ambrozie București';
    
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ro');
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;  
    $mail->Username = 'balan.claudiu@gmail.com';
    $mail->Password = 'parola92';   

    $mail->addAttachment($path);

    $mail->IsHTML(true);
    $mail->From="balan.claudiu@gmail.com";
    $mail->FromName=$from_name;
    $mail->Sender=$from;
    $mail->AddReplyTo($from, $from_name);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($to);
    if(!$mail->Send())
    {
        $error ="Vă rugăm încercați mai târziu. A apărut o eroare...";
        return $error; 
    }
    else 
    {
        $error = "Mailul a fost trimis cu succes.";  
        return $error;
    }
}