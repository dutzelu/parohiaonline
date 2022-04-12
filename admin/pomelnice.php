<?php  include "header-admin.php"; ?>

<title>Pomelnice</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>


        <div class="row mt-3 ultimele-programari">
          <div class="col-sm-12">
            <p class="fw-bold">Pomelnice</p>

            <div class="filtre mb-4">

            <form method="GET" action="pomelnice-filtre.php">

                <div class="input-group mb-2">
                    <!-- <span class="input-group-text">Tip pomelnic</span> -->
                    <select name="tip_pomelnic" class="form-control">
                        <option hidden disabled selected value> - Tip pomelnic - </option>
                        <option value="1" >Liturghie (vii)</option>
                        <option value="2" >Liturghie (adormiți)</option>
                        <option value="3" >Maslu</option>
                        <option value="4" >Acatist</option>
                        <option value="5" >Parastas</option>
                    </select>

                    <!-- <span class="input-group-text">Durata</span> -->
                    <select name="durata_in_zile" class="form-control">
                        <option hidden disabled selected value> - Durata - </option>
                        <option value="1">O zi</option>
                        <option value="7">O săptămână</option>
                        <option value="30">O lună</option>
                        <option value="40">40 de zile</option>
                        <option value="365">Un an</option>
                    </select>

                    <input type="text" name="nume_si_prenume" class="form-control" placeholder="nume">

                    <!-- <span class="input-group-text">Cu sau fără donație</span> -->
                    <select name="cu_donatie" class="form-control">
                        <option hidden disabled selected value> - Donație - </option>
                        <option value="1">Da</option>
                        <option value="2">Nu</option>
                    </select>

                </div>

                <div class="input-group mb-2">

                    <span class="input-group-text">Începând cu data</span>
                    <input type="date" name="data_start" class="form-control">

                    <span class="input-group-text">Până la data</span>
                    <input type="date" name="data_final" class="form-control">

                </div>

                    <button class="btn btn-primary" name="filtre">Filtrează</button>
                    <a href="pomelnice.php" class="btn btn-outline-primary">Reset</a>

                </form>


</div>

            <?php
                  if (isset($_GET['sters'])) {
                      echo '<p id="dispari">Pomelnicul a fost șters cu succes</p>';
                  }
            ?>

            
            <table class="table">

              <thead>
                <tr>
                  <th scope="col">Tip</th>
                  <th scope="col">Lista nume</th>
                  <th scope="col">Durata (zile)</th>
                  <th scope="col">Nume</th>
                  <th scope="col">Data începerii</th>
                  <th scope="col">Donație</th>
                  <th scope="col">Șterge</th>
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

                    $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM pomelnice WHERE parohie_id = $id");
             
                    $total_records = mysqli_fetch_array($result_count);
                    $total_records = $total_records['total_records'];
                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                    $second_last = $total_no_of_pages - 1; // total page minus 1

            // datele

                $query_pom = "Select * FROM pomelnice WHERE parohie_id = $id ORDER BY id DESC Limit "  . $offset . ',' . $total_records_per_page; // Limit și Offset
               

                $stmt = $conn->prepare($query_pom);
             
                $result = $stmt->execute();
                $result = $stmt->get_result();
                $nr_randuri = mysqli_num_rows ($result);
                                
                while ($row = mysqli_fetch_assoc($result)) { 
                    
                ?>

                <tr class='clickable-row' <?php echo 'data-href="pomelnic-unic.php?id=' . $row['id'] . '"';?>>
                  <td><?php if ($row['tip_pomelnic'] == "1") {
                      echo "Liturghie (vii)";
                  } elseif ($row['tip_pomelnic'] == "2") {
                    echo "Liturghie (adormiți)";
                  } elseif ($row['tip_pomelnic'] == "3") {
                    echo "Maslu";
                  } elseif ($row['tip_pomelnic'] == "4") {
                    echo "Acatist";
                  } elseif ($row['tip_pomelnic'] == "5") {
                    echo "Parastas";
                  }
                  ?></td>

                  <td><?php echo $row['lista_nume'];?></td>
                  <td><?php echo $row['durata_in_zile'] ;?></td>
                  <td><?php echo $row['nume_si_prenume'];?></td>
                  <td><?php echo date("d.m.Y", strtotime($row['data_inceperii']));?></td>
                  <td><?php  
                    if ($row['cu_donatie'] == 1) {
                        echo '<span class="verde"><i class="fas fa-check"></i></span>';
                    } elseif  ($row['cu_donatie'] == 0) {
                        echo '';
                    }
                  
                  ;?></td>
 
                  <td>  <a href="actiuni.php?eveniment=pomelnic&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                <i class="rosu fas fa-trash-alt"></i></a></td>
                </tr>

            <?php } 
            
            
            
            ?>
            
              </tbody>
            </table>


            <?php $link_paginatie = 'pomelnice.php?'; include "../includes/paginatie.php";?>


            
        </div>
      </div>
    </div>
 </div>
</div>

</body>
</html>



