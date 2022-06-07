<?php  include "header-frontend.php"; ?>

<title>Panoul de control</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-frontend.php";?>

            <div class="row mt-1 justify-content-start contoare">

                <a href="frontend.php?pentru=botez" class="col-sm-3 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="images/botez-albastru.png" /></div>
                            <div class="col-sm-9">Programează Taina Botezului</div>
                        </div>
                    </div>
                </a>

                <a href="frontend.php?pentru=cununie" class="col-sm-3 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="images/cununii-auriu.png" /></div>
                            <div class="col-sm-9">Programează Taina Cununiei</div>
                        </div>
                    </div>
                </a>

                <a href="frontend.php?pentru=sfestanie" class="col-sm-3 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="images/sfestanii-verde.png" /></div>
                            <div class="col-sm-9">Programează Șfeștanie</div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="row mt-3 justify-content-start contoare">

                <a href="frontend.php?pentru=spovedanie" class="col-sm-4 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="images/spovedanii-rosu.png" /></div>
                            <div class="col-sm-9">Programează Taina Spovedaniei</div>
                        </div>
                    </div>
                </a>

                <a href="frontend.php?pentru=parastas" class="col-sm-3 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="images/parastase-portocaliu.png" /></div>
                            <div class="col-sm-9">Programează Parastas</div>
                        </div>
                    </div>
                </a>

                </div>

            <div class="row mt-3 justify-content-start p-4 urmeaza">
                <div class="col-sm-4 p-5 urmeaza-in-calendar">

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

                <div class="col-sm-8 p-5 calendar">
                     
                        
 
                </div>
            </div>

            <div class="row mt-3 ultimele-programari">
                <div class="col-sm-12">
                    <p class="fw-bold">Ultimele programări</p>
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
                            Select id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_botez 
                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_cununie 

                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Spovedanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_spovedanie 

                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Sfeștanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_sfestanie 

                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Parastas' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_parastas

                            WHERE user_id = ?

                            ORDER BY Data ASC 
                                    
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




<?php include "includes/footer.php"?>
</body>
</html>


