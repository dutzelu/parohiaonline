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

// afla dacă userul e blocat

function detalii_user ($user_id) {

  global $conn, $user_blocat, $nume_user, $prenume_user;

  $sql="Select * FROM users WHERE id = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  $rezultat = mysqli_stmt_get_result($stmt);
  while ($data = mysqli_fetch_assoc($rezultat)) {
     $user_blocat = $data['blocat'];
     $nume_user = $data['nume'];
     $prenume_user = $data['prenume'];
  }

}

function detalii_parohie ($parohie_id) {

  global $conn, $nume_parohie, $localitatea_parohiei, $hramul_bisericii, $adresa_bisericii, $telefonul_parohiei, $emailul_parohiei, $preot_paroh;

  $sql="Select * FROM parohii WHERE id = ?";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $sql);
  mysqli_stmt_bind_param($stmt, "i", $parohie_id);
  mysqli_stmt_execute($stmt);
  $rezultat = mysqli_stmt_get_result($stmt);
  while ($data = mysqli_fetch_assoc($rezultat)) {
     $nume_parohie = $data['nume_parohie'];
     $localitatea_parohiei = $data['localitatea'];
     $hramul_bisericii = $data['hramul_bisericii'];
     $adresa_bisericii = $data['adresa_bisericii'];
     $telefonul_parohiei = $data['telefon'];
     $emailul_parohiei = $data['email'];
     $preot_paroh = $data['numele_preotului'];
  }

}

// programari în ultimele 30 de zile

function program_ultimele_30_zile ($tabel_programari, $parohie_id) {

  global $conn;
  global $nr_randuri_prog;

  $query = "Select * FROM $tabel_programari WHERE parohie_id = $parohie_id AND data_si_ora > (current_date - interval 30 day)";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $query);
  mysqli_stmt_execute($stmt);
  
  $rezultat = mysqli_stmt_get_result($stmt);
  echo $nr_randuri_prog = mysqli_num_rows($rezultat);

}

// programari în ultimele 30 de zile

function pomelnice_30_zile ($parohie_id) {

  global $conn;
  global $nr_randuri_prog;
  
  $query = "Select * FROM pomelnice WHERE parohie_id = $parohie_id";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $query);
  mysqli_stmt_execute($stmt);
  
  $rezultat = mysqli_stmt_get_result($stmt);
  echo $nr_randuri_prog = mysqli_num_rows($rezultat);

}

function alerta_program_oficial ($parohie_id) {
  global $conn;
  $query = "Select * FROM program_liturgic WHERE parohie_id = $parohie_id AND status = 1";
  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $query);
  mysqli_stmt_execute($stmt);

  $rezultat = mysqli_stmt_get_result($stmt);
  $nr_randuri_prog = mysqli_num_rows($rezultat);
  if ($nr_randuri_prog == 0) {
    echo "<p class='rosu'>Nu ai stabilit un program oficial până acum. Alege un program și apasa mai jos butonul <strong>Setează ca oficial</strong></p>";
  }

}


// Află user_id-ul dintr-o programare

function afla_user_id ($id_programare, $eveniment) {

  global $conn;
  global $user_id;
      switch ($eveniment) {
        case "botez": 
        $query = "SELECT user_id FROM programari_botez Where id = $id_programare";
        break;
        
        case "cununie":
        $query = "SELECT user_id FROM programari_cununie Where id = $id_programare ";
        break;
          
        case "sfestanie":
        $query = "SELECT user_id FROM programari_sfestanie Where id = $id_programare ";
        break;
          
        case "parastas":
        $query = "SELECT user_id FROM programari_parastas Where id = $id_programare ";
        break;
      } 

  $stmt = mysqli_stmt_init($conn);
  mysqli_stmt_prepare($stmt, $query);
  mysqli_stmt_execute($stmt);
  $rezultat = mysqli_stmt_get_result($stmt);
  $rez = mysqli_fetch_all($rezultat);
  $user_id = $rez[0][0];

}

// afla parohie

function afla_parohia() {

    global $conn, $parohia, $mitropolia, $episcopia, $numele_preotului;
    $query_parohie = "Select * from parohii Where id = ?";

    $stmt = $conn->prepare($query_parohie);
    $stmt->bind_param('i', $_SESSION['parohie_id']);
    $rez = $stmt->execute();
    $rez = $stmt->get_result();

    while ($data = mysqli_fetch_assoc($rez)) {
      $parohia = $data['nume_parohie'];
      $mitropolia = $data['mitropolia'];
      $episcopia = $data['episcopia'];
      $numele_preotului = $data['numele_preotului'];
    }
}

// afla data Paștelui

// function data_pastelui($anul) {

//     global $conn, $data_pastelui;
//     $query = "Select * from data_pastelui Where anul = ?";

//     $stmt = $conn->prepare($query);
//     $stmt->bind_param('i', $anul);
//     $rez = $stmt->execute();
//     $rez = $stmt->get_result();

