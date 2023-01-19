<?php
 
if ($eveniment == "Taina Botezului") {
  $eveniment = 'botez';}

if ($eveniment == "Taina Cununiei") {
  $eveniment = 'cununie';}

if ($eveniment == "Sfeștania") {
  $eveniment = 'sfestanie';}
  
if ($eveniment == "Parastas") {
  $eveniment = 'parastas';}

$query = 'SELECT * FROM mesaje WHERE id_programare = ? AND (eveniment = ? AND parohie_id = ?) ORDER BY data_ora ASC ';
 
$stmt = $conn->prepare($query);
$stmt->bind_param('isi', $id_programare, $eveniment, $_SESSION['parohie_id']);
$result = $stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) !== 0) { 

  echo '<ul id="zone_mesaje">';

  while($data = $result->fetch_assoc()) {

    $mesaj = $data['mesaj'];
    $data_mesajului = strftime('%e %b %Y',strtotime($data["data_ora"]));
    $ora_mesajului  = date("H:m", strtotime($data["data_ora"]));
    $trimis_de = $data['trimis_de'];

    echo "<li>";
    echo '<p><span>' . $data_mesajului . ' | ' . $ora_mesajului . '<br /></span>';
    echo  '<strong>' . $trimis_de . ':</strong></p>';
    echo '<p>' . $mesaj . '<br /><hr style="border-top:2px dotted #CCC"/>' ;
    echo "</li>";

  }

  echo '</ul>';
  
}
