
<?php

include "../header-frontend.php"; 
 
 if (isset($_POST['pasul1'])) {

 $zile = $_POST['zile'];
 

   foreach ($zile as $zi) {

        if($pentru == "spovedanie"){
          echo '<script> location.replace("pasul2-spovedanie.php?month='  .$month .'&year='. $year .'&pentru=' .$pentru .'&zi=' .$zi . '"); </script>';
        } elseif($pentru == "sfestanie"){
          echo '<script> location.replace("pasul2-sfestanie.php?month='  .$month .'&year='. $year .'&pentru=' .$pentru .'&zi=' .$zi . '"); </script>';
        } elseif($pentru == "botez" || $pentru == "cununie") {
          echo '<script> location.replace("pasul2.php?month='  .$month .'&year='. $year .'&pentru=' .$pentru .'&zi=' .$zi .'"); </script>';
        } elseif($pentru == "parastas") {
          echo '<script> location.replace("pasul2-parastas.php?month='  .$month .'&year='. $year .'&pentru=' .$pentru .'&zi=' .$zi .'"); </script>';
        }

   }

}

?>


