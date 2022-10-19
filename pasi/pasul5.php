<?php 
include "../header-frontend.php"; 
$data_simpla = '';
$nume_si_prenume_mama = '';
$nume_si_prenume_tata = '';
$nume_si_prenume_copil = '';




if (isset($_GET['id'])) {

    $last_id = (int)$_GET['id'];

    $sql = 'SELECT * FROM programari_botez WHERE id=? AND parohie_id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $last_id, $parohie_id);
    $result = $stmt->execute();
    $result = $stmt->get_result();


    while($data = $result->fetch_assoc()) {

        $eveniment = $data['eveniment'];
        $data_si_ora = strtotime( $data['data_si_ora'] );
        $data_simpla = date('d-m-Y', $data_si_ora);
        $nume_tata = $data['nume_tata'];
        $prenume_tata = $data['prenume_tata'];
        $nume_si_prenume_tata = $nume_tata . '-' . $prenume_tata;
        $nume_mama = $data['nume_mama'];
        $prenume_mama = $data['prenume_mama'];
        $nume_si_prenume_mama = $nume_mama . '-' . $prenume_mama;
        $nume_copil = $data['nume_copil'];
        $prenume_copil = $data['prenume_copil'];
        $nume_si_prenume_copil = $nume_copil . '-' . $prenume_copil;

    }
}
 
 

if (isset($_POST['ataseaza'])) {

     
    $base_dir = "rezervari/";
    
    $target_dir = ROOT_PATH . '/rezervari/' . $data_simpla . '-'. $eveniment . '-' . 'id-' . $last_id;
    $target_dir = preg_replace('/\s+/', '-', $target_dir);

    mkdir($target_dir);

    $target_dir_www = 'rezervari/' . $data_simpla . '-'. $eveniment . '-' . 'id-' . $last_id;
    $target_dir_www = preg_replace('/\s+/', '-', $target_dir_www);


    // preia fișierele uplodate în inputuri

    $link_tata_ci = $link_mama_ci = $link_plata_contributiei = $link_certificat_nastere_copil = '';

    upload_foto('tata_ci', $nume_si_prenume_tata, 'link_tata_ci');
    upload_foto('mama_ci', $nume_si_prenume_mama, 'link_mama_ci');
    upload_foto('plata_contributiei', $nume_si_prenume_mama, 'link_plata_contributiei');
    upload_foto('certificat_nastere_copil', $nume_si_prenume_copil, 'link_certificat_nastere_copil');


    $query = ' 
    UPDATE programari_botez
    SET
    link_tata_ci=?,
    link_mama_ci=?,
    link_plata_contributiei=?,
    link_certificat_nastere_copil=?
    WHERE id=?';

    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssi', $link_tata_ci, $link_mama_ci, $link_plata_contributiei, $link_certificat_nastere_copil, $last_id);
    $rezultat = $stmt->execute();

}


?>



<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "../sidebar-frontend.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "../header-mic-frontend.php";?>

            <div class="ultimele-programari">

                
                <?php include "pasi.php";?>
                
                <h1 class="h1 mb-5">Au fost atașate cu succes documentele necesare. Programează data catehezei pentru Taina Botezului</h1>
                
                
                
                <?php


$an_si_luna = $selected_year . '-' . $selected_month;
$zile_programate = [];

$sql="SELECT * FROM zile_stabilite WHERE tip_programare LIKE '$pentru' AND (data_start LIKE '%$an_si_luna%' AND parohie_id = $parohie_id)";
$rezultate = mysqli_query ($conn, $sql);

while ($data = mysqli_fetch_assoc($rezultate)){   
    
    $zi = date("d", strtotime($data['data_start']));
    $zi = ltrim ($zi, '0');
    array_push($zile_programate, $zi);
}



