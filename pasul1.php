
<?php

include "header-frontend.php"; 
 
 if (isset($_POST['pasul1'])) {

 $zile = $_POST['zile'];


   foreach ($zile as $zi) {

            echo '<script> location.replace("pasul2.php?month='  .$month .'&year='. $year .'&pentru=' .$pentru .'&zi=' .$zi .'"); </script>';

   }

}

?>


