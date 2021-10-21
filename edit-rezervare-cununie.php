<?php

include "header-frontend.php"; 
include "sidebar-frontend.php"; 
include "functions.php";

$data_cateheza = '';
$ora_cateheza = '';

if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
}


$query = 'SELECT * FROM programari_cununie WHERE id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_programare);
$result = $stmt->execute();
$result = $stmt->get_result();
 
while ($data = mysqli_fetch_assoc($result)){    

    include "extras-programare-cununie.php";

    $data_cateheza = $data_start_fara_ora = date("Y-m-d", strtotime($data["data_ora_cateheza"]));
    $ora_cateheza = date("H:i", strtotime($data["data_ora_cateheza"]));
    $data_simpla = date("d-m-Y", strtotime($data["data_si_ora"]));

}
?>


<div class="mare">
  <div class="container-fluid">

 <?php    
 
 echo '<h5>Modifică rezervarea din <br />'  . date("d.m.Y", strtotime($data_si_ora)) . ' - ' . $eveniment . ' - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mire . ' ' . $prenume_mire . '</h5>';

    echo  '<hr />';
 
 ?>

<form action="update-edit-rezervare-cununie.php?id=<?php echo $id_programare?>" method="post" enctype = "multipart/form-data">


<div class="input-group mb-2">
  <span class="input-group-text">Data și ora catehezei</span>
  <input type="date" value="<?php echo $data_cateheza; ?>" class="form-control" readonly>
  <input type="text" value="<?php echo $ora_cateheza; ?>" class="form-control" readonly>
</div>


<div class="input-group mb-2">
  <input type="text" name="eveniment" value="<?php echo $eveniment; ?>" class="form-control" readonly>
  <input type="text" name="data_simpla" value="<?php echo $data_simpla; ?>" class="form-control" readonly>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Nume tată*</span>
    <input type="text" name="nume_mire" value="<?php echo $nume_mire; ?>" class="form-control" required>
    <input type="text" name="prenume_mire" value="<?php echo $prenume_mire; ?>" class="form-control" required>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Nume mamă*</span>
    <input type="text" name="nume_mireasa" value="<?php echo $nume_mireasa; ?>" class="form-control" required>
    <input type="text" name="prenume_mireasa" value="<?php echo $prenume_mireasa; ?>" class="form-control" required>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Adresă mire*</span>
    <textarea name="adresa_mire" class="form-control" required><?php echo $adresa_mire; ?></textarea>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Adresă mireasă*</span>
    <textarea name="adresa_mireasa" class="form-control" required><?php echo $adresa_mireasa; ?></textarea>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Telefon*</span>
    <input type="text" name = "telefon" value="<?php echo $telefon; ?>" class="form-control" required>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Email*</span>
    <input type="text" name = "email" value="<?php echo $email; ?>" class="form-control" required>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Nr. certificat căsătorie</span>
    <input type="text" name = "numar_certificat_casatorie" value="<?php echo $numar_certificat_casatorie; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Data eliberarii certificatului</span>
    <input type="date" name = "data_eliberarii_certificatului" value="<?php echo $data_eliberarii_certificatului; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Eliberat de primaria</span>
    <input type="text" name = "eliberat_de_primaria" value="<?php echo $eliberat_de_primaria; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Nume nași*</span>
    <input type="text" name="nume_nas" value="<?php echo $nume_nas; ?>" class="form-control" required>
    <input type="text" name="nume_nasa" value="<?php echo $nume_nasa; ?>" class="form-control" required>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Localitate nași*</span>
    <input type="text" name = "localitate_nasi" value="<?php echo $localitate_nasi; ?>" class="form-control" required>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Contact cameraman</span>
    <input type="text" name="nume_cameraman" value="<?php echo $nume_cameraman; ?>" class="form-control" >
    <input type="text" name="telefon_cameraman" value="<?php echo $telefon_cameraman; ?>" class="form-control" >
</div>


<div class="row mb-1">
    <label class="col-sm-4 col-form-label">Carte identitate mire</label>
         <div class="col-sm-8">
             <input type="file" name="mire_ci" class="col-sm-8 form-control" >
         </div>
    </div>

<div class="row mb-1">
    <label class="col-sm-4 col-form-label">Carte identitate mireasa</label>
         <div class="col-sm-8">
                <input type="file" name="mireasa_ci" class="col-sm-8 form-control" >
          </div>
</div>
  
<div class="row mb-1">
    <label class="col-sm-4 col-form-label">Plata contribuției anuale față de parohie</label>

    <div class="col-sm-8">
        <input type="file" name="plata_contributiei" class="col-sm-8 form-control" >
        <p>Se atașează copia chitanței plătite la biserică sau copia viramentului bancar (100 lei). <br />Puteți plăti contribuția în contul:<br /> <strong>RO11 RNCB 0083 0028 8937 0001</strong> titular fiind: <br /><strong>PAROHIA APARATORII PATRIEI II</strong>.</p>
    </div>
</div>

<div class="row mb-1">
    <label class="col-sm-4 col-form-label">Certificatul de căsătorie civilă</label>
    <div class="col-sm-8">
     <input type="file" name="certificat_casatorie_civila" class="col-sm-8 form-control" >
    </div>
</div>

<div class="row mb-1">
    <label class="col-sm-4 col-form-label">Certificatul de botez mire</label>
    <div class="col-sm-8">
     <input type="file" name="certificat_botez_mire" class="col-sm-8 form-control" >
    </div>
</div>
   

<div class="row mb-1">
    <label class="col-sm-4 col-form-label">Certificatul de botez mireasă</label>
    <div class="col-sm-8">
     <input type="file" name="certificat_botez_mireasa" class="col-sm-8 form-control" >
    </div>
</div>
   

<div class="row mb-1">
    <label class="col-sm-4 col-form-label">Dispensă</label>
    <div class="col-sm-8">
     <input type="file" name="dispensa" class="col-sm-8 form-control" >
    </div>
</div>
   
 

<button type="submit" name ="actualizeaza" class="btn btn-primary">Actualizează datele</button>
 
</form>

    </div>
</div>