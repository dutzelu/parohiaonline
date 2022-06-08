<?php 
      include "header-admin.php"; 

      // datele programarilor cu status acceptat

          $query = "
          Select id, user_id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_botez 
          WHERE status LIKE 'acceptata' AND parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_cununie 
          WHERE status LIKE 'acceptata' AND parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Spovedanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_spovedanie WHERE status LIKE 'acceptata' AND parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Sfeștanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_sfestanie WHERE status LIKE 'acceptata' AND parohie_id = $id
          
          UNION ALL 

          Select id, user_id, 'Parastas' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_parastas WHERE status LIKE 'acceptata' AND parohie_id = $id
          

          ORDER BY Data DESC 
          
          LIMIT 15";

          $stmt = $conn->prepare($query);
          $result = $stmt->execute();
          $result = $stmt->get_result();
                
          $rows = array();
          while ($row = mysqli_fetch_assoc($result)) { 
              $id_programare = $row['id'];
              $rows[] = $row;
          }

        // datele programarilor cu orice status

          $query_orice_status = "
          Select id, user_id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_botez WHERE parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_cununie WHERE parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Spovedanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_spovedanie WHERE parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Sfeștanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_sfestanie WHERE parohie_id = $id
          
          UNION ALL 

          Select id, user_id, 'Parastas' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_parastas WHERE parohie_id = $id
          

          ORDER BY Data DESC 
          
          LIMIT 15";

          $stmt = $conn->prepare($query_orice_status);
          $result2 = $stmt->execute();
          $result2 = $stmt->get_result();
                
          $rows2 = array();
          while ($row2 = mysqli_fetch_assoc($result2)) { 
              $id_programare2 = $row2['id'];
              $rows2[] = $row2;
          }


?>

