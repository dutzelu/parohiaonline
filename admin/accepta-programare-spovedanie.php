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
  $query = 'UPDATE programari_spovedanie SET status = ? WHERE id=? ';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $status, $id);
  $result = $stmt->execute();
  $result = $stmt->get_result();
  
} 

if ( isset ($_GET['backpage']) ) {
    $page_no = $_GET['backpage'];
    echo '<script> location.replace("registru.php?eveniment=programari_spovedanie&page_no=' . $page_no .  '"); </script>';
}

if ( isset ($_GET['back']) ) {
    echo '<script> location.replace("admin.php#accepta' . $id . '"); </script>';
}

?>

<script> location.replace("rezervare-unica-spovedanie.php?id=<?php echo $id; ?>"); </script>