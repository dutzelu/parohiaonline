<?php include "header-admin.php"; 

$user_id = $_SESSION['parohie_id'];

if(isset ($_GET['id'])) {
    $id_pomelnic = $_GET['id'];
}
?>


<div class="container-fluid">

    <div class="row">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>

  
        <div class="mt-3 wrapper-rezervare-unica">

<?php


$query = 'SELECT * FROM pomelnice WHERE id = ? ORDER BY id DESC';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_pomelnic);
$result = $stmt->execute();
$result = $stmt->get_result();


while($data = $result->fetch_assoc()) {

  include "../includes/extras-pomelnic.php";

      echo '<p><span class="nume">' . $nume_si_prenume . "</span></p>"; 
            
 ;?>


              <?php  
              echo '<p class="butoane">';
              echo '<a href="pomelnice.php"><i class="fas fa-chevron-circle-left" style="margin:0"></i> Înapoi</a> ';

              echo '<a href="" onclick="window.print()"><i class="fas fa-print"></i> Print</a></p>';
    ?>

    <div class="tabel-responsive">
              
              <table class='table rezervare-unica'>
                  
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>

                <tr>
                  <td class="evident">Tip pomelnic: </td>
                  <td class="evident-date"><?php 
                      if ($data['tip_pomelnic'] == "1") {
                          echo "Liturghie (vii)";
                      } elseif ($data['tip_pomelnic'] == "2") {
                        echo "Liturghie (adormiți)";
                      } elseif ($data['tip_pomelnic'] == "3") {
                        echo "Maslu";
                      } elseif ($data['tip_pomelnic'] == "4") {
                        echo "Acatist";
                      } elseif ($data['tip_pomelnic'] == "5") {
                        echo "Parastas";
                      }
                  ?></td>
                 </tr>    
 
                <tr>
                  <td class="evident">Listă nume:</td>
                  <td class="evident-date"><?php echo $lista_nume;?></td>
                </tr>
    
 
                <tr>
                  <td class="evident">Durată în zile:</td>
                  <td class="evident-date"><?php echo $durata_in_zile;?></td>
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
                  <td class="evident">Data începerii:</td>
                  <td class="evident-date"><?php echo date("d.m.Y", strtotime($data['data_inceperii']));?></td>
                </tr>
 
                <tr>
                  <td class="evident">Donație:</td>
                  <td class="evident-date"><?php 
                      if ($data['cu_donatie'] == 1) {
                        echo '<span class="verde"><i class="fas fa-check"></i> Da </span>';
                    } elseif  ($data['cu_donatie'] == 0) {echo '-';}
                  ?></td>
                </tr>
 
                </table>
              </div>
  
        <?php } ?>






</div>

</div>

</div>

</div>

