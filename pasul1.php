
<?php

include "header-frontend.php"; 
 
 if (isset($_POST['pasul1'])) {

 $zile = $_POST['zile'];


   foreach ($zile as $zi) {

      header('location: pasul2.php?month=' .$month .'&year='. $year .'&pentru=' .$pentru .'&zi=' .$zi);
      // var_dump ($zi);
      // var_dump ($month);
      // var_dump ($year);

   }

}

?>


