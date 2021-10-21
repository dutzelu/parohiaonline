<?php

include "header-frontend.php"; 
include "sidebar-frontend.php"; 
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


?>

<h2 class="mb-2">Rezervări</h2>


<?php

$user_id = $_SESSION['id'];


$query = 'SELECT * FROM programari_botez WHERE id = ? AND user_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $user_id);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

    include "extras-programare.php";
 
    echo '<span class="badge mb-1 ' . $clasa_accept . '">' 
    
  
    . $status_accept_afisat . '</span>' . '<br /><h5 style="color:' . $color . '">'  . date("d.m.Y", strtotime($data_si_ora)) . ' - ' . $eveniment . ' - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mama . ' ' . $prenume_mama . '</h5>';

    echo '<a class="btn btn-outline-primary" href="edit-rezervare.php?id=' . $id_programare . '">Modifică detaliile programării / adaugă documente</a>';
    echo  '<hr />';

    if (isset($_GET['edit'])) { 
      echo '<p id ="dispari" class="btn btn-success"> Rezervarea a fost editată cu succes</p>' ;
    } 

    echo '<p>Data catehezei: <strong>' . date("d.m.Y", strtotime($data_ora_cateheza)) . '</strong>' . ' | Ora: <strong>' . date("H:i", strtotime($data_ora_cateheza)) . '</strong></p>';

    echo '<p>Nume tată: <strong>' . $nume_tata . ' ' . $prenume_tata . '</strong> | Nume mamă: <strong>' . $nume_mama . ' ' . $prenume_mama . '</strong></p>';

    echo '<p>Adresă: <strong>' . $adresa . '</strong></p>';
    echo '<p>Telefon: <strong>' . $telefon . '</strong></p>';
    echo '<p>Email: <strong>' . $email . '</strong></p>';

    echo '<p>Nume copil: <strong>' . $nume_copil . ' ' . $prenume_copil . '</strong> | Nume botez copil: <strong>' . $nume_botez_copil . '</strong></p>';

    echo '<p>Data nașterii copilului <strong>' . $data_nasterii_copilului . '</strong></p>'; 
    echo '<p>Număr certificat de naștere: <strong>' . $numar_certificat_nastere . '</strong></p>';
    echo '<p>Data eliberării certificatului: <strong>' . $data_eliberarii_certificatului . '</strong></p>';
    echo '<p>Eliberat de Primăria: <strong>' . $eliberat_de_primaria . '</strong></p>';
    echo '<p>Nași: <strong>' . $nume_nas . ' și ' . $nume_nasa . '</strong></p>';
    if (!empty($nume_cameraman)) {
        echo '<p>Nume cameraman: <strong>' . $nume_cameraman . "</strong> | Telefon: <strong>" . $telefon_cameraman . '</strong></p>';
    }

    echo '<p>Link carte de identitate tată: ';

    // if-urile sunt necesare pentru a nu încarca galeria foto imagini goale in lightbox 
    
    if (!empty($link_tata_ci)) {

    echo '<a target="popup" data-title ="' . basename($link_tata_ci) . '"data-lightbox ="foto_acte" href="' . $link_tata_ci .'">'. basename($link_tata_ci) . '</a>';

    }

    echo '<p>Link carte de identitate mamă: ';
    
    if (!empty($link_mama_ci)) {
    
    echo '<a target="popup" data-title ="' . basename($link_mama_ci) . '"data-lightbox ="foto_acte"  href="' . $link_mama_ci .'">' . basename($link_mama_ci) . '</a>';

    }

    echo '<p>Link plata contribuției: ';
    
    if (!empty($link_plata_contributiei)) {

    echo '<a target="popup" data-title ="' . basename($link_plata_contributiei) . '"data-lightbox ="foto_acte"  href="' . $link_plata_contributiei .'">' . basename($link_plata_contributiei) . '</a>';

    }

    echo '<p>Link certificat de naștere copil: ';
    
    if (!empty($link_certificat_nastere_copil)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_nastere_copil) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_nastere_copil .'">' . basename($link_certificat_nastere_copil) . '</a>';

    }
  
  
    echo '<p>Link cerere și declarație: <a target="popup" href="' . $link_cerere .'">' . basename($link_cerere) . '</a>';
    echo '<p></p><hr>';

    



    if (empty($succes)) {

      // selectez din db toate mesajele corespunzătoare acestei rezervări

          include "afiseaza-mesaje.php";

      // Formular pentru butonul de "Raspunde cu detalii" 

      echo '<form method="POST" action="raspunde-client.php?id=' . $id_programare . '&eveniment=botez">' .

      '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici mesajul dumneavoastră." style="margin:20px 0" rows="6" cols="10"></textarea>  
      <button type="submit" name ="raspunde" class="btn btn-warning">Trimite mesaj</button>';


      echo "</form>";

     }
}   
?>







</div>

</div>

