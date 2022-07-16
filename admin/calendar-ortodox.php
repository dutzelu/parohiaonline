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

            data_pastelui($year);
            $Pasti = $data_pastelui;
    
//---------------------------------------------------

            // Calculez dumincile dinainte și după Naștere în ANUL ANTERIOR

            $Nasterea_Domnului_0 = $year-1 . "-12-25";
            $ziua_sapt_Nasterea_Domnului_0 = (int)date('w', strtotime($Nasterea_Domnului_0));

            // dacă Nașterea Domnului cade duminica, adică este = 0

            If ($ziua_sapt_Nasterea_Domnului_0 == 0) {
                
                $Duminica_dinaintea_Nasterii_Domnului_0 = date('d M Y', strtotime($Nasterea_Domnului_0. ' -7 days'));
                $Nasterea_Domnului_0 = date("d M Y", strtotime($Nasterea_Domnului_0));
                $Duminica_dupa_Nasterea_Domnului_0 = $Nasterea_Domnului_0;
            } 
            
            //  dacă Nașterea Domnului cade în timpul săptămânii, adică este 1,2,3,4,5 si 6

            else {
                
                $Duminica_dinaintea_Nasterii_Domnului_0 = date('d M Y', strtotime($Nasterea_Domnului_0. '-' . $ziua_sapt_Nasterea_Domnului_0 . ' days'));
               
                $Nasterea_Domnului_0 = date("d M Y", strtotime($Nasterea_Domnului_0));

                $Duminica_dupa_Nasterea_Domnului_0 = date('d M Y', strtotime($Nasterea_Domnului_0. '+' . 7- $ziua_sapt_Nasterea_Domnului_0 . ' days'));
                
            }
         
