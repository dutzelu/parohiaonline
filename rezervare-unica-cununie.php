<?php

include "header-frontend.php"; 
include "sidebar-admin.php"; 
include "functions.php";

$user_id = $_SESSION['id'];
?>


<div class="mare">
  <div class="container-fluid">

<?php


  if (isset($_GET['succes'])) { 
    echo '<h1 class="h1">Cererea ta de programare online s-a finalizat cu succes. În cel mai scurt timp părintele va confirma PRIN EMAIL primirea rezervării și a documetelor trimise sau vă va cere detalii suplimentare. </h1>'
    ;
    $succes = $_GET['succes'];
  } else $succes = '';


  if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
  }

 
  if (isset($_GET['status'])) {
  
    $status = $_GET['status'];
    $query = 'UPDATE programari_cununie SET status = ? WHERE id=? ';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $status, $id_programare);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    
  } 





$query = 'SELECT * FROM programari_cununie WHERE id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_programare);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

  include "extras-programare-cununie.php";

  echo "<div id='butoane'>";
  echo '<a class="btn btn-outline-primary" href="edit-rezervare-cununie.php?id=' . $id_programare . '">Modifică detaliile programării / adaugă documente</a> ';
  echo ' <button class="btn btn-outline-primary" onclick="window.print()">Print</button>';
  echo "</div>";

  
    echo '<span class="badge mb-1 ' . $clasa_accept . '">' 
    
  
    . $status_accept_afisat . '</span>' . '<br />
    
    
    <div id="tabel-rezervare">
    <h5 style="color:' . $color . '">'  . date("d.m.Y", strtotime($data_si_ora)) . ' - ' . $eveniment . ' - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mire . ' ' . $prenume_mire . '</h5>';


    echo  '<hr />';

    if (isset($_GET['edit'])) { 
      echo '<p id ="dispari" class="btn btn-success"> Rezervarea a fost editată cu succes</p>' ;
    } 
    
    echo '<p><span class="cap">Data catehezei: </span>' . date("d.m.Y", strtotime($data_ora_cateheza)) . '' . ' <span class="cap stanga">Ora:</span> ' . date("H:i", strtotime($data_ora_cateheza)) . '</p>';

    echo '<p><span class="cap">Nume mire: </span>' . $nume_mire . ' ' . $prenume_mire . '</p>';
    echo '<p><span class="cap">Nume mireasă: </span>' . $nume_mireasa . ' ' . $prenume_mireasa . '</p>';

    echo '<p><span class="cap">Adresă mire:  </span>' . $adresa_mire . '</p>';
    echo '<p><span class="cap">Adresă mireasă:  </span>' . $adresa_mireasa . '</p>';
    echo '<p><span class="cap">Telefon: </span>' . $telefon . '</p>';
    echo '<p><span class="cap">Email: </span>' . $email . '</p>';

    echo '<p><span class="cap">Număr certificat de căsătorie: </span>' . $numar_certificat_casatorie . '</p>';
    echo '<p><span class="cap">Data eliberării certificatului: </span>' . $data_eliberarii_certificatului . '</p>';
    echo '<p><span class="cap">Eliberat de Primăria: </span>' . $eliberat_de_primaria . '</p>';
    echo '<p><span class="cap">Nași: </span>' . $nume_nas . ' și ' . $nume_nasa . '</p>';
    echo '<p><span class="cap">Nume cameraman: </span>' . $nume_cameraman . '</p>';
    echo '<p><span class="cap">Telefon cameraman: </span>' . $telefon_cameraman . '</p>';
 
    echo '<p><span class="cap">Carte de identitate mire: </span>';

    // if-urile sunt necesare pentru a nu încarca galeria foto imagini goale in lightbox 
    
    if (!empty($link_mire_ci)) {

    echo '<a target="popup" data-title ="' . basename($link_mire_ci) . '"data-lightbox ="foto_acte" href="' . $link_mire_ci .'">
    <br /><img src="' . $link_mire_ci . '"/></a></p>';

    }

    echo '<p><span class="cap">Carte de identitate mireasă: </span>';
    
    if (!empty($link_mireasa_ci)) {
    
    echo '<a target="popup" data-title ="' . basename($link_mireasa_ci) . '"data-lightbox ="foto_acte"  href="' . $link_mireasa_ci .'">
    <br /><img src="' . $link_mireasa_ci . '"/></a></p>';

    }

    echo '<p><span class="cap">Plata contribuției: </span>';
    
    if (!empty($link_plata_contributiei)) {

    echo '<a target="popup" data-title ="' . basename($link_plata_contributiei) . '"data-lightbox ="foto_acte"  href="' . $link_plata_contributiei .'"><br /><img src="' . $link_plata_contributiei . '"/></a></p>';

    }

    echo '<p><span class="cap">Certificat de căsătorie: </span>';
    
    if (!empty($link_certificat_casatorie_civila)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_casatorie_civila) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_casatorie_civila .'"><br /><img src="' . $link_certificat_casatorie_civila . '"/></a></p>';

    }

    echo '<p><span class="cap">Certificat de botez mire: </span>';
    
    if (!empty($link_certificat_botez_mire)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_botez_mire) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_botez_mire .'"><br /><img src="' . $link_certificat_botez_mire . '"/></a></p>';

    }

    echo '<p><span class="cap">Certificat de botez mireasă: </span>';
  
    if (!empty($link_certificat_botez_mireasa)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_botez_mireasa) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_botez_mireasa .'"><br /><img src="' . $link_certificat_botez_mireasa . '"/></a></p>';

    }

    echo '<p><span class="cap">Link dispensă: </span>';
    
    if (!empty($link_dispensa)) {
    
    echo '<a target="popup" data-title ="' . basename($link_dispensa) . '"data-lightbox ="foto_acte"  href="' . $link_dispensa .'"><br /><img src="' . $link_dispensa . '"/></a></p>';

    }
  
  
    echo '<p><span class="cap">Link cerere și declarație: </span><a target="popup" href="' . $link_cerere .'">' . basename($link_cerere) . '</a>';

    echo "</div>";
    echo '<p></p><hr>';

    

    if ($status !== 'acceptata') {
        echo '<a class="btn btn-success" href="accepta-programare-cununie.php?id=' . $id_programare . '&status=acceptata" role="button" style="margin-right:10px">Acceptă</a>';
      }  
      
      echo ' <a class="btn btn-danger" href="rezervare-unica-cununie.php?id=' . $id_programare . '&status=respinsa" role="button" style="margin-right:10px">Respinge</a>';
  
      echo '<hr />';
  
      // selectez din db toate mesajele corespunzătoare acestei rezervări
  
      include "afiseaza-mesaje.php";
  
      // Formular pentru butonul de "Raspunde cu detalii" 
  
      echo '<form method="POST" action="raspunde-cu-detalii.php?id=' . $id_programare . '&status=detalii&eveniment=cununie">' .
  
      '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici mesajul dumneavoastră." style="margin:20px 0" rows="6" cols="10"></textarea>  
      <button type="submit" name ="raspunde" class="btn btn-warning">Răspunde cu detalii</button>';
  
  
      echo "</form>";
}   
?>







</div>

</div>

