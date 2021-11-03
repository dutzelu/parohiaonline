<?php 

include 'controllers/authController.php';
include "conexiune.php";
$verificat = "";
$mesaj_inregistrare = "";
setlocale(LC_ALL, 'ro_RO');



// Cazul 1. Fără cont și nelogat. Afișează mai jos formularul de login.

// Cazul 2. Are înregistrat un cont

if (!empty($_SESSION['id'])) {

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id= $id";
    $rezultate = mysqli_query ($conn, $sql);
    while ($data = mysqli_fetch_assoc($rezultate)){  
        $admin = $data['admin'];
        $verificat = $data['verified'];
    }

    // 1a) ..dar nu are emailul verificat

        if ($verificat == 0) {

            $mesaj_inregistrare = "Înregistrarea a avut loc cu succes! Pentru a valida adresa dvs. de email v-am trimis un link de confirmare. Vă rugăm să dați click pe acel link și apoi vă puteți loga în panoul de administrare. ";

        } else {$mesaj_inregistrare = '';}
    
    // 1b) ..are emailul verificat și este admin

        if ($verificat == 1 && $admin == 1 ) {
            header('location: registru.php?eveniment=programari_botez');
        } 

     // 1c) ..are emailul verificat și NU este admin

     if ($verificat == 1 && $admin == 0 ) {
        header('location: frontend.php?pentru=botez');
    } 
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
  <link rel="stylesheet" href="main.css">
  <title>Parohia Online - Login</title>
</head>

<body>

  <div class="container">

    <div class="row">
     
    <div class="col-md-4 offset-md-4 form-wrapper auth login">
      <p><img src="images/logo-parohiaonline.png" class="logo"/></p>
        <h3 class="text-center form-title">Login</h3>
       
        <?php 

        foreach ($errors as $error) {
          echo '<p class="btn btn-danger">' . $error . '</p>';
        }

        echo '<p>' . $mesaj_inregistrare . '</p>';
        
        ?>

        <form action="login.php" method="post">
          <div class="form-group">
            <label>Utilizator sau Email</label>
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $username; ?>">
          </div>
          <div class="form-group">
            <label>Parola</label>
            <input type="password" name="password" class="form-control form-control-lg">
          </div>
          <div class="form-group">
            <button type="submit" name="login-btn" class="btn btn-lg btn-block">Login</button>
          </div>
        </form>
        
        <p>Nu ai încă un cont? <a href="signup.php">Înregistrează-te</a></p>
        <p>Ai uitat parola? <a href="recupereaza.php">Recupereaz-o</a></p>
      </div>

    </div>

  </div>

</body>
</html>