<?php
include 'vendor/autoload.php';


function sendVerificationEmail($userEmail, $token, $username)
{
    global $url_site;
    $mesaj = '<!DOCTYPE html>
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
        <p>Dacă ați uitat parola dați click aici: <a href="' .$url_site . '/recupereaza.php"> recuperează parola </a></p>
        <p>Vă rugăm să dați clic pe linkul de mai jos pentru a vă verifica contul de email:</p>
        <a href="' . $url_site . '/verify_email.php?token=' . $token . '"> Verificați emailul dumneavoastră! </a>
      </div>
    </body>

    </html>';

 

    $subiect = "Programare botez/cununie";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
    $headers .= 'From: <parohiaonline@sfantulambrozie.ro>' . "\r\n";


    // Send the message
 
    mail($userEmail, $subiect, $mesaj, $headers);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}

 