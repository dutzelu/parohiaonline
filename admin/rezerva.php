<?php 

if (!empty($_SESSION['id']) && $admin == 0) {
   echo '<script> location.replace("frontend.php?pentru=botez"); </script>';
} elseif (!empty($_SESSION['id']) && $admin == 1) {
   echo '<script> location.replace("registru.php?eveniment=programari_botez"); </script>';
}

include "header-admin.php";


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
    $interval_programari = $_POST['intervalul'];

    $date1 = new DateTime($ora_start);
    $date2 = new DateTime($ora_final);
    $interval = $date1->diff($date2);
    
    // aflu numarul de rezervari
    $ore_diferenta = $interval->h;

   foreach ($zile as $zi) {

      $data_start = $year . '-' . $month . '-' . $zi . ' ' . $ora_start;
      $data_final = $year . '-' . $month . '-' . $zi . ' ' . $ora_final;
      $query = "INSERT INTO zile_stabilite SET tip_programare=?, data_start=?, data_final=?, rezervari=?, intervalul=?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param('sssii', $pentru, $data_start, $data_final, $ore_diferenta, $interval_programari);
      $result = $stmt->execute();
     
   }

 }

 echo '<script> location.replace("zile-stabilite.php?month=' . $month .'&year='. $year .'&pentru=' .$pentru .'"); </script>';

?>
 