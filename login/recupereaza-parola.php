<?php

include "../includes/conexiune.php";
include "../controllers/sendEmails.php";

if (isset($_POST['recupereaza'])) {

  $email = $_POST['email'];
  
  $sql="SELECT id, email FROM users WHERE email = '$email'";
  $rezultate = mysqli_query ($conn, $sql);

  while ($data = mysqli_fetch_assoc($rezultate)){
    $id_user_email = $data['id'];
  }

    if(mysqli_num_rows($rezultate)==1)
      {
      
        // generez un cod de 6 cifre random și-l trimit pe email
        $code = mt_rand(100000,999999); 

        $sql="UPDATE users SET code = $code WHERE email = '$email';";
        mysqli_query ($conn, $sql);
      
        $mesaj_email = '<!DOCTYPE html>
        <html>

        <head>
          <meta charset="UTF-8">
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
            <p>Ați ales să vă resetați parola contului de pe site-ul parohiei. Codul pentru a continua procesul de schimbare a parolei este: <strong>' . $code . ' <strong></p>
                  
          </div>
        </body>

        </html>';

        phpmailer ($email, $from, "Parohia Sf. Ambrozie București", "Cod recuperare parolă", $mesaj_email, $link_cerere='');

        echo '<script> location.replace("reset.php?id=' . $id_user_email . '&email=ok"); </script>';

      } else {echo '<script> location.replace("login/recupereaza.php?succes=nu"); </script>';}
} 
 
?>

