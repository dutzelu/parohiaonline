<?php 

 include "../controllers/authController.php";
 include "../includes/functions.php";
 

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
            header('location: ../admin/registru.php?eveniment=programari_botez');
        } 

     // 1c) ..are emailul verificat și NU este admin

     if ($verificat == 1 && $admin == 0 ) {
        header('location: ../eroare-404.php');
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
  <link rel="stylesheet" href="../css/main.css">
  <title>Parohia Online - Login</title>
</head>

<body id="login">

  <div class="container">

    <div class="row">
     
    <?php include ("../login/login-form.php"); ?>

    </div>
  
  </div>

</body>
</html>