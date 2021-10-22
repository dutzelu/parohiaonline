<?php 

include 'controllers/authController.php';
include 'database.php';
include 'functions.php';
include "conexiune.php";

// redirect user to index page if they're not logged in
if (empty($_SESSION['id'])) {
    header('location:index.php');
}

setlocale(LC_ALL, 'ro_RO');

$id = $_SESSION['id'];
$sql = "SELECT * FROM `users` WHERE `id`= $id AND `admin`=1";
$rezultate = mysqli_query ($conn, $sql);
while ($data = mysqli_fetch_assoc($rezultate)){  
    $admin = $data['admin'];
}

 

if ( isset($_GET['pentru']) ) {$pentru = $_GET['pentru'];} else {$pentru = "";}

switch ($pentru) {
    case "botez": $eveniment = "Taina Botezului"; break;
    case "cununie": $eveniment = "Taina Cununiei"; break;
    case "spovedanie": $eveniment = "Taina Spovedaniei"; break;
    case "sfestanie": $eveniment = "Sfeștania"; break;
    case "cateheza_botez": $eveniment = "Cateheză Botez"; break;
    case "cateheza_cununie": $eveniment = "Cateheză Cununie"; break;
    default: $eveniment = '';
}


if (isset($_GET['month']) && isset($_GET['year'])) {

    $selected_month = $_GET['month'];
    // daca luna e de forma simpla '0,1,2,3...9" o transform in "01,02,03....09"
        if (strlen($selected_month) == 1 ) {$selected_month = '0' . $selected_month;}
        else {$selected_month = $selected_month;}
    $selected_year = $_GET['year'];  
} else {
    $selected_month = date('m');
    $selected_year = date ('Y');
}

$link_rezervare = "rezerva.php?year=" . $selected_year . "&month=" . $selected_month . "&pentru=" . $pentru;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


 
