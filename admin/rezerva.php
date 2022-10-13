<?php 

include "header-admin.php";
$zile = NULL;

if (isset($_GET['month']) && isset($_GET['year'])) {
   $month = $_GET['month'];
   $year = $_GET['year'];  
} else {
   $month = '';
   $year = '';
}

if ( isset($_POST['rezerva']) && $pentru !=NULL) {

   // datele din formular 

   $zile = $_POST['zile'];
   $ora_start = $_POST['ora_start'];
   $ora_final = $_POST['ora_final'];
   $interval_programari = $_POST['intervalul'];

   // calculez diferența între ore

   $date1 = new DateTime($ora_start);
   $date2 = new DateTime($ora_final);
   $interval = $date2->diff($date1)->format("%h:%i");

   $ore_minute = explode (":", $interval);
   $diferenta_ore = (int)$ore_minute[0];
   $diferenta_minute = (int)$ore_minute[1];

   // calculez diferența în minute
   $diferenta_minute = $diferenta_ore * 60 + $diferenta_minute; echo "<br>";

   // calculez numarul total de rezervări disponibile (libere)
   $libere = round($diferenta_minute / $interval_programari);


  foreach ($zile as $zi) {

     $data_start = $year . '-' . $month . '-' . $zi . ' ' . $ora_start;
     $data_final = $year . '-' . $month . '-' . $zi . ' ' . $ora_final;
     $query = "INSERT INTO zile_stabilite SET parohie_id=?, tip_programare=?, data_start=?, data_final=?, libere=?, intervalul=?";
     $stmt = $conn->prepare($query);
     $stmt->bind_param('isssii', $id, $pentru, $data_start, $data_final, $libere, $interval_programari);
     $result = $stmt->execute();
    
  }

  echo '<script> location.replace("zile-stabilite.php?month=' . $month .'&year='. $year .'&pentru=' .$pentru .'"); </script>';
} 

// else {
//    echo '<script> location.replace("zile-stabilite.php?month=' . $month .'&year='. $year .'&pentru=botez"); </script>';
// }

if (isset($_POST['participare_slujbe'])) {

   $zile = $_POST['zile'];
   $ora_start = $_POST['ora_start'];
   $ora_final = $_POST['ora_final'];


   $date1 = new DateTime($ora_start);
   $date2 = new DateTime($ora_final);
   $interval = $date1->diff($date2);

   $slujba = $_POST['slujba'];
   $numar_persoane = $_POST['numar_persoane'];

  foreach ($zile as $zi) {

     $data_start = $year . '-' . $month . '-' . $zi . ' ' . $ora_start;
     $data_final = $year . '-' . $month . '-' . $zi . ' ' . $ora_final;
     $query = "INSERT INTO participare_slujbe SET parohie_id=?, slujba=?, data_start=?, data_final=?, numar_persoane=?";
     $stmt = $conn->prepare($query);
     $stmt->bind_param('isssi', $id, $slujba, $data_start, $data_final, $numar_persoane);
     $result = $stmt->execute();
    
  }

  echo '<script> location.replace("participare-slujbe.php?month=' . $month .'&year='. $year .'&pentru=' .$pentru .'"); </script>';
}



?>
 