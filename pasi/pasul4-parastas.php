<?php 
include "../header-frontend.php"; 

 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$ora = '';

    if (!empty($_GET)) {
        $zi = $_GET['zi'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        $pentru = $_GET['pentru'];
        $ora = $_GET['ora'];
    }

 $user_id = $_SESSION['id'];
 $data_si_ora = $year . "-" . $month . '-' . $zi . " " . $ora . ":00";
 $data_simpla = $year . "-" . $month . '-' . $zi;



 if (isset($_POST['date_personale'])) {

    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $mesaj = $_POST['mesaj'];

    $status = "în așteptare";
  
    $query = 'INSERT INTO programari_parastas SET 
    user_id=?, 
    eveniment=?,
    nume=?,
    prenume=?,
    adresa=?,
    telefon=?,
    email=?,
    mesaj=?,
    data_si_ora=?,
    status=?,
    parohie_id=?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('isssssssssi', $user_id, $eveniment, $nume, $prenume, $adresa, $telefon, $email, $mesaj, $data_si_ora, $status, $id);
    $result = $stmt->execute();

    $last_id = mysqli_insert_id($conn);


    $sql="UPDATE zile_stabilite
    SET rezervari = rezervari - 1
    WHERE tip_programare = 'botez' AND (data_start LIKE '%$data_simpla%' AND parohie_id = $id)";

    $rezultate = mysqli_query ($conn, $sql);

}

// detalii mail


$from = "contact@parohiaonline.ro";
$name = "Parohia Online";
 
 $subiect = "Programare: " . $eveniment . '  ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora));
 
 $mesaj_email = '
 <p>Doamne ajută!</p>
 <p>Cererea pentru programarea dvs. online de pe site-ul Parohiei X a fost acceptată.</p>
 <p>Pentru a anula această programare intrați în aplicația Parohia Online la "Programările mele", selectați programarea și apăsați "Anulează".
 </p>';
 
 phpmailer ($email, $from, $name, $subiect, $mesaj_email, "");

 echo '<script> location.replace("../info-utile.php?succes=ok&tip=parastas"); </script>';
 
 ?>