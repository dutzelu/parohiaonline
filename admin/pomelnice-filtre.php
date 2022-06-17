<?php 
$tip_pomelnic ='';
$durata_in_zile = '';
$nume_si_prenume = "";
$data_start = "";
$data_final = "";
$cu_donatie = "";
$filtre = NULL;
$i = 0;

      include "header-admin.php"; 
                       
            if (!empty($_GET['tip_pomelnic'])) {
                $tip_pomelnic = htmlspecialchars($_GET['tip_pomelnic']);  
                $filtre .= " WHERE ";
                $filtre .= 'tip_pomelnic = ' . $tip_pomelnic;
                $i++;
            } 

            // var_dump($filtre); echo "<br>";
            
            if (!empty($_GET['durata_in_zile'])) {
                $durata_in_zile = htmlspecialchars($_GET['durata_in_zile']);
                if ($i == 0) {$filtre .= "WHERE ";}
                else {$filtre .= " AND ";}
                $filtre .= " durata_in_zile = " . htmlspecialchars($_GET['durata_in_zile']);
                $i++;
            }  
            
            // var_dump($filtre); echo "<br>";
            
            if (!empty($_GET['nume_si_prenume'])) {
                $nume_si_prenume = htmlspecialchars($_GET['nume_si_prenume']);
                if ($i == 0) {$filtre .= " WHERE ";}
                else {$filtre .= " AND ";}
                $filtre .= "nume_si_prenume LIKE '%" . htmlspecialchars($_GET['nume_si_prenume']) . "%'";
                $i++;
            } 
            
            // var_dump($filtre); echo "<br>";
            
            if (!empty($_GET['data_start'])) {
                $data_start = htmlspecialchars($_GET['data_start']);
                if ($i == 0) {$filtre .= " WHERE ";}
                else {$filtre .= " AND ";}
                $filtre .= "data_inceperii >= '" .  htmlspecialchars($_GET['data_start']) . "'";
                $i++;
            }  
            
            // var_dump($filtre); echo "<br>";
            
            if (!empty($_GET['data_final'])) {
                $data_final = htmlspecialchars($_GET['data_final']);
                if ($i == 0) {$filtre .= " WHERE ";}
                else {$filtre .= " AND ";}
                $filtre .= "data_inceperii <= '" .  htmlspecialchars($_GET['data_final']) . "'";
                $i++;
            }  
            
            // var_dump($filtre); echo "<br>";
            
            if (!empty($_GET['cu_donatie'])) {
                $cu_donatie = htmlspecialchars($_GET['cu_donatie']);
                if ($i == 0) {$filtre .= " WHERE ";}
                else {$filtre .= " AND ";}
                $filtre .= 'cu_donatie = ' . htmlspecialchars($_GET['cu_donatie']);
                $i++;
            }  
            
            // var_dump($filtre); echo "<br>";
 

        $query_filtru = "Select * from pomelnice "  . $filtre . " AND parohie_id = " . $id . " ";

?>

