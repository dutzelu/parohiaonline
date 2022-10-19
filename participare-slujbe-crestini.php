<?php include 'header-frontend.php';?>

  <title><?php echo $eveniment; ?></title>
  
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">

        <div class="col-sm-3 sidebar-frontend"><?php include "sidebar-frontend.php"?></div>
        <div class="col-lg-9 p-4 zona-principala">

             <?php include "header-mic-frontend.php";?>

            <div class="row zile-stabilite">
                    <h1 class="h1 mb-2">Participare la slujbe pe timp de restricții (pandemie, etc.)</h1>
                    <p class="fw-bold">Slujbele de mai jos au un număr limitat de participanți . Alege o slujbă pentru care vrei să te înscrii:</p>

                        <?php
                        

                        $an_si_luna = $selected_year . '-' . $selected_month;
                        $zile_programate = [];

                        $sql="SELECT * FROM participare_slujbe WHERE data_start LIKE '%$an_si_luna%' AND parohie_id =" . $parohie_id;
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

                        $select_month_control = '<select name="month" id="month" class="d-inline form-select">';
                        for($x = 1; $x <= 12; $x++) {
                        $select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.strftime('%B',mktime(0,0,0,$x,1,$year)).'</option>';
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

                        $next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control"> &#10095; </a>';

                        /* "previous month" control */

                        $previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.    ($month != 1 ? $year : $year - 1). '" class="control"> &#10094; </a>';

                        /* bringing the controls together */

                        $controls = 
                        '<form method="get" class="calendar-complet">
                
                        <p><span class="sageti">' .  $previous_month_link . ' ' . $next_month_link . '</span>' . $select_month_control . $select_year_control .  '<button type="submit" class="btn btn-outline-primary"/> '.' Schimbă luna și anul</button></p>
     
                        </form>';;
                        
                        echo $controls;

                    if (isset($_GET['succes'])) { 
                        echo '<p id="dispari" >Te-ai înscris cu succes.</p>';
                        $succes = $_GET['succes'];
                        } else $succes = '';

                    if (isset($_GET['retragere'])) { 
                        echo '<p id="dispari">Te-ai retras de la slujba selectată..</p>';
                        $retragere = $_GET['retragere'];
                        } else $retragere = '';
        

                    echo '<table class="table">';
                    echo '
                        <thead>
                        <tr>
                            <th scope="col">Dată</th>
                            <th scope="col">Start</th>
                            <th scope="col">Final</th>
                            <th scope="col">Slujba</th>
                            <th scope="col">Nr. pers.</th>
                            <th scope="col">Rezervări</th>
                            <th scope="col">Înscrie-te</th>
                        </tr>
                        </thead>
                        <tbody>
                    ';

                    $sql="SELECT * FROM participare_slujbe WHERE data_start LIKE '%$an_si_luna%' AND parohie_id = $parohie_id ORDER BY DATE(data_start) ASC";
                    $rezultate = mysqli_query ($conn, $sql);

                    while ($data = mysqli_fetch_assoc($rezultate)){   
                            
                            $id_slujba = $data['id'];
                            $data_start = $data["data_start"];
                            $data_start_fara_ora = date("d M Y", strtotime($data["data_start"]));
                            $ora_start = date("H:i", strtotime($data["data_start"]));
                            $ora_final = date("H:i", strtotime($data["data_final"]));
                            $ora_start_simpla = date("H", strtotime($data["data_start"]));
                            $ora_final_simpla = date("H", strtotime($data["data_final"]));
                            $slujba = $data['slujba'];
                            $numar_persoane = $data['numar_persoane'];

 
                            $rezervari = $data['rezervari'];
                       
                            echo '<tr>';
                            
                            echo '<td>' . $data_start_fara_ora . '</td>';
                            echo '<td>' . $ora_start . '</td>';
                            echo '<td>' . $ora_final . '</td>';
                            echo '<td>' . $slujba . '</td>';
                            echo '<td>' . $numar_persoane . '</td>';
                            echo '<td>' . $rezervari . '</td>';
                            echo '<td class="inscrie_te">';
                            
                            // cauta user-id-ul în lista participantilor slujbei

                            $query = 'Select * FROM participare_slujbe WHERE id = ?';
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $id_slujba);
                            $rezultat = $stmt->execute();
                            $rezultat = $stmt->get_result();

                            while ($data = mysqli_fetch_assoc($rezultat)){  
                                $participanti = $data['participanti'];
                                $iduri_participanti = explode(",", $participanti);
                                $rezervari = $data['rezervari'];
                                $numar_persoane = $data['numar_persoane'];
                               
                                if ( in_array( $user_id, $iduri_participanti ) ) {

                                    echo '<span class="inscris_la_slujba">înscris</span>';
                                    echo ' <a href="inscriere-slujbe-pandemie.php?id-slujba-retragere='. $id_slujba . '&month=' . $month . '&year=' . $year . '"><small>Retrage-te</small></a>';

                                } elseif ( !in_array( $user_id, $iduri_participanti ) && $rezervari < $numar_persoane  ) {

                                    echo '<a href="inscriere-slujbe-pandemie.php?id-slujba='. $id_slujba . '&month=' . $month . '&year=' . $year . '"><small>înscrie-te <span class="rosu">»</span></small></a></td>'; 
                                
                                } elseif ( !in_array( $user_id, $iduri_participanti ) && $numar_persoane == $rezervari ) {

                                    echo '<small>Locuri ocupate</small></td>';
                                }
                            }
                            
                           
                            
                            
                            echo '</tr>';
                    
                            }
                    ?>

                 </div>
            </div>

</body>
</html>