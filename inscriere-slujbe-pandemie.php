<?php

include "header-frontend.php"; 

$user_id = $_SESSION['id'];
$user_id = $user_id . ',';

if ($_GET[ 'month' ] && $_GET ['year'])  {
   $month = $_GET[ 'month' ];
   $year = $_GET[ 'year' ];
}

if ( $_GET[ 'id-slujba' ] )  {
   $id_slujba = $_GET[ 'id-slujba' ];

 
   $query = '
   UPDATE participare_slujbe SET participanti = CONCAT(participanti, ?), rezervari = rezervari+1 WHERE id = ?';

   $stmt = $conn->prepare($query);
   $stmt->bind_param("si", $user_id, $id_slujba);
   $rezultat = $stmt->execute();
   $rezultat = $stmt->get_result();

   echo '<script> location.replace("participare-slujbe-crestini.php?month=' . $month . '&year=' . $year .  '&succes=ok"); </script>';
}

if ( $_GET[ 'id-slujba-retragere' ] )  {
   $id_slujba = $_GET[ 'id-slujba-retragere' ];

 
   $query = '
   UPDATE participare_slujbe SET participanti = replace(participanti, ?, ""), rezervari = rezervari-1 WHERE id = ?';

   $stmt = $conn->prepare($query);
   $stmt->bind_param("si", $user_id, $id_slujba);
   $rezultat = $stmt->execute();
   $rezultat = $stmt->get_result();

   echo '<script> location.replace("participare-slujbe-crestini.php?month=' . $month . '&year=' . $year .  '&retragere=ok"); </script>';
}
 
