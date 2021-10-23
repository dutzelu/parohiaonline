<?php
include "conexiune.php";


if (isset($_POST['login-btn'])) {
    $email = $_POST['email'];

$sql="SELECT 'email', 'password' FROM users WHERE'email'='$email'";
$rezultate = mysqli_query ($conn, $sql);

  if(mysqli_num_rows($rezultate)==1)
  {
    while($data=mysql_fetch_array($rezultate))
    {
      $email=md5($data['email']);
      $pass=md5($data['password']);
    }
    $link="<a href='localhost/parohiionline/reset.php?key=".$email."&reset=".$pass."'>Click aici pentru a reseta parola</a>";

    // Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
->setUsername("parohiaonline@sfantulambrozie.ro")
->setPassword("parola92");

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

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
        <p>Ați ales să vă resetați parola contului de pe site-uL Parohiei Apărătorii Patriei II, Sf. Ierarh Ambrozie.</p>
        <p>'. $link . '</p>
        
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Resetare parolă'))
        ->setFrom("parohiaonline@sfantulambrozie.ro", "Parohia Apărătorii Patriei II Sf. Ierarh Ambrozie")
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
} header ('location:recupereaza.php');
?>