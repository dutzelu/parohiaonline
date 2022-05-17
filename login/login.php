<?php 

include "../header-frontend.php";
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
  <link rel="stylesheet" href="../css/main.css">
  <title>Parohia Online - Login</title>
</head>

<body id="login">

  <div class="container">

    <div class="row">
     
      
 <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 form-wrapper auth login">
      <p><a href="../"><img src="<?php echo BASE_URL . 'images/logo-parohiaonline.png';?>" class="logo"/></a></p>
        <h3 class="text-center form-title">Login utilizator</h3>
        <?php 

        foreach ($errors as $error) {
          echo '<p class="btn btn-danger">' . $error . '</p>';
        }

        if (isset($_GET['inregistrare'])) {
          $mesaj_inregistrare = "Înregistrarea a avut loc cu succes! Pentru a valida adresa dvs. de email v-am trimis un link de confirmare. Vă rugăm să dați click pe acel link și apoi vă puteți loga în panoul de administrare. ";
        }

        echo '<p>' . $mesaj_inregistrare . '</p>';

        if (isset($_GET['verificat'])) {
          echo '<p>' .  $_SESSION['message'] . '</p>';
        }
        
        ?>

        <form action="<?php echo BASE_URL; ?>login/login.php" method="post">
          <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $username; ?>" placeholder="Utilizator sau email" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Parola" required>
          </div>
          <div class="form-group">
            <button type="submit" name="login-btn" class="btn btn-lg btn-block">Login</button>
          </div>
        </form>
        <div class="linkuri_login_form">
          <p>Nu ai încă un cont? <a href="<?php echo BASE_URL; ?>login/signup.php">Înregistrează-te</a></p>
          <p>Ai uitat parola? <a href="<?php echo BASE_URL; ?>login/recupereaza.php">Recupereaz-o</a></p>
       </div>
      </div>

    </div>
    
  </div>

</body>
</html>