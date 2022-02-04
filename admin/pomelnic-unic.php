<?php include "header-admin.php"; 

$user_id = $_SESSION['id'];

if(isset ($_GET['id'])) {
    $id_pomelnic = $_GET['id'];
}
?>


<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>

  
        <div class="mt-3 p-5 wrapper-rezervare-unica">

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
    
    echo '   
    
    <div class="tabel-rezervare view">
    
    <hr />';

 
    echo '<p><span class="cap">Tip pomelnic: </span>'; 
    
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
    }; echo '' . '</p>';

    echo '<p> <div class="m-3">' . $lista_nume . '</div></p>';
    echo '<p><span class="cap">Durată în zile: </span>' . $durata_in_zile. '</p>';

    echo '<p><span class="cap">Telefon:  </span>' . $telefon . '</p>';
    echo '<p><span class="cap">Email:  </span>' . $email . '</p>';
    echo '<p><span class="cap">Data începerii:  </span>' . date("d.m.Y", strtotime($data['data_inceperii'])) . '</p>';
    echo '<p><span class="cap">Donație:  </span>';
    
    if ($data['cu_donatie'] == 1) {
        echo '<span class="verde"><i class="fas fa-check"></i> Da </span>';
    } elseif  ($data['cu_donatie'] == 0) {
        echo '-';
    }
    
    echo '</p>';
 

    echo "</div>";
    echo '<p></p><hr>';

  
     
}   
?>






</div>

</div>

</div>

</div>

