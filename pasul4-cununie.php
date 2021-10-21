<?php 
include "header-frontend.php"; 
include "sidebar-frontend.php"; 
include "functions.php";

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

    $nume_mire = $_POST['nume_mire'];
    $prenume_mire = $_POST['prenume_mire'];
    $nume_mireasa = $_POST['nume_mireasa'];
    $prenume_mireasa = $_POST['prenume_mireasa'];

    /* Adresa mire */

    $localitate_mire =  $_POST['localitate_mire'];
    $judetsector_mire =  $_POST['judetsector_mire'];
    $strada_mire =  $_POST['strada_mire'];
    $numar_mire =  $_POST['numar_mire'];
    $bloc_mire  =  $_POST['bloc_mire'];
    $scara_mire  =  $_POST['scara_mire'];
    $etaj_mire  =  $_POST['etaj_mire'];
    $apartament_mire  =  $_POST['apartament_mire'];


    $adresa_mire = $_POST['localitate_mire'] . ' judet/sector ' . $_POST['judetsector_mire'] . ', strada ' 
              . $_POST['strada_mire'] . ' nr. ' . $_POST['numar_mire'];

    if (!empty($bloc_mire)) {
        $adresa_mire .= ', bloc ' . $_POST['bloc_mire'];
    }
   
    if (!empty($scara_mire)) {
        $adresa_mire .=  ', scara ' . $_POST['scara_mire'];
    }

    if (!empty($etaj)) {
        $adresa_mire .=  ', etaj ' . $_POST['etaj_mire'];
    }

    if (!empty($apartament)) {
        $adresa_mire .=  ', ap. ' . $_POST['apartament_mire'];
    }

    /* Adresa mireasa */

    $localitate_mireasa =  $_POST['localitate_mireasa'];
    $judetsector_mireasa =  $_POST['judetsector_mireasa'];
    $strada_mireasa =  $_POST['strada_mireasa'];
    $numar_mireasa =  $_POST['numar_mireasa'];
    $bloc_mireasa  =  $_POST['bloc_mireasa'];
    $scara_mireasa  =  $_POST['scara_mireasa'];
    $etaj_mireasa  =  $_POST['etaj_mireasa'];
    $apartament_mireasa  =  $_POST['apartament_mireasa'];


    $adresa_mireasa = $_POST['localitate_mireasa'] . ' judet/sector ' . $_POST['judetsector_mireasa'] . ', strada ' 
              . $_POST['strada_mireasa'] . ' nr. ' . $_POST['numar_mireasa'];

    if (!empty($bloc_mireasa)) {
        $adresa_mireasa .= ', bloc ' . $_POST['bloc_mireasa'];
    }
   
    if (!empty($scara_mireasa)) {
        $adresa_mireasa .=  ', scara ' . $_POST['scara_mireasa'];
    }

    if (!empty($etaj)) {
        $adresa_mireasa .=  ', etaj ' . $_POST['etaj_mireasa'];
    }

    if (!empty($apartament)) {
        $adresa_mireasa .=  ', ap. ' . $_POST['apartament_mireasa'];
    }

    /* final adrese */
        
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];

    $numar_certificat_casatorie = $_POST['numar_certificat_casatorie'];
    $data_eliberarii_certificatului = $_POST['data_eliberarii_certificatului'];
    $eliberat_de_primaria = $_POST['eliberat_de_primaria'];

    $nume_nas = $_POST['nume_nas'];
    $nume_nasa = $_POST['nume_nasa'];
    $localitate_nasi = $_POST['localitate_nasi'];
    $nume_cameraman = $_POST['nume_cameraman'];
    $telefon_cameraman = $_POST['telefon_cameraman'];
  
    // var_dump($user_id);
    // var_dump($eveniment);
    // var_dump($data_si_ora);
    // var_dump($nume_si_prenume_mire);
    // var_dump($nume_si_prenume_mireasa);
    // var_dump($adresa);
    // var_dump($telefon);
    // var_dump($email);
    // var_dump($nume_si_prenume_copil);
    // var_dump($data_nasterii_copilului);
    // var_dump($numar_certificat_nastere);
    // var_dump($data_eliberarii_certificatului);
    // var_dump($eliberat_de_primaria);
    // var_dump($nume_botez);
    // var_dump($nume_nas);
    // var_dump($nume_nasa);
    // var_dump($localitate_nasi);
    // var_dump($nume_cameraman);
    // var_dump($telefon_cameraman);

    $query = 'INSERT INTO programari_cununie SET 
    user_id=?, 
    eveniment=?,
    data_si_ora=?,
    nume_mire=?,
    prenume_mire=?,
    nume_mireasa=?,
    prenume_mireasa=?,
    adresa_mire=?,
    adresa_mireasa=?,
    telefon=?,
    email=?,
    numar_certificat_casatorie=?,
    data_eliberarii_certificatului=?,
    eliberat_de_primaria=?,
    nume_nas=?,
    nume_nasa=?,
    localitate_nasi=?,  
    nume_cameraman=?,
    telefon_cameraman=?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('issssssssssssssssss', $user_id, $eveniment, $data_si_ora, $nume_mire, $prenume_mire, $nume_mireasa, $prenume_mireasa, $adresa_mire, $adresa_mireasa, $telefon, $email, $numar_certificat_casatorie, $data_eliberarii_certificatului, $eliberat_de_primaria,  $nume_nas, $nume_nasa, $localitate_nasi, $nume_cameraman, $telefon_cameraman);
    $result = $stmt->execute();

    $last_id = mysqli_insert_id($conn);


    $sql="UPDATE zile_stabilite
    SET rezervari = rezervari - 1
    WHERE data_start LIKE '%$data_simpla%' ";

    $rezultate = mysqli_query ($conn, $sql);

}

