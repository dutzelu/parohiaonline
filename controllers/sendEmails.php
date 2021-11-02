<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'phpmailer/src/Exception.php';

/* The main PHPMailer class. */
require 'phpmailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'phpmailer/src/SMTP.php';

$email = new PHPMailer();


function phpmailer($to, $from, $from_name, $subject, $body, $path)
{
    $from = 'parohiaonline@parohiasfantulambrozie.ro';
    $name = 'Parohia Sf. Ambrozie București';
    
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ro');
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'mail.sfantulambrozie.ro';
    $mail->Port = 465;  
    $mail->Username = 'parohiaonline@sfantulambrozie.ro';
    $mail->Password = 'Parola*0920';   

    $mail->addAttachment($path);

    $mail->IsHTML(true);
    $mail->From="parohiaonline@sfantulambrozie.ro";
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