<?php
 
session_start();

include __DIR__. "/../includes/config.php";
include __DIR__. '/../includes/conexiune.php';
include  __DIR__. '/../controllers/sendEmails.php';

$verificat = "";
$mesaj_inregistrare = "";
setlocale(LC_ALL, 'ro_RO');

$nume = "";
$prenume = "";
$username = "";
$email = "";
$errors = [];

// Cazul 1. Abia s-a înregistrat

if (isset($_GET['inregistrare'])) {

    $mesaj_inregistrare = "Înregistrarea a avut loc cu succes! Pentru a valida adresa dvs. de email v-am trimis un link de confirmare. Vă rugăm să dați click pe acel link și apoi vă puteți loga în panoul de administrare. ";

}  

// Cazul 2. Încearcă să se înregistreze dar nu și-a validat adresa de email

if (isset($_GET['verificat'])) {

        $verificat = $_GET['verificat'];

    if ($verificat =='nu') {

        $mesaj_inregistrare = "Încă nu ați validat adresa dvs. de email. V-am trimis un link de confirmare. ";
    }

    if ($verificat =='ok') {

        $mesaj_inregistrare = "Email verificat cu succes";
    }

}  

// LOGIN
if (isset($_POST['login-parohie'])) {

    if (empty($_POST['username'])) {
        $errors['username'] = 'Utilizator bligatoriu';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Parola obligatorie';
    }
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (count($errors) === 0) {

        $query = "SELECT * FROM parohii WHERE username=? OR email=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

            while($user = $result->fetch_assoc())  {

                $verificat = $user['verified'];

                if (password_verify($password, $user['password'])) { 
                    
                    // if password matches

                    $stmt->close();

                    $_SESSION['id'] = $user['id'];
                    $_SESSION['nume_parohie'] = $user['nume_parohie'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['verified'] = true;
                    $_SESSION['message'] = 'Adresa dvs. de e-mail a fost verificată cu succes.';
                    $_SESSION['type'] = 'alert-success';

                }  else { 
                    $errors['login_fail'] = "Utilizator sau parolă greșit(ă)";
                    }
    
            }
                    // if password does not match

            
                if ($verificat == 1) {
                    echo '<script> location.replace("../admin/admin.php"); </script>';
                } else {
                    echo '<script> location.replace("../admin/index.php?verificat=nu"); </script>';
                }
    
    } else {
        $_SESSION['message'] = "Eroare de bază de date. Loginul a eșuat!";
        $_SESSION['type'] = "alert-danger";
    }
}
