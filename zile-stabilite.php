<?php include 'header-admin.php';

if (!empty($_SESSION['id']) && $admin == 0) {
    echo '<script> location.replace("frontend.php?pentru=botez"); </script>';
} 

;?>

  <title><?php echo $eveniment; ?></title>
  
</head>

<body>

<?php include "sidebar-admin.php" ?>

<div class="mare">
  <div class="container-fluid">
     <h1 class="h1 text-center">Alegeți zilele pentru <br > <span class="albastru"><?php echo $eveniment; ?></span> pentru fiecare lună  </h1>


<?php
 

$an_si_luna = $selected_year . '-' . $selected_month;
$zile_programate = [];

$sql="SELECT * FROM zile_stabilite WHERE tip_programare LIKE '$pentru' AND data_start LIKE '%$an_si_luna%' ";
$rezultate = mysqli_query ($conn, $sql);

while ($data = mysqli_fetch_assoc($rezultate)){   
        
         $zi = date("d", strtotime($data['data_start']));
         $zi = ltrim ($zi, '0');
         array_push($zile_programate, $zi);
        }

        /* draws a calendar */
        function draw_calendar($month,$year){
         
        global $link_rezervare;
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
echo '<form method="POST" action="' . $link_rezervare .'" enctype = "multipart/form-data">' .
'<div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">';

global $zile_programate;
global $an_si_luna;

    for($list_day = 1; $list_day <= $days_in_month; $list_day++):   
        $calendar.= '<li class="calendar-day">';

 /* add in the day number */
        
        if (in_array($list_day, $zile_programate)) {

          /* daca ziua ESTE deja rezervata*/
            $calendar.= ' 
            <span class="btn btn-danger ora" data-toggle="tooltip" title="">' . $list_day . '</span>';
        } else {
        /* daca NU este rezervata*/ 
            $calendar.= ' 
            <input type="checkbox" class="btn-check" id="btncheck' 
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
$select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
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

<!--select pentru ora_start -->

<div class="row mt-3">
    <label class="col-sm-4 col-form-label">Start</label>  
    <div class="col-sm-8">
        <?php ore_pentru_select("ora_start"); ?>
    </div>
</div>

<!--select pentru ora_final -->

<div class="row mt-3">
    <label class="col-sm-4 col-form-label">Final</label>  
    <div class="col-sm-8">
        <?php ore_pentru_select("ora_final"); ?>
    </div>
</div>


<input type="submit" value="Rezervă" name="rezerva" class="btn btn-primary rezerva">

</form>

<div class="rezervari">
<h3 class="mt-4 mb-4 text-center"> Zile rezervate pentru <?php echo $eveniment; ?></h2>

<?php

echo '<table class="table table-striped">';
echo '
    <thead>
    <tr>
        <th scope="col">Dată</th>
        <th scope="col">Ora start</th>
        <th scope="col">Ora final</th>
        <th scope="col">Rezervări</th>
        <th scope="col">Ore libere</th>
        <th scope="col">Șterge</th>
    </tr>
    </thead>
    <tbody>
';

$sql="SELECT * FROM zile_stabilite WHERE tip_programare LIKE '$pentru' AND data_start LIKE '%$an_si_luna%' ORDER BY DATE(data_start) ASC";
$rezultate = mysqli_query ($conn, $sql);

while ($data = mysqli_fetch_assoc($rezultate)){   
        
        $id_rezervare = $data['id'];
        $data_start_fara_ora = date("d F Y", strtotime($data["data_start"]));
        $ora_start = date("H:i", strtotime($data["data_start"]));
        $ora_final = date("H:i", strtotime($data["data_final"]));
        $ora_start_simpla = date("H", strtotime($data["data_start"]));
        $ora_final_simpla = date("H", strtotime($data["data_final"]));
 

        $total_rezervari =  $ora_final_simpla - $ora_start_simpla;
        $rezervari_disponibile = $data['rezervari'];
        $rezervari = $total_rezervari - $rezervari_disponibile;

        

        echo '<tr>';
        
        echo '<td>' . $data_start_fara_ora . '</td>';
        echo '<td>' . $ora_start . '</td>';
        echo '<td>' . $ora_final . '</td>';
        echo '<td>' . $rezervari . '</td>';
        echo '<td>' . $rezervari_disponibile . '</td>';
        echo '<td> <a href="sterge-camp.php?month='. $month .'&year='. $year .'&id='. $id_rezervare .'&pentru='. $pentru .'">x șterge</a>' . '</td>';
        echo '</tr>';
  
        }


?>


    </div>
</div>
</div>
</body>
</html>