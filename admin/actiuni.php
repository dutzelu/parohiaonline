<?php

include "../admin/header-admin.php";


    if (isset($_GET['id']) && isset($_GET['month']) && isset($_GET['year'])) {
        $id_rezervare = $_GET['id'];
        $month = $_GET['month'];
        $year = $_GET['year'];

    $sql="DELETE FROM zile_stabilite WHERE id = ? AND parohie_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $id_rezervare, $id);
    $result = $stmt->execute();  


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    echo '<script> location.replace("zile-stabilite.php?month=' . $month .'&year='. $year .'&pentru=' .$pentru .'"); </script>';

    } 

    // ștergere programari

    if ( isset ( $_GET['stergeid'] ) && isset ( $_GET['eveniment'] )  && isset ( $_GET['data'] )) {

        $stergeid = $_GET['stergeid'];
        $eveniment = $_GET['eveniment'];
        $data_programarii = $_GET['data'];

        if ($eveniment=="programari_botez") {

            sterge_programare_parohie ($eveniment, $stergeid, $parohie_id, "botez");
            echo '<script> location.replace("registru.php?eveniment=programari_botez&sters=ok"); </script>';
        }

        if ($eveniment=="programari_cununie") {
       
            sterge_programare_parohie ($eveniment, $stergeid, $parohie_id, "cununie");
            echo '<script> location.replace("registru.php?eveniment=programari_cununie&sters=ok"); </script>';
        }

        if ($eveniment=="programari_spovedanie") {
       
            sterge_programare_parohie ($eveniment, $stergeid, $parohie_id, "spovedanie");
            echo '<script> location.replace("registru.php?eveniment=programari_spovedanie&sters=ok"); </script>';
        }

        if ($eveniment=="programari_sfestanie") {
       
            sterge_programare_parohie ($eveniment, $stergeid, $parohie_id, "sfestanie");
            echo '<script> location.replace("registru.php?eveniment=programari_sfestanie&sters=ok"); </script>';
        }

        if ($eveniment=="programari_parastas") {
    
            sterge_programare_parohie ($eveniment, $stergeid, $parohie_id, "parastas");
            echo '<script> location.replace("registru.php?eveniment=programari_parastas&sters=ok"); </script>';

        } 
    }
    
//----------------------------//


    if (isset($_GET['stergeid']) && isset($_GET['eveniment'])) {

        $stergeid = $_GET['stergeid'];
        $eveniment = $_GET['eveniment'];

        if ($eveniment=="pomelnic") {
            $sql="DELETE FROM pomelnice WHERE id = ? AND parohie_id = ?";
             
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $id);
            $result = $stmt->execute();  
        
            echo '<script> location.replace("pomelnice.php?sters=ok"); </script>';
        }

        if ($eveniment=="anunt") {
            $sql="DELETE FROM articole WHERE id = ? AND parohie_id = ?";
             
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $id);
            $result = $stmt->execute();  
        
            echo '<script> location.replace("anunturi.php?sters=ok"); </script>';
        }

        if ($eveniment=="participare_slujbe") {
            $sql="DELETE FROM participare_slujbe WHERE id = ? AND parohie_id = ?";
             
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $id);
            $result = $stmt->execute();  
        
            echo '<script> location.replace("participare-slujbe.php?sters=ok"); </script>';
        }

        if ($eveniment=="membri") {
            $sql="DELETE FROM users WHERE id = ? AND parohie_id = ?";
             
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $stergeid, $id);
            $result = $stmt->execute();  
        
            echo '<script> location.replace("membri.php?sters=ok"); </script>';
        }

    } 

    if (isset($_GET['blocheaza_id'])) {

        $blocheaza_id = $_GET['blocheaza_id'];
        $query = "UPDATE users SET blocat = 1 WHERE id = ? AND parohie_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $blocheaza_id, $id);
        $result = $stmt->execute();  
        echo '<script> location.replace("membri.php?blocat=ok"); </script>';

    }

    if (isset($_GET['deblocheaza_id'])) {

        $deblocheaza_id = $_GET['deblocheaza_id'];
        $query = "UPDATE users SET blocat = 0 WHERE id = ? AND parohie_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $deblocheaza_id, $id);
        $result = $stmt->execute();  
        echo '<script> location.replace("membri.php?deblocat=ok"); </script>';
        
    }


?>