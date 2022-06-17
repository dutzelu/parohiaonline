<?php

include "header-frontend.php"; 





$data_cateheza = '';
$ora_cateheza = '';

if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
}

$query = 'SELECT * FROM programari_botez WHERE id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_programare);
$result = $stmt->execute();
$result = $stmt->get_result();
 
while ($data = mysqli_fetch_assoc($result)){    

    include "includes/extras-programare.php";

    $data_cateheza = $data_start_fara_ora = date("Y-m-d", strtotime($data["data_ora_cateheza"]));
    $ora_cateheza = date("H:i", strtotime($data["data_ora_cateheza"]));
    $data_simpla = date("d-m-Y", strtotime($data["data_si_ora"]));

}

?>


<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-frontend.php";?></div>

        <div class="col-lg-9 p-4 zona-principala">

        <?php include "header-mic-frontend.php";?>

  
        <div class="mt-3 p-5 wrapper-rezervare-unica">

 <?php    


    echo "<p>";

        if (empty($nume_tata)) {
        echo '<span class="nume">' . $nume_mama . ' ' . $prenume_mama . '</span><span class="rosu"> [Edit]</span>"'; 
        } else {
        echo '<span class="nume">' . $nume_tata . ' ' . $prenume_tata . '</span><span class="rosu">  [Edit]</span>'; 
        }

        echo ' <i class="fas fa-angle-double-right"></i> ';
        
        echo ' <span class="albastru-inchis">' . $eveniment . ' </span>';

        echo ' <i class="fas fa-angle-double-right"></i> ';

        echo '<span class="rosu">' . date("d M Y", strtotime($data_si_ora)) . '</span>';

        echo ' <i class="fas fa-angle-double-right"></i> ';

        echo '<span class="rosu">' . date("H:i", strtotime($data_si_ora)) . '</span>';

    echo "</p>";

    echo "<p class='butoane'>";

    echo '<span class="status ';
                    
    switch($status) {

        case "acceptata": echo 'acceptata';
        break;
        case "respinsa": echo 'respinsa';
        break;
        case "anulata": echo 'respinsa';
        break;
        case "detalii": echo 'detalii';
        break;
        case "în așteptare": echo 'in-asteptare';
        break;
    }

    echo '">' .$status . '</span>';
    echo '<a href="home-unic.php?id=' . $id_programare . '"><i class="fas fa-chevron-circle-left"></i> Renunță</a> ';
    echo ' <button type="submit" form="actualizeaza" name ="actualizeaza" class="btn salveaza"><i class="fas fa-save"></i> Salveaza</button>';

    echo '</p>';
 
 ?>

<form id="actualizeaza" action="update-edit-rezervare.php?id=<?php echo $id_programare?>" method="post" enctype = "multipart/form-data">


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
    <span class="input-group-text">Nume tată</span>
    <input type="text" name="nume_tata" value="<?php echo $nume_tata; ?>" class="form-control" >
    <input type="text" name="prenume_tata" value="<?php echo $prenume_tata; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Nume mamă</span>
    <input type="text" name="nume_mama" value="<?php echo $nume_mama; ?>" class="form-control" >
    <input type="text" name="prenume_mama" value="<?php echo $prenume_mama; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Adresă</span>
    <textarea name="adresa" class="form-control" ><?php echo $adresa; ?></textarea>
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Telefon</span>
    <input type="text" name = "telefon" value="<?php echo $telefon; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Email</span>
    <input type="text" name = "email" value="<?php echo $email; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Nume copil</span>
    <input type="text" name="nume_copil" value="<?php echo $nume_copil; ?>" class="form-control" >
    <input type="text" name="prenume_copil" value="<?php echo $prenume_copil; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Nume botez copil</span>
    <input type="text" name = "nume_botez_copil" value="<?php echo $nume_botez_copil; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Data nașterii copilului</span>
    <input type="date" name = "data_nasterii_copilului" value="<?php echo $data_nasterii_copilului; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Nr. certificat naștere</span>
    <input type="text" name = "numar_certificat_nastere" value="<?php echo $numar_certificat_nastere; ?>" class="form-control" >
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
    <span class="input-group-text">Nume nași</span>
    <input type="text" name="nume_nas" value="<?php echo $nume_nas; ?>" class="form-control" >
    <input type="text" name="nume_nasa" value="<?php echo $nume_nasa; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Localitate nași</span>
    <input type="text" name = "localitate_nasi" value="<?php echo $localitate_nasi; ?>" class="form-control" >
</div>

<div class="input-group mb-2">
    <span class="input-group-text">Contact cameraman</span>
    <input type="text" name="nume_cameraman" value="<?php echo $nume_cameraman; ?>" class="form-control" >
    <input type="text" name="telefon_cameraman" value="<?php echo $telefon_cameraman; ?>" class="form-control" >
</div>

<div class="edit-foto">

        <div class="row mb-1">
            <label class="col-sm-4 col-form-label">Carte identitate tată</label>
                <div class="col-sm-8">
                    <input type="file" name="tata_ci" class="col-sm-8 form-control" onchange="ValidateSingleInput(this);validateSize(this);">
                </div>
            </div>

        <div class="row mb-1">
            <label class="col-sm-4 col-form-label">Carte identitate mamă *</label>
                <div class="col-sm-8">
                        <input type="file" name="mama_ci" class="col-sm-8 form-control" onchange="ValidateSingleInput(this);validateSize(this);">
                </div>
        </div>
        
        <div class="row mb-1">
            <label class="col-sm-4 col-form-label">Plata contribuției anuale față de parohie *</label>

            <div class="col-sm-8">
                <input type="file" name="plata_contributiei" class="col-sm-8 form-control" onchange="ValidateSingleInput(this);validateSize(this);">
                <p>Se atașează copia chitanței plătite la biserică sau copia viramentului bancar (100 lei). <br />Puteți plăti contribuția în contul:<br /> <strong>RO11 RNCB 0083 0028 8937 0001</strong> titular fiind: <br /><strong>PAROHIA APARATORII PATRIEI II</strong>.</p>
            </div>
        </div>

        <div class="row mb-1">
            <label class="col-sm-4 col-form-label">Certificatul de naștere al copilului *</label>
            <div class="col-sm-8">
            <input type="file" name="certificat_nastere_copil" class="col-sm-8 form-control" onchange="ValidateSingleInput(this);validateSize(this);">
            </div>
        </div>
</div>


 
</form>

<?php
    echo ' <button type="submit" form="actualizeaza" name ="actualizeaza" class="btn btn-primary">Salveaza</button>';

?>


 
</div>

</div>

</div>

</div>

