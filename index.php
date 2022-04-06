<?php 

include "controllers/authController.php";

if (isset($_GET['inregistrare'])) {
  $mesaj_inregistrare = "Înregistrarea a avut loc cu succes! Pentru a valida adresa dvs. de email v-am trimis un link de confirmare. Vă rugăm să dați click pe acel link și apoi vă puteți loga în panoul de administrare. ";
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/main.css">
  <title>Parohia Online - Login</title>
</head>

<body id="login">

  <div class="container">

    <div class="row">
     
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 form-wrapper auth login">
      <p><img src="<?php echo BASE_URL . 'images/logo-parohiaonline.png';?>" class="logo"/></p>
      
      <div style="margin-top:30px">
        <a href="login/login.php" class="btn btn-warning" role="button" style="width:49%">Utilizator</a>
        <a href="admin/index.php" class="btn btn-success" role="button" style="width:49%">Parohie</a>
      </div>
 

      </div>

    </div>

    </div>
  
  </div>

</body>
</html>