//---------------------------------------------------

            // Calculez data Duminicii Înainte de Botezul Domnului. 
            
            // Dacă Botezul Domnului cade duminica, adică este = 0

            $Botezul_Domnului = $year . "-01-06";
            $ziua_sapt_Botezul_Domnului = (int)date('w', strtotime($Botezul_Domnului));
            $Botezul_Domnului = date("d M Y", strtotime($Botezul_Domnului));
            
            If ($ziua_sapt_Botezul_Domnului == 0) {
                
                $Duminica_dinaintea_Botezului_Domnului = date('d M Y', strtotime($Botezul_Domnului. ' -7 days'));
                $Duminica_dupa_Botezul_Domnului = date('d M Y', strtotime($Botezul_Domnului. '+' . 7- $ziua_sapt_Botezul_Domnului . ' days'));

                // Duminica după Nașterea Domnului SĂ NU coincidă cu duminica dinaintea Botezului Domnului  
                if ($Duminica_dupa_Nasterea_Domnului_0 != $Duminica_dinaintea_Botezului_Domnului) {
                    $calendarMobil += [$Duminica_dinaintea_Botezului_Domnului => "Duminica_dinaintea_Botezului_Domnului"];
                }
                $calendarMobil += [$Duminica_dupa_Botezul_Domnului => "Duminica dupa Botezul Domnului"];

            } 

            //  dacă Botezul Domnului cade în timpul săptămânii

            elseIf ($ziua_sapt_Botezul_Domnului !== 0 ) {
                
                $Duminica_dinaintea_Botezului_Domnului = date('d M Y', strtotime($Botezul_Domnului. '-' . $ziua_sapt_Botezul_Domnului . ' days'));
               
                $Botezul_Domnului = date("d M Y", strtotime($Botezul_Domnului));

                $Duminica_dupa_Botezul_Domnului = date('d M Y', strtotime($Botezul_Domnului. '+' . 7- $ziua_sapt_Botezul_Domnului . ' days'));

                if ($Duminica_dupa_Nasterea_Domnului_0 != $Duminica_dinaintea_Botezului_Domnului) {
                    $calendarMobil += [$Duminica_dinaintea_Botezului_Domnului => "Duminica dinaintea Botezului Domnului"];
                }
                $calendarMobil += [$Duminica_dupa_Botezul_Domnului => "Duminica dupa Botezului Domnului"];
                
            } 

            // Numărul de săptămâni între Duminica după Botezul Domnului și Duminica a 33-a după Rusalii

            $Duminica_Rusalii_33 = date('d M Y', strtotime($Pasti. ' - 70 days'));

            $interval = date_diff(date_create ($Duminica_dupa_Botezul_Domnului), date_create ($Duminica_Rusalii_33));
            $nrZilePanaLaTriod = $interval->format('%R%a');
            $nrZilePanaLaTriod = (int)trim ($nrZilePanaLaTriod, "+");
            $nrSaptPanaLaTriod = (int) $nrZilePanaLaTriod / 7 - 1;
            
            $duminici_ramase = [
                    "Duminica a 29-a după Rusalii (a celor 10 leproși)",
                    "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)",
                    "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)",
                    "Duminica a 15-a după Rusalii (Porunca cea mare din Lege)",
                    "Duminica a 16-a după Rusalii (Pilda talanților)",
                    "Duminica a 17-a după Rusalii (a Canaanencei)",
            ];

            if ($nrSaptPanaLaTriod == 1) {
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            }
            
            if ($nrSaptPanaLaTriod == 2) {
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            }
            
            if ($nrSaptPanaLaTriod == 3) {
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
           
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 21 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 17-a după Rusalii (a Canaanencei)"];
            }
                
            
            if ($nrSaptPanaLaTriod == 4) {

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 21 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 28 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 17-a după Rusalii (a Canaanencei)"];
            }
            
            if ($nrSaptPanaLaTriod == 5) {

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 21 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 28 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 16-a după Rusalii (Pilda talanților)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 35 days')); 
                $calendarMobil += [$data_duminicii => "Duminica a 17-a după Rusalii (a Canaanencei)"];
            }
            
            if ($nrSaptPanaLaTriod == 6) {
                
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 7 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 29-a după Rusalii (a celor 10 leproși)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 14 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 21 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 32-a după Rusalii (a lui Zaheu vameșul)"];
            
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 28 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 15-a după Rusalii (Porunca cea mare din Lege)"];
            
                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 35 days'));
                $calendarMobil += [$data_duminicii => "Duminica a 16-a după Rusalii (Pilda talanților)"];

                $data_duminicii = date('d M Y', strtotime($Duminica_dupa_Botezul_Domnului. ' + 42 days')); 
                $calendarMobil += [$data_duminicii => "Duminica a 17-a după Rusalii (a Canaanencei)"];
            }
                
            
            // Duminicile Triodului
    
            $calendarMobil += [$Duminica_Rusalii_33 => "Duminica a 33-a după Rusalii (a Vameșului și a Fariselui). Începutul Triodului"];
    
            $Duminica_Rusalii_34 = date('d M Y', strtotime($Pasti. ' - 63 days'));
            $calendarMobil += [$Duminica_Rusalii_34 => "Duminica a 34-a după Rusalii (a Întoarcerii Fiului risipitor)"];
    
            $Duminica_3_Triod = date('d M Y', strtotime($Pasti. ' - 56 days'));
            $calendarMobil += [$Duminica_3_Triod => "Duminica Înfricoșătoarei judecăți (a Lăsatului sec de carne)"];

            $Duminica_4_Triod = date('d M Y', strtotime($Pasti. ' - 49 days'));
            $calendarMobil += [$Duminica_4_Triod => "Duminica izgonirii lui Adam din Rai (a Lăsatului sec de brânză)"];

            // Duminicile Postului Mare
    
            $Inceputul_Postului_Mare = date('d M Y', strtotime($Pasti. ' - 48 days'));
            $calendarMobil += [$Inceputul_Postului_Mare => "Începutul Postului Sfintelor Paști. Zi aliturgică. Canonul cel Mare"];
    
            $Marti_sapt_1_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 47 days'));
            $calendarMobil += [$Marti_sapt_1_Postul_Mare => "Canonul cel Mare. Zi aliturgică."];
    
            $Miercuri_sapt_1_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 46 days'));
            $calendarMobil += [$Miercuri_sapt_1_Postul_Mare => "Canonul cel Mare. Zi aliturgică."];
    
            $Joi_sapt_1_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 45 days'));
            $calendarMobil += [$Joi_sapt_1_Postul_Mare => "Canonul cel Mare. Zi aliturgică."];
    
            $Duminica_1_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 42 days'));
            $calendarMobil += [$Duminica_1_Postul_Mare => "Duminica Întâi din Post (a Ortodoxiei)"];
    
            $Duminica_2_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 35 days'));
            $calendarMobil += [$Duminica_2_Postul_Mare => "Duminica a 2-a din Post (a Sfântului Grigorie Palama)"];
    
            $Duminica_3_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 28 days'));
            $calendarMobil += [$Duminica_3_Postul_Mare => "Duminica a 3-a din Post (a Sfintei Cruci)"];
    
            $Duminica_4_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 21 days'));
            $calendarMobil += [$Duminica_4_Postul_Mare => "Duminica a 4-a din Post (a Sf. Ioan Scărarul)"];
    
            $Duminica_5_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 14 days'));
            $calendarMobil += [$Duminica_5_Postul_Mare => "Duminica a 5-a din Post (a Cuvioasei Maria Egipteanca)"];
    
            $Duminica_6_Postul_Mare = date('d M Y', strtotime($Pasti. ' - 7 days'));
            $calendarMobil += [$Duminica_6_Postul_Mare => "Duminica a 6-a din Post (a Floriilor). Intrarea Domnului în Ierusalim"];

    
            // Săptămâna Mare

            $Lunea_mare = date('d M Y', strtotime($Pasti. ' - 6 days'));
            $calendarMobil += [$Lunea_mare => "Sfânta și Marea zi de Luni"];
    
            $Martea_mare = date('d M Y', strtotime($Pasti. ' - 5 days'));
            $calendarMobil += [$Martea_mare => "Sfânta și Marea zi de Marti"];
    
            $Miercurea_mare = date('d M Y', strtotime($Pasti. ' - 4 days'));
            $calendarMobil += [$Miercurea_mare => "Sfânta și Marea zi de Miercuri"];
    
            $Joia_mare = date('d M Y', strtotime($Pasti. ' - 3 days'));
            $calendarMobil += [$Joia_mare => "Sfânta și Marea zi de Joi"];
    
            $Vinerea_mare = date('d M Y', strtotime($Pasti. ' - 2 days'));
            $calendarMobil += [$Vinerea_mare => "Sfânta și Marea zi de Vineri"];
    
            $Sambata_mare = date('d M Y', strtotime($Pasti. ' - 1 days'));
            $calendarMobil += [$Sambata_mare => "Sfânta și Marea zi de Sâmbăta"];

          
            // Duminicile Penticostarului
            
            $calendarMobil += [$Pasti => "Învierea Domnului (Sfintele Paști)"];
            
            $Ziua_2_Pasti = date('d M Y', strtotime($Pasti. ' + 1 days'));
            $calendarMobil += [$Ziua_2_Pasti => "Sfintele Paști"];
            
            $Ziua_3_Pasti = date('d M Y', strtotime($Pasti. ' + 2 days'));
            $calendarMobil += [$Ziua_3_Pasti => "Sfintele Paști"];
            
            $Izvorul_tamaduirii = date('d M Y', strtotime($Pasti. ' + 5 days'));
            $calendarMobil += [$Izvorul_tamaduirii => "Izvorul Tămăduirii"];
            
            $Duminica_2_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 7 days'));
            $calendarMobil += [$Duminica_2_dupa_Pasti => "Duminica a 2-a după Paști (a Sf. Apostol Toma)"];
            
            $Duminica_3_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 14 days'));
            $calendarMobil += [$Duminica_3_dupa_Pasti => "Duminica a 3-a după Paști (a Mironosițelor)"];
            
            $Duminica_4_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 21 days'));
            $calendarMobil += [$Duminica_4_dupa_Pasti => "Duminica a 4-a după Paști (Vindecarea slăbănogului de la Vitezda)"];
            
            $Duminica_5_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 28 days'));
            $calendarMobil += [$Duminica_5_dupa_Pasti => "Duminica a 5-a după Paști (a Samarinencei)"];
            
            $Duminica_6_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 35 days'));
            $calendarMobil += [$Duminica_6_dupa_Pasti => "Duminica a 6-a după Paști (Vindecarea orbului din naștere)"];
            
            $Inaltarea_Domnului = date('d M Y', strtotime($Pasti. ' + 39 days'));
            $calendarMobil += [$Inaltarea_Domnului => "Înălțarea Domnului (Ziua Eroilor)"];
            
            $Duminica_7_dupa_Pasti = date('d M Y', strtotime($Pasti. ' + 42 days'));
            $calendarMobil += [$Duminica_7_dupa_Pasti => "Duminica a 7-a după Paști (a Sf. Părinți de la Sinodul I Ecumenic)"];
            
            $Rusalii = $Duminica_Pogorarii_Duhului_Sfant = date('d M Y', strtotime($Pasti. ' + 49 days'));
            $calendarMobil += [$Duminica_Pogorarii_Duhului_Sfant => "Pogorârea Sfântului Duh (Cincizecimea sau Rusaliile)"];
            
            $Sfanta_Treime = date('d M Y', strtotime($Pasti. ' + 50 days'));
            $calendarMobil += [$Sfanta_Treime => "Sfânta Treime"];

            // Octoihul

            $Duminica_Rusalii_1 = $Duminica_Tuturor_Sfintilor = date('d M Y', strtotime($Rusalii. ' + 7 days'));
            $calendarMobil += [$Duminica_Tuturor_Sfintilor => "Duminica întâi după Rusalii (a Tuturor Sfinților)"];
            
            // // Postul Sfinților Apostoli Petru și Pavel
            
            // $data_sf_apostoli = $year . "-06-29";
            
            // $Postul_Sf_Apostoli = date_diff(date_create ($Duminica_Tuturor_Sfintilor), date_create ($data_sf_apostoli));
            // $nrZileRamaseSfAp = (int)$Postul_Sf_Apostoli->format('%R%a');
            
            // if ($nrZileRamaseSfAp > 7) {
            //     $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($Duminica_Tuturor_Sfintilor. ' + 1 days'));
            //     $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            // }

            // if ($nrZileRamaseSfAp < 7 && $nrZileRamaseSfAp > 2) {
            //     $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($Duminica_Tuturor_Sfintilor. ' + 2 days'));
            //     $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            //     }
                
            //     if ($nrZileRamaseSfAp < 0 ) {
            //         $Inceputul_Postului_Sf_Apostoli = date('d M Y', strtotime($data_sf_apostoli. ' - 7 days'));
            //         $calendarMobil += [ $Inceputul_Postului_Sf_Apostoli => "Începutul Postului Sf. Ap. Petru și Pavel"];
            //     }
                
            $Duminica_Rusalii_2 = date('d M Y', strtotime($Rusalii. ' + 14 days'));
            $calendarMobil += [$Duminica_Rusalii_2 => "Duminica a 2-a după Rusalii (a Sfinților Români)"];
            
            $Duminica_Rusalii_3 = date('d M Y', strtotime($Rusalii. ' + 21 days'));
            $calendarMobil += [$Duminica_Rusalii_3 => "Duminica a 3-a după Rusalii (Despre grijile vieții)"];
            
            $Duminica_Rusalii_4 = date('d M Y', strtotime($Rusalii. ' + 28 days'));
            $calendarMobil += [$Duminica_Rusalii_4 => "Duminica a 4-a după Rusalii (Vindecarea slujii sutașului)"];
            
            $Duminica_Rusalii_5 = date('d M Y', strtotime($Rusalii. ' + 35 days'));
            $calendarMobil += [$Duminica_Rusalii_5 => "Duminica a 5-a după Rusalii (a Sf. Părinți de la Sinodul al IV-lea Ecumenic. Vindecarea celor doi demonizați din ținutul Gadarei.)"];
            
            $Duminica_Rusalii_6 = date('d M Y', strtotime($Rusalii. ' + 42 days'));
            $calendarMobil += [$Duminica_Rusalii_6 => "Duminica a 6-a după Rusalii (Vindecarea slăbănogului din Capernaum)"];
            
            $Duminica_Rusalii_7 = date('d M Y', strtotime($Rusalii. ' + 49 days'));
            $calendarMobil += [$Duminica_Rusalii_7 => "Duminica a 7-a după Rusalii (Vindecarea a doi orbi și a unui mut din Capernaum)"];
            
            $Duminica_Rusalii_8 = date('d M Y', strtotime($Rusalii. ' + 56 days'));
            $calendarMobil += [$Duminica_Rusalii_8 => "Duminica a 8-a după Rusalii (Înmulțirea pâinilor)"];
            
            $Duminica_Rusalii_9 = date('d M Y', strtotime($Rusalii. ' + 63 days'));
            $calendarMobil += [$Duminica_Rusalii_9 => "Duminica a 9-a după Rusalii (Umblarea pe mare. Potolirea furtunii.)"];
            
            $Duminica_Rusalii_10 = date('d M Y', strtotime($Rusalii. ' + 70 days'));
            $calendarMobil += [$Duminica_Rusalii_10 => "Duminica a 10-a după Rusalii (Vindecarea lunaticului)"];

            // verific dacă Înălțarea Sfintei Cruci cade duminica, adică este = 0

            $Inaltarea_Sfintei_Cruci = $year . "-09-14";
            
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

            $Duminica_Rusalii_11 = date('d M Y', strtotime($Rusalii. ' + 77 days'));
            if ( strtotime($Duminica_Rusalii_11) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_11 => "Duminica a 11-a după Rusalii (Pilda datornicului nemilostiv)"];
            }
            
            $Duminica_Rusalii_12 = date('d M Y', strtotime($Rusalii. ' + 84 days'));
            if ( strtotime($Duminica_Rusalii_12) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_12 => "Duminica a 12-a după Rusalii (Tânărul bogat)"];
            }
            
            $Duminica_Rusalii_13 = date('d M Y', strtotime($Rusalii. ' + 91 days'));
            if ( strtotime($Duminica_Rusalii_13) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_13 => "Duminica a 13-a după Rusalii (Pilda lucrătorilor celor răi)"];
            }
            
            $Duminica_Rusalii_14 = date('d M Y', strtotime($Rusalii. ' + 98 days'));
            if ( strtotime($Duminica_Rusalii_14) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_14 => "Duminica a 14-a după Rusalii (Pilda nunții fiului de împărat)"];
            }
            
            $Duminica_Rusalii_15 = date('d M Y', strtotime($Rusalii. ' + 105 days'));
            if ( strtotime($Duminica_Rusalii_15) < strtotime($Duminica_dinaintea_Inaltarii_Sf_Cruci) ) {
                $calendarMobil += [$Duminica_Rusalii_15 => "Duminica a 15-a după Rusalii (Porunca cea mare din Lege)"];
            }

            $calendarMobil += [$Duminica_dinaintea_Inaltarii_Sf_Cruci => "Duminica dinaintea Înălțării Sfintei Cruci"];

            $calendarMobil += [$Duminica_dupa_Inaltarea_Sf_Cruci => "Duminica după Înălțărea Sfintei Cruci"];

            $Duminica_Rusalii_18 = date('d M Y', strtotime( $Duminica_dupa_Inaltarea_Sf_Cruci. ' + 7 days'));
            $calendarMobil += [$Duminica_Rusalii_18 => "Duminica a 18-a după Rusalii (Pescuirea minunată)"];
            
            $Duminica_Rusalii_19 = date('d M Y', strtotime( $Duminica_dupa_Inaltarea_Sf_Cruci. ' + 14 days'));
            $calendarMobil += [$Duminica_Rusalii_19 => "Duminica a 19-a după Rusalii (Predica de pe munte - iubirea vrăjmașilor)"];
   
            // condiție: Duminica a 21-a după Rusalii să fie în intervalul 11-17 octombrie

            for ($x=11; $x <= 17; $x++) {

                $Duminica_Rusalii_21 = $year . "-10-" . $x;
                $ziua_Duminica_Rusalii_21 = (int)date('w', strtotime($Duminica_Rusalii_21));
            
                if ($ziua_Duminica_Rusalii_21 == 0) {
                    $Duminica_Rusalii_21_corecta = date('d M Y', strtotime($Duminica_Rusalii_21));

                    $calendarMobil += [$Duminica_Rusalii_21_corecta => "Duminica a 21-a după Rusalii (a Sf. Părinți de la Sinodul al VII-lea ecumenic)"];
                }
            }


            // condiție: Duminica a 22-a după Rusalii să fie în intervalul 30 oct. - 5 nov.

            // Pt 30 si 31 oct.
            for ($x=30; $x <= 31; $x++) {

                $Duminica_Rusalii_22 = $year . "-10-" . $x;
                $ziua_Duminica_Rusalii_22 = (int)date('w', strtotime($Duminica_Rusalii_22));
                
                if ($ziua_Duminica_Rusalii_22 == 0) {

                    $Duminica_Rusalii_22_corecta = date('d M Y', strtotime($Duminica_Rusalii_22));

                     $calendarMobil += [$Duminica_Rusalii_22_corecta => "Duminica a 22-a după Rusalii (Bogatul nemilostiv și săracul Lazăr)"];
                   
                }

            }

            // Pentru 1-5 nov.
            for ($x=1; $x <= 5; $x++) {

                $Duminica_Rusalii_22 = $year . "-11-" . $x;
                $ziua_Duminica_Rusalii_22 = (int)date('w', strtotime($Duminica_Rusalii_22));

                if ($ziua_Duminica_Rusalii_22 == 0) {

                    $Duminica_Rusalii_22_corecta = date('d M Y', strtotime($Duminica_Rusalii_22));

                     $calendarMobil += [$Duminica_Rusalii_22_corecta => "Duminica a 22-a după Rusalii (Bogatul nemilostiv și săracul Lazăr)"];
                }

            }


            // Aflu toate duminicile rămase libere în octombrie 

                $duminici_libere_oct_nov  = array();

                aflaDuminici ($year, 10);
                foreach ($duminici_in_luna as $dum) {
                    $duminica = date('d M Y', strtotime($dum . '-10-' . $year)); 
                    if ( !array_key_exists($duminica, $calendarMobil) ) {
                        $duminici_libere_oct_nov[] = $duminica;
                    }
                } 
           

            // Ultimele trei duminici din luna noiembrie sunt întotdeauna 
                // Duminica a 25-a (Pilda Samarineanului milostiv), 
                // Duminica a 26-a (Pilda bogatului căruia i-a rodit țarina) și 
                // Duminica a 30-a (Dregătorul bogat – păzirea poruncilor)

          
            aflaDuminici ($year, 11);
            end($duminici_in_luna);

            $ultima_duminica_din_nov = $year . '-11-' . end($duminici_in_luna);

            $Duminica_Rusalii_25 = date('d M Y', strtotime(  $ultima_duminica_din_nov. ' - 14 days'));
            $calendarMobil += [$Duminica_Rusalii_25 => "Duminica a 25-a după Rusalii (Pilda Samarineanului milostiv)"];
 
            $Duminica_Rusalii_26 = date('d M Y', strtotime(  $ultima_duminica_din_nov. ' - 7 days'));
            $calendarMobil += [$Duminica_Rusalii_26 => "Duminica a 26-a după Rusalii (Pilda bogatului căruia i-a rodit țarina)"];
 
            $Duminica_Rusalii_27 = date('d M Y', strtotime(  $ultima_duminica_din_nov));
            $calendarMobil += [$Duminica_Rusalii_27 => "Duminica a 27-a după Rusalii (Pilda bogatului căruia i-a rodit țarina)"];

            
            // Aflu toate duminicile rămase libere în noiembrie 
   
                foreach ($duminici_in_luna as $dum) {
                    $duminica = date('d M Y', strtotime($dum .  '-11-' . $year)); 
                    if ( !array_key_exists($duminica, $calendarMobil) ) {
                        $duminici_libere_oct_nov[]= $duminica;
                    }
                } 
           
            if (array_key_last($duminici_libere_oct_nov) == 2) {

                $Duminica_Rusalii_20 = date('d M Y', strtotime( $duminici_libere_oct_nov[0] ));
                $calendarMobil += [$Duminica_Rusalii_20 => "Duminica a 20-a după Rusalii (Învierea fiului văduvei din Nain)"];
                
                $Duminica_Rusalii_23 = date('d M Y', strtotime( $duminici_libere_oct_nov[1] ));
                $calendarMobil += [$Duminica_Rusalii_23 => "Duminica a 23-a după Rusalii (Vindecarea demonizatului din ținutul Gherghesenilor)"];

                $Duminica_Rusalii_24 = date('d M Y', strtotime( $duminici_libere_oct_nov[2] ));
                $calendarMobil += [$Duminica_Rusalii_24 => "Duminica a 24-a după Rusalii (Învierea fiicei lui Iair)"];
            }

            if (array_key_last($duminici_libere_oct_nov) == 1) {

                $Duminica_Rusalii_20 = date('d M Y', strtotime( $duminici_libere_oct_nov[0] ));
                $calendarMobil += [$Duminica_Rusalii_20 => "Duminica a 20-a după Rusalii (Învierea fiului văduvei din Nain)"];
                
                $Duminica_Rusalii_23 = date('d M Y', strtotime( $duminici_libere_oct_nov[1] ));
                $calendarMobil += [$Duminica_Rusalii_23 => "Duminica a 23-a după Rusalii (Vindecarea demonizatului din ținutul Gherghesenilor)"];

            }


            // Calculez data Duminicii Înainte de Nașterea Domnului. 
            // Verific dacă Nașterea Domnului cade duminica, adică este = 0

            $Nasterea_Domnului = $year . "-12-25";
            
            $ziua_sapt_Nasterea_Domnului = (int)date('w', strtotime($Nasterea_Domnului));


            // dacă Nașterea Domnului cade duminica

            If ($ziua_sapt_Nasterea_Domnului == 0) {
                
                $Duminica_dinaintea_Nasterii_Domnului = date('d M Y', strtotime($Nasterea_Domnului. ' -7 days'));
                $Nasterea_Domnului = date("d M Y", strtotime($Nasterea_Domnului));
                $Duminica_dupa_Nasterea_Domnului = $Nasterea_Domnului;
            } 
            
            //  dacă Nașterea Domnului cade în timpul săptămânii

            else {
                
                $Duminica_dinaintea_Nasterii_Domnului = date('d M Y', strtotime($Nasterea_Domnului. '-' . $ziua_sapt_Nasterea_Domnului . ' days'));
               
                $Nasterea_Domnului = date("d M Y", strtotime($Nasterea_Domnului));

                $Duminica_dupa_Nasterea_Domnului = date('d M Y', strtotime($Nasterea_Domnului. '+' . 7- $ziua_sapt_Nasterea_Domnului . ' days'));
                
            }

            // Duminicile a 27-a (Tămăduirea femeii gârbove) și Duminica a 28-a (Pilda celor poftiți la cină) vor fi așezate totdeauna ca antepenultima, respectiv penultima înainte de Nașterea Domnului

            $Duminica_Rusalii_27 = date('d M Y', strtotime($Duminica_dinaintea_Nasterii_Domnului. ' - 14 days'));

            // Dacă luna decembrie are cinci duminici încape aici și Duminica a 31-a (condiție)

            $prima_zi_dec = $year . '-12-01';

            $interval = date_diff(date_create ($prima_zi_dec), date_create ($Duminica_Rusalii_27));
            $nrZile = $interval->format('%R%a');
            $nrZile = (int)trim ($nrZile, "+");

            if($nrZile > 6) {

                $Duminica_Rusalii_31 = date('d M Y', strtotime($Duminica_dinaintea_Nasterii_Domnului. ' - 21 days'));
                $calendarMobil += [$Duminica_Rusalii_31 => "Duminica a 31-a după Rusalii (Vindecarea orbului din Ierihon)"];

            }

            $calendarMobil += [$Duminica_Rusalii_27 => "Duminica a 27-a după Rusalii (Tămăduirea femeii gârbove)"];

            $Duminica_Rusalii_28 = date('d M Y', strtotime($Duminica_dinaintea_Nasterii_Domnului. ' - 7 days'));
            $calendarMobil += [$Duminica_Rusalii_28 => "Duminica a 28-a după Rusalii (a Sf. Strămoși după trup ai Domnului.)"];

            $calendarMobil += [$Duminica_dinaintea_Nasterii_Domnului => "Duminica dinaintea Nașterii Domnului"];
            $calendarMobil += [$Duminica_dupa_Nasterea_Domnului => "Duminica după Nașterea Domnului"];
            
            // sortez array-ul în ordinea cronologică a datelor

                foreach ($calendarMobil as $data => $numele_duminicii) {
                    $sort[$data] = strtotime($data);
                }

                array_multisort($sort, SORT_ASC, $calendarMobil);

            echo '<pre>'; print_r($calendarMobil); echo '</pre>';
                
            
                    ?>

                </div>    
        </div>

    </div>
          
</div>




<?php include "../includes/footer.php"?>
</body>
</html>

