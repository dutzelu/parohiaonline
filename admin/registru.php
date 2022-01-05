<?php 

      include "header-admin.php"; 

      if (isset($_GET['eveniment'])) {
        $eveniment_registru = $_GET['eveniment'];
      }

      switch ($eveniment_registru) {
        case 'programari_botez':
          $fisier_editare = "edit-rezervare.php";
          $vizualizare = "rezervare-unica.php";
          $titlu = "Botezuri";
        break;

        case 'programari_cununie':
          $fisier_editare = "edit-rezervare-cununie.php";
          $vizualizare = "rezervare-unica-cununie.php";
          $titlu = "Cununii";
        break;

        case 'programari_spovedanie':
          $fisier_editare = "";
          $vizualizare = "rezervare-unica-spovedanie.php";
          $titlu = "Spovedanii";
        break;

        case 'programari_sfestanie':
          $fisier_editare = "";
          $vizualizare = "rezervare-unica-sfestanie.php";
          $titlu = "Sfeștanii";
        break;

        case 'programari_parastas':
          $fisier_editare = "";
          $vizualizare = "rezervare-unica-parastas.php";
          $titlu = "Parastase";
        break;

      }
?>

<title>Registru <?php echo $titlu; ?></title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>


        <div class="row mt-3 ultimele-programari">
          <div class="col-sm-12">
            <p class="fw-bold">Registru <?php echo $titlu; ?></p>

            <?php
                  if (isset($_GET['sters'])) {
                      echo '<p id="dispari">Programarea a fost ștearsă cu succes</p>';
                  }
            ?>
            
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nume</th>
                  <th scope="col">Data</th>
                  <th scope="col">Ora</th>
                  <th scope="col">Telefon</th>
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

                  $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM $eveniment_registru");
                  $total_records = mysqli_fetch_array($result_count);
                  $total_records = $total_records['total_records'];
                  $total_no_of_pages = ceil($total_records / $total_records_per_page);
                  $second_last = $total_no_of_pages - 1; // total page minus 1


            // datele

                $a = new database();
                $altele = "ORDER BY id DESC Limit " . $offset . ',' . $total_records_per_page; // Limit și Offset
                $a -> select($eveniment_registru, '*', "", $altele);
                $result = $a->sql;
                $nr_randuri = mysqli_num_rows ($result);
                
                
                while ($row = mysqli_fetch_assoc($result)) { 
                    
                ?>

                <tr class='clickable-row' <?php echo 'data-href="' . $vizualizare . '?id=' . $row['id'] . '"';?>>
                  <td><?php 

                  if ($eveniment_registru == 'programari_botez') {
                    if (empty($row['nume_tata'])) {
                      echo '<span class="nume">' . $row['nume_mama'] . ' ' . $row['prenume_mama'] . "</span>"; 
                    } else {
                      echo '<span class="nume">' . $row['nume_tata'] . ' ' . $row['prenume_tata'] . "</span>"; 
                    }
                  } elseif ($eveniment_registru == 'programari_cununie') {
                      echo '<span class="nume">' . $row['nume_mire'] . ' ' . $row['prenume_mire'] . "</span>"; 
                  }
                   elseif ($eveniment_registru == 'programari_spovedanie') {
                      echo '<span class="nume">' . $row['nume'] . ' ' . $row['prenume'] . "</span>"; 
                  }

                   elseif ($eveniment_registru == 'programari_sfestanie') {
                      echo '<span class="nume">' . $row['nume'] . ' ' . $row['prenume'] . "</span>"; 
                  }
                   elseif ($eveniment_registru == 'programari_parastas') {
                      echo '<span class="nume">' . $row['nume'] . ' ' . $row['prenume'] . "</span>"; 
                  }

                  ?></td>
                  <td><?php echo date("d.m.Y", strtotime($row['data_si_ora'])); ?></td>
                  <td><?php echo date("H:i", strtotime($row['data_si_ora'])); ?></td>
                  <td><?php echo $row['telefon']; ?></td>
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

                      <a href="sterge-camp.php?eveniment=<?php echo $eveniment_registru; ?>&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                      <i class="fas fa-trash-alt"></i></a>

                      <?php echo '<a href="';

                      echo "edit-rezervare.php?id=" . $row['id'];
                      
                      echo '" class="edit"><i class="fas fa-edit"></i></a>';




              ?></td>
                </tr>

            <?php } 
            
            
            
            ?>
            
              </tbody>
            </table>


            <?php $link_paginatie = '?eveniment=' . $eveniment_registru .'&'; include "../includes/paginatie.php";?>


            
        </div>
                </div>
                </div>
    </div>
</div>

</body>
</html>



