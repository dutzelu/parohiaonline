<?php

include "includes/conexiune.php";

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

        echo '<script> location.replace("home-unic.php?id=' . $id_anulare . '"); </script>';
    }

    if ($eveniment=="TainaCununiei") {
        $sql="UPDATE programari_cununie SET status = 'anulata' WHERE id = $id_anulare";
        $rezultate = mysqli_query ($conn, $sql);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        echo '<script> location.replace("home-unic-cununie.php?id=' . $id_anulare . '"); </script>';
    }

} 