//     while ($data = mysqli_fetch_assoc($rez)) {
//       $luna_pastelui = $data['luna'];
//       $ziua_pastelui = $data['ziua'];
//       $data_pastelui = date("d M Y", mktime(00, 00, 00, $luna_pastelui, $ziua_pastelui, $anul));
//     }
// }

function aflaDuminici ($y,$m){ 

  global $duminici_in_luna;
  $date = "$y-$m-01";
  $first_day = date('N',strtotime($date));
  $first_day = 7 - $first_day + 1;
  $last_day =  date('t',strtotime($date));
  $duminici_in_luna = array();
  for($i=$first_day; $i<=$last_day; $i=$i+7 ){
      $duminici_in_luna[] = $i;
  }
  return  $duminici_in_luna;
}

function aflaSambete ($y,$m){ 

  global $sambete_in_luna;
  $date = "$y-$m-01";
  $first_day = date('N',strtotime($date));
  $first_day = 6 - $first_day + 1;
  $last_day =  date('t',strtotime($date));
  $sambete_in_luna = array();
  for($i=$first_day; $i<=$last_day; $i=$i+7 ){
      $sambete_in_luna[] = $i;
  }
  return  $sambete_in_luna;
}

function afiseazaSfinti ($month, $day) {
 
  global $conn, $sfinti, $sarbatoare, $post, $dezlegare_peste;

  $query_sfinti = "SELECT * FROM calendar_date_fixe WHERE luna = ? AND zi = ?";
  $stmt = $conn->prepare($query_sfinti);
  $stmt->bind_param('ii', $month, $day);
  $rez = $stmt->execute();
  $rez = $stmt->get_result();

  while ($data = mysqli_fetch_assoc($rez)) {
      $sfinti = $data['sfinti'];
      $sarbatoare = $data['sarbatoare'];
      $post = $data['post'];
      $dezlegare_peste = $data['dezlegare_peste'];
  }
}

$martiri_fcp_total = array();

function martiri_fcp ($month) {
 
  global $conn, $martiri_fcp_total;

  if ( strlen($month) < 2) {
    $month = '0' . (string)$month;
  } else {}

  $mDataAdormire = '%-' . $month . '-%';

  $query_mFCP = "SELECT * FROM calendar_fcp WHERE mDataAdormire LIKE ?";
  $stmt = $conn->prepare($query_mFCP);
  $stmt->bind_param('s', $mDataAdormire);
  $rez = $stmt->execute();
  $rez = $stmt->get_result();

  while ($data = mysqli_fetch_assoc($rez)) {
     $martiri_fcp_total[]= $data;
  }
  // echo '<pre>';
  // print_r ($martiri_fcp_total);
  // echo '</pre>';
}

$rezs = array();

function afiseazaSfinti_luna ($month) {
 
  global $conn, $sfinti, $sarbatoare, $post, $dezlegare_peste, $rezs; 

  $query_sfinti = "SELECT * FROM calendar_date_fixe WHERE luna = ?";
  $stmt = $conn->prepare($query_sfinti);
  $stmt->bind_param('i', $month);
  $rezultate = $stmt->execute();
  $rezultate = $stmt->get_result();

  

  while ($data = mysqli_fetch_assoc($rezultate)) {
        $rezs[] = $data;
  }
   
}

function controls() {

    global $day, $month, $year, $pentru, $formatter;

    /* select month control */
  
    $select_month_control = '<select name="month" id="month" class="d-inline form-select">';
    for($x = 1; $x <= 12; $x++) {
    $select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.$formatter->format(mktime(0,0,0,$x,1,$year)).'</option>';
    }
    $select_month_control.= '</select>';
    
    /* select year control */
    
    $year_range = 7;
    $select_year_control = '<select name="year" id="year" class="d-inline form-select">';
    for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
    $select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
    }
    $select_year_control.= '</select>';
    
    /* "next month" control */
    
    $next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1). '&pentru='. $pentru .'" class="control"> &#10095; </a>';
    
    /* "previous month" control */
    
    $previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.    ($month != 1 ? $year : $year - 1). '&pentru='. $pentru .'" class="control"> &#10094; </a>';
    
    /* bringing the controls together */
    
    $controls = 
                '<form method="get" class="calendar-complet">
                    
                <div class="navigare"><div class="sageti">'  .  $previous_month_link . ' ' . $next_month_link . '</div>' . $select_month_control . $select_year_control .  '<button type="submit" class="btn btn-outline-primary"/> '.' Schimbă</button></div>
    
                </form>';
    echo $controls;

}

// Împarte numărul de telefon în grupuri lizibile

function space($str, $step, $reverse = false) {
    
  if ($reverse)
      return strrev(chunk_split(strrev($str), $step, ' '));
  
  return chunk_split($str, $step, ' ');
}