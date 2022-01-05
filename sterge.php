<?php


include "header-frontend.php";
$user_id = $_SESSION['id'];


    
    if (isset($_GET['stergeid']) && isset($_GET['eveniment'])) {

        $stergeid = $_GET['stergeid'];
        $eveniment = $_GET['eveniment'];

        if ($eveniment=="programari_botez") {

            $sql="DELETE FROM programari_botez WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $user_id);
            $result = $stmt->execute();
            $result = $stmt->get_result();


            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            echo '<script> location.replace("home-botez.php?sters=ok"); </script>';
        }

        if ($eveniment=="programari_cununie") {
       
            $sql="DELETE FROM programari_cununie WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $user_id);
            $result = $stmt->execute();
            $result = $stmt->get_result();

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            echo '<script> location.replace("home-cununie.php?sters=ok"); </script>';
        }

        if ($eveniment=="programari_spovedanie") {
       
            $sql="DELETE FROM programari_spovedanie WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $user_id);
            $result = $stmt->execute();
            $result = $stmt->get_result();

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            echo '<script> location.replace("home-spovedanie.php?sters=ok"); </script>';
        }

        if ($eveniment=="programari_sfestanie") {
       
            $sql="DELETE FROM programari_sfestanie WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $user_id);
            $result = $stmt->execute();
            $result = $stmt->get_result();

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            echo '<script> location.replace("home-sfestanie.php?sters=ok"); </script>';
        }

        if ($eveniment=="programari_parastas") {
       
            $sql="DELETE FROM programari_parastas WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $user_id);
            $result = $stmt->execute();
            $result = $stmt->get_result();

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            echo '<script> location.replace("home-parastas.php?sters=ok"); </script>';
        }

    } 









?>