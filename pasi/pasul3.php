<?php 
include "../header-frontend.php"; 


$ora = '';

 if ( isset($_GET['zi']) ) {
     $zi = $_GET['zi'];
 }

 if ( isset($_GET['ora']) ) {
    $ora = $_GET['ora'];
}


?>
 
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "../sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "../header-mic-frontend.php";?>

     <?php include "pasi.php";?>

     <h1 class="h1"><?php echo $eveniment; ?> <?php echo ' - ' . $zi . '.' . $month . '.' . $year . ' ora: ' . $ora; ?> <br />Completează formularul cu datele personale:</h1>

     <form  method="POST" action="pasul4.php<?php echo '?month=' . $month . '&year=' .  $year . '&pentru=' .  $pentru . '&zi=' . $zi . '&ora=' . $ora;?> " enctype = "multipart/form-data">

     <p style="color: #AAA; font-size:12px;">Câmpurile marcate cu * sunt obligatorii pentru completarea formularului</p>
     <p class="mt-5">Subsemnații</p>

     <div class="row">
         <div class="col-sm">
             <p><input type="text" name="nume_tata" class="form-control" placeholder="Numele TATĂLUI" ></p>
        </div>
        <div class="col-sm">
            <p><input type="text" name="prenume_tata" class="form-control" placeholder="Prenumele TATĂLUI "></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm">
             <p><input type="text" name="nume_mama" class="form-control" placeholder="Numele MAMEI *" required></p>
        </div>
        <div class="col-sm">
              <p><input type="text" name="prenume_mama" class="form-control" placeholder="Prenumele MAMEI *" required></p>
        </div>
    </div>

     <br /><hr/><br />

     <p>Domiciliați în </p>

     <div class="row">
        <div class="col-sm">
            <p><input type="text" name="localitate" class="form-control" placeholder="Localitatea *" required></p>
        </div>
        <div class="col-sm">
            <p><input type="text" name="judetsector" class="form-control" placeholder="Județul / Sectorul *" required></p>
        </div>  
    </div>
     <p><input type="text" name="strada" class="form-control" placeholder="Strada *" required></p>

     <div class="row">

        <div class="col-sm">
                <p><input type="text" name="numar" class="form-control" placeholder="Număr *" required></p>
        </div>

        <div class="col-sm">
                 <p><input type="text" name="bloc" class="form-control" placeholder="Bloc" ></p>
        </div>
     
        <div class="col-sm">
                <p><input type="text" name="scara" class="form-control" placeholder="Scara" ></p>
        </div>
    </div>
      
    <div class="row">

        <div class="col-sm">
        <p><input type="number" name="etaj" class="form-control" placeholder="Etaj" ></p>
        </div>

        <div class="col-sm">
        <p><input type="text" name="apartament" class="form-control" placeholder="Apartament" ></p>
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

    <br /><hr/><br />

    <p>În calitate de părinți ai copilului:</p>

    <div class="row">
        <div class="col-sm">
            <p><input type="text" name="nume_copil" class="form-control" placeholder="Numele COPILULUI *" required></p>
        </div>
        <div class="col-sm">
            <p><input type="text" name="prenume_copil" class="form-control" placeholder="Prenumele COPILULUI *" required></p>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-4">
            <p>Născut la data de: *</p>
        </div>
        <div class="col-sm-8">
            <p><input type="date" name="data_nasterii_copilului" class="form-control" required></p>
        </div>
    </div>  

    <div class="row">
        <div class="col-sm">
        <p>Conform certificatului de naștere nr.:</p>
        </div>
        <div class="col-sm">
           <p><input type="text" name="numar_certificat_nastere" class="form-control" placeholder="nr. certificatului de naștere  *" required> <a href="<?php echo BASE_URL . 'images/certificat-de-nastere-numar.jpg'; ?>" data-lightbox="certificat-de-nastere-numar.jpg">vezi certificat »</a>
        
        
        </p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
         <p>Eliberat la data de: *</p>
        </div>
        <div class="col-sm-8">
         <p><input type="date" name="data_eliberarii_certificatului" class="form-control" placeholder = "Alege data" required></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
         <p>De primăria</p>
        </div>
        <div class="col-sm-8">
         <p><input type="text" name="eliberat_de_primaria" class="form-control" placeholder="localității *" required></p>
        </div>
    </div>

    <br /><hr/><br />

    <p>Vă rugăm să aprobați săvârșirea Tainei Sfântului Botez copilului nostru, în biserica parohială «Sfântul Ambrozie», în data de: <strong>
        <?php echo $zi . '.' . $month . '.' . $year . ' ora: ' . $ora;?>
    </strong></p>


    <p>Dorim ca cel botezat să poarte din botez numele de:</p>
    <p><input type="text" name="nume_botez_copil" class="form-control" placeholder="Numele de botez al copilului *" required></p>
    <p>Menționăm că nașii copilului <strong>sunt de credință creștin ortodoxă</strong> și se numesc:</p>
    <p><input type="text" name="nume_nas" class="form-control" placeholder="Numele și prenumele NAȘULUI *" required></p>
    <p><input type="text" name="nume_nasa" class="form-control" placeholder="Numele și prenumele NAȘEI *" required></p>
    <p>din localitatea: </p>
    <p><input type="text" name="localitate_nasi" class="form-control" placeholder="localitatea de domiciliu a nașilor *" required></p>

    <br /><hr/><br />

    <p>Am luat la cunoștință de obligația de a participa la <strong>cursul de catehizare</strong> organizat de parohie pentru pregătirea botezului și de cuantumul contribuțiilor stabilite de Consiliul Parohial și suntem de acord cu acestea.</p>
    <p>Precizăm că am fost informați în legătură cu legislația privind protecția datelor personale de către parohie și suntem de acord cu completarea și semnarea respectivei Declarații.</p>
    <p>Întrucât dorim să filmăm și să facem fotografii la eveniment, am solicitat colaborarea domnului:</p>
    <p><input type="text" name="nume_cameraman" class="form-control" placeholder="Numele cameramanului" ></p>
    <p><input type="tel" name="telefon_cameraman" class="form-control" placeholder="Telefonul cameramanului" ></p>

    <button type="submit" name ="date_personale" class="btn btn-primary">Trimite</button>
     </form>


     </div>    
</div>

</div>
  
</div>

</body>
</html>
