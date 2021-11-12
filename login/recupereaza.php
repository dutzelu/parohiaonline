<?php 

include 'controllers/authController.php'; 

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
     
    <div class="col-md-4 form-wrapper auth login">
      <p><img src="images/logo-parohiaonline.png" class="logo"/></p>

      <p> <?php 
      
           if (isset($_GET['succes']) == 'nu') {echo '<div class="alert alert-danger">' . "Adresa de email introdusă nu există în baza noastră de date." . '</div>'; }
      
      ?> </p>
      
        <h3 class="text-center form-title">Recuperează parola</h3>
       
        <form action="recupereaza-parola.php" method="post">
          <div class="form-group">
            <input type="text" name="email" class="form-control form-control-lg" placeholder = "Introdu aici email tău">
          </div>
          <div class="form-group">
            <button type="submit" name="recupereaza" class="btn btn-lg btn-block">Recuperează</button>
          </div>
        </form>
        <p>Ai deja un cont? <a href="index.php">Login</a></p>
        <p>Nu ai încă un cont? <a href="signup.php">Înregistrează-te</a></p>
        
      </div>

    </div>

  </div>

</body>
</html>