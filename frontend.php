<?php 
include "header-frontend.php"; 
include "sidebar-frontend.php"; 
include "functions.php";

$link_rezervare = "pasul1.php?year=" . $selected_year . "&month=" . $selected_month . "&pentru=" . $pentru;

$numar_pas = 1;
$rezervari = '';

?>

<title>Programare Botez</title>
</head>

<body>


<div class="mare">
  <div class="container-fluid">

  <?php include "pasi.php";?>

     <h1 class="h1">Alegeți ziua dorită pentru <span class="albastru"><?php echo $eveniment; ?></span> </h1>


<?php include "calendar.php";?>
 
 </div>
 
 <input type="submit" value="Alege ziua" name="pasul1" class="btn btn-primary rezerva">
 
 </form>
 
 
 </div>
 </div>
</body>
</html>

 


      