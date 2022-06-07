<?php

include "header-frontend.php";
    
    if ( isset ( $_GET['stergeid'] ) && isset ( $_GET['eveniment'] )  && isset ( $_GET['data'] )) {

        $stergeid = $_GET['stergeid'];
        $eveniment = $_GET['eveniment'];
        $data_programarii = $_GET['data'];

        if ($eveniment=="programari_botez") {

            sterge_programare_user ($eveniment, $stergeid, $user_id, "botez", $parohie_id);
            echo '<script> location.replace("home-botez.php?sters=ok"); </script>';
        }

        if ($eveniment=="programari_cununie") {
       
            sterge_programare_user ($eveniment, $stergeid, $user_id, "cununie", $parohie_id);
            echo '<script> location.replace("home-cununie.php?sters=ok"); </script>';
        }

        if ($eveniment=="programari_spovedanie") {
       
            sterge_programare_user ($eveniment, $stergeid, $user_id, "spovedanie", $parohie_id);
            echo '<script> location.replace("home-spovedanie.php?sters=ok"); </script>';
        }

        if ($eveniment=="programari_sfestanie") {
       
            sterge_programare_user ($eveniment, $stergeid, $user_id, "sfestanie", $parohie_id);
            echo '<script> location.replace("home-sfestanie.php?sters=ok"); </script>';
        }

        if ($eveniment=="programari_parastas") {
    
            sterge_programare_user ($eveniment, $stergeid, $user_id, "parastas", $parohie_id);
            echo '<script> location.replace("home-parastas.php?sters=ok"); </script>';
        }

    } 










?>