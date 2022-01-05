<?php

include "../header-frontend.php"; 

 

if (isset($_POST['pomelnic'])) {

   if (isset($_GET['tip'])) {
     $tip_pomelnic = $_GET['tip'];
   }    
 
   $lista_nume = $_POST['lista_nume'];
   $durata_in_zile = $_POST['durata_in_zile'];
   $nume_si_prenume = $_POST['nume_si_prenume'];
   $telefon = $_POST['telefon'];
   $email = $_POST['email'];
   $data_trimiterii =$_POST['data_trimiterii'];
   $cu_donatie = isset($_POST['cu_donatie']) ? '1' : '0';



    $query = 'INSERT INTO pomelnice 
    SET 
        tip_pomelnic=?,
        lista_nume=?,
        durata_in_zile=?,
        nume_si_prenume=?,
        telefon=?,
        email=?,
        data_trimiterii=?,
        cu_donatie=?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('isissssi', $tip_pomelnic, $lista_nume, $durata_in_zile, $nume_si_prenume, $telefon, $email, $data_trimiterii, $cu_donatie);
    $result = $stmt->execute();


}

echo '<script> location.replace("pomelnic.php?tip=' . $tip_pomelnic . '&succes=ok"); </script>';

?>