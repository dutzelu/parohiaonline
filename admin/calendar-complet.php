<?php 

$ultima_luna = null;
$zi = null;

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
          echo "ziua: " . $day;
          echo "<br>";
          echo "luna: " . $month;
          echo "<br>";
          echo "anul: " . $year;
          echo "<br>";
        

          include "calendar-date-variabile.php";
 
          
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
                     $data_exacta = trim($data_exacta, "%");
                     $data_exacta = date('d M Y', strtotime($data_exacta));

                     echo "<br>";
                     echo $data_exacta;
                     echo "Calendarul se afișează greșit începând cu 1 mai. Apar duminicile în locul zilelor de luni.";

                     // afișez datele variabile
                     foreach ($calendarMobil as $zi => $descriere) {
                        if ($zi == $data_exacta) {
                            echo "<p class='rosu'>" . $zi . ' - ' . $descriere . "</p>";
                        }
                     }

                     // afișez datele fixe

                     afiseazaSfinti ($month, $day);

                     echo "<p>" . $sfinti . "</p>";

                     

                ?>

                    <table class="table calendar-complet">

                        <thead>
                            <tr>
                            <th scope="col">Data</th>
                            <th scope="col">Ora</th>
                            <th scope="col">Programare</th>
                            <th scope="col">Nume</th>
                            <th scope="col">Status</th>
                    
                            </tr>
                        </thead>

                        <tbody >

                    
                            <?php foreach ($rows as $row) {
                                
                            $luna = $row['Data'];

                            echo '<tr class="clickable-row';
                            
                            if ($ultima_luna != $luna){
                                echo " subliniat"; 
                                }
                            echo '"';
                            if ($row['Programare']=="Botez") {
                                echo 'data-href = "rezervare-unica.php?id=' . $row['id'] .'"';
                            }

                            if ($row['Programare']=="Cununie") {
                                echo 'data-href = "rezervare-unica-cununie.php?id=' .  $row['id']  .'"';
                            }

                            if ($row['Programare']=="Sfeștanie") {
                                echo 'data-href = "rezervare-unica-sfestanie.php?id=' . $row['id']  .'"';
                            }

                            if ($row['Programare']=="Spovedanie") {
                                echo 'data-href = "rezervare-unica-spovedanie.php?id=' .  $row['id']  .'"';
                            }
                            

                            if ($row['Programare']=="Parastas") {
                                echo 'data-href = "rezervare-unica-parastas.php?id=' .  $row['id']  .'"';
                            }
                            
                            
                            ?>'>

                            <td><?php 
                              
                                if ($ultima_luna != $luna) {
                                    $ultima_luna = $luna;
                                    echo '<span class="red">' . date("d M", strtotime($luna)) . '</span>'; }?>
                               
                            
                            </td>

                            <td><?php echo $row['Ora']; ?></td>
                            <td><?php echo $row['Programare']; ?></td>
                            <td><?php echo '<span class="nume">' . $row['Nume'] . '</span>'; ?></td>
                            <td><?php echo '<span class="status ';
                            
                            switch($row['status']) {

                                case "acceptata": echo 'acceptata';
                                break;
                                case "respinsa": echo 'respinsa';
                                break;
                                case "anulata": echo 'respinsa';
                                break;
                                case "detalii": echo 'detalii';
                                break;
                                case "în așteptare": echo 'in-asteptare';
                                break;
                            }
                            
                            echo '">' .$row['status'] . '</span>'; ?></td>

                            
                            </tr>

                            <?php }?>

                        </tbody>

                    </table>

                </div>    
        </div>

    </div>
          
</div>




<?php include "../includes/footer.php"?>
</body>
</html>


