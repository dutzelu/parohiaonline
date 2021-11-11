<?php include 'controllers/authController.php'; 
$mesaj_inregistrare = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">
  <title>Parohia Online - Login</title>
</head>

<body id="login">

  <div class="container">

    <div class="row">
     
    <?php include "login-form.php";?>
    
  </div>

</body>
</html>