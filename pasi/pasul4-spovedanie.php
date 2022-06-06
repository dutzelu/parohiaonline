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


 $data_si_ora = $year . "-" . $month . '-' . $zi . " " . $ora . ":00";
 $data_simpla = $year . "-" . $month . '-' . $zi;



 if (isset($_POST['date_personale'])) {

    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];

    $telefon = $_POST['telefon'];
    $email_crestin = $_POST['email'];

    $status = "în așteptare";
  
    $query = 'INSERT INTO programari_spovedanie SET 
    user_id=?, 
    parohie_id=?,
    eveniment=?,
    nume=?,
    prenume=?,
    telefon=?,
    email=?,
    data_si_ora=?,
    status=?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('iisssssss', $user_id, $parohie_id, $eveniment, $nume, $prenume, $telefon, $email, $data_si_ora, $status);
    $result = $stmt->execute();

    $last_id = mysqli_insert_id($conn);


    $sql="UPDATE zile_stabilite
    SET libere = libere - 1, rezervari = rezervari + 1
    WHERE tip_programare = 'spovedanie' AND (data_start LIKE '%$data_simpla%' AND parohie_id = $parohie_id) ";

    $rezultate = mysqli_query ($conn, $sql);

}

 
// detalii mail


$from = "contact@parohiaonline.ro";
$name = "Parohia Online";
 
 $subiect = "Programare: " . $eveniment . '  ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora));
 
 $mesaj_email = '
 <p>Doamne ajută!</p>
 <p>Cererea pentru programarea dvs. online de pe site-ul Parohiei X a fost acceptată.</p>
 <p>Pentru a anula această programare intrați în aplicația Parohia Online la "Programările mele", selectați programarea și apăsați "Anulează spovedania".
 </p>';
 
 phpmailer ($email_crestin, $from, $name, $subiect, $mesaj_email, "");

 echo '<script> location.replace("../info-utile.php?succes=ok"); </script>';
 
 ?>