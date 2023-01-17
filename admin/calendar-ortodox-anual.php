<?php 

        $ultima_luna = null;
        $zi = null;
        $calendarMobil = [];

        include "header-admin.php"; 
               
        $day = (int) (isset($_GET['day']) ? $_GET['day'] : date('d'));
        $month = (int) (isset($_GET['month']) ? $_GET['month'] : date('m'));
        $year = (int)  (isset($_GET['year']) ? $_GET['year'] : date('Y'));
        
        include 'calendar-date-variabile.php';
        afiseazaSfinti_luna($month);
        martiri_fcp($month);
?>

<title>Calendar ortodox anual</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>

            <div class="row mt-3 ultimele-programari">
                <h1>Calendarul ortodox anual</h1>
               
                    <?php controls();
                    
                       $monthName = strftime('%B', mktime(0, 0, 0, $month));

                       echo '<p class="titlu_luna" >' . $monthName . '</p>';

                            foreach ($rezs as $x){

                                if($x['sarbatoare'] == 1) {$clasa = 'rosu';} else {$clasa="";}

                                $data_selectata = $year . "-" .  $month. "-" . $x['zi'];
                                $ziua_sapt = (int)date('w', strtotime($data_selectata));

                                switch ($ziua_sapt) {
                                    case 0: $ziua_sapt = "D"; break;
                                    case 1: $ziua_sapt = "L"; break;
                                    case 2: $ziua_sapt = "M"; break;
                                    case 3: $ziua_sapt = "M"; break;
                                    case 4: $ziua_sapt = "J"; break;
                                    case 5: $ziua_sapt = "V"; break;
                                    case 6: $ziua_sapt = "S"; break;
                                }

                                if ($ziua_sapt == "S") {
                                    $clasa_zi = "sambata";
                                } else {$clasa_zi = 'normala';}

              
                                echo '<div class="row align-items-center ' . $clasa_zi . '">';
                                echo '<div class="col-2 col-sm-1">'. $x['zi'] . ' ' . $ziua_sapt . '</div>';
                                
                                $data_selectata = date('d M Y', strtotime($data_selectata));

                                echo '<div class="col-10 col-sm-11">';
                                     
                                    foreach ($calendarMobil as $zi => $descriere) {
                                        if ($zi == $data_selectata) {
                                            echo "<div class='rosu fw-bold'>" . $descriere . "</div>";
                                        }
                                     }
                                     
                                 
                                echo '<p class="sfinti ' . $clasa .  '">' . $x['sfinti'] ;

                                foreach ($zi_aparte as $zi => $descriere) {
                                    if ($zi == $data_selectata) {
                                        echo '<strong>(' . $descriere . '</strong>) ' ;
                                    }
                                 }

                                foreach ($dezlegari as $zi => $descriere) {
                                    if ($zi == $data_selectata) {
                                        echo '(' . $descriere . ')</p>';
                                    }
                                 }

                                // listează titlu Comemorare:
                                 foreach ($martiri_fcp_total as $a) {
                                    $data_deces = strtotime($a['mDataAdormire']);
                                    $zi_deces = date('d', $data_deces);
                                    
                                    if ($x['zi'] == $zi_deces) {                                 
                                        echo '<p>Comemorare: ';
                                        break;
                                    } 
                                 }

                                 // listează martiri

                                 foreach ($martiri_fcp_total as $a) {
                                     $data_deces = strtotime($a['mDataAdormire']);
                                     $zi_deces = date('d', $data_deces);
                                     
                                     if ($x['zi'] == $zi_deces) {
                                         
                                        echo '<span class="comemorareFCP"><a href="https://fericiticeiprigoniti.net/' . strtolower(replaceSpecialChars($a['mPrenume']))  . '-' . strtolower(replaceSpecialChars($a['mNume'])) . '">'. $a['mPrefix'] . ' ' . $a['mPrenume'] . ' ' . $a['mNume'] . ';</a></span> ';
                                        
                                        } else {$token = NULL;}

                                }
                                 
                                 echo '</div>';
                                 
                                 echo '</div>';
                                 
                                }
                            
                            ?>
                        </div>
          
            <?php
                echo "<ul>";
                    
                echo "</ul>";
            ?>



    </div>
          
</div>




<?php include "../includes/footer.php"?>
</body>
</html>


