<?php 
include "header-frontend.php"; 
if(isset($_POST['pentru'])){
  $pentru = $_POST['pentru'];
}

$link_rezervare = "pasi/pasul1.php?year=" . $selected_year . "&month=" . $selected_month . "&pentru=" . $pentru;

$numar_pas = 1;
$rezervari = '';

?>

<title>Programări Botez</title>
</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">

          <?php include "header-mic-frontend.php";?>

           <div class="row ultimele-programari">

              <div class="calendar-frontend">
              <?php include "pasi/pasi.php";?>

              <h1 class="h1">Alegeți ziua dorită pentru <span class="albastru"><?php echo $eveniment; ?></span> </h1>


              <?php include "includes/calendar.php";?>
 
              </div>
              
              <input type="submit" value="Confirmă ziua" name="pasul1" class="btn btn-primary rezerva">
              
              </form>
              </div>
              </div>
            </div>
        </div>    
     </div>
</div>

</body>
</html>

 


      