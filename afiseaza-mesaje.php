<?php

if ($eveniment == "Taina Botezului") {
  $eveniment = 'botez';}

if ($eveniment == "Taina Cununiei") {
  $eveniment = 'cununie';}
  

$query =

'SELECT user_id, mesaj, data_ora, nume, prenume FROM mesaje LEFT JOIN users ON mesaje.user_id = users.id WHERE id_programare = ? AND eveniment = ? ORDER BY data_ora ASC 
';

$stmt = $conn->prepare($query);
$stmt->bind_param('is', $id_programare, $eveniment);
$result = $stmt->execute();
$result = $stmt->get_result();

if (mysqli_num_rows($result) !== 0) { 

  echo '<ul id="zone_mesaje">';

  while($data = $result->fetch_assoc()) {

    $mesaj = $data['mesaj'];
    $data_mesajului = $data['data_ora'];
    $nume_user = $data['nume'];
    $prenume_user = $data['prenume'];

    echo "<li>";
    echo '<p><span style="color:#007bff">' . $data_mesajului . '<br />';
    echo  'Mesaj de la ' . $nume_user . ' ' . $prenume_user . ':</span></p>';
    echo '<p>' . $mesaj . '<br /><hr style="border-top:2px dotted #CCC"/>' ;
    echo "</li>";

  }

  echo '</ul>';

}
