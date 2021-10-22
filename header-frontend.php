<?php 

include 'controllers/authController.php';
include 'database.php';

$nume_fisier = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
$numar_pas = (int) filter_var($nume_fisier, FILTER_SANITIZE_NUMBER_INT);


// redirect user to login page if they're not logged in
if (empty($_SESSION['id'])) {
    header('location: index.php');
}

if ( isset($_GET['pentru']) ) {$pentru = $_GET['pentru'];} else {$pentru = "";}

switch ($pentru) {
    case "botez": $eveniment = "Taina Botezului"; break;
    case "cununie": $eveniment = "Taina Cununiei"; break;
    case "spovedanie": $eveniment = "Taina Spovedaniei"; break;
    case "sfestanie": $eveniment = "Sfeștania"; break;
    default: $eveniment = '';
}


if (isset($_GET['month']) && isset($_GET['year'])) {

  $month = $_GET['month'];
  $year = $_GET['year'];

  $selected_month = $_GET['month'];
  // daca luna e de forma simpla '0,1,2,3...9" o transform in "01,02,03....09"
      if (strlen($selected_month) == 1 ) {$selected_month = '0' . $selected_month;}
      else {$selected_month = $selected_month;}
  $selected_year = $_GET['year'];  
} else {
  $selected_month = date('m');
  $selected_year = date ('Y');
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="main.css">
  <link href="lightbox/dist/css/lightbox.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="lightbox/dist/js/lightbox.js"></script>
  <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>

