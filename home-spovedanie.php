<?php include "header-frontend.php"; ?>

<title>Programări Spovedanii</title>
</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-frontend.php";?>
        
        <div class="row mt-3 ultimele-programari">
              <p class="fw-bold">Programări SPOVEDANII</p>

              <?php
                  if (isset($_GET['sters'])) {
                      echo '<p id="dispari">Programarea a fost ștearsă cu succes</p>';
                  }
             ?>
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

                            $query_count = "
                            
                            SELECT COUNT(*) As total_records
                            FROM (
                       
                                Select id, 'Spovedanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_spovedanie 
                                WHERE user_id = ?


                              ) x ";

                            $stmt = $conn->prepare($query_count);
                            $stmt->bind_param('i', $user_id);
                            $rez = $stmt->execute();
                            $rez = $stmt->get_result();
 
                            $total_records = mysqli_fetch_array($rez);
                            $total_records = $total_records['total_records'];
                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                            $second_last = $total_no_of_pages - 1; // total page minus 1
                            
                            // datele programarilor cu status acceptat

                            $query = "
                            Select id, 'Spovedanie' as Programare, concat(nume, ' ', prenume) as Nume , DATE(data_si_ora) as Data, DATE_FORMAT(data_si_ora,'%H:%i') as Ora, status FROM programari_spovedanie 

                            WHERE user_id = ?

                            ORDER BY Data ASC 
                                    
                            LIMIT ?, ?";

                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('iii', $user_id, $offset, $total_records_per_page);
                            $result = $stmt->execute();
                            $result = $stmt->get_result();

                            
                                
                            while ($row = mysqli_fetch_assoc($result)) { 
                            ?>

                            <tr class='clickable-row' data-href="<?php echo "home-unic-spovedanie.php?id=" . $row['id'];
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
                            <td>

                             

                                <a href="sterge.php?eveniment=programari_spovedanie&data=<?php echo $row['Data']; ?>&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                <i class="rosu fas fa-trash-alt"></i></a>
                

                        </td>
                            </tr>

                            <?php }?>

                        </tbody>

                    </table>

                    <?php 
                    $link_paginatie = 'home-spovedanie.php?'; 
                    include "includes/paginatie.php"; ?>

 
</div>    
</div>

</div>
  
</div>

</body>
</html>

 