<?php

include "header-admin.php"; 

$date=(array)NULL;
$ziua_saptamanii = (array)NULL;
$slujba = (array)NULL;
$text_optional =  (array)NULL;
$alte_observatii =  (array)NULL;
$ora_start =  (array)NULL;

if (isset($_POST['salveazaProgram'])) {

    $jsondata = json_encode($_POST, JSON_UNESCAPED_UNICODE);

}

 

$query = 'INSERT INTO programul_slujbelor (nume, program, status, parohie_id) VALUES (?,?,?,?)';

$role=0;
$stmt = $conn->prepare($query);
$stmt->bind_param('ssii', $_POST['nume_program'], $jsondata, $role, $id);
$result = $stmt->execute();
$result = $stmt->get_result();


    
echo '<script> location.replace("program-liturgic.php?adaugat=ok"); </script>';
