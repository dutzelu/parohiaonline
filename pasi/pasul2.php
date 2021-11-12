<?php 
include "header-frontend.php"; 
include "sidebar-frontend.php"; 
include "functions.php";

 if ( isset($_GET['zi']) ) {
     $zi = $_GET['zi'];
 }

$start = '';
$ora = '';
$ore_rezervate = [];

?>

 
</head>

<body>


<div class="mare">
  <div class="container-fluid">
  <?php include "pasi.php";?>

     <h1 class="h1"><?php echo $eveniment; ?> | Ziua: <span class="albastru"><?php echo $zi . '.' . $month . '.' . $year; ?>  </span></h1>

<?php

if (strlen($zi)==1) {
  $zi = '0' . $zi;
} else {$zi = $zi;}

$an_luna_zi = $year . '-' . $month . '-' . $zi;

$sql="SELECT * FROM zile_stabilite WHERE tip_programare LIKE '$pentru' AND data_start LIKE '%$an_luna_zi%' ORDER BY DATE(data_start) ASC";
$rezultate = mysqli_query ($conn, $sql);
 

while ($data = mysqli_fetch_assoc($rezultate)){   

    $id_rezervare = $data['id'];
    $data_start_fara_ora = date("Y-m-d", strtotime($data["data_start"]));
    $ora_start = date("H:i", strtotime($data["data_start"]));
    $ora_final = date("H:i", strtotime($data["data_final"]));

    $ore = create_time_range($ora_start, $ora_final, '60 mins');

}    

    foreach ($ore as $key => $ora) {

      // verific daca exista data si ora in tabelul programari

          $ora = $data_start_fara_ora . ' ' . $ora . ':00';

          $query = 'SELECT * FROM programari_botez WHERE data_si_ora=?';
          $stmt = $conn->prepare($query);
          $stmt->bind_param('s', $ora);
          $result = $stmt->execute();
          $result = $stmt->get_result();
      
          while($data = $result->fetch_assoc()) {
            array_push($ore_rezervate, date("H:i", strtotime($data['data_si_ora'])));
          }
    }
     

// ce ore rămân liber aflăm prin intersecția array-urilor
$ore_libere = array_diff ($ore, $ore_rezervate);


// Primul element al array-ului $ore
$prima_valoare_ore = reset($ore); 

// Primul element al array-ului $ore_libere
$prima_valoare_ore_libere = reset($ore_libere); 

 

  if(!empty($ore_libere)) {
    echo '<p>Ora liberă la care se poate desfășura ' . $eveniment .  ' este <span class="albastru">' . $prima_valoare_ore_libere . '</span></p>';
    $ora_afisata = $prima_valoare_ore_libere;
  } else {
    echo '<p>Ora liberă la care se poate desfășura ' . $eveniment .  ' este <span class="albastru">' . $prima_valoare_ore . '</span></p>';
    $ora_afisata = $prima_valoare_ore;
  }
    
  if ($eveniment == 'Taina Botezului') {
     $pasul3 = 'pasul3.php?month=' . $month . '&year=' .  $year . '&pentru=' .  $pentru . '&zi=' . $zi . '&ora=' . $prima_valoare_ore;
  } elseif ($eveniment == "Taina Cununiei") {
    $pasul3 = 'pasul3-cununie.php?month=' . $month . '&year=' .  $year . '&pentru=' .  $pentru . '&zi=' . $zi . '&ora=' . $prima_valoare_ore;
  }
  ?>

<p><a class="btn btn-primary" href="<?php echo $pasul3;?>" role="button">Confirmă ora</a></p>

   

 </div>
 </div>
</body>
</html>

 


      