<title>Panoul de control</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>

            <div class="row mt-1 justify-content-start contoare">

                <a href="registru.php?eveniment=programari_botez" class="col-sm-3 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="../images/botez-albastru.png" /></div>
                            <div class="col-sm-9">3 botezuri <br> în ultimele 30 de zile</div>
                        </div>
                    </div>
                </a>

                <a href="registru.php?eveniment=programari_cununie" class="col-sm-3 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="../images/cununii-auriu.png" /></div>
                            <div class="col-sm-9">2 cununii <br> în ultimele 30 de zile</div>
                        </div>
                    </div>
                </a>

                <a href="registru.php?eveniment=programari_sfestanie" class="col-sm-3 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="../images/sfestanii-verde.png" /></div>
                            <div class="col-sm-9">5 sfeștanii <br> în ultimele 30 de zile</div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="row mt-3 justify-content-start contoare">

                <a href="registru.php?eveniment=programari_botez" class="col-sm-4 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="../images/spovedanii-rosu.png" /></div>
                            <div class="col-sm-9">23 persoane programate la Spovedanie în ultimele 30 de zile</div>
                        </div>
                    </div>
                </a>

                <a href="registru.php?eveniment=programari_cununie" class="col-sm-3 m-2">
                    <div>
                        <div class="row align-items-center">
                            <div class="col-sm-3"><img src="../images/parastase-portocaliu.png" /></div>
                            <div class="col-sm-9">2 cununii <br> în ultimele 30 de zile</div>
                        </div>
                    </div>
                </a>

                </div>

            <div class="row mt-3 justify-content-start p-4 urmeaza">
                <div class="col-sm-4 p-5 urmeaza-in-calendar">

                    <p class="fw-bold">Calendar (status: acceptat)</p>
                    
                    <?php 
                    
                    $i = 0;
                
                    foreach ($rows as $row) {
                        echo '<p><span class="';

                        switch($row['Programare']) {

                            case "Botez": echo 'urmeaza-botez';
                            break;
                            case "Cununie": echo 'urmeaza-cununie';
                            break;
                            case "Spovedanie": echo 'urmeaza-spovedanie';
                            break;
                            case "Parastas": echo 'urmeaza-parastas';
                            break;
                            case "Sfeștanie": echo 'urmeaza-sfestanie';
                            break;
                        
                        }
                        
                       echo '">' . $row['Programare'] . '</span> ' . $row['Data'] . ' | ' . $row['Ora'] . '<br>' . '<span class="nume">' . $row['Nume'] . '</span></p><hr>';
                       
                       if (++$i == 6) break;
                    } ?>


                </div>
                <div class="col-sm-8 p-5 calendar">
                    <?php include 'calendar-slujbe.php'?>
                        
                        <div class="mt-3 legenda">
                            <p><span class="fw-bold">Legenda:</span><br>
                          În calendar apar subliniate zilele în care există evenimente. <br> Alegeți una din zilele pentru detalii.</p>

                        <p class="mt-5"><a class="btn btn-primary" href="calendar-complet.php" role="button">Vezi Calendar complet</a>  </p>

                        </div>

                </div>
            </div>

            <div class="row mt-3 ultimele-programari">
                <div class="col-sm-12">
                    <p class="fw-bold">Ultimele programări (orice status)</p>
                    <table class="table">

                        <thead>
                            <tr>
                            <th scope="col">Nume</th>
                            <th scope="col">Programare</th>
                            <th scope="col">Data</th>
                            <th scope="col">Ora</th>
                            <th scope="col">Adăugat de:</th>
                            <th scope="col">Status</th>
                            <th scope="col">Acțiuni</th>
                            </tr>
                        </thead>

                        <tbody >

                    
                            <?php foreach ($rows2 as $row2) { ?>

                            <tr class='clickable-row' data-href='<?php 
                            
                            if ($row2['Programare']=="Botez") {
                                echo "rezervare-unica.php?id=" . $row2['id'];
                            }

                            if ($row2['Programare']=="Cununie") {
                                echo "rezervare-unica-cununie.php?id=" .  $row2['id'];
                            }

                            if ($row2['Programare']=="Sfeștanie") {
                                echo "rezervare-unica-sfestanie.php?id=" . $row2['id'];
                            }

                            if ($row2['Programare']=="Spovedanie") {
                                echo "rezervare-unica-spovedanie.php?id=" .  $row2['id'];
                            }
                            

                            if ($row2['Programare']=="Parastas") {
                                echo "rezervare-unica-parastas.php?id=" .  $row2['id'];
                            }
                            
                            
                            ?>'>
                            <td><?php echo '<span class="nume">' . $row2['Nume'] . '</span>'; ?></td>
                            <td><?php echo $row2['Programare']; ?></td>
                            <td><?php echo $row2['Data']; ?></td>
                            <td><?php echo $row2['Ora']; ?></td>
                            <td><?php nume_user($row2['user_id']); ?></td>
                            <td><?php echo '<span class="status ';
                            
                            switch($row2['status']) {

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
                            
                            echo '">' .$row2['status'] . '</span>'; ?></td>
                            <td><?php 

                            if ($row2['Programare']=="Botez") {?>

                                <a href="actiuni.php?eveniment=programari_botez&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row2['id']; ?>" class="sterge" title="Șterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                <i class="rosu fas fa-trash-alt"></i></a>
                            <?php
                            }

                            if ($row2['Programare']=="Cununie") {?>
                            <a href="actiuni.php?eveniment=programari_cununie&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row2['id']; ?>" class="sterge" title="Șterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                <i class="rosu fas fa-trash-alt"></i></a>

                            <?php    
                            }

                            if ($row2['Programare']=="Spovedanie") {?>
                            <a href="actiuni.php?eveniment=programari_spovedanie&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row2['id']; ?>" class="sterge" title="Șterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                <i class="rosu fas fa-trash-alt"></i></a>

                            <?php    
                            }

                            if ($row2['Programare']=="Sfeștanie") {?>
                            <a href="actiuni.php?eveniment=programari_sfestanie&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row2['id']; ?>" class="sterge" title="Șterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                <i class="rosu fas fa-trash-alt"></i></a>

                            <?php    
                            }

                            if ($row2['Programare']=="Parastas") {?>
                            <a href="actiuni.php?eveniment=programari_parastas&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row2['id']; ?>" class="sterge" title="Șterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                <i class="rosu fas fa-trash-alt"></i></a>

                            <?php    
                            }

                             
                      if ($row2['Programare']=="Botez") {

                          echo '<a class="accepta" id="accepta' . $row2['id'] . '". href="accepta-programare.php?id=' . $row2['id'] . '&status=acceptata&back=admin" role="button" title="Acceptă"><i class="far fa-check-circle"></i></a>';
                     
                      } elseif ($row2['Programare']=="Cununie") {

                          echo '<a class="accepta" id="accepta' . $row2['id'] . '". href="accepta-programare-cununie.php?id=' . $row2['id'] . '&status=acceptata&back=admin" role="button" title="Acceptă"><i class="far fa-check-circle"></i></a>';

                      }
                       elseif ($row2['Programare']=="Spovedanie") {

                          echo '<a class="accepta" id="accepta' . $row2['id'] . '". href="accepta-programare-spovedanie.php?id=' . $row2['id'] . '&status=acceptata&back=admin" role="button" title="Acceptă"><i class="far fa-check-circle"></i></a>';

                      }
    
                       elseif ($row2['Programare']=="Sfeștanie") {

                          echo '<a class="accepta" id="accepta' . $row2['id'] . '". href="accepta-programare-sfestanie.php?id=' . $row2['id'] . '&status=acceptata&back=admin" role="button" title="Acceptă"><i class=" far fa-check-circle"></i></a>';

                      }
                       elseif ($row2['Programare']=="Parastas") {

                          echo '<a class="accepta" id="accepta' . $row2['id'] . '". href="accepta-programare-parastas.php?id=' . $row2['id'] . '&status=acceptata&back=admin" role="button" title="Acceptă"><i class=" far fa-check-circle"></i></a>';

                      }

                            
                            ?></td>
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


