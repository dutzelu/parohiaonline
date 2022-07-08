<?php include "header-frontend.php"; ?>


<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">

        <?php include "header-mic-frontend.php";?>

  
        <div class="mt-3 wrapper-rezervare-unica">

<?php


  if (isset($_GET['succes'])) { 
    echo '<h1 class="h1">Cererea ta de programare online s-a finalizat cu succes. În cel mai scurt timp vei primi un EMAIL privind starea cererii tale de programare. Dacă este cazul, ți se vor solicita detalii suplimentare. Dacă dorești să ceri lămuriri suplimentare privind cererea ta de programare făcută, te rugăm să suni la numărul de telefon 0744.185.581 sau să trimiți un mesaj la paroh@sfantulambrozie.ro</h1>'
    ;
    $succes = $_GET['succes'];
  } else $succes = '';


  if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
  }



$query = 'SELECT * FROM programari_sfestanie WHERE id = ? AND user_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $user_id);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

    include "includes/extras-programare-sfestanie.php";

    echo "<p>";


        echo '<span class="nume">' . $data['nume'] . ' ' . $data['prenume'] . "</span>"; 
      

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

        echo '<a href="home-sfestanie.php"><i class="fas fa-chevron-circle-left"></i> Înapoi</a> ';

        ?>

          <a href="sterge.php?eveniment=programari_sfestanie&data=<?php echo date("Y-m-d", strtotime($data_si_ora)); ?>&stergeid=<?php echo $id_programare; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
          <i class="rosu fas fa-trash-alt"></i> Șterge</a>
          

        <?php
                    
    echo '</p>';

    
  }?>
  
              
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
        <td class="evident">Nume: </td>
        <td class="evident-date"><?php echo $nume;?></td>
      </tr>

      <tr>
        <td class="evident">Prenume:</td>
        <td class="evident-date"><?php echo $prenume;?></td>
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
        <td class="evident">Mesaj:
        <td class="evident-date"><?php echo $mesaj;?></td>
      </tr>

    </table>
    </div>


<?php
    
if (empty($succes)) {

    // selectez din db toate mesajele corespunzătoare acestei rezervări

        include "includes/afiseaza-mesaje.php";

    // Formular pentru butonul de "Raspunde cu detalii" 

    echo '<form method="POST" action="raspunde-client.php?id=' . $id_programare . '&eveniment=sfestanie">' .

    '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici mesajul dumneavoastră." style="margin:20px 0" rows="6" cols="10"></textarea>  
    <button type="submit" name ="raspunde" class="btn btn-warning">Trimite mesaj</button>';


    echo "</form>";

   }
?>







</div>

</div>

</div>

</div>


