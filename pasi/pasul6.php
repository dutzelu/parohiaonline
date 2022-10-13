<?php 
include "../header-frontend.php"; 

 
if (isset($_POST['pasul1'])) {

  $zile = $_POST['zile'];
 foreach ($zile as $zi) {

 }

}

 if ( isset($_GET['zi']) ) {
     $zi = $_GET['zi'];
 }

 if ( isset($_GET['id']) ) {
  $id = $_GET['id'];
}

$start = NULL;
$ora = NULL;
$ore_rezervate = (array) NULL;
$ore =(array) NULL;

?>
 
</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "../sidebar-frontend.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "../header-mic-frontend.php";?>
            
            <div class="ultimele-programari">

              <?php include "pasi.php";?>
              
              <h1 class="h1 "><?php echo $eveniment; ?> <br />Alegeți ora pentru ziua de cateheză <span class="albastru"><?php echo $zi . '.' . $month . '.' . $year; ?>  </span><br />din cele disponibile mai jos:</h1>
              
              <?php

if (strlen($zi)==1) {
  $zi = '0' . $zi;
} else {$zi = $zi;}

$an_luna_zi = $year . '-' . $month . '-' . $zi;

$sql="SELECT * FROM zile_stabilite WHERE tip_programare LIKE '$pentru' AND (data_start LIKE '%$an_luna_zi%' AND parohie_id = $parohie_id) ORDER BY DATE(data_start) ASC";
$rezultate = mysqli_query ($conn, $sql);

while ($data = mysqli_fetch_assoc($rezultate)){   
  
  $id_rezervare = $data['id'];
  $data_start_fara_ora = date("Y-m-d", strtotime($data["data_start"]));
  $ora_start = date("H:i", strtotime($data["data_start"]));
  $ora_final = date("H:i", strtotime($data["data_final"]));
  $intervalul = $data['intervalul'];
  $intervalul = $intervalul . ' mins';

  $ore = create_time_range($ora_start, $ora_final, $intervalul, $format = '24');
  array_pop($ore);
  
  ?>

<form method="POST" action="pasul7.php<?php echo '?id=' . $id . '&pentru=' .  $pentru . '&year=' .  $year . '&month=' . $month . '&zi=' . $zi;?> " enctype = "multipart/form-data">
  
    <?php


foreach ($ore as $key => $ora) {
  
  
  // verific daca exista data si ora in tabelul programari
  
  $ora = $data_start_fara_ora . ' ' . $ora . ':00';
  
  $query = 'SELECT * FROM programari_botez WHERE data_ora_cateheza=? AND parohie_id = ?';
  $stmt = $conn->prepare($query);
  $stmt->bind_param('si', $ora, $parohie_id);
  $result = $stmt->execute();
  $result = $stmt->get_result();
  
  
  while($data = $result->fetch_assoc()) {
    array_push($ore_rezervate, $data['data_ora_cateheza']);
  }
  
  // afisez doar orele care nu sunt rezervate

  if (!in_array($ora, $ore_rezervate)) {
    echo '
    <input type="radio" class="btn-check" name="ora" id="ora' . $key . '" autocomplete="off" value="' . date("H:i", strtotime($ora)) . '"> 
    <label class="btn btn-outline-primary" for="ora' . $key . '">' . date("H:i", strtotime($ora)) . '</label>'; 
  }
  
}

}



?>



<input type="submit" name="ora_cateheza" class="btn btn-primary" value="Alege ora"/>
</form>

<?php



?>



</div>
</div>
</div>
</div>
 </div>
</body>
</html>




      