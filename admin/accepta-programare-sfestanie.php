<?php
include "header-admin.php"; 
$mesaj_email_admin = "";
$name = "";
$from = "";
$data_si_ora = NULL;
$data_ora_cateheza = NULL;
$nume_mire = NULL;
$prenume_mire = NULL;

if (isset($_GET['id'])) {$id = $_GET['id'];} 

// modific in baza de date statusul cererii (programarii), daca e cazul
if (isset($_GET['status'])) {

  $status = $_GET['status'];
  $query = 'UPDATE programari_sfestanie SET status = ? WHERE id=? ';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $status, $id);
  $result = $stmt->execute();
  $result = $stmt->get_result();
  
} 


?>

<script> location.replace("rezervare-unica-sfestanie.php?id=<?php echo $id; ?>"); </script>