<?php

include "header-frontend.php"; 

$mesaj='';
$mesaj_email = '';
$link_cerere = '';
$data_si_ora = '';

$timp = date('Y-m-d h:i:s', time());

$user_id = $_SESSION['id'];
 
if (isset($_POST['raspunde'])) {
    $id = $_GET['id'];
    $mesaj = $_POST['mesaj'];

if (isset($_GET['eveniment'])) {
    $eveniment = $_GET['eveniment'];
}
  

    // introdu mesajul in baza de date

    $query = 'INSERT INTO mesaje (id_programare, eveniment, user_id, mesaj, data_ora) VALUES (?,?,?,?,?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isiss', $id, $eveniment, $user_id, $mesaj, $timp);
    $result = $stmt->execute();
    $result = $stmt->get_result();


}

if ($eveniment == 'botez') {
    echo '<script> location.replace("home-unic.php?id=' .$id .'"); </script>';
} elseif ($eveniment == 'cununie') {
    echo '<script> location.replace("home-unic-cununie.php?id=' .$id .'"); </script>';
}

