<?php

session_start();

include 'controllers/sendEmails.php';
include "conexiune.php";

$nume = "";
$prenume = "";
$username = "";
$email = "";
$errors = [];

// SIGN UP USER
if (isset($_POST['signup-btn'])) {
    if (empty($_POST['nume'])) {
        $errors['nume'] = 'Ai uitat să completezi numele.';
    }
    if (empty($_POST['prenume'])) {
        $errors['prenume'] = 'Ai uitat să completezi prenumele.';
    }
    if (empty($_POST['username'])) {
        $errors['username'] = 'Ai uitat să completezi utilizatorul.';
    }
    if (empty($_POST['email'])) {
        $errors['email'] = 'Ai uitat să completezi emailul.';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Ai uitat să completezi parola.';
    } else {$password = $_POST['password'];}

    $litera_mare = preg_match('@[A-Z]@', $password);
    $litere_mici = preg_match('@[a-z]@', $password);
    $numere    = preg_match('@[0-9]@', $password);

    if(!$litera_mare || !$litere_mici || !$numere || strlen($_POST['password']) < 8) {
        $errors['password'] = 'Parola trebuie să aibă cel puțin 8 caractere și trebuie să includă cel puțin o literă mare și un număr.';
    }


    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors['passwordConf'] = 'Cele două parole nu coincid.';
    }

    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "Emailul există deja în baza noastră de date";
    }

    if (count($errors) === 0) {
        $query = "INSERT INTO users SET nume=?, prenume=?, username=?, email=?, token=?, password=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssss', $nume, $prenume, $username, $email, $token, $password);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // TO DO: send verification email to user
            $url_site = 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
            

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
                background: #592f80;
                text-decoration: none;
                padding: 8px 15px;
                border-radius: 5px;
                color: #fff;
                }
            </style>
            </head>

            <body>
            <div class="wrapper">
                <p>Vă mulțumim că v-ați înscris pe site-ul parohiei noastre. Ați primit acest email pentru că doriti să faceți o programare pentru Taina Sfântului Botezul sau Taina Sfintei Cununii la biserica noastră. </p>
                <p>Datele dvs. de acces sunt următoarele:<br> <strong>Username:</strong> ' .$username . ' <br /><strong>Parolă:</strong> pe care ați ales-o.</p>
                <p>Dacă ați uitat parola dați click aici: <a href="' .$url_site . '/recupereaza.php"> recuperează parola </a></p>
                <p>Vă rugăm să activați contul accesând linkul de mai jos:</p>
                <a href="' . $url_site . '/verify_email.php?token=' . $token . '"> Verificați emailul dumneavoastră! </a>
            </div>
            </body>

            </html>';

            phpmailer ($email, $from, "Parohia Sf. Ambrozie București", "Programări botezuri/cununii", $mesaj_email, $link_cerere='');
         
            $_SESSION['id'] = $user_id;
            $_SESSION['nume'] = $nume;
            $_SESSION['prenume'] = $prenume;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;
            $_SESSION['message'] = 'Ești logat!';
            $_SESSION['type'] = 'alert-success';
            header('location: index.php');
        } else {
            $_SESSION['error_msg'] = "Eroare de bază de date: Nu am putut înregistra utilizatorul.";
        }
    }
}

// LOGIN
if (isset($_POST['login-btn'])) {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Utilizator sau email obligatoriu';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Parola obligatorie';
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (count($errors) === 0) {
        $query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) { // if password matches
                $stmt->close();

                $_SESSION['id'] = $user['id'];
                $_SESSION['nume'] = $user['nume'];
                $_SESSION['prenume'] = $user['prenume'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];
                $_SESSION['message'] = 'Ești logat!';
                $_SESSION['type'] = 'alert-success';
                header('location: index.php');
                exit(0);
            } else { // if password does not match
               $errors['login_fail'] = "Utilizator sau parolă greșit(ă)";
            }
        } else {
            $_SESSION['message'] = "Eroare de bază de date. Loginul a eșuat!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}
