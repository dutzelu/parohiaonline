<?php
 $an_si_luna = $selected_year . '-' . $selected_month;
 $zile_programate = [];
       
 
         /* draws a calendar */
         function draw_calendar($month,$year){
        
         global $link_rezervare;
         $calendar = '';
 ?>
 
     <ul class="weekdays">
     <li>Lun</li>     <li>Mar</li>    <li>Mie</li>     <li>Joi</li>    <li>Vin</li>     <li>Sâm</li>    <li>Dum</li>    </ul>
 
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
 
 echo '<form method="POST" action="' . $link_rezervare .'" enctype = "multipart/form-data">' .
 '<div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">';
 
 global $zile_programate;
 global $an_si_luna;
 global $rezervari;
 global $conn;

 
 

 $query_prog_luna_in_curs = "

 Select id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_botez 
 WHERE data_si_ora LIKE '%$an_si_luna%' AND status LIKE 'acceptata'

 UNION ALL 

 Select id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_cununie 
 WHERE `data_si_ora` LIKE '%$an_si_luna%' AND status LIKE 'acceptata'

 ORDER BY Data ASC";

 $stmt = $conn->prepare($query_prog_luna_in_curs);
 $rezultat = $stmt->execute();
 $rezultat = $stmt->get_result();
  
 while ($data = mysqli_fetch_assoc($rezultat)) { 

     $zi = str_replace ($an_si_luna . "-", '', $data['Data'],);
     $zi = ltrim ($zi, '0');
     $zile_programate[]= $zi; 

 }
 

     for($list_day = 1; $list_day <= $days_in_month; $list_day++):   
         $calendar.= '<li class="calendar-day">';
// var_dump($zile_programate);
            if (!in_array($list_day, $zile_programate)) {
    
                /* daca ziua ESTE deja rezervata*/
                    $calendar.= ' 
                    <span class="btn" data-toggle="tooltip" title="">' . $list_day . '</span>';
                } else {
   
                /* daca NU este rezervata*/ 
                    $calendar.= ' 
                    
                    <a href="?ziua='. $list_day . '&luna=' . $month . '&an=' . $year . '"><label class="btn btn-outline-primary " for="btncheck' . $list_day .  '">' . $list_day . '</label></a>';
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
 
 $select_month_control = '<select name="month" id="month" class="d-inline form-select">';
 for($x = 1; $x <= 12; $x++) {
 $select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
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
        '<form method="get">
            <div class="row justify-content-between align-items-center mb-5">
                <div class="col-sm-1 text-center">' . $previous_month_link . '</div>
                <div class="col-sm-3">' . $select_month_control . '</div>
                <div class="col-sm-1 text-center">' . $next_month_link . '</div> 
                <div class="col-sm-2">' . $select_year_control .  '</div> 
                <div class="col-sm-4"><button type="submit" name="pentru" value="' .$pentru . '" class="btn btn-outline-primary"/> '.' Schimbă luna și anul</button></div>
            </div>
        </form>';
 echo $controls;
 echo draw_calendar($month,$year);
 
 ?>
</div>
