<?php include 'header-admin.php';

if (!empty($_SESSION['id']) && $admin == 0) {
    echo '<script> location.replace("frontend.php?pentru=botez"); </script>';
} 

;?>

  <title><?php echo $eveniment; ?></title>
  
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">

        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>
        <div class="col-sm-9 p-4 zona-principala">

             <?php include "header-mic-admin.php";?>

            <div class="row zile-stabilite">
                 <div class="col-sm-12 col-xl-5 justify-content-between">
                    <h1 class="h1 mb-2">Participare la slujbe pe timp de pandemie</h1>
                    <p>Dacă autoritățile impun un număr maxim de persoane în biserică la participarea la slujbe (de ex.: 30, 50, 100), atunci puteți crea aici o listă pentru înscrieri.</p>
                    <p class="fw-bold">Alege o zi pentru slujbă:</p>

                        <?php
                        

                        $an_si_luna = $selected_year . '-' . $selected_month;
                        $zile_programate = [];

                        $sql="SELECT * FROM participare_slujbe WHERE data_start LIKE '%$an_si_luna%' AND parohie_id = $id";
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
                        echo '<form method="POST" action="' . $link_rezervare .'" enctype = "multipart/form-data">' .
                        '<div class="row btn-group" role="group" aria-label="Basic checkbox toggle button group">';

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
                                <div class="col-sm-3">' . $select_year_control .  '</div> 
                                <div class="col-sm-4"><button type="submit" name="pentru" value="' .$pentru . '" class="btn btn-outline-primary"/> '.' Schimbă luna și anul</button></div>
                            </div>
                        </form>';
                        
                        echo $controls;
                        echo draw_calendar($month,$year);

                        ?>

        
                        <div class="input-group mb-2">
                            <span class="input-group-text">Alege o slujbă</span>
                            <select class="form-control" name="slujba" id="slujba" value="Sfânta Liturghie">
                                <optgroup label="Liturgice">
                                    <option value="Sfânta Liturghie">Sfânta Liturghie</option>
                                    <option value="Vecernia">Vecernia</option>
                                    <option value="Pavecernita">Pavecernița</option>
                                    <option value="Utrenia">Utrenia</option>
                                    <option value="Litia">Litia</option>
                                    <option value="Pomenirea morților">Pomenirea morților</option>
                                    <option value="Miezonoptica">Miezonoptica</option>
                                    <option value="Obednița">Obednița</option>
                                    <option value="Priveghere de noapte">Priveghere de noapte</option>
                                </optgroup>
                                <optgroup label="Sfintele Taine">
                                    <option value="Taina Sfântului Botez">Taina Sfântului Botez</option>
                                    <option value="Taina Sfintei Cununii">Taina Sfintei Cununii</option>
                                    <option value="Taina Sfântului Maslu">Taina Sfântului Maslu</option>
                                    <option value="Taina Spovedaniei">Taina Spovedaniei</option>option>
                                </optgroup>
                                <optgroup label="Sfinți">
                                    <option value="Acatistul">Acatistul</option>
                                    <option value="Paraclisul">Paraclisul</option>
                                </optgroup>
                                <optgroup label="Rugăciuni">
                                    <option value="Rugăciunile de seară">Rugăciunile de seară</option>
                                    <option value="Rugăciunile de dimineață">Rugăciunile de dimineață</option>
                                    <option value="Ceasul I">Ceasul I</option>
                                    <option value="Ceasul III">Ceasul III</option>
                                    <option value="Ceasul VI">Ceasul VI</option>
                                    <option value="Ceasul IX">Ceasul IX</option>
                                </optgroup>
                                <optgroup label="Speciale">
                                    <option value="Denia">Denia</option>
                                    <option value="Slujba Învierii">Slujba Învierii</option>
                                    <option value="Cateheză">Cateheză</option>
                                    <option value="Seară biblică">Seară biblică</option>
                                    <option value="Sfințirea Apei (Aghiazma)">Sfințirea Apei (Aghiazma)</option>
                                    <option value="Tedeum">Tedeum</option>
                                    <option value="Moliftele Sf. Vasile cel Mare">Moliftele Sf. Vasile cel Mare</option>
                                    <option value="Citirea Psaltirii">Citirea Psaltirii</option>
                                    <option value="Rugăciunea lui Iisus">Rugăciunea lui Iisus</option>
                                    <option value="Concert">Concert</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text">Ora start</span>  
                            </div>
                            <div> <?php ore_pentru_select("ora_start"); ?> </div>

                            <div class="input-group-prepend ml-2" style="margin-left:25px">
                                <span class="input-group-text">Ora final</span>  
                            </div>
                            
                            <div><?php ore_pentru_select("ora_final"); ?></div>

                        </div>
                        
                        
                        <div class="input-group mt-3">
                            <label class="col-sm-6 col-form-label">Stabilește nr. maxim de persoane</label>  
                            <div class="col-sm-3">
                                <input type="number" name="numar_persoane" value="50" class="form-control" min="1" max="1000">
                            </div>

                        </div>

                        <input type="submit" value="Crează listă" name="participare_slujbe" class="btn btn-primary rezerva">
                        
                  
                    </form>
                    
               
                </div></div>
                <div class="col-sm-12 col-xl-7">
            


                    <div class="rezervari">
                    <p class="mb-4 text-center bg-light"> Slujbe stabilite pentru înscrieri</p>

                    <?php

                    echo '<table class="table participare_slujbe">';
                    echo '
                        <thead>
                        <tr>
                            <th scope="col">Dată</th>
                            <th scope="col">Start</th>
                            <th scope="col">Final</th>
                            <th scope="col">Slujba</th>
                            <th scope="col">Nr. pers.</th>
                            <th scope="col">Rezervări</th>
                            <th scope="col">Șterge</th>
                        </tr>
                        </thead>
                        <tbody>
                    ';

                    $sql="SELECT * FROM participare_slujbe WHERE data_start LIKE '%$an_si_luna%' AND parohie_id = $id ORDER BY DATE(data_start) ASC";
                    $rezultate = mysqli_query ($conn, $sql);

                    while ($data = mysqli_fetch_assoc($rezultate)){   
                            
                            $id_slujba= $data['id'];
                            $data_start_fara_ora = date("d M Y", strtotime($data["data_start"]));
                            $ora_start = date("H:i", strtotime($data["data_start"]));
                            $ora_final = date("H:i", strtotime($data["data_final"]));
                            $ora_start_simpla = date("H", strtotime($data["data_start"]));
                            $ora_final_simpla = date("H", strtotime($data["data_final"]));
                            $slujba = $data['slujba'];
                            $numar_persoane = $data['numar_persoane'];
                            $rezervari = $data['rezervari'];
                
                            echo '<tr  class="clickable-row" data-href="participare-slujba-unica.php?id=' . $id_slujba. '">';
                            
                            echo '<td><span class="nume">' . $data_start_fara_ora . '</span></td>';
                            echo '<td>' . $ora_start . '</td>';
                            echo '<td>' . $ora_final . '</td>';
                            echo '<td><span class="nume">' . $slujba . '</span></td>';
                            echo '<td>' . $numar_persoane . '</td>';
                            echo '<td>' . $rezervari . '</td>';
                            echo '<td> <a href="actiuni.php?stergeid='. $id_slujba.'&eveniment=participare_slujbe">x șterge</a>' . '</td>';
                            echo '</tr>';
                    
                            }
                    ?>

                 </div>
            </div>
</div>
</div>
</div>
</body>
</html>