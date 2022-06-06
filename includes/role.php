<?php

 
$admin = '';
$id_user = $user_id;

$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_user);
$result = $stmt->execute();
$result = $stmt->get_result();

while ($data = mysqli_fetch_assoc($result)){  
    $admin = $data['admin'];
}

if ($admin == 0) {
    header('HTTP/1.0 403 Forbidden');
    echo '<script> location.replace("../eroare-404.php"); </script>';
}


?>