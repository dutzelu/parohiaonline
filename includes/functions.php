<?php

if (isset($_GET['status'])) {
  $status = $_GET['status'];
} else {$status = '';}


switch ($status) {

      case '': 
        $clasa_accept = 'bg-primary'; 
        $status_accept_afisat = "Programare în curs de evaluare";
        $color = '#0d6efd';
      break;
    
      case 'acceptata': 
        $clasa_accept = 'bg-success'; 
        $status_accept_afisat = "Programare acceptată"; 
        $color = '#198754';
      break;
    
      case 'detalii': 
        $clasa_accept = 'bg-warning';
        $status_accept_afisat = "Cererea necesită detalii suplimentare"; 
        $color = '#ffc107';
      break;
    
      case 'respinsa': 
        $clasa_accept = 'bg-danger';
        $status_accept_afisat = "Programare respinsă"; 
        $color = '#dc3545';
      break;
      
    }


function ore_pentru_select($nume) {
    $start = "00:00";
    $end = "23:30";

    $tStart = strtotime($start);
    $tEnd = strtotime($end);
    $tNow = $tStart;
    echo '<select name="' . $nume . '" class="form-select">';
    while($tNow <= $tEnd){
        echo '<option value="'.date("H:i:s",$tNow).'" >'.date("H:i",$tNow).'</option>';
        $tNow = strtotime('+30 minutes',$tNow);
    }
    echo '</select>';
}


function create_time_range($start, $end, $interval = '60 mins', $format = '24') {
    $startTime = strtotime($start); 
    $endTime   = strtotime($end);
    $returnTimeFormat = ($format == '24')?'H:i':'H:i';

    $current   = time(); 
    $addTime   = strtotime('+'.$interval, $current); 
    $diff      = $addTime - $current;

    $times = array(); 
    while ($startTime < $endTime) { 
        $times[] = date($returnTimeFormat, $startTime); 
        $startTime += $diff; 
    } 
    $times[] = date($returnTimeFormat, $startTime); 
    return $times; 
}

function replaceSpecialChars($string){

    // caractere care trebuie inlocuite cu cele din $add (in aceeasi ordine)
    $rem = array('ă', 'Ă', 'ș', 'Ș', 'ț', 'Ț', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ð', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', '§', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', '€', 'Ð', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', '§', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'Ÿ',
  // aceleasi caractere, dar ca entitati HTML
  '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', '&egrave;', '&eacute;', '&ecirc;', '&euml;', '&eth;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&ntilde;', '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&oslash;', '&sect;', '&ugrave;', '&uacute;', '&ucirc;', '&uuml;', '&yacute;', '&yuml;', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&euro;', '&ETH;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&Ntilde;', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;', '&Ouml;', '&Oslash;', '&sect;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', '&Yuml;');
  
    // caractere care vor fi adaugate
    $add = array('a', 'A', 's', 'S', 't', 'T', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'ed', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 's', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'EUR', 'ED', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'S', 'U', 'U', 'U', 'U', 'Y', 'Y',
  // pentru inlocuit entitatile HTML
  'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'ed', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 's', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'EUR', 'ED', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'S', 'U', 'U', 'U', 'U', 'Y', 'Y');
  
      return str_replace($rem, $add, $string);
  }


function upload_foto($input, $nume_fisier, $link) {

    if( isset($_FILES[$input]) ){

      global $target_dir;
      global $target_dir_www;
      global $link_tata_ci;
      global $link_mama_ci;
      global $eveniment;
      global $link_mire_ci;
      $errors= array();

      $file_name = $_FILES[$input]['name'];
      $file_size = $_FILES[$input]['size'];
      $file_tmp = $_FILES[$input]['tmp_name'];
      $file_type = $_FILES[$input]['type'];
      $file_ext= strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

      $file_name = $input . '-' . replaceSpecialChars(preg_replace('/\s+/', '-', $nume_fisier)) . '.' . $file_ext;

      if($file_size > 10485760) {
      $errors[]='Dimensiunea fișierului trebuie să fie de maxim 10 MB';
      }
      
      if(empty($errors)==true) {
      move_uploaded_file($file_tmp, $target_dir .'/'.$file_name);
      } 

      if ($file_size !== 0 && empty($errors)==true ) {
        $GLOBALS[$link] = $target_dir_www .'/'.$file_name; 
      }
      
    
       
    } else {unset($errors); }

}
 

function hideEmailAddress($email) {

    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        list($first, $last) = explode('@', $email);
        $first = str_replace(substr($first, '3'), str_repeat('*', strlen($first)-3), $first);
        $last = explode('.', $last);
        $last_domain = str_replace(substr($last['0'], '1'), str_repeat('*', strlen($last['0'])-1), $last['0']);
        $hideEmailAddress = $first.'@'.$last_domain.'.'.$last['1'];
        return $hideEmailAddress;
    }
}


function sterge_programare_user ($eveniment, $sterge_id, $user_id, $slujba, $parohie_id) {

      global $conn;
      global $data_programarii;
     
      $sql="DELETE FROM $eveniment WHERE id = ? AND user_id = ?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "ii", $sterge_id, $user_id);
      mysqli_stmt_execute($stmt);

      $query="UPDATE zile_stabilite
      SET libere = libere + 1, rezervari = rezervari - 1
      WHERE tip_programare = ? AND (data_start LIKE ? AND parohie_id = ?) ";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $query);
      $data_programarii = '%' . $data_programarii . '%';
      mysqli_stmt_bind_param($stmt, "ssi", $slujba, $data_programarii, $parohie_id);
      mysqli_stmt_execute($stmt);

      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

      // adaug la zile stabilite 1 rezervare în plus

}

function sterge_programare_parohie ($tip_programare, $sterge_id, $parohie_id, $slujba) {

      global $conn;
      global $data_programarii;
      global $id;
      // $id este setat ca id-ul parohiei în header-admin.php
      $parohie_id = $id;
     
      $sql="DELETE FROM $tip_programare WHERE id = ? AND parohie_id = ?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, "ii", $sterge_id, $parohie_id);
      mysqli_stmt_execute($stmt);

      $query="UPDATE zile_stabilite
      SET libere = libere + 1, rezervari = rezervari - 1
      WHERE tip_programare = ? AND (data_start LIKE ? AND parohie_id = ?) ";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $query);
      $data_programarii = '%' . $data_programarii . '%';
      mysqli_stmt_bind_param($stmt, "ssi", $slujba, $data_programarii, $parohie_id);
      mysqli_stmt_execute($stmt);

      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

      // adaug la zile stabilite 1 rezervare în plus

}

// afla nume utilizator

function nume_user ($user_id) {

  global $conn;

  $sql="Select * FROM users WHERE id = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  $rezultat = mysqli_stmt_get_result($stmt);
  while ($data = mysqli_fetch_assoc($rezultat)) {
      echo $data['nume'] . ' ' . $data['prenume'];
  }

}

// afla dacă e blocat

function user_blocat ($user_id) {

  global $conn;
  global $user_blocat;

  $sql="Select * FROM users WHERE id = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  $rezultat = mysqli_stmt_get_result($stmt);
  while ($data = mysqli_fetch_assoc($rezultat)) {
     $user_blocat = $data['blocat'];
  }

}