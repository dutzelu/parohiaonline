<?php

include "header-frontend.php"; 

$mesaj='';
$mesaj_email = '';
$link_cerere = '';
$data_si_ora = '';

$timp = date('Y-m-d h:i:s', time());

if (isset($_POST['raspunde'])) {
    $id_prog = $_GET['id'];
    $mesaj = $_POST['mesaj'];

if (isset($_GET['eveniment'])) {
    $eveniment = $_GET['eveniment'];
}
  
    detalii_user ($user_id);
    $trimis_de = $nume_user . ' ' . $prenume_user;

    // introdu mesajul in baza de date

    $query = 'INSERT INTO mesaje (id_programare, parohie_id, eveniment, user_id, mesaj, data_ora, trimis_de) VALUES (?,?,?,?,?,?,?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iisisss', $id_prog, $parohie_id, $eveniment, $user_id, $mesaj, $timp, $trimis_de);
    $result = $stmt->execute();
    $result = $stmt->get_result();


}

if ($eveniment == 'botez') {
    echo '<script> location.replace("home-unic.php?id=' .$id_prog .'"); </script>';
} elseif ($eveniment == 'cununie') {
    echo '<script> location.replace("home-unic-cununie.php?id=' .$id_prog .'"); </script>';
} elseif ($eveniment == 'sfestanie') {
    echo '<script> location.replace("home-unic-sfestanie.php?id=' .$id_prog .'"); </script>';
} elseif ($eveniment == 'parastas') {
    echo '<script> location.replace("home-unic-parastas.php?id=' .$id_prog .'"); </script>';
}

