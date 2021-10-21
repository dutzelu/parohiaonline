
<?php

if (!empty($_SESSION['id']) && $admin == 0) {
   header('location: frontend.php?pentru=botez');
} elseif (!empty($_SESSION['id']) && $admin == 1) {
   header('location: registru.php?eveniment=programari_botez');
}

include "header-admin.php";
include "sidebar-admin.php";
include "conexiune.php";

if (isset($_GET['month']) && isset($_GET['year'])) {
   $month = $_GET['month'];
   $year = $_GET['year'];  
} else {
   $month = '';
   $year = '';
}

 if (isset($_POST['rezerva'])) {

    $zile = $_POST['zile'];
    $ora_start = $_POST['ora_start'];
    $ora_final = $_POST['ora_final'];

    $date1 = new DateTime($ora_start);
    $date2 = new DateTime($ora_final);
    $interval = $date1->diff($date2);
    
    // aflu numarul de rezervari
    $ore_diferenta = $interval->h;

   foreach ($zile as $zi) {

      $data_start = $year . '-' . $month . '-' . $zi . ' ' . $ora_start;
      $data_final = $year . '-' . $month . '-' . $zi . ' ' . $ora_final;
      $query = "INSERT INTO zile_stabilite SET tip_programare=?, data_start=?, data_final=?, rezervari=?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param('sssi', $pentru, $data_start, $data_final, $ore_diferenta);
      $result = $stmt->execute();
     
   }

 }

 header('location: zile-stabilite.php?month=' .$month .'&year='. $year .'&pentru=' .$pentru);






?>