<title>Pomelnice</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>


        <div class="row mt-3 ultimele-programari">
          <div class="col-sm-12">
            <p class="fw-bold">Pomelnice</p>

            <div class="filtre mb-4">

            <form method="GET" action="pomelnice-filtre.php">

                <div class="input-group mb-2">
                    <span class="input-group-text">Tip pomelnic</span>
                    <select name="tip_pomelnic" class="form-control">
                        <option hidden disabled selected value> - Selectează - </option>
                        <option value="1" <?php if ( $tip_pomelnic == 1) {echo 'selected="selected"';} else {echo "";}?> >Liturghie (vii)</option>
                        <option value="2" <?php if ($tip_pomelnic == 2) {echo 'selected="selected"';} else {echo "";}?>>Liturghie (adormiți)</option>
                        <option value="3" <?php if ( $tip_pomelnic == 3) {echo 'selected="selected"';} else {echo "";}?>>Maslu</option>
                        <option value="4" <?php if ( $tip_pomelnic == 4) {echo 'selected="selected"';} else {echo "";}?>>Acatist</option>
                        <option value="5" <?php if ( $tip_pomelnic == 5) {echo 'selected="selected"';} else {echo "";}?>>Parastas</option>
                    </select>

                    <span class="input-group-text">Durata</span>
                    <select name="durata_in_zile" class="form-control">
                        <option hidden disabled selected value> - Selectează - </option>
                        <option value="1" <?php if ($durata_in_zile == 1) {echo 'selected="selected"';} else {echo "";}?>>O zi</option>
                        <option value="7" <?php if ($durata_in_zile == 7) {echo 'selected="selected"';} else {echo "";}?>>O săptămână</option>
                        <option value="30" <?php if ($durata_in_zile == 30) {echo 'selected="selected"';} else {echo "";}?>>O lună</option>
                        <option value="40" <?php if ($durata_in_zile == 40) {echo 'selected="selected"';} else {echo "";}?>>40 de zile</option>
                        <option value="365" <?php if ($durata_in_zile == 365) {echo 'selected="selected"';} else {echo "";}?>>Un an</option>
                    </select>

                    <input type="text" name="nume_si_prenume" class="form-control" placeholder="nume"
                    <?php  echo 'value="' . $_GET['nume_si_prenume'] . '"'; ?>>
                </div>

                <div class="input-group mb-2">

                    <span class="input-group-text">Începând cu data</span>
                    <input type="date" name="data_start" class="form-control"
                    <?php if( isset( $_GET['data_start'] ) )
                            {echo 'value="' . $_GET['data_start'] . '"';} ?> >

                    <span class="input-group-text">Până la data</span>
                    <input type="date" name="data_final" class="form-control"
                    <?php if( isset ($_GET['data_final']) ) 
                            {echo 'value="' . $_GET['data_final'] . '"';} ?>>

                    <span class="input-group-text">Cu sau fără donație</span>
                    <select name="cu_donatie" class="form-control">
                        <option hidden disabled selected value> - Selectează - </option>
                        <option value="1" <?php if ( $cu_donatie == 1) {echo 'selected="selected"';} else {echo "";}?> >Da</option>
                        <option value="2" <?php if ( $cu_donatie == 2 ) {echo 'selected="selected"';} else {echo "";}?> >Nu</option>
                        
                    </select>

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

                    $query_filtru_c = str_replace ("*","Count(*) As total_records", $query_filtru);
                    $result_count = mysqli_query($conn, $query_filtru_c);
                    
                    $total_records = mysqli_fetch_array($result_count);
                    $total_records = $total_records['total_records'];
                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                    $second_last = $total_no_of_pages - 1; // total page minus 1
                    
                    
            // datele

                    echo "<br>";
                    // var_dump($query_filtru_c); echo "<br>";
                    $query_filtru = "Select * from pomelnice "  . $filtre . " AND parohie_id = " .$id . " ORDER BY id DESC Limit " . $offset . ',' .    $total_records_per_page; // Limit și Offset"
                    // var_dump($query_filtru); echo "<br>";

                    $stmt = $conn->prepare($query_filtru);
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
 
                  <td>  <a href="sterge-camp.php?eveniment=pomelnic&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                                <i class="rosu fas fa-trash-alt"></i></a></td>
                </tr>

            <?php } 
            
            
            
            ?>
            
              </tbody>
            </table>


            <?php 

            $link_paginatie = 'pomelnice-filtre.php?tip_pomelnic=' .  $tip_pomelnic . '&durata_in_zile=' . $durata_in_zile . '&nume_si_prenume=' . $nume_si_prenume . '&data_start=' . $data_start . '&data_final=' . $data_final . '&cu_donatie=' . $cu_donatie .'&'; include "../includes/paginatie.php";

            // var_dump ($link_paginatie);
            
            ?>


            
        </div>
      </div>
    </div>
 </div>
</div>

</body>
</html>



