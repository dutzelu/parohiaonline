<?php include "header-admin.php"; 

$user_id = $_SESSION['parohie_id'];
?>


<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>

  
        <div class="mt-3 wrapper-rezervare-unica">

<?php

  if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
  }

 
  if (isset($_GET['status'])) {
  
    $status = $_GET['status'];
    $query = 'UPDATE programari_cununie SET status = ? WHERE id=? AND parohie_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sii', $status, $id_programare, $id);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    
  } 


$query = 'SELECT * FROM programari_cununie WHERE id = ? AND parohie_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $id);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

  include "../includes/extras-programare-cununie.php";

  echo "<p class='inapoi'>";
    echo '<a href="registru.php?eveniment=programari_cununie"><i class="fas fa-chevron-circle-left"></i> Înapoi</a> ';
  echo '</p>';

  // afisez detaliile cererii (programarii)

  echo "<p>";
                  echo '<span class="nume">' . $nume_si_prenume_mire . "</span>"; 
               
                  echo '<br>';

                  echo ' <span class="albastru-inchis">' . $eveniment . ' </span>';

                  echo '<br>';
                  
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
                  

                  echo '<i class="fas fa-angle-double-right"></i>';

                  echo '<span class="rosu">' . strftime('%e %b %Y',strtotime($data_si_ora)) . '</span>';

                  echo '<i class="fas fa-angle-double-right"></i>';

                  echo '<span class="rosu">' . date("H:i", strtotime($data_si_ora)) . '</span>';

              ?>
              </p>

              <p class='butoane'>


              <a href="accepta-programare-cununie.php?id=<?php echo $id_programare;?>&status=acceptata" role="button" class="btn btn-success">Acceptă</a>
                
              <a href="rezervare-unica-cununie.php?id=<?php echo $id_programare;?>&status=respinsa" role="button" class="btn btn-danger">Respinge</a>
            
              <a href="actiuni.php?eveniment=programari_cununie&data=<?php echo date("Y-m-d", strtotime($data_si_ora)); ?>&stergeid=<?php echo $id_programare; ?>" class="sterge btn btn-outline-secondary" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');" role="button" >Șterge</a>

              <a href="edit-rezervare-cununie.php?id=<?php echo $id_programare;?>" role="button" class="btn btn-outline-secondary">Editează </a>

              </p>

         <?php }?>

        <div class="tabel-responsive">
              
          <table class='table rezervare-unica'>
              
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>

  
            <?php

              if (isset($_GET['edit'])) { 
                echo '<p id ="dispari" class="btn btn-success"> Rezervarea a fost editată cu succes</p>' ;
              } 
            ?>

            <tr>
                <td class="evident">Data catehezei:</td>
                <td class="evident-date"><?php echo strftime('%e %b %Y',strtotime($data_ora_cateheza));?></td>
              </tr>

              <tr>
                <td class="evident">Ora:</td>
                <td class="evident-date"><?php echo date("H:i", strtotime($data_ora_cateheza));?></td>
              </tr>

              <tr>
                <td class="evident">Nume mire:</td>
                <td class="evident-date"><?php echo $nume_mire . ' ' . $prenume_mire;?></td>
              </tr>

              <tr>
                <td class="evident">Nume mireasă:</td> 
                <td class="evident-date"><?php echo $nume_mireasa . ' ' . $prenume_mireasa;?></td>
              </tr>

              <tr>
                <td class="evident">Adresă mire:</td>
                <td class="evident-date"><?php echo $adresa_mire;?></td>
              </tr>

              <tr>
                <td class="evident">Adresă mireasă:</td>
                <td class="evident-date"><?php echo $adresa_mireasa;?></td>
              </tr>

              <tr>
                <td class="evident">Telefon:</td>
                <td class="evident-date"><?php echo $telefon;?></td>
              </tr>

              <tr>
                <td class="evident">Email:</td>
                <td class="evident-date"><?php echo $email;?></td>
              </tr>

              <tr>
                <td class="evident">Număr certificat de căsătorie:</td>
                <td class="evident-date"><?php echo $numar_certificat_casatorie;?></td>
              </tr>

              <tr>
                <td class="evident">Data eliberării certificatului:</td>
                <td class="evident-date"><?php echo strftime('%e %b %Y',strtotime($data_eliberarii_certificatului));?></td>
              </tr>

              <tr>
                <td class="evident">Eliberat de Primăria:</td>
                <td class="evident-date"><?php echo $eliberat_de_primaria;?></td>
              </tr>
    
              <tr>
                <td class="evident">Nași:</td>
                <td class="evident-date"><?php echo $nume_nas . ' și ' . $nume_nasa;?></td>
              </tr>
    
              <tr>
                <td class="evident">Nume cameraman: </td>
                <td class="evident-date"><?php echo $nume_cameraman;?></td>
              </tr>
    
              <tr>
                <td class="evident">Telefon cameraman: </td>
                <td class="evident-date"><?php echo $telefon_cameraman;?></td>
              </tr>
    
              <tr>
                <td class="evident">Carte de identitate mire:</td>
                <td class="evident-date"><?php  
                // if-urile sunt necesare pentru a nu încarca galeria foto imagini goale in lightbox 
    
                  if (!empty($link_mire_ci)) {

                    echo '<a target="popup" data-title ="' . basename($link_mire_ci) . '"data-lightbox ="foto_acte" href="' . BASE_URL . $link_mire_ci .'">
                    <img src="../' . $link_mire_ci . '"/></a></p>';
                 }?></td>
              </tr>
        
              <tr>
                <td class="evident">Carte de identitate mireasă:</td>
                <td class="evident-date"><?php 
                
                if (!empty($link_mireasa_ci)) {
    
                  echo '<a target="popup" data-title ="' . basename($link_mireasa_ci) . '"data-lightbox ="foto_acte"  href="' . BASE_URL  . $link_mireasa_ci .'">
                  <img src="../' . $link_mireasa_ci . '"/></a></p>';
 
                }?></td>
                </tr>

    
                <tr>
                <td class="evident">Plata contribuției: </td>
                <td class="evident-date"><?php  

                    if (!empty($link_plata_contributiei)) {

                      echo '<a target="popup" data-title ="' . basename($link_plata_contributiei) . '"data-lightbox ="foto_acte"  href="' . BASE_URL  . $link_plata_contributiei .'"><img src="../' . $link_plata_contributiei . '"/></a></p>';
    
                    }?></td>
                  </tr>
 
      
                <tr>
                <td class="evident">Certificat de căsătorie:</td>
                <td class="evident-date"><?php  

                if (!empty($link_certificat_casatorie_civila)) {
                
                echo '<a target="popup" data-title ="' . basename($link_certificat_casatorie_civila) . '"data-lightbox ="foto_acte"  href="' . BASE_URL  . $link_certificat_casatorie_civila .'"><img src="../' . $link_certificat_casatorie_civila . '"/></a></p>';

                }?></td>
                </tr>

                <tr>
                <td class="evident">Certificat de botez mire: </td>
                <td class="evident-date"><?php  

                  if (!empty($link_certificat_botez_mire)) {

                  echo '<a target="popup" data-title ="' . basename($link_certificat_botez_mire) . '"data-lightbox ="foto_acte"  href="'  . BASE_URL . $link_certificat_botez_mire .'"><img src="../' . $link_certificat_botez_mire . '"/></a></p>';

                  }?></td>
                  </tr>

                <tr>
                <td class="evident">Certificat de botez mireasă:</td>
                <td class="evident-date"><?php  

                  if (!empty($link_certificat_botez_mireasa)) {
                  
                  echo '<a target="popup" data-title ="' . basename($link_certificat_botez_mireasa) . '"data-lightbox ="foto_acte"  href="' . BASE_URL  . $link_certificat_botez_mireasa .'"><img src="../' . $link_certificat_botez_mireasa . '"/></a></p>';

                 }?></td>
                </tr>
                  
                <tr>
                  <td class="evident">Link dispensă:</td>
                  <td class="evident-date"><?php  
                  
                     if (!empty($link_dispensa)) {
                     
                     echo '<a target="popup" data-title ="' . basename($link_dispensa) . '"data-lightbox ="foto_acte"  href="' . BASE_URL  . $link_dispensa .'"><img src="../' . $link_dispensa . '"/></a></p>';

                }?></td>
                </tr>

                    
              <tr>
                <td class="evident">Link cerere și declarație:</td>
                <td class="evident-date"><?php echo '<p><span class="cap"></span><a target="popup" href="' . BASE_URL  . $link_cerere .'">' . basename($link_cerere) . '</a>';?></td>
              </tr>
  
              </table>
              
              </div>
              
  
  
 <?php
  
      // selectez din db toate mesajele corespunzătoare acestei rezervări
  
      include "../includes/afiseaza-mesaje.php";
  
      // Formular pentru butonul de "Raspunde cu detalii" 
  
      echo '<form method="POST" action="raspunde-cu-detalii.php?id=' . $id_programare . '&status=detalii&eveniment=cununie">' .
  
      '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici mesajul dumneavoastră." style="margin:20px 0" rows="6" cols="10"></textarea>  
      <button type="submit" name ="raspunde" class="btn btn-warning">Trimite mesaj</button>';
  
  
      echo "</form>";
  
?>






</div>

</div>

</div>

</div>

