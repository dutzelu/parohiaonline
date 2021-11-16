<?php

include "header-admin.php"; 

if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
}

$query = "SELECT * FROM programari_cununie WHERE id = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_programare);
$result = $stmt->execute();
$result = $stmt->get_result();

while($data = $result->fetch_assoc()) {

    $link_mire_ci = $data['link_mire_ci'];
    $link_mireasa_ci = $data['link_mireasa_ci'];
    $link_plata_contributiei = $data['link_plata_contributiei'];
    $link_certificat_casatorie_civila = $data['link_certificat_casatorie_civila'];
    $link_certificat_botez_mire = $data['link_certificat_botez_mire'];
    $link_certificat_botez_mireasa = $data['link_certificat_botez_mireasa'];
    $link_dispensa = $data['link_dispensa'];
    $link_cerere = $data['link_cerere'];

    
}


if (isset($_POST['actualizeaza'])) {

    $eveniment = $_POST['eveniment'];
    $data_simpla = $_POST['data_simpla'];
    $nume_mire = $_POST['nume_mire'];
    $prenume_mire = $_POST['prenume_mire'];
    $nume_si_prenume_mire = $nume_mire . '-' . $prenume_mire;

    $nume_mireasa = $_POST['nume_mireasa'];
    $prenume_mireasa = $_POST['prenume_mireasa'];
    $nume_si_prenume_mireasa = $nume_mireasa . '-' . $prenume_mireasa;
 
    $adresa_mire = $_POST['adresa_mire'];
    $adresa_mireasa = $_POST['adresa_mireasa'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];

    $numar_certificat_casatorie = $_POST['numar_certificat_casatorie'];
    $data_eliberarii_certificatului = $_POST['data_eliberarii_certificatului'];
    $eliberat_de_primaria = $_POST['eliberat_de_primaria'];

    $nume_nas = $_POST['nume_nas'];
    $nume_nasa = $_POST['nume_nasa'];
    $localitate_nasi = $_POST['localitate_nasi'];
    $nume_cameraman = $_POST['nume_cameraman'];
    $telefon_cameraman = $_POST['telefon_cameraman'];

    $target_dir = ROOT_PATH . '/rezervari/' . $data_simpla . '-'. $eveniment . '-' . 'id-' . $id_programare;
    $target_dir = preg_replace('/\s+/', '-', $target_dir);

    $target_dir_www = 'rezervari/' . $data_simpla . '-'. $eveniment . '-' . 'id-' . $id_programare;
    $target_dir_www = preg_replace('/\s+/', '-', $target_dir_www);

    upload_foto('mire_ci', $nume_si_prenume_mire, 'link_mire_ci');
    upload_foto('mireasa_ci', $nume_si_prenume_mireasa, 'link_mireasa_ci');
    upload_foto('plata_contributiei', $nume_si_prenume_mire, 'link_plata_contributiei');
    upload_foto('certificat_casatorie_civila', $nume_si_prenume_mire, 'link_certificat_casatorie_civila');
    upload_foto('certificat_botez_mire', $nume_si_prenume_mire, 'link_certificat_botez_mire');
    upload_foto('certificat_botez_mireasa', $nume_si_prenume_mireasa, 'link_certificat_botez_mireasa');
    upload_foto('dispensa', $nume_si_prenume_mire, 'link_dispensa');
  

    $query = 'UPDATE programari_cununie
    SET 
    nume_mire=?,
    prenume_mire=?,
    nume_mireasa=?,
    prenume_mireasa=?,
    adresa_mire=?,
    adresa_mireasa=?,
    telefon=?,
    email=?,
    numar_certificat_casatorie=?,
    data_eliberarii_certificatului=?,
    eliberat_de_primaria=?,
    nume_nas=?,
    nume_nasa=?,
    localitate_nasi=?,  
    nume_cameraman=?,
    telefon_cameraman=?,
    link_mire_ci=?,
    link_mireasa_ci=?,
    link_plata_contributiei=?,
    link_certificat_casatorie_civila=?,
    link_certificat_botez_mire=?,
    link_certificat_botez_mireasa=?,
    link_dispensa=?

    WHERE id = ?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('sssssssssssssssssssssssi', $nume_mire, $prenume_mire, $nume_mireasa, $prenume_mireasa, $adresa_mire, $adresa_mireasa, $telefon, $email, $numar_certificat_casatorie, $data_eliberarii_certificatului, $eliberat_de_primaria,  $nume_nas, $nume_nasa, $localitate_nasi, $nume_cameraman, $telefon_cameraman, $link_mire_ci, $link_mireasa_ci, $link_plata_contributiei, $link_certificat_casatorie_civila, $link_certificat_botez_mire, $link_certificat_botez_mireasa,  $link_dispensa, $id_programare);
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
        echo '<script> location.replace("../home-unic-cununie.php?id=' . $id_programare . '&edit=ok"); </script>';
    } elseif ($admin == 1) {
        echo '<script> location.replace("rezervare-unica-cununie.php?id=' . $id_programare . '&edit=ok"); </script>';
    }
    
    

    }

?>