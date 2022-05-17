<?php

// SIGN UP PAROHIE

If ( isset ($_POST['inregistrare_parohie']) ) {

    $nume_parohie = $_POST['nume_parohie'];
    $episcopia = $_POST['episcopia'];
    $mitropolia = $_POST['mitropolia'];
    $tara = $_POST['tara'];
    $localitatea = $_POST['localitatea'];
    $adresa_bisericii = $_POST['adresa_bisericii'];
    $hramul_bisericii = $_POST['hramul_bisericii'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $numele_preotului = $_POST['numele_preotului'];
    $utilizator = $_POST['username'];
    $password = $_POST['password'];
    $conf_pass = $_POST['conf_pass'];

    $litera_mare = preg_match('@[A-Z]@', $password);
    $litere_mici = preg_match('@[a-z]@', $password);
    $numere    = preg_match('@[0-9]@', $password);

    if(!$litera_mare || !$litere_mici || !$numere || strlen($_POST['password']) < 8) {
        $errors['password'] = 'Parola trebuie să aibă cel puțin 8 caractere și trebuie să includă cel puțin o literă mare și un număr.';
    }


    if (isset($_POST['password']) && $_POST['password'] !== $_POST['conf_pass']) {
        $errors['conf_pass'] = 'Cele două parole nu coincid.';
    }

    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
    $sql = "SELECT * FROM parohii WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "Emailul există deja în baza noastră de date";
    }
    echo  "<br>" ;
 
    if (count($errors) === 0) {

        $query = "
            INSERT INTO parohii (nume_parohie, episcopia, mitropolia, tara, localitatea, adresa_bisericii, hramul_bisericii, telefon, email, numele_preotului, username, password, token)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)  
        ";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssssssssss', $nume_parohie, $episcopia, $mitropolia, $tara, $localitatea, $adresa_bisericii, $hramul_bisericii, $telefon, $email, $numele_preotului, $utilizator, $password, $token);
        $result = $stmt->execute();
 
    
        if ($result) {

            $user_id = $stmt->insert_id;
            $stmt->close();

            // TO DO: send verification email to user
            $url_site = BASE_URL .'/login';
            

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
                color: #592f80;
                }
            </style>
            </head>

            <body>
            <div class="wrapper">
                <p>Ați creat cu succes un cont pentru parohia dumneavoastră pe siteul parohiaonline.com</p>
                <p>Datele dvs. de acces sunt următoarele:<br> <strong>Username:</strong> ' .$utilizator . ' <br /><strong>Parolă:</strong> pe care ați ales-o.</p>
                <p>Vă rugăm să activați contul accesând linkul de mai jos:</p>
                <a href="' . $url_site . '/verify_email.php?ptoken=' . $token . '"> Verificați emailul dumneavoastră! </a>
                <p>Dacă ați uitat password dați click aici: <a href="' .$url_site . '/recupereaza.php"> recuperează parolă </a></p>
            </div>
            </body>

            </html>';

            phpmailer ($email, $from, $nume_parohie , "Înregistrare parohiaonline.com", $mesaj_email, $link_cerere='');
        
            $_SESSION['id'] = $user_id;
            $_SESSION['nume'] = $nume;
            $_SESSION['prenume'] = $prenume;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'Ești logat!';
            $_SESSION['type'] = 'alert-success';

            echo '<script> location.replace("admin/index.php?inregistrare=succes"); </script>';
            
        } else {
            $_SESSION['error_msg'] = "Eroare de bază de date: Nu am putut înregistra utilizatorul.";
        }
    }  
} else {
    $nume_parohie = NULL;
    $episcopia = NULL;
    $mitropolia = NULL;
    $tara = NULL;
    $localitatea = NULL;
    $adresa_bisericii = NULL;
    $hramul_bisericii = NULL;
    $telefon = NULL;
    $email = NULL;
    $numele_preotului = NULL;
    $utilizator = NULL;
}