?>
 
</head>

<body>



<div class="mare">
  <div class="container-fluid">

    <?php include "pasi.php";?>

     <h1 class="h1 mb-5">Cererea de programare pentru <?php echo $eveniment; ?> în data de <?php echo ' ' . $zi . '-' . $month . '-' . $year . ' ora: ' . $ora; ?> a fost înregistrată.</h1>


    <form method="POST" action="pasul5-cununie.php?id=<?php echo $last_id . '&pentru=cateheza_cununie'; ?>" enctype = "multipart/form-data" > 

          <p><strong>Atașează documentele necesare</strong></p>
          <p style="color: #AAA; font-size:12px;">Câmpurile marcate cu * sunt obligatorii pentru completarea formularului
         <br />Acceptăm doar fotografii în format JPEG, JPG sau PNG</p>
          
          <div class="row mb-1">
              <label class="col-sm-4 col-form-label">Carte identitate mire*</label>
              <div class="col-sm-8">
                  <input type="file" name="mire_ci" class="col-sm-8 form-control" required>
              </div>
          </div>

          <div class="row mb-1">
            <label class="col-sm-4 col-form-label">Carte identitate mireasă*</label>
            <div class="col-sm-8">
                <input type="file" name="mireasa_ci" class="col-sm-8 form-control" required>
            </div>
        </div>
  
          <div class="row mb-1">
              <label class="col-sm-4 col-form-label">Plata contribuției anuale față de parohie *</label>
       
              <div class="col-sm-8">
                  <input type="file" name="plata_contributiei" class="col-sm-8 form-control" required>
                  <p>Se atașează copia chitanței plătite la biserică sau copia viramentului bancar. <br />Puteți plăti contribuția în contul:<br /> <strong>RO11 RNCB 0083 0028 8937 0001</strong> titular fiind: <br /><strong>PAROHIA APARATORII PATRIEI II</strong>.</p>
              </div>
          </div>

          <div class="row mb-1">
            <label class="col-sm-4 col-form-label">Certificatul de căsătorie civilă</label>
            <div class="col-sm-8">
                <input type="file" name="certificat_casatorie_civila" class="col-sm-8 form-control">
            </div>
         </div>

 

            <div class="row mb-1">
                <label class="col-sm-4 col-form-label">Certificatul de botez al MIRELUI</label>
                <div class="col-sm-8">
                    <input type="file" name="certificat_botez_mire" class="col-sm-8 form-control" >
                </div>
             </div>

            <div class="row mb-1">
                <label class="col-sm-4 col-form-label">Certificatul de botez al MIRESEI</label>
                <div class="col-sm-8">
                    <input type="file" name="certificat_botez_mireasa" class="col-sm-8 form-control" >
                </div>
            </div>

            <div class="row mb-1">
            <p><hr /></p>
                <p>În cazul în care nu aveți <strong>CERTIFICATELE DE BOTEZ</strong>, le veți solicita de la parohia unde ați fost botezat. Și le veți atașa la rezervarea dvs. din contul creat pe siteul parohie cu cel puțin 7 zile înaintea nunții, sau le veți aduce direct la biserică.</p>
            <p><hr /></p>
            </div>

            <div class="row mb-1">
                <label class="col-sm-4 col-form-label">Dispensă chiriarhală (vezi pct. VII. Situații excepționale de la <a href="info-cununie.php" target="blank">Info Cununie</a>)</label>
                <div class="col-sm-8">
                    <input type="file" name="dispensa" class="col-sm-8 form-control">
                </div>
            </div>
        
        <button type="submit" name ="ataseaza" class="btn btn-primary">Atașează</button>
      </div>
    
    </form>

   