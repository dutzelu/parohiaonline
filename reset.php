<?php 

include 'controllers/authController.php'; 
include 'functions.php'; 

if (isset($_GET['id'])) {
    $id_user_email = $_GET['id'];

    // aflu adresa de email pentru a-o afișa și cenzura parțail
    $query = 'SELECT * FROM users WHERE id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i',  $id_user_email);
    $result = $stmt->execute();
    $result = $stmt->get_result();

    while ($data = mysqli_fetch_assoc($result)){   
        $email = $data['email'];
        $email_cenzurat = hideEmailAddress($data['email']);
    }
}


if (isset($_POST['reset-btn'])) {
    
    $code = $_POST['code'];
    $parola_noua = $_POST['parola_noua'];
    $confirma_parola = $_POST['confirma_parola'];

    // verifică dacă codul există în baza de date la acel id

    $query = 'SELECT * FROM users WHERE code = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i',  $code);
    $result = $stmt->execute();
    $result = $stmt->get_result();

 
    // dacă codul de 6 cifre e incorect

    if(mysqli_num_rows($result)==0 ) {
        $errors['code_incorect'] = "Codul introdus nu este corect. V-am trimis codul corect pe email.";
    }

    if (empty($code)) {
        $errors['code_lipsa'] = "Ați uitat să completați codul de confirmare.";
    }

    // dacă parola nu are 8 caractere și nu include literă mare și un număr

    $litera_mare = preg_match('@[A-Z]@', $parola_noua);
    $litere_mici = preg_match('@[a-z]@', $parola_noua);
    $numere    = preg_match('@[0-9]@', $parola_noua);

    if(!$litera_mare || !$litere_mici || !$numere || strlen($_POST['parola_noua']) < 8) {
        $errors['parola'] = 'Parola trebuie să aibă cel puțin 8 caractere și trebuie să includă cel puțin o literă mare și un număr.';
    }

    // dacă cele două parole nu coincid

    if (empty($parola_noua)) {
        $errors['parola_noua_lipsa'] = "Ați uitat să completați parola.";
    }

    if (empty($confirma_parola)) {
        $errors['confirma_parola_lipsa'] = "Ați uitat să confirmați noua parolă.";
    }

    if($parola_noua !== $confirma_parola) {
        $errors['parole'] = "Parolele nu coincid.";
    }

    // dacă totul este corect

    if (count($errors) === 0) {
        $query = 'Update users SET password = ? WHERE id = ?';
        $stmt = $conn->prepare($query);
        $parola_noua = password_hash($parola_noua, PASSWORD_DEFAULT); //encrypt password
        $stmt->bind_param('si', $parola_noua, $id_user_email);
        $rezultat_schimbare_parola = $stmt->execute();

        if (!empty($rezultat_schimbare_parola)){

            $mesaj_succes = '<div class="alert alert-success" role="alert">Parola a fost schimbată cu succes.</div>';

            // schimb codul in baza de date ca să nu mai poată fi folosit
            $query = 'Update users SET code = code-101 WHERE id = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $id_user_email);
            $result2 = $stmt->execute();

        } else {$mesaj_succes = '';}
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

     
        <h3 class="text-center form-title">Resetare parolă</h3>

        <!-- dacă adresa de email nu există în baza de date -->

        <p> 

         <?php 

        if (isset($_GET['email'])) {
            echo "V-am trimis pe adresa de email <strong>" . $email_cenzurat . "</strong> un cod de 6 cifre pentru confirmare.";
        }
         
         if ($_GET['succes'] == 'nu') {echo '<div class="alert alert-danger">' . "Adresa de email introdusă nu există în baza noastră de date." . '</div>'; }


        // dacă schimbare s-a făcut cu succes
        echo $mesaj_succes; ?> 

        </p> 

       <!-- dacă sunt erori după introducerea parolelor și a codului -->

      <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                             <li>  <?php echo $error; ?> </li>
                        <?php endforeach;?>
                    </div>
      <?php endif;
      
      if (empty($rezultat_schimbare_parola))

        {echo  '<form action="' .  $_SERVER['PHP_SELF'] . '?id=' . $id_user_email . '" method="post"
       
       ?>
        <div class="form-group">
            <input type="number" name="code" class="form-control form-control-lg" placeholder = "Cod de confirmare">
          </div>
          <div class="form-group">
            <input type="password" name="parola_noua" class="form-control form-control-lg" placeholder = "Parola nouă">
          </div>
          <div class="form-group">
            <input type="password" name="confirma_parola" class="form-control form-control-lg" placeholder = "Confirmă parola">
          </div>
          <div class="form-group">
            <button type="submit" name="reset-btn" class="btn btn-lg btn-block">Schimbă parola</button>
          </div>
        </form>
        
        <p>Ai deja un cont? <a href="index.php">Login</a></p>
        <p>Nu ai încă un cont? <a href="signup.php">Înregistrează-te</a></p>
        
      </div>

        <?php ';
        } echo '<a class="btn btn-primary loginlink" href="login.php" role="button">Login</a>'; 
        ?>
    </div>

  </div>

</body>
</html>