/* draws a calendar */
function draw_calendar($month,$year){
    global $link_rezervare;
    global $zile_programate, $an_si_luna, $last_id, $pentru, $selected_year, $selected_month;
    $calendar = '';
    ?>
 
 <ul class="weekdays">
     <li>L</li>     <li>M</li>    <li>M</li>     <li>J</li>    <li>V</li>     <li>S</li>    <li>D</li>    </ul>
     
     <?php

/* days and weeks vars now ... */
$running_day = date('w',mktime(0,0,0,$month,1,$year)); /* ziua din sapt. de la 0 (dum) la 6 (samb)  */
$days_in_month = date('t',mktime(0,0,0,$month,1,$year)); /* numarul de zile in acea luna (de la 28 la 31) */
$days_in_this_week = 1;
$day_counter = 0;
$dates_array = array();

/* row for week one */
$calendar.= '<ul class="days">';

/* print "blank" days until the first of the current week */
for($x = 1; $x < $running_day; $x++):
    $calendar.= '<li class="calendar-day-np"> </li>';
    $days_in_this_week++;
endfor;





/* keep going with days.... */

$link_finalizare = "pasul6.php?id=" . $last_id  . "&pentru=" . $pentru . "&year=" . $selected_year . "&month=" . $selected_month;

echo '<form method="POST" action="' . $link_finalizare .'" enctype = "multipart/form-data">' .
'<div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">';



for($list_day = 1; $list_day <= $days_in_month; $list_day++):   
    $calendar.= '<li class="calendar-day">';
    
    /* add in the day number */
    
    if (!in_array($list_day, $zile_programate)) {
        
        /* daca ziua ESTE deja rezervata*/
             $calendar.= ' 
             <span class="btn btn-danger" data-toggle="tooltip" title="">' . $list_day . '</span>';
            } else {
                /* daca NU este rezervata*/ 
                $calendar.= ' 
                <input type="checkbox" class="btn-check"  id="btncheck' 
                . $list_day . '"  autocomplete="off" value ="' . $list_day . '"   name="zile[]">' .  '<label class="btn btn-outline-primary " for="btncheck' . $list_day .  '">' . $list_day . '</label>';
                
            }
            
            $calendar.= '</li>';
            if($running_day == 6):
                $calendar.= '</li>';
                if(($day_counter+1) != $days_in_month):
                    $calendar.= '';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;
 
     /* finish the rest of the days in the week */
     if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<li class="calendar-day-np"> </li>';
        endfor;
    endif;
    
    /* final row */
    $calendar.= '</li>';
    
    /* end the table */
    $calendar.= '</ul>';
    
    /* all done, return result */
    return $calendar;
}

/* date settings */

$month = (int) (isset($_GET['month']) ? $_GET['month'] : date('m'));
$year = (int)  (isset($_GET['year']) ? $_GET['year'] : date('Y'));

/* select month control */

$select_month_control = '<select name="month" id="month" class="form-select-sm mb-3">';
 for($x = 1; $x <= 12; $x++) {
     $select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.strftime('%B',mktime(0,0,0,$x,1,$year)).'</option>';
 }
 $select_month_control.= '</select>';
 
 /* select year control */
 
 $year_range = 7;
 $select_year_control = '<select name="year" id="year" class="form-select-sm mb-3">';
 for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
     $select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
    }
    $select_year_control.= '</select>';
    
    /* "next month" control */
    
    $next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1). '&pentru='. $pentru .'" class="control"> &#10095; </a>';
    
    /* "previous month" control */
    
    $previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.    ($month != 1 ? $year : $year - 1). '&pentru='. $pentru .'" class="control"> &#10094; </a>';
    
    /* bringing the controls together */
    
    $controls = '<form method="get">' . '<div class="capcalendar text-center">' . $previous_month_link .$select_month_control .$next_month_link .$select_year_control . ' <button type="submit" name="pentru" value="' .$pentru . '" class="btn btn-primary"/> '.' Schimbă luna și anul</button></div></form>';
    echo $controls;
    echo draw_calendar($month,$year);
    
    
    ?>
 
</div>

<input type="submit" value="Alege ziua" name="pasul1" class="btn btn-primary rezerva">

</form>



</div>
</div>
</div>
</div>
</div>
</body>
</html>





 