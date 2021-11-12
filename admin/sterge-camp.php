<?php

include "header-admin.php";

$id = $_SESSION['id'];

$query = "SELECT * FROM users WHERE id = ? AND admin = 1";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$result = $stmt->execute();
$result = $stmt->get_result();

while ($data = mysqli_fetch_assoc($result)){  
    $admin = $data['admin'];
}

// dacă nu e admin

if ($admin == 0) {
    echo '<script>location.replace("admin-client.php");</script>';
} else {

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

}







?>