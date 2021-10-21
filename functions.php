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



// function tipProgramare ($status) {

//     global $conn;
//     $query = 'SELECT * FROM programari_botez WHERE status = ? ORDER BY data_si_ora ASC';
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param('s', $status);
//     $result = $stmt->execute();
//     $result = $stmt->get_result();
 
//   while($data = $result->fetch_assoc()) {
//     include "extras-programare.php";
//     echo '<p><a href="rezervare-unica.php?id=' . $id .  '">' . ' ' . date("d.m.Y", strtotime($data_si_ora)) . ' - <span class="red">' . $eveniment . '</span> - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mama . ' ' . $prenume_mama .  '</a><br />';
//   }

//   global $conn;
//   $query = 'SELECT * FROM programari_cununie WHERE status = ? ORDER BY data_si_ora ASC';
//   $stmt = $conn->prepare($query);
//   $stmt->bind_param('s', $status);
//   $result = $stmt->execute();
//   $result = $stmt->get_result();

// while($data = $result->fetch_assoc()) {
//   include "extras-programare-cununie.php";
//   echo '<p><a href="rezervare-unica-cununie.php?id=' . $id .  '">' . ' ' . date("d.m.Y", strtotime($data_si_ora)) . ' - <span class="red">' . $eveniment . '</span> - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mire . ' ' . $prenume_mire .  '</a><br />';
// }

// }


function upload_foto($input, $nume_fisier, $link) {

    if( isset($_FILES[$input]) ){

      global $target_dir;
      
      $errors= array();

      $file_name = $_FILES[$input]['name'];
      $file_size = $_FILES[$input]['size'];
      $file_tmp = $_FILES[$input]['tmp_name'];
      $file_type = $_FILES[$input]['type'];
      $file_ext= strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

      $file_name = 'copie_ci_' . replaceSpecialChars(preg_replace('/\s+/', '-', $nume_fisier)) . '.' . $file_ext;

      $extensions= array("jpeg","jpg","png", "");
      if(in_array($file_ext,$extensions)=== false){
      $errors[]="Acceptăm doar fotografii în format JPEG, JPG sau PNG";
      }
      
      if($file_size > 10485760) {
      $errors[]='Dimensiunea fișierului trebuie să fie de maxim 10 MB';
      }
      
      if(empty($errors)==true) {
      move_uploaded_file($file_tmp, $target_dir .'/'.$file_name);
      } else{print_r($errors);}

      if ($file_size !== 0 && empty($errors)==true ) {
      $GLOBALS[$link] = $target_dir .'/'.$file_name; }     
       
    } else {unset($errors); }

}
 