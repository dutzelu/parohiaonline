<?php

include "header-frontend.php"; 

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

?>

<h2 class="mb-2">Rezervări</h2>


<?php

$user_id = $_SESSION['id'];


$query = 'SELECT * FROM programari_cununie WHERE id = ? AND user_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $user_id);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

    include 'extras-programare-cununie.php';

    echo '<span class="badge mb-1 ' . $clasa_accept . '">' 
    
  
    . $status_accept_afisat . '</span>' . '<br /><h5 style="color:' . $color . '">'  . date("d.m.Y", strtotime($data_si_ora)) . ' - ' . $eveniment . ' - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mire . ' ' . $prenume_mire . '</h5>';

    echo '<a class="btn btn-outline-primary" href="edit-rezervare-cununie.php?id=' . $id_programare . '">Modifică detaliile programării / adaugă documente</a>';
    echo  '<hr />';

    if (isset($_GET['edit'])) { 
      echo '<p id ="dispari" class="btn btn-success"> Rezervarea a fost editată cu succes</p>' ;
    } 

    echo '<p>Data catehezei: <strong>' . date("d.m.Y", strtotime($data_ora_cateheza)) . '</strong>' . ' | Ora: <strong>' . date("H:i", strtotime($data_ora_cateheza)) . '</strong></p>';

    echo '<p>Nume mire: <strong>' . $nume_mire . ' ' . $prenume_mire . '</strong> | Nume mireasă: <strong>' . $nume_mireasa . ' ' . $prenume_mireasa . '</strong></p>';

    echo '<p>Adresă mire: <strong> ' . $adresa_mire . '</strong></p>';
    echo '<p>Adresă mireasă: <strong> ' . $adresa_mireasa . '</strong></p>';
    echo '<p>Telefon: <strong>' . $telefon . '</strong></p>';
    echo '<p>Email: <strong>' . $email . '</strong></p>';

    echo '<p>Număr certificat de căsătorie: <strong>' . $numar_certificat_casatorie . '</strong></p>';
    echo '<p>Data eliberării certificatului: <strong>' . $data_eliberarii_certificatului . '</strong></p>';
    echo '<p>Eliberat de Primăria: <strong>' . $eliberat_de_primaria . '</strong></p>';
    echo '<p>Nași: <strong>' . $nume_nas . ' și ' . $nume_nasa . '</strong></p>';
    if (!empty($nume_cameraman)) {
        echo '<p>Nume cameraman: <strong>' . $nume_cameraman . "</strong> | Telefon: <strong>" . $telefon_cameraman . '</strong></p>';
    }

    echo '<p>Link carte de identitate mire: ';

    // if-urile sunt necesare pentru a nu încarca galeria foto imagini goale in lightbox 
    
    if (!empty($link_mire_ci)) {

    echo '<a target="popup" data-title ="' . basename($link_mire_ci) . '"data-lightbox ="foto_acte" href="' . $link_mire_ci .'">'. basename($link_mire_ci) . '</a></p>';

    }

    echo '<p>Link carte de identitate mireasă: ';
    
    if (!empty($link_mireasa_ci)) {
    
    echo '<a target="popup" data-title ="' . basename($link_mireasa_ci) . '"data-lightbox ="foto_acte"  href="' . $link_mireasa_ci .'">' . basename($link_mireasa_ci) . '</a></p>';

    }

    echo '<p>Link plata contribuției: ';
    
    if (!empty($link_plata_contributiei)) {

    echo '<a target="popup" data-title ="' . basename($link_plata_contributiei) . '"data-lightbox ="foto_acte"  href="' . $link_plata_contributiei .'">' . basename($link_plata_contributiei) . '</a></p>';

    }

    echo '<p>Link certificat de căsătorie: ';
    
    if (!empty($link_certificat_casatorie_civila)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_casatorie_civila) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_casatorie_civila .'">' . basename($link_certificat_casatorie_civila) . '</a></p>';

    }

    echo '<p>Link certificat de botez mire: ';
    
    if (!empty($link_certificat_botez_mire)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_botez_mire) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_botez_mire .'">' . basename($link_certificat_botez_mire) . '</a></p>';

    }

    echo '<p>Link certificat de botez mireasă: ';
  
    if (!empty($link_certificat_botez_mireasa)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_botez_mireasa) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_botez_mireasa .'">' . basename($link_certificat_botez_mireasa) . '</a></p>';

    }

    echo '<p>Link dispensă: ';
    
    if (!empty($link_dispensa)) {
    
    echo '<a target="popup" data-title ="' . basename($link_dispensa) . '"data-lightbox ="foto_acte"  href="' . $link_dispensa .'">' . basename($link_dispensa) . '</a></p>';

    }
  
  
    echo '<p>Link cerere și declarație: <a target="popup" href="' . $link_cerere .'">' . basename($link_cerere) . '</a>';
    echo '<p></p><hr>';

    
    if (empty($succes)) {

      // selectez din db toate mesajele corespunzătoare acestei rezervări

          include "afiseaza-mesaje.php";

      // Formular pentru butonul de "Raspunde cu detalii" 

      echo '<form method="POST" action="raspunde-client.php?id=' . $id_programare . '&eveniment=cununie">' .

      '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici mesajul dumneavoastră." style="margin:20px 0" rows="6" cols="10"></textarea>  
      <button type="submit" name ="raspunde" class="btn btn-warning">Trimite mesaj</button>';


      echo "</form>";

     }
}   
?>







</div>

</div>

