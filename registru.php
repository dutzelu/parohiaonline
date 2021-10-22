<?php 

header ('Content-type: text/html; charset=utf-8');

      include "header-admin.php"; 
      include "sidebar-admin.php";

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

      }
?>

<title>Registru <?php echo $titlu; ?></title>
</head>

<body>



<div class="mare">
  <div class="container-fluid">

     <h1 class="h1">Registru <?php echo $titlu; ?></h1>


<table class="styled-table">
  <thead>
    <tr>
      <th scope="col">Nr.</th>
      <th scope="col">Data</th>
      <th scope="col">Ora</th>
      <th scope="col">Nume</th>
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
    
    for ($i=1; $i <= $nr_randuri; $i++) {
    while ($row = mysqli_fetch_assoc($result)) { 
        
    ?>

    <tr class='clickable-row' <?php echo 'data-href="' . $vizualizare . '?id=' . $row['id'] . '"';?>>
      <td><?php echo '<span class="albastru">' . $i++ . "</span>"; ?></td>
      <td><?php echo date("d.m.Y", strtotime($row['data_si_ora'])); ?></td>
      <td><?php echo date("H:i", strtotime($row['data_si_ora'])); ?></td>
      <td><?php 

      if ($eveniment_registru == 'programari_botez') {
        if (empty($row['nume_tata'])) {
           echo '<span class="albastru">' . $row['nume_mama'] . ' ' . $row['prenume_mama'] . "</span>"; 
        } else {
          echo '<span class="albastru">' . $row['nume_tata'] . ' ' . $row['prenume_tata'] . "</span>"; 
        }
      } elseif ($eveniment_registru == 'programari_cununie') {
          echo '<span class="albastru">' . $row['nume_mire'] . ' ' . $row['prenume_mire'] . "</span>"; 
      }

      ?></td>
      <td><?php echo $row['status']; ?></td>
      <td><?php 

        echo '<a class="badge btn-danger" href="' . $fisier_editare . '?id=' . $row['id'] . '">Editează</a>';
      

      
      ?></td>
    </tr>

 <?php } } 
 
 
 
 ?>
 
  </tbody>
</table>


<?php include "paginatie.php"?>


 
  </div>
</div>


</body>
</html>



<script>
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
  </script>