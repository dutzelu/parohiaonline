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

 

$query = 'INSERT INTO programul_slujbelor (nume, program, status) VALUES (?,?,?)';

$role=0;
$stmt = $conn->prepare($query);
$stmt->bind_param('ssi', $_POST['nume_program'], $jsondata, $role);
$result = $stmt->execute();
$result = $stmt->get_result();

// var_dump($_POST);
    
echo '<script> location.replace("programul-slujbelor.php?adaugat=ok"); </script>';
