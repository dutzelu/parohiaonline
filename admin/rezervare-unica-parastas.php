<?php include "header-admin.php"; 

$user_id = $_SESSION['id'];
?>


<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>

  
        <div class="mt-3 p-5 wrapper-rezervare-unica">

<?php


 


  if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
  }

 
  if (isset($_GET['status'])) {
  
    $status = $_GET['status'];
    $query = 'UPDATE programari_parastas SET status = ? WHERE id=? AND parohie_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sii', $status, $id_programare, $id);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    
  } 


$query = 'SELECT * FROM programari_parastas WHERE id = ? AND parohie_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $id);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

  include "../includes/extras-programare-parastas.php";

  echo "<p>";
                  echo '<span class="nume">' . $nume . ' ' . $prenume . "</span>"; 
               
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

              echo '<a href="registru.php?eveniment=programari_parastas"><i class="fas fa-chevron-circle-left"></i> Înapoi</a> ';

              echo '<a href="accepta-programare-parastas.php?id=' . $id_programare . '&status=acceptata" role="button"><i class="verde far fa-check-circle"></i>  Acceptă</a>';

              echo '<a href="rezervare-unica-parastas.php?id=' . $id_programare . '&status=respinsa" role="button" ><i class="orange fas fa-backspace"></i> Respinge</a>';?>

              <a href="actiuni.php?eveniment=programari_parastas&stergeid=<?php echo $id_programare; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
              <i class="rosu fas fa-trash-alt"></i> Șterge</a>

              <?php
              
            
             
            echo '</p>';

 

  
    echo '   
    
    <div class="tabel-rezervare view">
    
    <hr />';

    if (isset($_GET['edit'])) { 
      echo '<p id ="dispari" class="btn btn-success"> Rezervarea a fost editată cu succes</p>' ;
    } 
    
    echo '<p><span class="cap">Nume mire: </span>' . $nume . '</p>';
    echo '<p><span class="cap">Nume mireasă: </span>' . $prenume . '</p>';
    echo '<p><span class="cap">Telefon: </span>' . $telefon . '</p>';
    echo '<p><span class="cap">Email: </span>' . $email . '</p>';

}   
 
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

