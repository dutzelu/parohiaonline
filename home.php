<?php include "header-frontend.php"; 
 


$user_id = $_SESSION['id'];
  
?>

<title>Programările mele</title>
</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>
        
        <div class="row mt-3 ultimele-programari">
              <p class="fw-bold">Programările mele</p>
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

                          // paginatia 

                          if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                            $page_no = $_GET['page_no'];
                            } else {$page_no = 1;}

                            $total_records_per_page = 10; // numar de randuri pe pagina
                            $offset = ($page_no-1) * $total_records_per_page;
                            $previous_page = $page_no - 1;
                            $next_page = $page_no + 1;
                            $adjacents = "2"; 

                            $result_count = mysqli_query($conn,"
                            
                            SELECT COUNT(*) As total_records
                              FROM (
                              Select id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_botez 
                              WHERE user_id = 25

                              UNION ALL 

                              Select id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_cununie 
                              WHERE user_id = 25

                              ) x ");

                            $total_records = mysqli_fetch_array($result_count);
                            $total_records = $total_records['total_records'];
                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                            $second_last = $total_no_of_pages - 1; // total page minus 1
                            
                            // datele programarilor cu status acceptat

                            $query = "
                            Select id, 'Botez' as Programare, concat(nume_tata, ' ', prenume_tata) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_botez 
                            WHERE user_id = ?

                            UNION ALL 

                            Select id, 'Cununie' as Programare, concat(nume_mire, ' ', prenume_mire) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_cununie 

                            WHERE user_id = ?

                            ORDER BY Data ASC 
                                    
                            LIMIT ?, ?";

                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('iiii', $_SESSION['id'], $_SESSION['id'], $offset, $total_records_per_page);
                            $result = $stmt->execute();
                            $result = $stmt->get_result();

                            
                                
                            while ($row = mysqli_fetch_assoc($result)) { 
                            ?>

                            <tr class='clickable-row' data-href="<?php 
                            
                            if ($row['Programare']=="Botez") {
                                echo "home-unic.php?id=" . $row['id'];
                            }

                            if ($row['Programare']=="Cununie") {
                                echo "home-unic-cununie.php?id=" .  $row['id'];
                            }
                            
                            
                            ?>">
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

                    <?php 
                    $link_paginatie = 'home.php?'; 
                    include "paginatie.php"; ?>

 
</div>    
</div>

</div>
  
</div>

</body>
</html>

 