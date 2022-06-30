<?php

$url_site = 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
include "header-admin.php"; 

$mesaj='';
$mesaj_email = '';
$link_cerere = '';
$data_si_ora = '';
$from = '';
$name = '';

$timp = date('Y-m-d h:i:s', time());

$parohie_id = $_SESSION['parohie_id'];
 
if (isset($_POST['raspunde'])) {
    $id_programare = $_GET['id'];
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
    }
} 

if (isset($_GET['eveniment'])) {
    $eveniment = $_GET['eveniment'];
}


// MESAJE pentru Botezuri și Cununii

afla_user_id ($id_programare, $eveniment);
afla_parohia();

if (isset($_POST['raspunde'])) {

    $mesaj = $_POST['mesaj'];
    

    // introdu mesajul in baza de date

    $query = 'INSERT INTO mesaje (id_programare, parohie_id, eveniment, user_id, mesaj, data_ora, trimis_de) VALUES (?,?,?,?,?,?,?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iisisss', $id_programare, $parohie_id,  $eveniment, $user_id, $mesaj, $timp, $numele_preotului);
    $result = $stmt->execute();
    $result = $stmt->get_result();

    // redirecționează
    
    switch ($eveniment) {
        case "botez": 
        echo '<script> location.replace("rezervare-unica.php?id=' . $id_programare . '"); </script>';
        break;

        case "cununie":
        echo '<script> location.replace("rezervare-unica-cununie.php?id=' . $id_programare . '"); </script>';
        break;

        case "sfestanie":
        echo '<script> location.replace("rezervare-unica-sfestanie.php?id=' . $id_programare . '"); </script>';
        break;

        case "parastas":
        echo '<script> location.replace("rezervare-unica-parastas.php?id=' . $id_programare . '"); </script>';
        break;
    } 



// SETEAZĂ STATUS 

    if ($eveniment == 'botez') {
        $query = 'UPDATE programari_botez SET status = ? WHERE id = ? ';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $status, $id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        // extrage adresa de email

        $query = 'SELECT * FROM programari_botez WHERE id=?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        while($data = $result->fetch_assoc()) {
            $email = $data['email'];
            $eveniment = $data['eveniment'];
            $data_si_ora = $data['data_si_ora'];
        }

        // detalii mail
        
        $subiect = "Programare: " . $eveniment . ' - ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora));

        $mesaj_email .= '
        <p>Doamne ajută!</p>
        <p>Am primit rezervarea dvs. pentru ' . $eveniment . ' din data de ' . date("H:i", strtotime($data_si_ora)) . 
        '. În urma verificării documentelor vă comunicăm urmatoarele:</p>';

        $mesaj_email .='<p>';

        $mesaj_email .= $mesaj;

        $mesaj_email .='</p>';

        $mesaj_email .= 'Vă rugăm să vă conectați pe site-ul nostru în zona aplicației de <a href="' . $url_site . '/login.php">programări online</a> cu userul și parola pe care le-ați ales, ca să atașați documentele și informațiile care lipsesc. Apoi părintele va verifica din nou validitatea rezervării și veți primi un răspuns prin email dar și direct în aplicație.';
        
        $email_admin = 'balan.claudiu@gmail.com';

        phpmailer($email, $from, $name, $subiect, $mesaj_email, $path='');


        echo '<script> location.replace("rezervare-unica.php?id=' . $id . '"); </script>';

    }

    elseif ($eveniment == 'cununie') {

        $query = 'UPDATE programari_cununie SET status = ? WHERE id = ? ';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $status, $id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        // extrage adresa de email

        $query = 'SELECT * FROM programari_cununie WHERE id=?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        while($data = $result->fetch_assoc()) {
            $email = $data['email'];
            $eveniment = $data['eveniment'];
            $data_si_ora = $data['data_si_ora'];
        }

        // detalii mail

        $subiect = "Programare: " . $eveniment . ' - ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora));

        $mesaj_email .= '
        <p>Doamne ajută!</p>
        <p>Am primit rezervarea dvs. pentru ' . $eveniment . ' din data de ' . date("H:i", strtotime($data_si_ora)) . 
        '. În urma verificării documentelor vă comunicăm urmatoarele:</p>';

        $mesaj_email .='<p>';

        $mesaj_email .= $mesaj;

        $mesaj_email .='</p>';

        $mesaj_email .= 'Vă rugăm să vă conectați pe site-ul nostru în zona aplicației de <a href="' . $url_site . 'index.php">programări online</a> cu userul și parola pe care le-ați ales, ca să atașați documentele și informațiile care lipsesc. Apoi părintele va verifica din nou validitatea rezervării și veți primi un răspuns prin email dar și direct în aplicație.';
        
        $email_admin = 'balan.claudiu@gmail.com';
       
        phpmailer($email, $from, "Parohia Online", $subiect, $mesaj_email, $path='');

        echo '<script> location.replace("rezervare-unica-cununie.php?id=' . $id . '"); </script>';

    }

    elseif ($eveniment == 'spovedanie') {

        $query = 'UPDATE programari_spovedanie SET status = ? WHERE id = ? ';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $status, $id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        // extrage adresa de email

        $query = 'SELECT * FROM programari_spovedanie WHERE id=?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        while($data = $result->fetch_assoc()) {
            $email = $data['email'];
            $eveniment = $data['eveniment'];
            $data_si_ora = $data['data_si_ora'];
        }

        echo '<script> location.replace("rezervare-unica-spovedanie.php?id=' . $id . '"); </script>';

    }

    elseif ($eveniment == 'sfestanie') {

        $query = 'UPDATE programari_sfestanie SET status = ? WHERE id = ? ';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $status, $id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

          echo '<script> location.replace("rezervare-unica-sfestanie.php?id=' . $id . '"); </script>';

    }

    elseif ($eveniment == 'parastas') {

        $query = 'UPDATE programari_parastas SET status = ? WHERE id = ? ';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $status, $id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        echo '<script> location.replace("rezervare-unica-parastas.php?id=' . $id . '"); </script>';

    }

} 
?>



 


    