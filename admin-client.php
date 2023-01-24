<?php  
include "header-frontend.php"; 
$ultima_zi = NULL;

?>

<title>Panoul de control</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "header-mic-frontend.php";?>

            <div class="row g-4 align-items-center contoare mt-4 mb-5">

                <a href="frontend.php?pentru=botez" class="col-md-4 col-6">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-lg-4  mb-2"><img src="images/botez-albastru.png" /></div>
                            <div class="col-lg-8">Programează un botez</div>
                        </div>
                    </div>
                </a>

                <a href="frontend.php?pentru=cununie" class="col-md-4 col-6">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-lg-4  mb-2"><img src="images/cununii-auriu.png" /></div>
                            <div class="col-lg-8">Programează o cununie</div>
                        </div>
                    </div>
                </a>

                <a href="frontend.php?pentru=sfestanie" class="col-md-4 col-6">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-lg-4  mb-2"><img src="images/sfestanii-verde.png" /></div>
                            <div class="col-lg-8">Programează o Șfeștanie</div>
                        </div>
                    </div>
                </a>

                <a href="frontend.php?pentru=spovedanie" class="col-md-4 col-6">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-lg-4  mb-2"><img src="images/spovedanii-rosu.png" /></div>
                            <div class="col-lg-8">Programează o spovedanie</div>
                        </div>
                    </div>
                </a>

                <a href="frontend.php?pentru=parastas" class="col-md-4 col-6 ">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-lg-4  mb-2"><img src="images/parastase-portocaliu.png" /></div>
                            <div class="col-lg-8">Programează un parastas</div>
                        </div>
                    </div>
                </a>

                <a href="pomelnic-online.php" class="col-md-4 col-6">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-lg-4  mb-2"><img src="images/pomelnic-albastru.png" /></div>
                            <div class="col-lg-8">Trimte un pomelnic</div>
                        </div>
                    </div>
                </a>

            </div>
               
            <div class="row justify-content-start mt-3 urmeaza">
                <div class="col-md-4 col-sm-12 urmeaza-in-calendar">

                <p>Anunțuri în parohie</p>
                <?php

                    $query = 'Select * From articole WHERE tip_articol = "anunt" AND parohie_id = ' . $parohie_id . ' ORDER BY id DESC';

                    $stmt = $conn->prepare($query);
                    $rezultat = $stmt->execute();
                    $rezultat = $stmt->get_result();

                    echo '<ul class="anunt">';

                    while ($data = mysqli_fetch_assoc($rezultat)) {

                    $continut_scurt = substr($data['continut'],0,100).'...';
                    $data_articolului =  date("d M. Y", strtotime($data["data"]));

                    echo '<a class="fs-6" href=info-utile.php?id=' . $data['id'] . '><li>';
                        echo '<p class="titlu-anunt">' . $data['titlu'] .'</p>';
                        echo '<p class="data">' . $data_articolului .'</p>';
                    echo '</li></a>' ; 
                    }

                    echo "</ul>";
                            
                ?>

                </div>

                <div class="col-md-8 col-sm-12 calendar">
                     
                <div class="col-sm-12">

                <!-- Afiseaza programul liturgic oficial -->                    

                    <?php

                    $query = "Select * From program_liturgic Where status = 1 AND parohie_id = ?;";

                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('i',$parohie_id);
                    $rezultat = $stmt->execute();
                    $rezultat = $stmt->get_result();
                    $rowcount = mysqli_num_rows($rezultat);

                    if ($rowcount != 0) {

                        while ($data = mysqli_fetch_assoc($rezultat)) {
                    
                            $program_json = $data['program'];
                            $nume_program_selectat = $data['nume'];
                            $prog_decod = json_decode($program_json);
                            $status = $data['status'];
    
                        }
                    } else {
                        $nume_program_selectat = NULL;
                        echo "<h5>Programul slujbelor</h5>";
                        echo "<p>Încă nu a fost introdus de parohie.</p>";
                    }

                    echo '<h5 class="mt-3">' . $nume_program_selectat . "</h5>";  ?>

                    <div class="table-responsive">
                    <table class="table">
                        
                        
                    <?php if($rowcount != 0) { ?>
                        
                        <thead>
                            <tr>
                                <th scope="col">Ziua</th>
                                <th scope="col">Ora</th>
                                <th scope="col">Slujba</th>
                                <th scope="col">Observații</th>
                            </tr>
                        </thead>
                        
                        <tbody >

                         <?php

                        $data = json_decode($program_json, true);
                        $nr_slujbe = (count($data)-2)/5;

                        for ($i=1; $i <= $nr_slujbe ; $i++) {

                        $ziua_saptamanii = 'ziua_saptamanii'.$i;
                        $slujba = 'slujba'.$i;
                        $text_optional = 'text_optional'.$i;
                        $alte_observatii = 'alte_observatii'.$i;
                        $ora_start = 'ora_start'.$i;

                         ?>

                        <tr class="
                            <?php  $ziua = $prog_decod->$ziua_saptamanii;
                            if ($ultima_zi != $ziua){echo "subliniat"; } ?>">

                        <td class="ziua">
                            <?php if ($ultima_zi != $ziua)
                            {
                                $ultima_zi = $ziua;
                                // dacă e zi a săptămânii
                                if(preg_match("/[a-z]/i", $ziua)){
                                    echo $ziua; 
                                } 
                                // dacă e zi calendaristică
                                else {
                                    $time = strtotime($ziua);
                                    echo $formatter_zi_sapt->format($time) . ', ' . $formatter_zi_luna_an->format($time);
                                }
                            }?>
                        </td>

                        <td><?php echo $prog_decod->$ora_start; ?></td>
                        <td class="slujba_colorata"><?php 


                            echo '<span class="p-1 albastru-inchis">' . $prog_decod->$slujba . ' ' . $prog_decod->$text_optional . '</span>' ; ?>
                        </td>

                            <td><?php echo $prog_decod->$alte_observatii; ?></td>

                    </tr>
                    <?php }} ?> 
                    </tbody>
                    </table>

                    </div>

                </div>
            </div>
            </div>

            <div class="row  ultimele-programari mt-5">
           <h1>Ultimele programări</h1>
            
            <div class="table-responsive">
                    <table class="table">

                        <thead>
                            <tr>
                            <th scope="col">Nume</th>
                            <th scope="col">Programare</th>
                            <th scope="col">Data</th>
                            <th scope="col">Ora</th>
                            <th scope="col">Status</th>
                            <th scope="col">Acțiuni</th>
                            </tr>
                        </thead>

                        <tbody >

                            <?php 
                            
                            // datele programarilor cu status acceptat

                            $query = "
                            Select id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_botez 
                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_cununie 

                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Spovedanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_spovedanie 

                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Sfeștanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_sfestanie 

                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Parastas' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_parastas

                            WHERE user_id = ?

                            ORDER BY introdus_la_data DESC 
                                    
                            LIMIT 15";

                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('iiiii', $user_id, $user_id, $user_id, $user_id, $user_id);
                            $result = $stmt->execute();
                            $result = $stmt->get_result();
                                
                            while ($row = mysqli_fetch_assoc($result)) { 
                            ?>

                            <tr class='clickable-row' data-href='<?php 
                            
                            if ($row['Programare']=="Botez") {
                                echo "home-unic.php?id=" . $row['id'];
                            }

                            if ($row['Programare']=="Cununie") {
                                echo "home-unic-cununie.php?id=" .  $row['id'];
                            }

                            if ($row['Programare']=="Spovedanie") {
                                echo "home-unic-spovedanie.php?id=" .  $row['id'];
                            }

                            if ($row['Programare']=="Sfeștanie") {
                                echo "home-unic-sfestanie.php?id=" .  $row['id'];
                            }
                            if ($row['Programare']=="Parastas") {
                                echo "home-unic-parastas.php?id=" .  $row['id'];
                            }
                            
                            
                            ?>'>
                            <td><?php echo '<span class="nume">' . $row['Nume'] . '</span>'; ?></td>
                            <td><?php echo $row['Programare']; ?></td>
                            <td><?php echo $row['Data']; ?></td>
                            <td><?php echo $row['Ora']; ?></td>
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
                            <td><?php 

                                if ($row['Programare']=="Botez") {?>

                                      <a href="sterge.php?eveniment=programari_botez&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                      <i class="rosu fas fa-trash-alt"></i></a>
                                <?php
                                }
    
                                if ($row['Programare']=="Cununie") {?>
                                     <a href="sterge.php?eveniment=programari_cununie&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                      <i class="rosu fas fa-trash-alt"></i></a>
                                
                                <?php    
                                }
    
                                if ($row['Programare']=="Spovedanie") {?>
                                     <a href="sterge.php?eveniment=programari_spovedanie&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                      <i class="rosu fas fa-trash-alt"></i></a>
                                
                                <?php    
                                }
    
                                if ($row['Programare']=="Sfeștanie") {?>
                                     <a href="sterge.php?eveniment=programari_sfestanie&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                      <i class="rosu fas fa-trash-alt"></i></a>
                                
                                <?php    
                                }
    
                                if ($row['Programare']=="Parastas") {?>
                                     <a href="sterge.php?eveniment=programari_parastas&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                      <i class="rosu fas fa-trash-alt"></i></a>
                                
                                <?php    
                                }

                                if ($row['Programare']=="Botez") {
                                    echo '  <a href="';
                                    echo "home-unic.php?id=" . $row['id'];
                                    echo '" class="edit"><i class="fas fa-edit"></i></a>';
                                } elseif ($row['Programare']=="Cununie") {
                                    echo '  <a href="';
                                    echo "home-unic-cununie.php?id=" .  $row['id'];
                                    echo '" class="edit"><i class="fas fa-edit"></i></a>';
                                } else {echo '';}
    
                                 
                                
                                
                            

                            
                            ?></td>
                            </tr>

                            <?php }?>

                        </tbody>

                    </table>
                    </div> 
                </div>    
        </div>

    </div>
          
</div>




<?php include "includes/footer.php"?>
</body>
</html>


