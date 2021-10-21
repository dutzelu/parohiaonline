<?php
include 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername("balan.claudiu@gmail.com")
    ->setPassword("parola92");

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $token, $username)
{
    global $mailer;
    $body = '<!DOCTYPE html>
    <html>

    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Vă mulțumim că v-ați înscris pe site-ul parohiei noastre. Ați primit acest email pentru că doriti să faceți o programare pentru Taina Sfântului Botezul sau Taina Sfintei Cununii la biserica noastră. </p>
        <p>Datele dvs. de acces sunt următoarele:<br> <strong>Username:</strong> ' .$username . ' <br /><strong>Parolă:</strong> pe care ați ales-o.</p>
        <p>Dacă ați uitat parola dați click aici: <a href="localhost/parohiaonline/recupereaza.php"> recuperează parola </a></p>
        <p>Vă rugăm să dați clic pe linkul de mai jos pentru a vă verifica contul de email:</p>
        <a href="http://localhost/parohiaonline/verify_email.php?token=' . $token . '"> Verificați emailul dumneavoastră! </a>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Programare botez/cununie'))
        ->setFrom("balan.claudiu@gmail.com", "Parohia Apărătorii Patriei II Sf. Ierarh Ambrozie")
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}



function emailCuAtasament ($email, $subiect, $link_cerere, $mesaj_email)
{
    global $mailer;
    $body = '<!DOCTYPE html>
    <html>

    <head>
      <meta charset="UTF-8">
    </head>

    <body>
      <div class="wrapper">' . $mesaj_email . '
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message($subiect))
        ->setFrom("balan.claudiu@gmail.com", "Parohia Apărătorii Patriei II Sf. Ambrozie")
        ->setTo($email)
        ->setBody($body, 'text/html');

    $message->attach(Swift_Attachment::fromPath($link_cerere));

    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}

function emailFaraAtasament ($email, $subiect, $mesaj_email)
{
    global $mailer;
    $body = '<!DOCTYPE html>
    <html>

    <head>
      <meta charset="UTF-8">
    </head>

    <body>
      <div class="wrapper">' . $mesaj_email . '
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message($subiect))
        ->setFrom("balan.claudiu@gmail.com", "Parohia Apărătorii Patriei II Sf. Ambrozie")
        ->setTo($email)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}
