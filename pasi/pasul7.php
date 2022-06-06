<?php

include "../header-frontend.php"; 

 
$ora = '';
$judetsector = '';
$strada = '';
$numar = '';

 if ( isset($_GET['zi']) ) {
     $zi = $_GET['zi'];
 }

 if ( isset($_GET['pentru']) ) {
     $pentru = $_GET['pentru'];
 }

 if (!empty($_POST)) {
    $ora_cateheza = $_POST['ora'];
}

if (isset($_GET['id'])) {
   $id_prog = $_GET['id'];
}
 
$data_ora_cateheza = $year . '-' . $month . '-' . $zi . ' ' . $ora_cateheza . ":00";
$data_cateheza = $year . '-' . $month . '-' . $zi;

 
if ($pentru == 'cateheza_botez') {
 
 
    $query = "UPDATE programari_botez SET data_ora_cateheza = '$data_ora_cateheza'  WHERE id =  $id_prog";
    var_dump ( $query);
    $rezultate = mysqli_query ($conn, $query);


    $sql="UPDATE zile_stabilite
    SET libere = libere - 1, rezervari = rezervari + 1
    WHERE tip_programare = 'cateheza_botez' AND (data_start LIKE '%$data_cateheza%' AND parohie_id = $parohie_id)";
    $rezultate = mysqli_query ($conn, $sql);

    echo '<script> location.replace("../info-utile.php?succes=ok"); </script>';

}

if ($pentru == 'cateheza_cununie') {

    $query = "UPDATE programari_cununie SET data_ora_cateheza = '$data_ora_cateheza' WHERE id = $id_prog";
    $rezultate = mysqli_query ($conn, $query);

    $sql="UPDATE zile_stabilite
    SET libere = libere - 1, rezervari = rezervari + 1
    WHERE tip_programare = 'cateheza_cununie' AND (data_start LIKE '%$data_cateheza%' AND parohie_id = $parohie_id)";

    $rezultate = mysqli_query ($conn, $sql);

    echo '<script> location.replace("../info-utile.php?succes=ok"); </script>';
}



?>


