<?php 
      include "header-frontend.php"; 

?>
<title>Panoul de control</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>

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

                    <p class="fw-bold">Anunțuri</p>
                    <p>In fiecare duminica <strong>Sfanta Liturghie incepe la ora 9:00,</strong> iar de la ora 13:00 avem popasuri de rugaciune si momente in care se pot impartasi copiii si cei care au binecuvantare pentru impartasanie.</p>

                    <p>Pentru Sfanta Liturghie <strong>se poate intra in biserica doar intre orele 8:15 si 8:45.</strong> Cu alte cuvinte, intodeauna ajungem la biserica inainte de inceperea Sfintei Liturghii. Pentru impartasire de la ora 13:00, se intra in biserica intre 12:45 si 13:00</p>

                    <p><strong>Nu este nevoie de programare pentru a participa la slujbele sus mentionate.</strong><p>

                    <p>Pomelnicele se scriu doar acasa si vor putea fi lasate dimpreuna cu ofranda pentru biserica intr-o cutie la intrare. </p>

                    <p>Tuturor sanatate si pace in viata!</p>
                

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

                            ORDER BY Data ASC 
                                    
                            LIMIT 15";

                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('ii', $_SESSION['id'], $_SESSION['id']);
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

                                      <a href="sterge-camp.php?eveniment=programari_botez&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                      <i class="rosu fas fa-trash-alt"></i></a>
                                <?php
                                }
    
                                if ($row['Programare']=="Cununie") {?>
                                     <a href="sterge-camp.php?eveniment=programari_cununie&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                      <i class="rosu fas fa-trash-alt"></i></a>
                                
                                <?php    
                                }

                                
                                
                                echo '  <a href="';
                                
                                if ($row['Programare']=="Botez") {
                                    echo "edit-rezervare.php?id=" . $row['id'];
                                }
    
                                if ($row['Programare']=="Cununie") {
                                    echo "edit-rezervare-cununie.php?id=" .  $row['id'];
                                }
                                
                                
                                echo '" class="edit"><i class="fas fa-edit"></i></a>';
                            

                            
                            ?></td>
                            </tr>

                            <?php }?>

                        </tbody>

                    </table>

                </div>    
        </div>

    </div>
          
</div>




<?php include "footer.php"?>
</body>
</html>


