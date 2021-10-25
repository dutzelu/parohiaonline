<?php

include "header-frontend.php"; 
include "sidebar-admin.php"; 
include "functions.php";
?>


<div class="mare">
  <div class="container-fluid">

  

<?php

if (isset($_GET['succes'])) { 
  echo '<h1 class="h1">Cererea ta de programare online s-a finalizat cu succes. În cel mai scurt timp părintele va confirma PRIN EMAIL primirea rezervării și a documetelor trimise sau vă va cere detalii suplimentare. </h1>'
  ;
  $succes = $_GET['succes'];
} else $succes = '';


if (isset($_GET['id'])) {$id_programare = $_GET['id'];} 
if (isset($_GET['status'])) {

  $status = $_GET['status'];
  $query = 'UPDATE programari_botez SET status = ? WHERE id=? ';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $status, $id_programare);
  $result = $stmt->execute();
  $result = $stmt->get_result();
  
} 

 
// selectez din db toate detaliile cererii (programarii)

$query = 'SELECT * FROM programari_botez WHERE id=? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_programare);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

    include "extras-programare.php";

  
    // afisez detaliile cererii (programarii)

  
    echo "<div id='butoane'>";
      echo '<a class="btn btn-outline-primary" href="edit-rezervare.php?id=' . $id_programare . '">Modifică detaliile programării / adaugă documente</a> ';
      echo ' <button class="btn btn-outline-primary" onclick="window.print()">Print</button>';
    echo "</div>";
    

    echo '<span class="badge mb-1 ' . $clasa_accept . '">' 
    
    
    . $status_accept_afisat . '</span>' . '<br />
    
    <div id="tabel-rezervare">
    <h5 style="color:' . $color . '">'  . date("d.m.Y", strtotime($data_si_ora)) . ' - ' . $eveniment . ' - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mama . ' ' . $prenume_mama . '</h5>';


    ?>




    <?php
    echo  '<hr />';

    if (isset($_GET['edit'])) { 
      echo '<p id ="dispari" class="btn btn-success"> Rezervarea a fost editată cu succes</p>' ;
    } 
    
    echo '<p><span class="cap">Data catehezei: </span>' . date("d.m.Y", strtotime($data_ora_cateheza)) . '' . ' <span class="cap stanga">Ora: </span>' . date("H:i", strtotime($data_ora_cateheza)) . '</p>';

    echo '<p><span class="cap">Nume tată: </span>' . $nume_tata . ' ' . $prenume_tata . '</p>';
    echo '<p><span class="cap">Nume mamă: </span>' . $nume_mama . ' ' . $prenume_mama . '</p>';

    echo '<p><span class="cap">Adresă: </span>' . $adresa . '</p>';
    echo '<p><span class="cap">Telefon: </span>' . $telefon . '</p>';
    echo '<p><span class="cap">Email: </span>' . $email . '</p>';

    echo '<p><span class="cap">Nume copil: </span>' . $nume_copil . ' ' . $prenume_copil . '  <span class="cap stanga"> Nume botez copil: </span>' . $nume_botez_copil . '</p>';

    echo '<p><span class="cap">Data nașterii copilului </span>' . $data_nasterii_copilului . '</p>'; 
    echo '<p><span class="cap">Număr certificat de naștere: </span>' . $numar_certificat_nastere . '</p>';
    echo '<p><span class="cap">Data eliberării certificatului: </span>' . $data_eliberarii_certificatului . '</p>';
    echo '<p><span class="cap">Eliberat de Primăria: </span>' . $eliberat_de_primaria . '</p>';
    echo '<p><span class="cap">Nași: </span>' . $nume_nas . ' și ' . $nume_nasa . '</p>';
    echo '<p><span class="cap">Nume cameraman: </span>' . $nume_cameraman . '</p>';
    echo '<p><span class="cap">Telefon cameraman: </span>' . $telefon_cameraman . '</p>';
    

    echo '<p><span class="cap">Carte de identitate tată: </span>';

    // if-urile sunt necesare pentru a nu încarca galeria foto imagini goale in lightbox 
    
    if (!empty($link_tata_ci)) {

    echo '<a target="popup" data-title ="' . basename($link_tata_ci) . '"data-lightbox ="foto_acte" href="' . $link_tata_ci .'">
    <br />
    <img src="' . $link_tata_ci . '"/></a>';

    }

    echo '<p><span class="cap">Carte de identitate mamă: </span>';
    
    if (!empty($link_mama_ci)) {
    
    echo '<a target="popup" data-title ="' . basename($link_mama_ci) . '"data-lightbox ="foto_acte"  href="' . $link_mama_ci .'">
    <br />
    <img src="' . $link_mama_ci . '"/></a>';

    }

    echo '<p><span class="cap">Plata contribuției: </span>';
    
    if (!empty($link_plata_contributiei)) {

    echo '<a target="popup" data-title ="' . basename($link_plata_contributiei) . '"data-lightbox ="foto_acte"  href="' . $link_plata_contributiei .'"><br />
    <img src="' . $link_plata_contributiei . '"/></a>';

    }

    echo '<p><span class="cap">Certificat de naștere copil: </span>';
    
    if (!empty($link_certificat_nastere_copil)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_nastere_copil) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_nastere_copil .'"><br />
    <img src="' . $link_certificat_nastere_copil . '"/></a>';

    }

    echo '<p><span class="cap">Cerere și declarație: </span><a target="popup" href="' . $link_cerere .'">' . basename($link_cerere) . '</a>';
    echo '<hr>';
}   
    echo '</div>';

    if ($status !== 'acceptata') {
      echo '<a class="btn btn-success" href="accepta-programare.php?id=' . $id_programare . '&status=acceptata" role="button" style="margin-right:10px">Acceptă</a>';
    }  
    
    echo ' <a class="btn btn-danger" href="rezervare-unica.php?id=' . $id_programare . '&status=respinsa" role="button" style="margin-right:10px">Respinge</a>';

    echo '<hr />';
  

    // selectez din db toate mesajele corespunzătoare acestei rezervări

    include "afiseaza-mesaje.php";

    // Formular pentru butonul de "Raspunde cu detalii" 

 

    echo '<form method="POST" action="raspunde-cu-detalii.php?id=' . $id_programare . '&status=detalii&eveniment=botez">' .

    '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici mesajul dumneavoastră." style="margin:20px 0" rows="6" cols="10"></textarea>  
    <button type="submit" name ="raspunde" class="btn btn-warning">Răspunde cu detalii</button>';


    echo "</form>";



  ?>

 


</div>

</div>

