<?php 

 include "../controllers/authController-parohie.php";
 include "../includes/functions.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/main.css">
  <title>Login Parohie</title>
</head>

<body id="login">

  <div class="container">

    <div class="row">
     
      
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 form-wrapper parohia auth login">
      <p><a href="../"><img src="<?php echo BASE_URL . 'images/logo-parohiaonline.png';?>" class="logo"/></a></p>
        <h3 class="text-center form-title"><img src="../images/participare-slujbe.png" /><br >Login parohie</h3>
       
        <?php 

        foreach ($errors as $error) {
          echo '<p class="btn btn-danger">' . $error . '</p>';
        }

        echo '<p>' .  $mesaj_inregistrare . '</p>';


        ?>

        <form action="index.php" method="post">
          <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $username; ?>" placeholder="Utilizator parohie sau email">
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Parola parohiei">
          </div>
          <div class="form-group">
            <button type="submit" name="login-parohie" class="btn btn-lg btn-block">Login</button>
          </div>
        </form>
        <div class="linkuri_login_form">
          <p>Nu ai încă un cont? <a href="<?php echo BASE_URL; ?>inregistreaza-parohie.php">Înregistrează-te</a></p>
          <p>Ai uitat parola? <a href="<?php echo BASE_URL; ?>login/recupereaza-parohie.php">Recupereaz-o</a></p>
       </div>
      </div>

    </div>

    </div>
  
  </div>

</body>
</html>