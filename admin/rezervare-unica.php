<?php include "header-admin.php"; ?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>

  
        <div class="mt-3 p-5 wrapper-rezervare-unica">
              <?php

 
              if (isset($_GET['id'])) {$id_programare = $_GET['id'];} 
              if (isset($_GET['status'])) {

              $status = $_GET['status'];
              $query = 'UPDATE programari_botez SET status = ? WHERE id=? AND parohie_id = ?';
              $stmt = $conn->prepare($query);
              $stmt->bind_param('sii', $status, $id_programare, $id);
              $result = $stmt->execute();
              $result = $stmt->get_result();

              } 


              // selectez din db toate detaliile cererii (programarii)

              $query = 'SELECT * FROM programari_botez WHERE id=? AND parohie_id = ? ORDER BY id DESC';
              $stmt = $conn->prepare($query);
              $stmt->bind_param('ii', $id_programare, $id);
              $result = $stmt->execute();
              $result = $stmt->get_result();


              while($data = $result->fetch_assoc()) {

              include "../includes/extras-programare.php";


              // afisez detaliile cererii (programarii)

              echo "<p>";

                  if (empty($data['nume_tata'])) {
                    echo '<span class="nume">' . $data['nume_mama'] . ' ' . $data['prenume_mama'] . "</span>"; 
                  } else {
                    echo '<span class="nume">' . $data['nume_tata'] . ' ' . $data['prenume_tata'] . "</span>"; 
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

                echo '<a href="registru.php?eveniment=programari_botez"><i class="fas fa-chevron-circle-left"></i> Înapoi</a> ';

                echo '<a href="accepta-programare.php?id=' . $id_programare . '&status=acceptata" role="button"><i class="verde far fa-check-circle"></i>  Acceptă</a>';

                echo '<a href="rezervare-unica.php?id=' . $id_programare . '&status=respinsa" role="button" ><i class="orange fas fa-backspace"></i> Respinge</a>'; ?>

                <a href="actiuni.php?eveniment=programari_botez&stergeid=<?php echo $id_programare; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                <i class="rosu fas fa-trash-alt"></i> Șterge</a>

                <?php
                             
                echo '<a href="edit-rezervare.php?id=' . $id_programare . '"><i class="albastru-inchis far fa-edit"></i> Modifică</a> ';

                echo '<a href="" onclick="window.print()"><i class="fas fa-print"></i> Print</a>';
               
              echo '</p>';

              echo  '<hr />';
              
              echo '<div class="tabel-rezervare view">';

              if (isset($_GET['edit'])) { 
                echo '<p id ="dispari" class="btn btn-outline-success"> Rezervarea a fost editată cu succes</p>' ;
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


              

              echo '<p><span class="cap imagine">Carte de identitate tată: </span>';

              // if-urile sunt necesare pentru a nu încarca galeria foto imagini goale in lightbox 

              if (!empty($link_tata_ci)) {

              echo '<a target="popup" data-title ="' . basename($link_tata_ci) . '"data-lightbox ="foto_acte" href="' . BASE_URL . $link_tata_ci .'">
              <img src="../' . $link_tata_ci . '"/></a>';

              }

              echo '<p><span class="cap imagine">Carte de identitate mamă: </span>';

              if (!empty($link_mama_ci)) {

              echo '<a target="popup" data-title ="' . basename($link_mama_ci) . '"data-lightbox ="foto_acte"  href="'. BASE_URL  . $link_mama_ci .'">
              <img src="../' . $link_mama_ci . '"/></a>';

              }

              echo '<p><span class="cap imagine">Plata contribuției: </span>';

              if (!empty($link_plata_contributiei)) {

              echo '<a target="popup" data-title ="' . basename($link_plata_contributiei) . '"data-lightbox ="foto_acte"  href="'. BASE_URL  . $link_plata_contributiei .'">
              <img src="../' . $link_plata_contributiei . '"/></a>';

              }

              echo '<p><span class="cap imagine">Certificat de naștere copil: </span>';

              if (!empty($link_certificat_nastere_copil)) {

              echo '<a target="popup" data-title ="' . basename($link_certificat_nastere_copil) . '"data-lightbox ="foto_acte"  href="'. BASE_URL  . $link_certificat_nastere_copil .'">
              <img src="../' . $link_certificat_nastere_copil . '"/></a>';

              }

              echo '<p><span class="cap">Cerere și declarație: </span><a target="popup" href="'. BASE_URL . $link_cerere .'">' . basename($link_cerere) . '</a>';
              echo '<hr>';
              }   
              echo '</div>';

              // selectez din db toate mesajele corespunzătoare acestei rezervări

              include "../includes/afiseaza-mesaje.php";

              // Formular pentru butonul de "Raspunde cu detalii" 

              echo '<form method="POST" action="raspunde-cu-detalii.php?id=' . $id_programare . '&status=detalii&eveniment=botez">' .

              '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici un mesaj persoanei care a făcut programarea." style="margin:20px 0" rows="6" cols="10"></textarea>  
              <button type="submit" name ="raspunde" class="btn btn-warning">Trimite mesaj</button>';


              echo "</form>";



              ?>

 
</div>

</div>

</div>

</div>

