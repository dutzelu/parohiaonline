<?php include "header-frontend.php"; ?>


<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">

        <?php include "header-mic-frontend.php";?>

  
        <div class="mt-3 wrapper-rezervare-unica">

<?php


  if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
  }

$query = 'SELECT * FROM programari_botez WHERE id = ? AND user_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $user_id);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

    include "includes/extras-programare.php";

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

        echo '<a href="home-botez.php"><i class="fas fa-chevron-circle-left"></i> Înapoi</a> ';

        echo '<a href="anuleaza.php?id-anulare=' . $id_programare . '&eveniment=' . preg_replace('/\s+/', '', $eveniment) . '"><i class="orange fas fa-backspace"></i> Anuleaza</a>'; ?>

        <a href="sterge.php?eveniment=programari_botez&data=<?php echo date("Y-m-d", strtotime($data_si_ora)); ?>&stergeid=<?php echo $id_programare; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
          <i class="rosu fas fa-trash-alt"></i> Șterge</a>

        <?php
                    
        echo '<a href="home-unic-edit.php?id=' . $id_programare . '"><i class="albastru-inchis far fa-edit"></i> Modifică</a> ';

       ?>

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
        } ?>

        <tr>
          <td class="evident">Data catehezei:</td>
          <td class="evident-date"><?php echo date("d.m.Y", strtotime($data_ora_cateheza));?></td>
        </tr>

        <tr>
          <td class="evident">Ora:</td>
          <td class="evident-date"><?php echo date("H:i", strtotime($data_ora_cateheza));?></td>
        </tr>

        <tr>
          <td class="evident">Nume tată:</td>
          <td class="evident-date"><?php echo $nume_tata . ' ' . $prenume_tata;?></td>
        </tr>

        <tr>
          <td class="evident">Nume mamă:</td> 
          <td class="evident-date"><?php echo $nume_mama . ' ' . $prenume_mama;?></td>
        </tr>

        <tr>
          <td class="evident">Adresă:</td>
          <td class="evident-date"><?php echo $adresa;?></td>
        </tr>

        <tr>
          <td class="evident">Telefon:</td>
          <td class="evident-date"><?php echo $telefon;?></td>
        </tr>

        <tr>
          <td class="evident">Email:
          <td class="evident-date"><?php echo $email;?></td>
        </tr>

        <tr>
          <td class="evident">Nume copil:</td>
          <td class="evident-date"><?php echo $nume_copil . ' ' . $prenume_copil;?></td>
        </tr> 

        <tr>
            <td class="evident"> Nume botez copil:
            <td class="evident-date"><?php echo $nume_botez_copil;?></td>
        </tr>

        <tr>
          <td class="evident">Data nașterii copilului
          <td class="evident-date"><?php echo $data_nasterii_copilului;?></td>
        </tr>
        
        <tr>
          <td class="evident">Număr certificat de naștere:
          <td class="evident-date"><?php echo $numar_certificat_nastere;?></td>
        </tr>
        
        <tr>
          <td class="evident">Data eliberării certificatului:
          <td class="evident-date"><?php echo $data_eliberarii_certificatului;?></td>
        </tr>

        <tr>
          <td class="evident">Eliberat de Primăria:
          <td class="evident-date"><?php echo $eliberat_de_primaria;?></td>
        </tr>

        <tr>
          <td class="evident">Nași:
          <td class="evident-date"><?php echo $nume_nas . ' și ' . $nume_nasa;?></td>
        </tr>

        <tr>
          <td class="evident">Nume cameraman:
          <td class="evident-date"><?php echo $nume_cameraman;?></td>
        </tr>
 
        <?php if (!empty($nume_cameraman)) {?>
          <tr>
            <td class="evident">Nume cameraman:
            <td class="evident-date"><?php echo $nume_cameraman; ?></td>
        </tr>
        <tr>
            <td class="evident">Telefon cameraman:
            <td class="evident-date"><?php echo $telefon_cameraman;?> </td>
        </tr>
       <?php } ?>

       <tr>
        <td class="evident">Carte de identitate tată:</td>

        <td class="evident-date"><?php 
        // if-urile sunt necesare pentru a nu încarca galeria foto imagini goale in lightbox 

        if (!empty($link_tata_ci)) {

        echo '<a target="popup" data-title ="' . basename($link_tata_ci) . '"data-lightbox ="foto_acte" href="' . BASE_URL . $link_tata_ci .'">
        <img src="'. $link_tata_ci . '"/></a>';

        }?></td>
      </tr>

      <tr>
        <td class="evident">Carte de identitate mamă:</td>
        <td><?php 
      if (!empty($link_mama_ci)) {

      echo '<a target="popup" data-title ="' . basename($link_mama_ci) . '"data-lightbox ="foto_acte"  href="'. BASE_URL  . $link_mama_ci .'">
      <img src="' . $link_mama_ci . '"/></a>';

      } ?></td>
      </tr>

      <tr>
        <td class="evident">Plata contribuției:</td>
        <td><?php 
        if (!empty($link_plata_contributiei)) {

        echo '<a target="popup" data-title ="' . basename($link_plata_contributiei) . '"data-lightbox ="foto_acte"  href="'. BASE_URL  . $link_plata_contributiei .'">
        <img src="' . $link_plata_contributiei . '"/></a>';

        }?></td>
      </tr>

      <tr>
        <td class="evident">Certificat de naștere copil:</td>
        <td class="evident-date"><?php 

        if (!empty($link_certificat_nastere_copil)) {

        echo '<a target="popup" data-title ="' . basename($link_certificat_nastere_copil) . '"data-lightbox ="foto_acte"  href="'. BASE_URL  . $link_certificat_nastere_copil .'">
        <img src="' . $link_certificat_nastere_copil . '"/></a>';

        }?></td>
      </tr>

      <tr>
        <td class="evident">Cerere și declarație:</td>
        <td class="evident-date"><a target="popup" href="<?php echo BASE_URL . $link_cerere;?>"> <?php echo basename($link_cerere);?> </a></td>
      </tr>

      
      </table>
      </div>
      
       <?php
    if (empty($succes)) {

      // selectez din db toate mesajele corespunzătoare acestei rezervări

          include "includes/afiseaza-mesaje.php";

      // Formular pentru butonul de "Raspunde cu detalii" 

      echo '<form method="POST" action="raspunde-client.php?id=' . $id_programare . '&eveniment=botez">' .

      '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici un mesaj persoanei care a făcut programarea." style="margin:20px 0" rows="6" cols="10"></textarea>  
      <button type="submit" name ="raspunde" class="btn btn-warning">Trimite mesaj</button>';


      echo "</form>";

     }
}   
?>






</div>

</div>

</div>

</div>


