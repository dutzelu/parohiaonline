<?php include 'controllers/authController.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">
  <title>Login ParohiaOnline</title>
</head>

<body>
  <div class="container">

    <div class="row">
      <div class="col-md-4 offset-md-4 form-wrapper auth">
        <p><img src="images/logo-parohiaonline.png" class="logo"/></p>
      
        <h3 class="text-center form-title">Înregistrare membri</h3>

             <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                             <li>  <?php echo $error; ?> </li>
                        <?php endforeach;?>
                    </div>
            <?php endif;?>

        <form action="signup.php" method="post">
        <div class="form-group">
            <input type="text" name="nume" class="form-control form-control-lg" value="<?php echo $nume; ?>" placeholder="Nume">
          </div>
         <div class="form-group">
            <input type="text" name="prenume" class="form-control form-control-lg" value="<?php echo $prenume; ?>" placeholder="Prenume">
          </div>
          <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $username; ?>" placeholder="Utilizator">
          </div>
          <div class="form-group">
            <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $email; ?>" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Parolă">
          </div>
          <div class="form-group">
            <input type="password" name="passwordConf" class="form-control form-control-lg" placeholder="Confirmă parola">
          </div>
          <div class="form-group">
            <button type="submit" name="signup-btn" class="btn btn-lg btn-block">Înregistrează-te</button>
          </div>
        </form>
        
        <p>Ai deja un cont? <a href="login.php">Login</a></p>
      </div>
    </div>

  </div>

</body>
</html>