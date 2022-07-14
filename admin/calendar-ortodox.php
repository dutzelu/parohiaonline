<?php 

$ultima_luna = null;
$zi = null;
$calendarMobil = [];

      include "header-admin.php"; 

        /* date settings */

        $day = (int) (isset($_GET['day']) ? $_GET['day'] : date('d'));
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

        $next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1) .'" class="control"> &#10095; </a>';

        /* "previous month" control */

        $previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.    ($month != 1 ? $year : $year - 1).'" class="control"> &#10094; </a>';



      // datele programarilor cu status acceptat

          $query = "
          Select id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_botez WHERE data_si_ora LIKE ? AND parohie_id = ?
         
          UNION ALL 

          Select id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_cununie  WHERE data_si_ora LIKE ? AND parohie_id = ?
      
          UNION ALL 

          Select id, 'Spovedanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_spovedanie  WHERE data_si_ora LIKE ? AND parohie_id = ?

          UNION ALL 

          Select id, 'Sfeștanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_sfestanie WHERE data_si_ora LIKE ? AND parohie_id = ?
          
          UNION ALL 

          Select id, 'Parastas' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_parastas WHERE data_si_ora LIKE ? AND parohie_id = ? 
          

          ORDER BY Data, Ora ASC";
        

        if ($day < 10) {$day = '0' . $day;}
        if ($month <= 10) {$month = '0' . $month;}
       
          if (isset($_GET['day'])) {
              $data_exacta = "%" . $year . "-" .  $month. "-" . $day  . "%" ;
          } else {
            $data_exacta = "%" . $year . "-" .  $month . "%" ;
          }

          $stmt = $conn->prepare($query);
          $stmt->bind_param('sisisisisi', $data_exacta, $id, $data_exacta, $id, $data_exacta, $id, $data_exacta, $id,  $data_exacta, $id );
          $result = $stmt->execute();
          $result = $stmt->get_result();
                
          $rows = array();
          while ($row = mysqli_fetch_assoc($result)) { 
              $id_programare = $row['id'];
              $rows[] = $row;
          }


?>

