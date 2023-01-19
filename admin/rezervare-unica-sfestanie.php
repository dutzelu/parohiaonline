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
    $query = 'UPDATE programari_sfestanie SET status = ? WHERE id=? AND parohie_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sii', $status, $id_programare, $id);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    
  } 


$query = 'SELECT * FROM programari_sfestanie WHERE id = ? AND parohie_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $id);
$result = $stmt->execute();
$result = $stmt->get_result();

echo '<p class="inapoi"><a href="registru.php?eveniment=programari_sfestanie"><i class="fas fa-chevron-circle-left"></i> Înapoi</a></p> ';

while($data = $result->fetch_assoc()) {

  include "../includes/extras-programare-sfestanie.php";

  echo "<p>";
                  echo '<span class="nume">' . $nume . ' ' . $prenume . "</span>"; 
               
                  echo "<br>";
                  
                  echo ' <span class="albastru-inchis">' . $eveniment . ' </span>';
                  
                  echo "<br>";

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

                <p class="butoane">

                  <a href="accepta-programare-sfestanie.php?id=<?php echo $id_programare;?>&status=acceptata" role="button" class="btn btn-success">Acceptă</a>
                  
                  <a href="rezervare-unica-sfestanie.php?id=<?php echo $id_programare;?>&status=respinsa" role="button" class="btn btn-danger">Respinge</a>

                  <a href="actiuni.php?eveniment=programari_sfestanie&data=<?php echo date("Y-m-d", strtotime($data_si_ora)); ?>&stergeid=<?php echo $id_programare; ?>" class="sterge btn btn-outline-secondary" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');" role="button" >Șterge</a>


                  <?php  }?>

                </p>
              
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

        include "../includes/afiseaza-mesaje.php";

    // Formular pentru butonul de "Raspunde cu detalii" 

    echo '<form method="POST" action="raspunde-cu-detalii.php?id=' . $id_programare . '&eveniment=sfestanie">' .

    '<textarea name="mesaj" class="form-control" placeholder = "Scrieți aici mesajul dumneavoastră." style="margin:20px 0" rows="6" cols="10"></textarea>  
    <button type="submit" name ="raspunde" class="btn btn-warning">Trimite mesaj</button>';


    echo "</form>";

   }
?>






</div>

</div>

</div>

</div>

