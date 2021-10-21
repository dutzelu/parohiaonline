<?php

include "header-frontend.php"; 
include "sidebar-frontend.php"; 
include "functions.php";

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

 if ( isset($_GET['id']) ) {
    $id = $_GET['id'];

 }
$data_ora_cateheza = $year . '-' . $month . '-' . $zi . ' ' . $ora_cateheza . ":00";

var_dump($pentru);

if ($pentru == 'cateheza_botez') {$query = "UPDATE programari_botez SET data_ora_cateheza = ? WHERE id = ?";}
elseif ($pentru == 'cateheza_cununie') {$query = "UPDATE programari_cununie SET data_ora_cateheza = ? WHERE id = ?";}

$stmt = $conn->prepare($query);
$stmt->bind_param('si', $data_ora_cateheza, $id);
$result = $stmt->execute();


header('Location:home-unic.php?succes=ok');
?>
