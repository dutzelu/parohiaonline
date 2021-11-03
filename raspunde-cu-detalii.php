<?php

$url_site = 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
include "header-admin.php"; 
include 'controllers/sendEmails.php';
 

$mesaj='';
$mesaj_email = '';
$link_cerere = '';
$data_si_ora = '';

$timp = date('Y-m-d h:i:s', time());

$user_id = $_SESSION['id'];
 
if (isset($_POST['raspunde'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
}

if (isset($_GET['eveniment'])) {
    $eveniment = $_GET['eveniment'];
}


 
if (isset($_POST['raspunde'])) {

    $mesaj = $_POST['mesaj'];
  

    // introdu mesajul in baza de date

    $query = 'INSERT INTO mesaje (id_programare, eveniment, user_id, mesaj, data_ora) VALUES (?,?,?,?,?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isiss', $id, $eveniment, $user_id, $mesaj, $timp);
    $result = $stmt->execute();
    $result = $stmt->get_result();

    // setează status detalii

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
        
        $email_admin = 'parohiaonline@sfantulambrozie.ro';

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
        
        $email_admin = 'parohiaonline@sfantulambrozie.ro';
       
        phpmailer($email, $from, "Parohia Online", $subiect, $mesaj_email, $path='');

        echo '<script> location.replace("rezervare-unica-cununie.php?id=' . $id . '"); </script>';

    }

} 
?>



 


    