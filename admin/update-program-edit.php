<?php
$program_json = NULL;
include "header-admin.php";

if (isset($_GET['idprog'])) {
    $id_selectat = $_GET['idprog'];
} 
$query = "Select * From programul_slujbelor Where id = ?;";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_selectat);
$rezultat = $stmt->execute();
$rezultat = $stmt->get_result();
$rowcount = mysqli_num_rows($rezultat);

while ($data = mysqli_fetch_assoc($rezultat)) {
    
    $program_json = $data['program'];
    $prog_decod = json_decode($program_json);
}
$data = json_decode($program_json, true);
$i = (count($data)-2)/5;


if (isset($_POST['editeaza'])) {

        for ($x=1; $x <= $i; $x++) {
// var_dump($_POST);
            $ziua_saptamanii = 'ziua_saptamanii'. $x;
            $slujba = 'slujba'. $x;
            $text_optional = 'text_optional'. $x;
            $alte_observatii = 'alte_observatii'. $x;
            $ora_start = 'ora_start'. $x;

            // var_dump($ziua_saptamanii);
            // echo "<br>";
            // var_dump($slujba);
            // echo "<br>";
            // var_dump($text_optional);
            // echo "<br>";
            // var_dump($alte_observatii);
            // echo "<br>";
            // var_dump($ora_start);
            // echo "<br>";
            // echo "<br>";
            
            $ziua_saptamanii_y = '"$.ziua_saptamanii' . $x . '"';
            $slujba_y = '"$.slujba' . $x . '"';
            $text_optional_y = '"$.text_optional' . $x . '"';
            $alte_observatii_y = '"$.alte_observatii' . $x . '"';
            $ora_start_y = '"$.ora_start' . $x . '"';
            
            // var_dump($ziua_saptamanii_y);
            // echo "<br>";
            // var_dump($slujba_y);
            // echo "<br>";
            // var_dump($text_optional_y);
            // echo "<br>";
            // var_dump($alte_observatii_y);
            // echo "<br>";
            // var_dump($ora_start_y);
            // echo "<br>";

            $z= '"' . $_POST[$ziua_saptamanii] . '"';
            $s = '"' . $_POST[$slujba] . '"';
            $t = '"' . $_POST[$text_optional] . '"';
            $a = '"' . $_POST[$alte_observatii] . '"';
            $o = '"' . $_POST[$ora_start] . '"';
            $nume_program = $_POST['nume_program'];

            // var_dump($z);
            // echo "<br>";
            // var_dump($s);
            // echo "<br>";
            // var_dump($t);
            // echo "<br>";
            // var_dump($a);
            // echo "<br>";
            // var_dump($o);
            // echo "<br>";
            // echo "<br>";

            $query = 'UPDATE programul_slujbelor  SET program = JSON_SET(program,' . $ziua_saptamanii_y . ',' . $z . ',' . $slujba_y . ',' . $s . ',' . $text_optional_y . ',' . $t . ',' . $alte_observatii_y . ',' . $a . ',' . $ora_start_y . ',' . $o . '), nume = "' . $nume_program . '" ' . 'WHERE id = ' . $id_selectat;

            // var_dump ($query);

            // $query = 'UPDATE programul_slujbelor 
            // SET program = JSON_SET(program, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            // WHERE id = ?;';


            $stmt = $conn->prepare($query);
            // $stmt->bind_param('ssssssssssi', $ziua_saptamanii_y, $z, $slujba_y, $s, $text_optional_y, $t, $alte_observatii_y, $a, $ora_start_y, $o,  $id_selectat);
            $result = $stmt->execute();
            // $result = $stmt->get_result();



        }


}

echo '<script> location.replace("program-liturgic.php?idprog=' . $id_selectat . '"); </script>';


