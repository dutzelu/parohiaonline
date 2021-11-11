<?php

include "header-admin.php";

if (isset($_GET['id']) && isset($_GET['month']) && isset($_GET['year'])) {
    $id_rezervare = $_GET['id'];
    $month = $_GET['month'];
    $year = $_GET['year'];

$sql="DELETE FROM zile_stabilite where id = '$id_rezervare'";
$rezultate = mysqli_query ($conn, $sql);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

echo '<script> location.replace("zile-stabilite.php?month=' . $month .'&year='. $year .'&pentru=' .$pentru .'"); </script>';

} 
 
if (isset($_GET['id-anulare']) && isset($_GET['eveniment'])) {

    $id_anulare = $_GET['id-anulare'];
    $eveniment = $_GET['eveniment'];

    if ($eveniment=="TainaBotezului") {
        $sql="UPDATE programari_botez SET status = 'anulata' WHERE id = $id_anulare";
        $rezultate = mysqli_query ($conn, $sql);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        echo '<script> location.replace("home.php"); </script>';
    }

    if ($eveniment=="TainaCununiei") {
        $sql="UPDATE programari_cununie SET status = 'anulata' WHERE id = $id_anulare";
        $rezultate = mysqli_query ($conn, $sql);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        echo '<script> location.replace("home.php"); </script>';
    }

} 

if (isset($_GET['stergeid']) && isset($_GET['eveniment'])) {

    $stergeid = $_GET['stergeid'];
    $eveniment = $_GET['eveniment'];

    if ($eveniment=="programari_botez") {
        $sql="DELETE FROM programari_botez WHERE id = $stergeid";
        $rezultate = mysqli_query ($conn, $sql);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        echo '<script> location.replace("registru.php?eveniment=programari_botez&sters=ok"); </script>';
    }

    if ($eveniment=="programari_cununie") {
        $sql="DELETE FROM programari_cununie WHERE id = $stergeid";
        $rezultate = mysqli_query ($conn, $sql);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        echo '<script> location.replace("registru.php?eveniment=programari_cununie&sters=ok"); </script>';
    }

} 








?>