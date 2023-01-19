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
    $query = 'UPDATE programari_spovedanie SET status = ? WHERE id=? AND parohie_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sii', $status, $id_programare, $id);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    
  } 


$query = 'SELECT * FROM programari_spovedanie WHERE id = ? AND parohie_id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id_programare, $id);
$result = $stmt->execute();
$result = $stmt->get_result();

echo '<p class="inapoi"><a href="registru.php?eveniment=programari_spovedanie"><i class="fas fa-chevron-circle-left"></i> Înapoi</a></p> ';

while($data = $result->fetch_assoc()) {

  include "../includes/extras-programare-spovedanie.php";

  // afisez detaliile cererii (programarii)

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

                <a href="accepta-programare-spovedanie.php?id=<?php echo $id_programare;?>&status=acceptata" role="button" class="btn btn-success">Acceptă</a>
                  
                <a href="rezervare-unica-spovedanie.php?id=<?php echo $id_programare;?>&status=respinsa" role="button" class="btn btn-danger">Respinge</a>
              
                <a href="actiuni.php?eveniment=programari_spovedanie&data=<?php echo date("Y-m-d", strtotime($data_si_ora)); ?>&stergeid=<?php echo $id_programare; ?>" class="sterge btn btn-outline-secondary" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');" role="button" >Șterge</a>

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

            </table>
            </div>

  

</div>

</div>

</div>

</div>

