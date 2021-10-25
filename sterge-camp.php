<?php

include "header-admin.php";

if ( isset($_GET['id_rezervare']) || isset($_GET['month']) || isset($_GET['id_year'])) {
    $id_rezervare = $_GET['id'];
    $month = $_GET['month'];
    $year = $_GET['year'];
} else {$id = '';}


$sql="DELETE FROM zile_stabilite where id = '$id_rezervare'";
$rezultate = mysqli_query ($conn, $sql);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

echo '<script> location.replace("zile-stabilite.php?month=' . $month .'&year='. $year .'&pentru=' .$pentru .'"); </script>';











?>