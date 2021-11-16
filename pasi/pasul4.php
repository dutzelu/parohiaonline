<?php 
include "../header-frontend.php"; 


error_reporting(E_ALL);
ini_set('display_errors', 1);

$ora = '';

    if (!empty($_GET)) {
        $zi = $_GET['zi'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        $pentru = $_GET['pentru'];
        $ora = $_GET['ora'];
    }

 $user_id = $_SESSION['id'];
 $data_si_ora = $year . "-" . $month . '-' . $zi . " " . $ora . ":00";
 $data_simpla = $year . "-" . $month . '-' . $zi;



 if (isset($_POST['date_personale'])) {

    $nume_tata = $_POST['nume_tata'];
    $prenume_tata = $_POST['prenume_tata'];
    $nume_mama = $_POST['nume_mama'];
    $prenume_mama = $_POST['prenume_mama'];

    $localitate =  $_POST['localitate'];
    $judetsector =  $_POST['judetsector'];
    $strada =  $_POST['strada'];
    $numar =  $_POST['numar'];
    $bloc  =  $_POST['bloc'];
    $scara  =  $_POST['scara'];
    $etaj  =  $_POST['etaj'];
    $apartament  =  $_POST['apartament'];


    $adresa = $_POST['localitate'] . ', judet/sector ' . $_POST['judetsector'] . ', strada ' 
              . $_POST['strada'] . ' nr. ' . $_POST['numar'];

    if (!empty($bloc)) {
        $adresa .= ', bloc ' . $_POST['bloc'];
    }
   
    if (!empty($scara)) {
        $adresa .=  ', scara ' . $_POST['scara'];
    }

    if (!empty($etaj)) {
        $adresa .=  ', etaj ' . $_POST['etaj'];
    }

    if (!empty($apartament)) {
        $adresa .=  ', ap. ' . $_POST['apartament'];
    }
        
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $nume_copil = $_POST['nume_copil'];
    $prenume_copil = $_POST['prenume_copil'];
    $data_nasterii_copilului = $_POST['data_nasterii_copilului'];
    $numar_certificat_nastere = $_POST['numar_certificat_nastere'];
    $data_eliberarii_certificatului = $_POST['data_eliberarii_certificatului'];
    $eliberat_de_primaria = $_POST['eliberat_de_primaria'];
    $nume_botez_copil = $_POST['nume_botez_copil'];
    $nume_nas = $_POST['nume_nas'];
    $nume_nasa = $_POST['nume_nasa'];
    $localitate_nasi = $_POST['localitate_nasi'];
    $nume_cameraman = $_POST['nume_cameraman'];
    $telefon_cameraman = $_POST['telefon_cameraman'];

    $status = "în așteptare";
  
    $query = 'INSERT INTO programari_botez SET 
    user_id=?, 
    eveniment=?,
    data_si_ora=?,
    nume_tata=?,
    prenume_tata=?,
    nume_mama=?,
    prenume_mama=?,
    adresa=?,
    telefon=?,
    email=?,
    nume_copil=?,
    prenume_copil=?,
    data_nasterii_copilului=?,
    numar_certificat_nastere=?,
    data_eliberarii_certificatului=?,
    eliberat_de_primaria=?,
    nume_botez_copil=?,
    nume_nas=?,
    nume_nasa=?,
    localitate_nasi=?,  
    nume_cameraman=?,
    telefon_cameraman=?,
    status=?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('issssssssssssssssssssss', $user_id, $eveniment, $data_si_ora, $nume_tata, $prenume_tata, $nume_mama, $prenume_mama, $adresa, $telefon, $email, $nume_copil, $prenume_copil, $data_nasterii_copilului, $numar_certificat_nastere, $data_eliberarii_certificatului, $eliberat_de_primaria, $nume_botez_copil, $nume_nas, $nume_nasa, $localitate_nasi, $nume_cameraman, $telefon_cameraman, $status);
    $result = $stmt->execute();

    $last_id = mysqli_insert_id($conn);


    $sql="UPDATE zile_stabilite
    SET rezervari = rezervari - 1
    WHERE tip_programare = 'botez' AND data_start LIKE '%$data_simpla%' ";

    $rezultate = mysqli_query ($conn, $sql);

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

     <h1 class="h1 mb-5">Cererea de programare pentru <?php echo $eveniment; ?> în data de <?php echo ' ' . $zi . '-' . $month . '-' . $year . ' ora: ' . $ora; ?> a fost înregistrată.</h1>


    <form method="POST" action="pasul5.php?id=<?php echo $last_id . '&pentru=cateheza_botez'; ?>" enctype = "multipart/form-data" > 

          <p><strong>Atașează documentele necesare</strong></p>
          <p style="color: #AAA; font-size:12px;">Câmpurile marcate cu * sunt obligatorii pentru completarea formularului</p>
          <p style="color: #AAA; font-size:12px;">Acceptăm doar fotografii în format JPEG, JPG; BMP, GIF sau PNG</p>
          
          <div class="row mb-1">
              <label class="col-sm-4 col-form-label">Carte identitate tată *</label>
              <div class="col-sm-8">
                  <input type="file" name="tata_ci" class="col-sm-8 form-control size" id="tata_ci" onchange="ValidateSingleInput(this);validateSize(this);" > 
                  <p class="mt-2"><input type="checkbox" id="checkMe" name="checkMe" onclick="disableMyInput()" class="form-check-input"/> Tatăl nu este trecut în certificatul de naștere al copilului. </p> 
              </div>
             
          </div>

          <div class="row mb-1">
            <label class="col-sm-4 col-form-label">Carte identitate mamă *</label>
            <div class="col-sm-8">
                <input type="file" name="mama_ci" class="col-sm-8 form-control size" required onchange="ValidateSingleInput(this);validateSize(this);" >
            </div>
        </div>
  
          <div class="row mb-1">
              <label class="col-sm-4 col-form-label">Plata contribuției anuale față de parohie *</label>
       
              <div class="col-sm-8">
                  <input type="file" name="plata_contributiei" class="col-sm-8 form-control size" required onchange="ValidateSingleInput(this);validateSize(this);">
                  <p>Se atașează copia chitanței plătite la biserică sau copia viramentului bancar. <br />Puteți plăti contribuția în contul:<br /> <strong>RO11 RNCB 0083 0028 8937 0001</strong> titular fiind: <br /><strong>PAROHIA APARATORII PATRIEI II</strong>.</p>
              </div>
          </div>

          <div class="row mb-1">
            <label class="col-sm-4 col-form-label">Certificatul de naștere al copilului *</label>
            <div class="col-sm-8">
                <input type="file" name="certificat_nastere_copil" class="col-sm-8 form-control size" required onchange="ValidateSingleInput(this);validateSize(this);" >
            </div>
        </div>
        <button type="submit" name ="ataseaza" class="btn btn-primary">Atașează</button>
      </div>
    
    </form>

    </div>

</div>
  
</div>

</body>
</html>