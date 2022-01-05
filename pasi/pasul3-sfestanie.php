<?php 
include "../header-frontend.php"; 


$ora = '';

 if ( isset($_GET['zi']) ) {
     $zi = $_GET['zi'];
 }

 if (isset($_POST['pasul3'])) {
     $ora = $_POST['ora'];
 }

?>
 
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "../sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "../header-mic-frontend.php";?>

    <div class="col-xl-9 ultimele-programari">
     <?php include "pasi.php";?>
     
     <h1 class="h1"><?php echo $eveniment; ?> <?php echo ' - ' . $zi . '.' . $month . '.' . $year . ' ora: ' . $ora; ?> <br />Completează formularul cu datele personale:</h1>

     <form  method="POST" action="pasul4-sfestanie.php<?php echo '?month=' . $month . '&year=' .  $year . '&pentru=' .  $pentru . '&zi=' . $zi . '&ora=' . $ora;?> " enctype = "multipart/form-data">


     <p style="color: #AAA; font-size:12px;">Câmpurile marcate cu * sunt obligatorii pentru completarea formularului</p>
   

     <div class="row">
         <div class="col-sm">
             <p><input type="text" name="nume" class="form-control" placeholder="Nume *" required></p>
        </div>
        <div class="col-sm">
            <p><input type="text" name="prenume" class="form-control" placeholder="Prenume *" required></p>
        </div>
    </div>

    <div class="row">

        <div class="col-sm">
        <p><input type="text" name="adresa" class="form-control" placeholder="Adresa completă *" required></p>
        </div>

    </div>

    
    <div class="row">
        
        <div class="col-sm">
            <p><input type="tel" name="telefon" class="form-control" placeholder="Telefon *" required></p>
        </div>
        
        <div class="col-sm">
            <p><input type="email" name="email" class="form-control" placeholder="Email *" required></p>
        </div>
        
    </div>
    
    
    <div class="row">

        <div class="col-sm">
        <p><textarea name="mesaj" class="form-control" placeholder="Scrie un mesaj părintelui"></textarea></p>
        </div>

    </div>
  

    <button type="submit" name ="date_personale" class="btn btn-primary">Trimite</button>
    </form>

</div>

     </div>    
</div>

</div>
  
</div>

</body>
</html>
