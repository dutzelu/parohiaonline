<?php 

setlocale(LC_TIME, array('ro.utf-8', 'ro_RO.UTF-8', 'ro_RO.utf-8', 'ro', 'ro_RO', 'ro_RO.ISO8859-2'));  

include __DIR__ .'/controllers/authController.php';
include __DIR__ .'/includes/functions.php';

if (isset($_SESSION['parohie_id'])) {
  $parohie_id = $_SESSION['parohie_id'];
}

$nume_fisier = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
$numar_pas = (int) filter_var($nume_fisier, FILTER_SANITIZE_NUMBER_INT);


if ( isset($_GET['pentru']) ) {$pentru = $_GET['pentru'];} else {$pentru = "";}

switch ($pentru) {
    case "botez": $eveniment = "Taina Botezului"; break;
    case "cununie": $eveniment = "Taina Cununiei"; break;
    case "spovedanie": $eveniment = "Taina Spovedaniei"; break;
    case "sfestanie": $eveniment = "Sfeștania"; break;
    case "parastas": $eveniment = "Parastas"; break;
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"><script src="https://kit.fontawesome.com/2211423278.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="<?php echo BASE_URL . "/css/main.css";?>">
  <link href="<?php echo BASE_URL . "/lightbox/dist/css/lightbox.css";?>" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> 
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="<?php echo BASE_URL . "/lightbox/dist/js/lightbox.js";?>"></script>
  <script src="<?php echo BASE_URL . "/js/main.js";?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/2211423278.js" crossorigin="anonymous"></script>