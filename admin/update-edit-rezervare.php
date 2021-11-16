<?php

include "header-admin.php"; 
 

if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
}

$query = "SELECT * FROM programari_botez WHERE id = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_programare);
$result = $stmt->execute();
$result = $stmt->get_result();

while($data = $result->fetch_assoc()) {

    $link_tata_ci = $data['link_tata_ci'];
    $link_mama_ci = $data['link_mama_ci'];
    $link_plata_contributiei = $data['link_plata_contributiei'];
    $link_certificat_nastere_copil = $data['link_certificat_nastere_copil'];
}


if (isset($_POST['actualizeaza'])) {

    $eveniment = $_POST['eveniment'];
    $data_simpla = $_POST['data_simpla'];
    $nume_tata = $_POST['nume_tata'];
    $prenume_tata = $_POST['prenume_tata'];
    $nume_si_prenume_tata = $nume_tata . '-' . $prenume_tata;

    $nume_mama = $_POST['nume_mama'];
    $prenume_mama = $_POST['prenume_mama'];
    $nume_si_prenume_mama = $nume_mama . '-' . $prenume_mama;
 
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];

    $nume_copil = $_POST['nume_copil'];
    $prenume_copil = $_POST['prenume_copil'];
    $nume_si_prenume_copil = $nume_copil . '-' . $prenume_copil;

    $data_nasterii_copilului = $_POST['data_nasterii_copilului'];
    $numar_certificat_nastere = $_POST['numar_certificat_nastere'];
    $data_eliberarii_certificatului = $_POST['data_eliberarii_certificatului'];
    $eliberat_de_primaria = $_POST['eliberat_de_primaria'];
    $nume_botez_copil = $_POST['nume_botez_copil'];
    $nume_nas = $_POST['nume_nas'];
    $nume_nasa = $_POST['nume_nasa'];
    $localitate_nasi = $_POST['localitate_nasi'];
    $nume_cameraman = $_POST['nume_cameraman'];
    $telefon_cameraman = $_POST['telefon_cameraman'];

    
    $target_dir = ROOT_PATH . '/rezervari/' . $data_simpla . '-'. $eveniment . '-' . 'id-' . $id_programare;
    $target_dir = preg_replace('/\s+/', '-', $target_dir);

    $target_dir_www = 'rezervari/' . $data_simpla . '-'. $eveniment . '-' . 'id-' . $id_programare;
    $target_dir_www = preg_replace('/\s+/', '-', $target_dir_www);
      
    upload_foto('tata_ci', $nume_si_prenume_tata, 'link_tata_ci');
    upload_foto('mama_ci', $nume_si_prenume_mama, 'link_mama_ci');
    upload_foto('plata_contributiei', $nume_si_prenume_mama, 'link_plata_contributiei');
    upload_foto('certificat_nastere_copil', $nume_si_prenume_mama, 'link_certificat_nastere_copil');
   

    $query = 'UPDATE programari_botez 
    SET 

    nume_tata=?,
    prenume_tata=?,
    nume_mama=?,
    prenume_mama=?,
    adresa=?,
    telefon=?,
    email=?,
    nume_copil=?,
    prenume_copil=?,
    data_nasterii_copilului=?,
    numar_certificat_nastere=?,
    data_eliberarii_certificatului=?,
    eliberat_de_primaria=?,
    nume_botez_copil=?,
    nume_nas=?,
    nume_nasa=?,
    localitate_nasi=?,  
    nume_cameraman=?,
    telefon_cameraman=?,
    link_tata_ci=?,
    link_mama_ci=?,
    link_plata_contributiei=?,
    link_certificat_nastere_copil=?

    WHERE id = ?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('sssssssssssssssssssssssi', $nume_tata, $prenume_tata, $nume_mama, $prenume_mama, $adresa, $telefon, $email, $nume_copil, $prenume_copil, $data_nasterii_copilului, $numar_certificat_nastere, $data_eliberarii_certificatului, $eliberat_de_primaria, $nume_botez_copil, $nume_nas, $nume_nasa, $localitate_nasi, $nume_cameraman, $telefon_cameraman, $link_tata_ci, $link_mama_ci, $link_plata_contributiei, $link_certificat_nastere_copil, $id_programare);
    $result = $stmt->execute();


}


$user_id = $_SESSION['id'];

$query = 'SELECT * FROM users WHERE id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$result = $stmt->execute();
$result = $stmt->get_result();

while($data = $result->fetch_assoc()) {

    $admin = $data['admin'];
 
    if ($admin == 0) {
        echo '<script> location.replace("../home-unic.php?id=' . $id_programare . '&edit=ok"); </script>';
    } elseif ($admin == 1) {
        echo '<script> location.replace("rezervare-unica.php?id=' . $id_programare . '&edit=ok"); </script>';
    }
    

    }














?>