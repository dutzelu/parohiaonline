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
          
          Select id, user_id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_botez WHERE parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_cununie WHERE parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Spovedanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_spovedanie WHERE parohie_id = $id

          UNION ALL 

          Select id, user_id, 'Sfeștanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_sfestanie WHERE parohie_id = $id
          
          UNION ALL 

          Select id, user_id, 'Parastas' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status, introdus_la_data FROM programari_parastas WHERE parohie_id = $id
          
          ORDER BY introdus_la_data DESC 
          
          LIMIT 50";


?>

<title>Panoul de control</title>
</head>

    <body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>

            <div class="row g-4 align-items-center contoare">
                <p class="mt-5">În ultimele 30 de zile:</p>
                
                <a href="registru.php?eveniment=programari_botez" class="col-md-4 col-6">
                    <div class="contor">
                        <div class="row align-items-center">
                            <div class="col-xxl-3 col-lg-4  mb-2"><img src="../images/botez-albastru.png" /></div>
                            <div class="col-lg-8 ">
                                <?php program_ultimele_30_zile("programari_botez", $id);
                                
                                if ($nr_randuri_prog == 1) {
                                    echo " botez ";
                                } else {echo ' botezuri ';}
                                
                                ?> 
                                </div>
                        </div>
                    </div>
                </a>

                <a href="registru.php?eveniment=programari_cununie" class="col-md-4 col-6">
                    <div class="contor">
                        <div class="row align-items-center">
                           <div class="col-xxl-3 col-lg-4  mb-2"><img src="../images/cununii-auriu.png" /></div>
                            <div class="col-lg-8">
                                
                            <?php program_ultimele_30_zile("programari_cununie", $id);
                                
                                if ($nr_randuri_prog == 1) {
                                    echo " cununie ";
                                } else {echo ' cununii ';}
                            ?>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="registru.php?eveniment=programari_spovedanie" class="col-md-4 col-6">
                    <div class="contor">
                        <div class="row align-items-center">
                           <div class="col-xxl-3 col-lg-4  mb-2"><img src="../images/spovedanii-rosu.png" /></div>
                            <div class="col-lg-8 ">
                                <?php program_ultimele_30_zile("programari_spovedanie", $id);
                                
                                if ($nr_randuri_prog == 1) {
                                    echo " spovedanie ";
                                } else {echo ' spovedanii ';} 
                                
                                ?> </div>
                        </div>
                    </div>
                </a>

                <a href="registru.php?eveniment=programari_parastas" class="col-md-4 col-6">
                    <div class="contor">
                        <div class="row align-items-center">
                           <div class="col-xxl-3 col-lg-4  mb-2"><img src="../images/parastase-portocaliu.png" /></div>
                            <div class="col-lg-8 ">
                                <?php program_ultimele_30_zile("programari_parastas", $id);
                                
                                if ($nr_randuri_prog == 1) {
                                    echo " parastas ";
                                } else {echo ' parastase ';} 
                                ?>
                               </div>
                        </div>
                    </div>
                </a>

                <a href="pomelnice.php" class="col-md-4 col-6">
                    <div class="contor">
                        <div class="row align-items-center">
                           <div class="col-xxl-3 col-lg-4  mb-2"><img src="../images/pomelnic-albastru.png" /></div>
                            <div class="col-lg-8 ">
                                <?php pomelnice_30_zile($id);
                                
                                if ($nr_randuri_prog == 1) {
                                    echo " pomelnic ";
                                } else {echo ' pomelnice ';} 
                                ?>
                                </div>
                        </div>
                    </div>
                </a>

                <a href="registru.php?eveniment=programari_sfestanie" class="col-md-4 col-6">
                    <div class="contor">
                        <div class="row align-items-center">
                           <div class="col-xxl-3 col-lg-4  mb-2"><img src="../images/sfestanii-verde.png" /></div>
                            <div class="col-lg-8">
                            
                            <?php program_ultimele_30_zile("programari_sfestanie", $id);
                                
                            if ($nr_randuri_prog == 1) {
                                echo " sfeștanie ";
                            } else {echo ' sfeștanii ';} 
                            ?>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="row justify-content-start mt-3 g-4 urmeaza">
                <div class="col-md-4 col-sm-12 urmeaza-in-calendar">

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

                        $data_afisata = strtotime($row['Data']);
                        $data_afisata = strftime('%e %b %Y',$data_afisata);
                         

                        echo '">' . $row['Programare'] . '</span> ' .  $data_afisata . ' | ' . $row['Ora'] . '<br>' . '<span class="nume">' . $row['Nume'] . '</span></p><hr>';
                        
                        if (++$i == 6) break;
                    } ?>



                </div>

                <div class="col-md-8 col-sm-12 calendar">
                    
                    <div class="legenda">
                        <p><span class="fw-bold mb-2">Calendar programări (orice status):</span><br>Alegeți una din zilele pentru detalii.</p>
                        
                        <?php include 'calendar-slujbe.php';
                        
                        $day = date('d');
                        $month = date('m');
                        $year = date('Y');
                        
                        ?>

                        <p class="mt-5"><a class="btn btn-primary" href="calendar-complet.php?<?php echo 'day=' . intval($day) . '&month=' . intval($month) . '&year=' . $year;?>" role="button">Vezi Calendar complet</a>  </p>

                        </div>

                </div>

            </div>

            <div class="row  ultimele-programari mt-5">
                <div class="table-responsive">
                   <h1>Ultimele programări (orice status)</h1>
                    <table id="example" class="table">

                        <thead>
                            <tr>
                            <th scope="col">Nume</th>
                            <th scope="col">Programare</th>
                            <th scope="col">Data</th>
                            <th scope="col">Ora</th>
                            <th scope="col">Status</th>
                            <th scope="col">Acțiuni</th>
                            <th scope="col">Adăugat de:</th>
                            </tr>
                        </thead>

                        <tbody >

                    
                            <?php 
                            
                            $stmt = $conn->prepare($query_orice_status);
                            $result2 = $stmt->execute();
                            $result2 = $stmt->get_result();
                            while ($row2 = mysqli_fetch_assoc($result2)) { ?>

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
                            <td><?php echo strftime('%e %b %Y',strtotime($row2['Data'])); ?></td>
                            <td><?php echo $row2['Ora']; ?></td>
                            
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
                        <td><?php nume_user($row2['user_id']); ?></td>
                            </tr>
                            
                            <?php }?>
                            
                        </tbody>
                        
                    </table>

                </div>    
        </div>

    </div>
          
</div>

<script>


$(document).ready(function () {
    $('#example').DataTable({
        "order": [],
        language: {
            url: '../js/dataTablesRomana.json'
        }
    });
});


</script>


<?php include "../includes/footer.php"?>

</body>
</html>


