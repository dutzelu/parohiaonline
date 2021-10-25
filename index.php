<?php 

include 'controllers/authController.php';
include "conexiune.php";

setlocale(LC_ALL, 'ro_RO');
 

$id = $_SESSION['id'];
var_dump ($_SESSION['id']);
$sql = "SELECT * FROM users WHERE id= $id AND admin = 1";
$rezultate = mysqli_query ($conn, $sql);
while ($data = mysqli_fetch_assoc($rezultate)){  
    $admin = $data['admin'];
}

// redirect user to login page if they're not logged in
if (empty($_SESSION['id'])) {
    header('location: index.php');
} elseif (!empty($_SESSION['id']) && $admin == 0) {
    header('location: frontend.php?pentru=botez');
} elseif (!empty($_SESSION['id']) && $admin == 1) {
    header('location: registru.php?eveniment=programari_botez');
}