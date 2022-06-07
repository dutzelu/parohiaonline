<?php include "header-frontend.php"; ?>


<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">

        <?php include "header-mic-frontend.php";?>

        <div class="mt-3 p-5 wrapper-rezervare-unica">

<?php


  if (isset($_GET['succes'])) { 
    echo '<h1 class="h1">Cererea ta de programare online s-a finalizat cu succes. În cel mai scurt timp părintele va confirma PRIN EMAIL primirea rezervării și a documetelor trimise sau vă va cere detalii suplimentare. </h1>'
    ;
    $succes = $_GET['succes'];
  } else $succes = '';


  if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
  }



$query = 'SELECT * FROM programari_cununie WHERE id = ? AND user_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $user_id);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

    include 'includes/extras-programare-cununie.php';

    echo "<p>";
  
    echo '<span class="nume">' . $data['nume_mire'] . ' ' . $data['prenume_mire'] . "</span>"; 
   

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

        echo '<a href="home.php"><i class="fas fa-chevron-circle-left"></i> Înapoi</a> ';

        echo '<a href="anuleaza.php?id-anulare=' . $id_programare . '&eveniment=' . preg_replace('/\s+/', '', $eveniment) . '"><i class="orange fas fa-backspace"></i> Anuleaza</a>'; ?>

        <a href="sterge.php?eveniment=programari_botez&data=<?php echo date("Y-m-d", strtotime($data_si_ora)); ?>&stergeid=<?php echo $id_programare; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
        <i class="rosu fas fa-trash-alt"></i> Șterge</a>

        <?php
                    
        echo '<a href="home-unic-cununie-edit.php?id=' . $id_programare . '"><i class="albastru-inchis far fa-edit"></i> Modifică</a> ';

        echo '<a href="" onclick="window.print()"><i class="fas fa-print"></i> Print</a>';

    echo '</p>';

    echo  '<hr />';

    echo '<div class="tabel-rezervare view">';

    if (isset($_GET['edit'])) { 
      echo '<p id ="dispari" class="btn btn-success"> Rezervarea a fost editată cu succes</p>' ;
    } 

    echo '<p><span class="cap">Data catehezei: </span>' . date("d.m.Y", strtotime($data_ora_cateheza)) . '' . '<span class="cap stanga">Ora: </span>' . date("H:i", strtotime($data_ora_cateheza)) . '</p>';

    echo '<p><span class="cap">Nume mire: </span>' . $nume_mire . ' ' . $prenume_mire . '<span class="cap stanga">Nume mireasă: </span>' . $nume_mireasa . ' ' . $prenume_mireasa . '</p>';

    echo '<p><span class="cap">Adresă mire: </span> ' . $adresa_mire . '</p>';
    echo '<p><span class="cap">Adresă mireasă: </span> ' . $adresa_mireasa . '</p>';
    echo '<p><span class="cap">Telefon: </span>' . $telefon . '</p>';
    echo '<p><span class="cap">Email: </span>' . $email . '</p>';

    echo '<p><span class="cap">Număr certificat de căsătorie: </span>' . $numar_certificat_casatorie . '</p>';
    echo '<p><span class="cap">Data eliberării certificatului: </span>' . $data_eliberarii_certificatului . '</p>';
    echo '<p><span class="cap">Eliberat de Primăria: </span>' . $eliberat_de_primaria . '</p>';
    echo '<p><span class="cap">Nași: </span>' . $nume_nas . ' și ' . $nume_nasa . '</p>';
    if (!empty($nume_cameraman)) {
        echo '<p><span class="cap">Nume cameraman: </span>' . $nume_cameraman . '<span class="cap stanga">Telefon: </span>' . $telefon_cameraman . '</p>';
    }

    echo '<p><span class="cap">Link carte de identitate mire: </span>';

    // if-urile sunt necesare pentru a nu încarca galeria foto imagini goale in lightbox 
    
    if (!empty($link_mire_ci)) {

    echo '<a target="popup" data-title ="' . basename($link_mire_ci) . '"data-lightbox ="foto_acte" href="' . $link_mire_ci .'">
    <img src="' . $link_mire_ci . '"/></a></p>';

    }

    echo '<p><span class="cap">Link carte de identitate mireasă: </span>';
    
    if (!empty($link_mireasa_ci)) {
    
    echo '<a target="popup" data-title ="' . basename($link_mireasa_ci) . '"data-lightbox ="foto_acte"  href="' . $link_mireasa_ci .'">
    <img src="' . $link_mireasa_ci . '"/></a></a></p>';

    }

    echo '<p><span class="cap">Link plata contribuției: </span>';
    
    if (!empty($link_plata_contributiei)) {

    echo '<a target="popup" data-title ="' . basename($link_plata_contributiei) . '"data-lightbox ="foto_acte"  href="' . $link_plata_contributiei .'"><img src="' . $link_plata_contributiei . '"/></a></a></p>';

    }

    echo '<p><span class="cap">Link certificat de căsătorie: </span>';
    
    if (!empty($link_certificat_casatorie_civila)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_casatorie_civila) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_casatorie_civila .'"><img src="' . $link_certificat_casatorie_civila . '"/></a></a></p>';

    }

    echo '<p><span class="cap">Link certificat de botez mire: </span>';
    
    if (!empty($link_certificat_botez_mire)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_botez_mire) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_botez_mire .'"><img src="' . $link_certificat_botez_mire . '"/></a></a></p>';

    }

    echo '<p><span class="cap">Link certificat de botez mireasă: </span>';
  
    if (!empty($link_certificat_botez_mireasa)) {
    
    echo '<a target="popup" data-title ="' . basename($link_certificat_botez_mireasa) . '"data-lightbox ="foto_acte"  href="' . $link_certificat_botez_mireasa .'"><img src="' . $link_certificat_botez_mireasa . '"/></a></p>';

    }

    echo '<p><span class="cap">Link dispensă: </span>';
    
    if (!empty($link_dispensa)) {
    
    echo '<a target="popup" data-title ="' . basename($link_dispensa) . '"data-lightbox ="foto_acte"  href="' . $link_dispensa .'">
    <img src="' . $link_dispensa . '"/></a></p>';

    }
  
  
    echo '<p><span class="cap">Link cerere și declarație: </span><a target="popup" href="' . $link_cerere .'">' . basename($link_cerere) . '</a>';
    echo '<p></p>';
    echo '</div>';

    
    if (empty($succes)) {

      // selectez din db toate mesajele corespunzătoare acestei rezervări

          include "includes/afiseaza-mesaje.php";

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
</div>

</div>

</body>
</html>

