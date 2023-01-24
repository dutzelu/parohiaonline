<?php include 'header-frontend.php';?>

  <title><?php echo $eveniment; ?></title>
</head>

<body>

<?php include "sidebar-frontend.php" ?>

<div class="mare">
  <div class="container-fluid">
     <h1 class="h1 text-center">Alegeți zilele pentru <br > <span class="albastru"><?php echo $eveniment; ?></span> pentru fiecare lună  </h1>


<?php

        /* draws a calendar */
        function draw_calendar($month,$year){
            global $link_rezervare;
        /* draw table */
        $calendar = '';
?>

    <ul class="weekdays">
    <li>L</li>
    <li>M</li>
    <li>M</li>
    <li>J</li>
    <li>V</li>
    <li>S</li>
    <li>D</li>
    </ul>

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


    for($list_day = 1; $list_day <= $days_in_month; $list_day++):   
        $calendar.= '<li class="calendar-day">';
            /* add in the day number */
            $calendar.= ' 
            <input type="checkbox" class="btn-check" id="btncheck' 
            . $list_day . '"  autocomplete="off" value ="' . $list_day . '"   name="zile[]">' .  '<label class="btn btn-outline-primary" for="btncheck' . $list_day .  '">' . $list_day . '</label>';

        

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
$select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.$formatter->format(mktime(0,0,0,$x,1,$year)).'</option>';
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
$next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control"> &#10095; </a>';

/* "previous month" control */
$previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.    ($month != 1 ? $year : $year - 1).'" class="control"> &#10094; </a>';

/* bringing the controls together */
$controls = '<form method="get">' . '<div>' . $previous_month_link .$select_month_control .$next_month_link .$select_year_control . ' <input type="submit" name="submit" value="Schimbă" class="btn btn-primary"/> '.' </div></form>';
echo $controls;
echo draw_calendar($month,$year);
?>

</div>

<div class="row mt-3">
    <label class="col-sm-4 col-form-label">Start</label>  
    <div class="col-sm-8">
        <?php ore_pentru_select(); ?>
    </div>
</div>

<div class="row mt-3">
    <label class="col-sm-4 col-form-label">FINAL</label>  
    <div class="col-sm-8">
        <?php ore_pentru_select(); ?>
    </div>
</div>


<input type="submit" value="Rezervă" name="rezerva" class="btn btn-primary rezerva">
</form>

 
</div>
</div>
</body>
</html>