<title>Calendar complet</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>

            <div class="row mt-3 ultimele-programari">
                <p class="fw-bold">Calendarul complet al rezervărilor</p>
                <div class="col-sm-6">
                    <?php include 'calendar-slujbe.php';?>
                </div>

                <div class="col-sm-6">


                     <?php

            $an_ales = 2050;
            data_pastelui($an_ales);
            $Pasti_anul0 = $data_pastelui;
            
            data_pastelui($an_ales+1);
            $Pasti_anul1 = $data_pastelui;
            // echo "<strong>Duminica Învierii în " .  $an_ales+1 . " este pe </strong>" . $data_pastelui;
            // echo "<br>";
            
            $interval = date_diff(date_create ($Pasti_anul0), date_create ($Pasti_anul1));
            $nrZileAnBisericesc = $interval->format('%R%a');
            $nrZileAnBisericesc = (int)trim ($nrZileAnBisericesc, "+");
            $nrSaptAn = (int) $nrZileAnBisericesc / 7;
            echo "<strong>Anul bisericesc " . $an_ales . "-" . $an_ales+1 . "</strong> are " . $nrZileAnBisericesc . " zile și " .$nrSaptAn . " săptămâni: </strong>";
            
            // Duminicile Penticostarului
            
            echo "<br><br>";
            echo "Penticostarul";
            echo "<br>";
            
            echo "<br>";
            echo $Pasti_anul0 . " - Duminica Învierii";
            $calendarMobil += [$Pasti_anul0 => "Învierea Domnului (Sfintele Paști)"];
            
            echo "<br>";
            $Ziua_2_Pasti = date('d M Y', strtotime($Pasti_anul0. ' + 1 days'));
            $calendarMobil += [$Ziua_2_Pasti => "Sfintele Paști"];
            echo $Ziua_2_Pasti . " - Sfintele Paști";
            
            echo "<br>";
            $Ziua_3_Pasti = date('d M Y', strtotime($Pasti_anul0. ' + 2 days'));
            $calendarMobil += [$Ziua_2_Pasti => "Sfintele Paști"];
            echo $Ziua_3_Pasti . " - Sfintele Paști";
            
            echo "<br>";
            $Izvorul_tamaduirii = date('d M Y', strtotime($Pasti_anul0. ' + 5 days'));
            $calendarMobil += [$Izvorul_tamaduirii => "Izvorul Tămăduirii"];
            echo $Izvorul_tamaduirii . " - Izvorul Tămăduirii";
            
            echo "<br>";
            $Duminica_2_dupa_Pasti = date('d M Y', strtotime($Pasti_anul0. ' + 7 days'));
            $calendarMobil += [$Duminica_2_dupa_Pasti => "Duminica a 2-a după Paști (a Sf. Apostol Toma)"];
            echo $Duminica_2_dupa_Pasti . " - Duminica a 2-a după Paști (a Sf. Apostol Toma)";
            
            echo "<br>";
            $Duminica_3_dupa_Pasti = date('d M Y', strtotime($Pasti_anul0. ' + 14 days'));
            $calendarMobil += [$Duminica_3_dupa_Pasti => "Duminica a 3-a după Paști (a Mironosițelor)"];
            echo $Duminica_3_dupa_Pasti . " - Duminica a 3-a după Paști (a Mironosițelor)";
            
            echo "<br>";
            $Duminica_4_dupa_Pasti = date('d M Y', strtotime($Pasti_anul0. ' + 21 days'));
            $calendarMobil += [$Duminica_4_dupa_Pasti => "Duminica a 4-a după Paști (Vindecarea slăbănogului de la Vitezda)"];
            echo $Duminica_4_dupa_Pasti . " - Duminica a 4-a după Paști (Vindecarea slăbănogului de la Vitezda)";
            
            echo "<br>";
            $Duminica_5_dupa_Pasti = date('d M Y', strtotime($Pasti_anul0. ' + 28 days'));
            $calendarMobil += [$Duminica_5_dupa_Pasti => "Duminica a 5-a după Paști (a Samarinencei)"];
            echo $Duminica_5_dupa_Pasti . " - Duminica a 5-a după Paști (a Samarinencei)";
            
            echo "<br>";
            $Duminica_6_dupa_Pasti = date('d M Y', strtotime($Pasti_anul0. ' + 35 days'));
            $calendarMobil += [$Duminica_6_dupa_Pasti => "Duminica a 6-a după Paști (Vindecarea orbului din naștere)"];
            echo $Duminica_6_dupa_Pasti . " - Duminica a 6-a după Paști (Vindecarea orbului din naștere)";
            
            echo "<br>";
            $Inaltarea_Domnului = date('d M Y', strtotime($Pasti_anul0. ' + 39 days'));
            $calendarMobil += [$Inaltarea_Domnului => "Înălțarea Domnului (Ziua Eroilor)"];
            echo $Inaltarea_Domnului . " - Înălțarea Domnului (Ziua Eroilor)";
            
            echo "<br>";
            $Duminica_7_dupa_Pasti = date('d M Y', strtotime($Pasti_anul0. ' + 42 days'));
            $calendarMobil += [$Duminica_7_dupa_Pasti => "Duminica a 7-a după Paști (a Sf. Părinți de la Sinodul I Ecumenic)"];
            echo $Duminica_7_dupa_Pasti . " - Duminica a 7-a după Paști (a Sf. Părinți de la Sinodul I Ecumenic)";
            
            echo "<br>";
            $Rusalii = $Duminica_Pogorarii_Duhului_Sfant = date('d M Y', strtotime($Pasti_anul0. ' + 49 days'));
            $calendarMobil += [$Duminica_Pogorarii_Duhului_Sfant => "Pogorârea Sfântului Duh (Cincizecimea sau Rusaliile)"];
            echo $Duminica_Pogorarii_Duhului_Sfant . " - Pogorârea Sfântului Duh (Cincizecimea sau <strong>Rusaliile</strong>)";
            
            echo "<br>";
            $Sfanta_Treime = date('d M Y', strtotime($Pasti_anul0. ' + 50 days'));
            $calendarMobil += [$Sfanta_Treime => "Sfânta Treime"];
            echo $Sfanta_Treime . " - Sfânta Treime";

            // Octoihul

            echo "<br>";
            echo "<br>Octoihul<br>";
            
            echo "<br>";
            $Duminica_Rusalii_1 = $Duminica_Tuturor_Sfintilor = date('d M Y', strtotime($Rusalii. ' + 7 days'));
            $calendarMobil += [$Duminica_Tuturor_Sfintilor => "Duminica întâi după Rusalii (a Tuturor Sfinților)"];
            echo $Duminica_Tuturor_Sfintilor . " - Duminica întâi după Rusalii (a Tuturor Sfinților)";
            
            // // Postul Sfinților Apostoli Petru și Pavel
            
            // $data_sf_apostoli = $an_ales . "-06-29";
            
            // $Postul_Sf_Apostoli = date_diff(date_create ($Duminica_Tuturor_Sfintilor), date_create ($data_sf_apostoli));
            // $nrZileRamaseSfAp = (int)$Postul_Sf_Apostoli->format('%R%a');
            // echo "<br>";
            
            // if ($nrZileRamaseSfAp > 7) {
            //     $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($Duminica_Tuturor_Sfintilor. ' + 1 days'));
            //     $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            //     echo $Inceputul_Postului_Sf_Apostoli . " - Începutul Postului Sf. Ap. Petru și Pavel";
            // }

            // if ($nrZileRamaseSfAp < 7 && $nrZileRamaseSfAp > 2) {
            //     $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($Duminica_Tuturor_Sfintilor. ' + 2 days'));
            //     $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            //         echo $Inceputul_Postului_Sf_Apostoli . " - Începutul Postului Sf. Ap. Petru și Pavel";
            //     }
                
            //     if ($nrZileRamaseSfAp < 0 ) {
            //         $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($data_sf_apostoli. ' - 7 days'));
            //         $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            //         echo $Inceputul_Postului_Sf_Apostoli . " - Începutul Postului Sf. Ap. Petru și Pavel";
            //     }
                
            
            echo "<br>";
            $Duminica_Rusalii_2 = date('d M Y', strtotime($Rusalii. ' + 14 days'));
            $calendarMobil += [$Duminica_Rusalii_2 => "Duminica a 2-a după Rusalii (a Sfinților Români)"];
            echo $Duminica_Rusalii_2 . " - Duminica a 2-a după Rusalii (a Sfinților Români)";
            
            echo "<br>";
            $Duminica_Rusalii_3 = date('d M Y', strtotime($Rusalii. ' + 21 days'));
            $calendarMobil += [$Duminica_Rusalii_3 => "Duminica a 3-a după Rusalii (Despre grijile vieții)"];
            echo $Duminica_Rusalii_3 . " - Duminica a 3-a după Rusalii (Despre grijile vieții)";
            
            echo "<br>";
            $Duminica_Rusalii_4 = date('d M Y', strtotime($Rusalii. ' + 28 days'));
            $calendarMobil += [$Duminica_Rusalii_4 => "Duminica a 4-a după Rusalii (Vindecarea slujii sutașului)"];
            echo $Duminica_Rusalii_4 . " - Duminica a 4-a după Rusalii (Vindecarea slujii sutașului)";
            
            echo "<br>";
            $Duminica_Rusalii_5 = date('d M Y', strtotime($Rusalii. ' + 35 days'));
            $calendarMobil += [$Duminica_Rusalii_5 => "Duminica a 5-a după Rusalii (a Sf. Părinți de la Sinodul al IV-lea Ecumenic. Vindecarea celor doi demonizați din ținutul Gadarei.)"];
            echo $Duminica_Rusalii_5 . " - Duminica a 5-a după Rusalii (a Sf. Părinți de la Sinodul al IV-lea Ecumenic. Vindecarea celor doi demonizați din ținutul Gadarei.)";
            
            echo "<br>";
            $Duminica_Rusalii_6 = date('d M Y', strtotime($Rusalii. ' + 42 days'));
            $calendarMobil += [$Duminica_Rusalii_6 => "Duminica a 6-a după Rusalii (Vindecarea slăbănogului din Capernaum)"];
            echo $Duminica_Rusalii_6 . " - Duminica a 6-a după Rusalii (Vindecarea slăbănogului din Capernaum)";
            
            echo "<br>";
            $Duminica_Rusalii_7 = date('d M Y', strtotime($Rusalii. ' + 49 days'));
            $calendarMobil += [$Duminica_Rusalii_7 => "Duminica a 7-a după Rusalii (Vindecarea a doi orbi și a unui mut din Capernaum)"];
            echo $Duminica_Rusalii_7 . " - Duminica a 7-a după Rusalii (Vindecarea a doi orbi și a unui mut din Capernaum)";
            
            echo "<br>";
            $Duminica_Rusalii_8 = date('d M Y', strtotime($Rusalii. ' + 56 days'));
            $calendarMobil += [$Duminica_Rusalii_8 => "Duminica a 8-a după Rusalii (Înmulțirea pâinilor)"];
            echo $Duminica_Rusalii_8 . " - Duminica a 8-a după Rusalii (Înmulțirea pâinilor)";
            
            echo "<br>";
            $Duminica_Rusalii_9 = date('d M Y', strtotime($Rusalii. ' + 63 days'));
            $calendarMobil += [$Duminica_Rusalii_9 => "Duminica a 9-a după Rusalii (Umblarea pe mare. Potolirea furtunii.)"];
            echo $Duminica_Rusalii_9 . " - Duminica a 9-a după Rusalii (Umblarea pe mare. Potolirea furtunii.)";
            
            echo "<br>";
            $Duminica_Rusalii_10 = date('d M Y', strtotime($Rusalii. ' + 70 days'));
            $calendarMobil += [$Duminica_Rusalii_10 => "Duminica a 10-a după Rusalii (Vindecarea lunaticului)"];
            echo $Duminica_Rusalii_10 . " - Duminica a 10-a după Rusalii (Vindecarea lunaticului)";

            // verific dacă Înălțarea Sfintei Cruci cade duminica, adică este = 0

            $Inaltarea_Sfintei_Cruci = $an_ales . "-09-14";
            
            $ziua_sapt_Inaltarea_Sfintei_Cruci = (int)date('w', strtotime($Inaltarea_Sfintei_Cruci));

            If ($ziua_sapt_Inaltarea_Sfintei_Cruci == 0) {
                
                $Duminica_dinaintea_Inaltarii_Sf_Cruci = date('d M Y', strtotime($Inaltarea_Sfintei_Cruci. ' -7 days'));
                $Inaltarea_Sfintei_Cruci = date("d M Y", strtotime($Inaltarea_Sfintei_Cruci));
                $Duminica_dupa_Inaltarea_Sf_Cruci = date('d M Y', strtotime($Inaltarea_Sfintei_Cruci. ' +7 days'));
               
            } 
            
            // dacă Înălțarea Sfintei Cruci cade în timpul săptămânii

            else {
                
                $Duminica_dinaintea_Inaltarii_Sf_Cruci = date('d M Y', strtotime($Inaltarea_Sfintei_Cruci. '-' . $ziua_sapt_Inaltarea_Sfintei_Cruci . ' days'));
               
                $Inaltarea_Sfintei_Cruci = date("d M Y", strtotime($Inaltarea_Sfintei_Cruci));
           
                $Duminica_dupa_Inaltarea_Sf_Cruci = date('d M Y', strtotime($Inaltarea_Sfintei_Cruci. '+' . 7- $ziua_sapt_Inaltarea_Sfintei_Cruci . ' days'));
                
            }

            // condiție: Duminicile să nu fie mai târzii decât Duminica dinaintea Înălțării Sfintei Cruci

            echo "<br>";

            $Duminica_Rusalii_11 = date('d M Y', strtotime($Rusalii. ' + 77 days'));
            if ( strtotime($Duminica_Rusalii_11) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_11 => "Duminica a 11-a după Rusalii (Pilda datornicului nemilostiv)"];
                echo $Duminica_Rusalii_11 . " - Duminica a 11-a după Rusalii (Pilda datornicului nemilostiv)";
            }
            
            $Duminica_Rusalii_12 = date('d M Y', strtotime($Rusalii. ' + 84 days'));
            if ( strtotime($Duminica_Rusalii_12) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                echo "<br>";
                $calendarMobil += [$Duminica_Rusalii_12 => "Duminica a 12-a după Rusalii (Tânărul bogat)"];
                echo $Duminica_Rusalii_12 . " - Duminica a 12-a după Rusalii (Tânărul bogat)";
            }
            
            $Duminica_Rusalii_13 = date('d M Y', strtotime($Rusalii. ' + 91 days'));
            if ( strtotime($Duminica_Rusalii_13) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                echo "<br>";
                $calendarMobil += [$Duminica_Rusalii_13 => "Duminica a 13-a după Rusalii (Pilda lucrătorilor celor răi)"];
                echo $Duminica_Rusalii_13 . " - Duminica a 13-a după Rusalii (Pilda lucrătorilor celor răi)";
            }
            
            $Duminica_Rusalii_14 = date('d M Y', strtotime($Rusalii. ' + 98 days'));
            if ( strtotime($Duminica_Rusalii_14) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                echo "<br>";
                $calendarMobil += [$Duminica_Rusalii_14 => "Duminica a 14-a după Rusalii (Pilda nunții fiului de împărat)"];
                echo $Duminica_Rusalii_14 . " - Duminica a 14-a după Rusalii (Pilda nunții fiului de împărat)";
            }
            
            $Duminica_Rusalii_15 = date('d M Y', strtotime($Rusalii. ' + 105 days'));
            if ( strtotime($Duminica_Rusalii_15) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                echo "<br>";
                $calendarMobil += [$Duminica_Rusalii_15 => "Duminica a 15-a după Rusalii (Porunca cea mare din Lege)"];
                echo $Duminica_Rusalii_15 . " - Duminica a 15-a după Rusalii (Porunca cea mare din Lege)";
            }
            echo "<hr>";

            echo $Duminica_dinaintea_Inaltarii_Sf_Cruci . " - Duminica dinaintea Înălțării Sfintei Cruci";
            $calendarMobil += [$Duminica_dinaintea_Inaltarii_Sf_Cruci => "Duminica dinaintea Înălțării Sfintei Cruci"];

            echo "<br>";
            echo $Inaltarea_Sfintei_Cruci . " - Înălțărea Sfintei Cruci";

            echo "<br>";
            $calendarMobil += [$Duminica_dupa_Inaltarea_Sf_Cruci => "Duminica după Înălțărea Sfintei Cruci"];
            echo $Duminica_dupa_Inaltarea_Sf_Cruci . " - Duminica dupa Înălțărea Sfintei Cruci";
            
            echo "<hr>";

            $Duminica_Rusalii_18 = date('d M Y', strtotime( $Duminica_dupa_Inaltarea_Sf_Cruci. ' + 7 days'));
            $calendarMobil += [$Duminica_Rusalii_18 => "Duminica a 18-a după Rusalii (Pescuirea minunată)"];
            echo  $Duminica_Rusalii_18 . "<strong> - Duminica a 18-a după Rusalii (Pescuirea minunată)</strong>";    
            
            echo "<br>";
            $Duminica_Rusalii_19 = date('d M Y', strtotime( $Duminica_dupa_Inaltarea_Sf_Cruci. ' + 14 days'));
            $calendarMobil += [$Duminica_Rusalii_19 => "Duminica a 19-a după Rusalii (Predica de pe munte - iubirea vrăjmașilor)"];
            echo $Duminica_Rusalii_19 . "<strong> - Duminica a 19-a după Rusalii (Predica de pe munte - iubirea vrăjmașilor)</strong>";    
   
            // condiție: Duminica a 21-a după Rusalii să fie în intervalul 11-17 octombrie

            for ($x=11; $x <= 17; $x++) {

                $Duminica_Rusalii_21 = $an_ales . "-10-" . $x;
                $ziua_Duminica_Rusalii_21 = (int)date('w', strtotime($Duminica_Rusalii_21));

                if ($ziua_Duminica_Rusalii_21 == 0) {
                    $Duminica_Rusalii_21 = date('d M Y', strtotime($Duminica_Rusalii_21));

                    $calendarMobil += [$Duminica_Rusalii_21 => "Duminica a 21-a după Rusalii (a Sf. Părinți de la Sinodul al VII-lea ecumenic)"];
                     echo "<br>";
                    echo $Duminica_Rusalii_21 . "<strong> - Duminica a 21-a după Rusalii (a Sf. Părinți de la Sinodul al VII-lea ecumenic)</strong>"; 
                }
            }

            // condiție: Duminica a 22-a după Rusalii să fie în intervalul 30 oct. - 5 nov.

            // Pt 30 si 31 oct.
            for ($x=30; $x <= 31; $x++) {

                $Duminica_Rusalii_22 = $an_ales . "-10-" . $x;
                $ziua_Duminica_Rusalii_22 = (int)date('w', strtotime($Duminica_Rusalii_22));
                
                if ($ziua_Duminica_Rusalii_22 == 0) {

                    $Duminica_Rusalii_22 = date('d M Y', strtotime($Duminica_Rusalii_22));

                     $calendarMobil += [$Duminica_Rusalii_22 => "Duminica a 22-a după Rusalii (Bogatul nemilostiv și săracul Lazăr)"];
                     echo "<br>";
                    echo $Duminica_Rusalii_22 . "<strong> - Duminica a 22-a după Rusalii (Bogatul nemilostiv și săracul Lazăr)</strong>"; 
                }

            }

            // Pentru 1-5 nov.
            for ($x=1; $x <= 5; $x++) {

                $Duminica_Rusalii_22 = $an_ales . "-11-" . $x;
                $ziua_Duminica_Rusalii_22 = (int)date('w', strtotime($Duminica_Rusalii_22));

                if ($ziua_Duminica_Rusalii_22 == 0) {

                    $Duminica_Rusalii_22 = date('d M Y', strtotime($Duminica_Rusalii_22));

                     $calendarMobil += [$Duminica_Rusalii_22 => "Duminica a 22-a după Rusalii (Bogatul nemilostiv și săracul Lazăr)"];
                     echo "<br>";
                    echo $Duminica_Rusalii_22 . "<strong> - Duminica a 22-a după Rusalii (Bogatul nemilostiv și săracul Lazăr)</strong>"; 
                }

            }


            // Calculez data Duminicii Înainte de Nașterea Domnului. 
            // Verific dacă Nașterea Domnului cade duminica, adică este = 0

            $Nasterea_Domnului = $an_ales . "-12-25";
            
            $ziua_sapt_Nasterea_Domnului = (int)date('w', strtotime($Nasterea_Domnului));

            If ($ziua_sapt_Nasterea_Domnului == 0) {
                
                $Duminica_dinaintea_Nașterii_Domnului = date('d M Y', strtotime($Nasterea_Domnului. ' -7 days'));
                $Nasterea_Domnului = date("d M Y", strtotime($Nasterea_Domnului));
                $Duminica_dupa_Nasterea_Domnului = $Nasterea_Domnului;
            } 
            
            //  dacă Nașterea Domnului cade în timpul săptămânii

            else {
                
                $Duminica_dinaintea_Nașterii_Domnului = date('d M Y', strtotime($Nasterea_Domnului. '-' . $ziua_sapt_Nasterea_Domnului . ' days'));
               
                $Nasterea_Domnului = date("d M Y", strtotime($Nasterea_Domnului));

                $Duminica_dupa_Nasterea_Domnului = date('d M Y', strtotime($Nasterea_Domnului. '+' . 7- $ziua_sapt_Nasterea_Domnului . ' days'));
                
            }

            echo "<hr>";
            
            $calendarMobil += [$Duminica_dinaintea_Nașterii_Domnului => "Duminica dinaintea Nașterii Domnului"];
            $calendarMobil += [$Duminica_dinaintea_Nașterii_Domnului => "Duminica după Nașterea Domnului"];

            // Duminicile a 27-a (Tămăduirea femeii gârbove) și Duminica a 28-a (Pilda celor poftiți la cină) vor fi așezate totdeauna ca antepenultima, respectiv penultima înainte de Nașterea Domnului

         
            $Duminica_Rusalii_27 = date('d M Y', strtotime($Duminica_dinaintea_Nașterii_Domnului. ' - 14 days'));

            // Dacă luna decembrie are cinci duminici încape aici și Duminica a 31-a (condiție)

            $prima_zi_dec = $an_ales . '-12-01';

            $interval = date_diff(date_create ($prima_zi_dec), date_create ($Duminica_Rusalii_27));
            $nrZile = $interval->format('%R%a');
            $nrZile = (int)trim ($nrZile, "+");

            if($nrZile > 6) {

                echo "<br>";
                $Duminica_Rusalii_31 = date('d M Y', strtotime($Duminica_dinaintea_Nașterii_Domnului. ' - 21 days'));
                $calendarMobil += [$Duminica_Rusalii_31 => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];
                echo $Duminica_Rusalii_31 . " - Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)";

            }


            $calendarMobil += [$Duminica_Rusalii_27 => "Duminica a 27-a după Rusalii (Tămăduirea femeii gârbove)"];
            echo "<br>";
            echo $Duminica_Rusalii_27 . " - Duminica a 27-a după Rusalii (Tămăduirea femeii gârbove)";

            echo "<br>";
            $Duminica_Rusalii_28 = date('d M Y', strtotime($Duminica_dinaintea_Nașterii_Domnului. ' - 7 days'));
            $calendarMobil += [$Duminica_Rusalii_28 => "Duminica a 28-a după Rusalii (a Sf. Strămoși după trup ai Domnului.)"];
            echo $Duminica_Rusalii_28 . " - Duminica a 28-a după Rusalii (a Sf. Strămoși după trup ai Domnului.)";
            
            echo "<br>";
            echo $Duminica_dinaintea_Nașterii_Domnului . " - Duminica dinaintea Nașterii Domnului (a Sf. Părinți după trup ai Domnului)"; 
            
            echo "<br>";
            echo $Nasterea_Domnului . " - Nașterea Domnului"; 
            
   
            If ($ziua_sapt_Nasterea_Domnului !== 0)  {
                echo "<br>";
                echo $Duminica_dupa_Nasterea_Domnului . " - Duminica după Nașterea Domnului"; 
            }

            
            echo "<hr>";

            // Calculez data Duminicii Înainte de Botezul Domnului. 
            // Verific dacă Botezul Domnului cade duminica, adică este = 0

            $Botezul_Domnului = $an_ales + 1 . "-01-06";
            $ziua_sapt_Botezul_Domnului = (int)date('w', strtotime($Botezul_Domnului));
            $Botezul_Domnului = date("d M Y", strtotime($Botezul_Domnului));
            
            // Duminica după Nașterea Domnului SĂ NU coincidă cu duminica dinaintea Botezului Domnului  
            
            // var_dump ($Duminica_dupa_Nasterea_Domnului);
            // echo "<br>";
            // var_dump($Duminica_dinaintea_Botezului_Domnului);
            // echo "<br>";
            // var_dump($ziua_sapt_Botezul_Domnului);
            // echo "<br>";
            
            If ($ziua_sapt_Botezul_Domnului == 0) {
                
                $Duminica_dinaintea_Botezului_Domnului = date('d M Y', strtotime($Botezul_Domnului. ' -7 days'));
                $calendarMobil += [$Duminica_dinaintea_Botezului_Domnului => "Duminica_dinaintea_Botezului_Domnului"];
                     

                if ($Duminica_dupa_Nasterea_Domnului != $Duminica_dinaintea_Botezului_Domnului) {

                    echo "<br>";
                    echo $Duminica_dinaintea_Botezului_Domnului . " - Duminica dinaintea Botezului Domnului"; 
                }
            
                echo "<br>";
                echo $Botezul_Domnului . " - Botezului Domnului"; 

            } 

            //  dacă Nașterea Domnului cade în timpul săptămânii



            elseIf ($ziua_sapt_Botezul_Domnului !== 0 ) {
                
                $Duminica_dinaintea_Botezului_Domnului = date('d M Y', strtotime($Botezul_Domnului. '-' . $ziua_sapt_Botezul_Domnului . ' days'));
               
                $Botezul_Domnului = date("d M Y", strtotime($Botezul_Domnului));

                $Duminica_dupa_Botezul_Domnului = date('d M Y', strtotime($Botezul_Domnului. '+' . 7- $ziua_sapt_Botezul_Domnului . ' days'));

                $calendarMobil += [$Duminica_dinaintea_Botezului_Domnului => "Duminica_dinaintea_Botezului_Domnului"];
                $calendarMobil += [$Duminica_dupa_Botezul_Domnului => "Duminica_dupa_Botezului_Domnului"];

                if ($Duminica_dupa_Nasterea_Domnului != $Duminica_dinaintea_Botezului_Domnului) {
                    echo "<br>";
                    echo $Duminica_dinaintea_Botezului_Domnului . " - Duminica dinaintea Botezului Domnului"; 
                }
                echo "<br>";
                echo $Botezul_Domnului . " - Botezului Domnului"; 
                echo "<br>";
                echo $Duminica_dupa_Botezul_Domnului . " - Duminica dupa Botezul Domnului"; 
                
            } else {
                
                echo "<br>";
                echo $Botezul_Domnului . " - Botezului Domnului"; 
            }
            
             
                
            //  echo '<pre>'; print_r($calendarMobil); echo '</pre>';
                

            
                    ?>

                </div>    
        </div>

    </div>
          
</div>




<?php include "../includes/footer.php"?>
</body>
</html>


