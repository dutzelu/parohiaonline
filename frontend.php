<?php 
include "header-frontend.php"; 


$link_rezervare = "pasi/pasul1.php?year=" . $selected_year . "&month=" . $selected_month . "&pentru=" . $pentru;

$numar_pas = 1;
$rezervari = '';

?>

<title>Programări Botez</title>
</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">

          <?php include "header-mic-frontend.php";?>

           <div class="row mt-3 ultimele-programari">

              <div class="col-sm-12 calendar-frontend">
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

 


      