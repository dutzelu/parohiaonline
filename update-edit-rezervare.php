<?php

include "header-frontend.php"; 
// include "sidebar-frontend.php"; 
include "functions.php";

if (isset($_GET['id'])) {
    $id_programare = $_GET['id'];
}

$query = "SELECT * FROM programari_botez WHERE id = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_programare);
$result = $stmt->execute();
$result = $stmt->get_result();

while($data = $result->fetch_assoc()) {

    $link_tata_ci = $data['link_tata_ci'];
    $link_mama_ci = $data['link_mama_ci'];
    $link_plata_contributiei = $data['link_plata_contributiei'];
    $link_certificat_nastere_copil = $data['link_certificat_nastere_copil'];
}


if (isset($_POST['actualizeaza'])) {

    $eveniment = $_POST['eveniment'];
    $data_simpla = $_POST['data_simpla'];
    $nume_tata = $_POST['nume_tata'];
    $prenume_tata = $_POST['prenume_tata'];
    $nume_si_prenume_tata = $nume_tata . '-' . $prenume_tata;

    $nume_mama = $_POST['nume_mama'];
    $prenume_mama = $_POST['prenume_mama'];
    $nume_si_prenume_mama = $nume_mama . '-' . $prenume_mama;
 
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];

    $nume_copil = $_POST['nume_copil'];
    $prenume_copil = $_POST['prenume_copil'];
    $nume_si_prenume_copil = $nume_copil . '-' . $prenume_copil;

    $data_nasterii_copilului = $_POST['data_nasterii_copilului'];
    $numar_certificat_nastere = $_POST['numar_certificat_nastere'];
    $data_eliberarii_certificatului = $_POST['data_eliberarii_certificatului'];
    $eliberat_de_primaria = $_POST['eliberat_de_primaria'];
    $nume_botez_copil = $_POST['nume_botez_copil'];
    $nume_nas = $_POST['nume_nas'];
    $nume_nasa = $_POST['nume_nasa'];
    $localitate_nasi = $_POST['localitate_nasi'];
    $nume_cameraman = $_POST['nume_cameraman'];
    $telefon_cameraman = $_POST['telefon_cameraman'];

    if (!empty($link_tata_ci)) {$target_dir =  dirname ($link_tata_ci);}
    elseif (!empty($link_mama_ci)) {$target_dir =  dirname ($link_mama_ci);}
    elseif (!empty($link_plata_contributiei)) {$target_dir =  dirname ($link_plata_contributiei);}
    elseif (!empty($link_certificat_nastere_copil)) {$target_dir =  dirname ($link_certificat_nastere_copil);} 
         else {
                $target_dir = 'rezervari/' . $data_simpla . '-'. $eveniment . '-' . replaceSpecialChars($nume_si_prenume_mama);
                $target_dir = preg_replace('/\s+/', '-', $target_dir);
              }

    
    
    if( isset($_FILES['tata_ci']) ){
        $errors1= array();

        $file_name = $_FILES['tata_ci']['name'];
        $file_size = $_FILES['tata_ci']['size'];
        $file_tmp = $_FILES['tata_ci']['tmp_name'];
        $file_type = $_FILES['tata_ci']['type'];
        $file_ext= strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

        $file_name = 'copie_ci_' . replaceSpecialChars(preg_replace('/\s+/', '-', $nume_si_prenume_tata)) . '.' . $file_ext;

        $extensions= array("jpeg","jpg","png", "");
        if(in_array($file_ext,$extensions)=== false){
        $errors1[]="Acceptăm doar fotografii în format JPEG, JPG sau PNG";
        }
        
        if($file_size > 10485760) {
        $errors1[]='Dimensiunea fișierului trebuie să fie de maxim 10 MB';
        }
        
        if(empty($errors1)==true) {
        move_uploaded_file($file_tmp, $target_dir .'/'.$file_name);
        } else{print_r($errors1);}

        if ($file_size !== 0 && empty($errors1)==true ) {
        $link_tata_ci = $target_dir .'/'.$file_name; }
        

    } else {unset($errors1); }



    if( isset($_FILES['mama_ci']) ){
        $errors1= array();
        $file_name = $_FILES['mama_ci']['name'];
        $file_size = $_FILES['mama_ci']['size'];
        $file_tmp = $_FILES['mama_ci']['tmp_name'];
        $file_type = $_FILES['mama_ci']['type'];
        $file_ext= strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

        $file_name = 'copie_ci_' . replaceSpecialChars(preg_replace('/\s+/', '-', $nume_si_prenume_mama)) . '.' . $file_ext;
        

        $extensions= array("jpeg","jpg","png", "");
        if(in_array($file_ext,$extensions)=== false){
        $errors1[]="Acceptăm doar fotografii în format JPEG, JPG sau PNG";
        }
        
        if($file_size > 10485760) {
        $errors1[]='Dimensiunea fișierului trebuie să fie de maxim 10 MB';
        }
        
        if(empty($errors1)==true) {
        move_uploaded_file($file_tmp, $target_dir .'/'.$file_name);
        } else{print_r($errors1);}

        if ($file_size !== 0 && empty($errors1)==true ) {
        $link_mama_ci = $target_dir .'/'.$file_name; }
        

    } else {unset($errors2); }


    
    if( isset($_FILES['plata_contributiei']) ){
        $errors1= array();
        $file_name = $_FILES['plata_contributiei']['name'];
        $file_size = $_FILES['plata_contributiei']['size'];
        $file_tmp = $_FILES['plata_contributiei']['tmp_name'];
        $file_type = $_FILES['plata_contributiei']['type'];
        $file_ext= strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

        $file_name = 'plata_contributiei_' . replaceSpecialChars(preg_replace('/\s+/', '-', $nume_si_prenume_mama)) . '.' . $file_ext;
        
        

        $extensions= array("jpeg","jpg","png", "");
        if(in_array($file_ext,$extensions)=== false){
        $errors1[]="Acceptăm doar fotografii în format JPEG, JPG sau PNG";
        }
        
        if($file_size > 10485760) {
        $errors1[]='Dimensiunea fișierului trebuie să fie de maxim 10 MB';
        }
        
        if(empty($errors1)==true) {
        move_uploaded_file($file_tmp, $target_dir .'/'.$file_name);
        } else{print_r($errors1);}

        if ($file_size !== 0 && empty($errors1)==true ) {
        $link_plata_contributiei = $target_dir .'/'.$file_name; }
        

    } else {unset($errors3); }


    
    if( isset($_FILES['certificat_nastere_copil']) ){
        $errors1= array();
        $file_name = $_FILES['certificat_nastere_copil']['name'];
        $file_size = $_FILES['certificat_nastere_copil']['size'];
        $file_tmp = $_FILES['certificat_nastere_copil']['tmp_name'];
        $file_type = $_FILES['certificat_nastere_copil']['type'];
        $file_ext= strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

        $file_name = 'certificat_nastere_copil_' . replaceSpecialChars($nume_si_prenume_copil). '.' . $file_ext;

        $extensions= array("jpeg","jpg","png", "");
        if(in_array($file_ext,$extensions)=== false){
        $errors1[]="Acceptăm doar fotografii în format JPEG, JPG sau PNG";
        }
        
        if($file_size > 10485760) {
        $errors1[]='Dimensiunea fișierului trebuie să fie de maxim 10 MB';
        }
        
        if(empty($errors1)==true) {
        move_uploaded_file($file_tmp, $target_dir .'/'.$file_name);
        } else{print_r($errors1);}

        if ($file_size !== 0 && empty($errors1)==true ) {
        $link_certificat_nastere_copil = $target_dir .'/'.$file_name; }
        

    } else {unset($errors4); }

  

    $query = 'UPDATE programari_botez 
    SET 

    nume_tata=?,
    prenume_tata=?,
    nume_mama=?,
    prenume_mama=?,
    adresa=?,
    telefon=?,
    email=?,
    nume_copil=?,
    prenume_copil=?,
    data_nasterii_copilului=?,
    numar_certificat_nastere=?,
    data_eliberarii_certificatului=?,
    eliberat_de_primaria=?,
    nume_botez_copil=?,
    nume_nas=?,
    nume_nasa=?,
    localitate_nasi=?,  
    nume_cameraman=?,
    telefon_cameraman=?,
    link_tata_ci=?,
    link_mama_ci=?,
    link_plata_contributiei=?,
    link_certificat_nastere_copil=?

    WHERE id = ?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('sssssssssssssssssssssssi', $nume_tata, $prenume_tata, $nume_mama, $prenume_mama, $adresa, $telefon, $email, $nume_copil, $prenume_copil, $data_nasterii_copilului, $numar_certificat_nastere, $data_eliberarii_certificatului, $eliberat_de_primaria, $nume_botez_copil, $nume_nas, $nume_nasa, $localitate_nasi, $nume_cameraman, $telefon_cameraman, $link_tata_ci, $link_mama_ci, $link_plata_contributiei, $link_certificat_nastere_copil, $id_programare);
    $result = $stmt->execute();




    

}


$user_id = $_SESSION['id'];

$query = 'SELECT * FROM users WHERE id = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$result = $stmt->execute();
$result = $stmt->get_result();

while($data = $result->fetch_assoc()) {

    $admin = $data['admin'];
 
    if ($admin == 0) {
        header ('Location:home-unic.php?id=' . $id_programare . '&edit=ok');
    } elseif ($admin == 1) {
        header ('Location:rezervare-unica.php?id=' . $id_programare . '&edit=ok');
    }
    

    }














?>