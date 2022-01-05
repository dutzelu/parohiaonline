<?php 
include "../header-frontend.php"; 


 if ( isset($_GET['zi']) ) {
     $zi = $_GET['zi'];
 }

$start = NULL;
$ora = NULL;
$data_start_fara_ora = NULL;
$ore_rezervate = (array) NULL;
$ore =(array) NULL;

 
$data_completa = $zi .  '-' . $month . '-' . $year; 


?>

 
</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "../sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "../header-mic-frontend.php";?>

            <div class="ultimele-programari">

                <?php include "pasi.php";?>
                
                <h1 class="h1"><?php echo $eveniment; ?> | Ziua: <span class="albastru"><?php echo $data_completa; ?>  </span></h1>
                
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
    $intervalul_programarii = $data["intervalul"] . ' mins';
    
    $ore = create_time_range($ora_start, $ora_final, $intervalul_programarii);
    
    
}    
?>

<form method="POST" action="pasul3-spovedanie.php<?php echo '?month=' . $month . '&year=' .  $year . '&pentru=' .  $pentru . '&zi=' . $zi;?> " enctype = "multipart/form-data">
    
    <?php


foreach ($ore as $key => $ora) {
    
    
    // verific daca exista data si ora in tabelul programari
    
    $ora = $data_start_fara_ora . ' ' . $ora . ':00';
    
    $query = 'SELECT * FROM programari_spovedanie WHERE data_si_ora=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $ora);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    
    
    while($data = $result->fetch_assoc()) {
        array_push($ore_rezervate, $data['data_si_ora']);
    }
    
    // afisez doar orele care nu sunt rezervate
    
    if (!in_array($ora, $ore_rezervate)) {
        echo '
        <input type="radio" class="btn-check" name="ora" id="ora' . $key . '" autocomplete="off" value="' . date("H:i", strtotime($ora)) . '"> 
        <label class="btn btn-outline-primary m-1" for="ora' . $key . '">' . date("H:i", strtotime($ora)) . '</label>'; 
      }
      
    }
    
    
    
    
    
    ?>



<input type="submit" name="pasul3" class="btn btn-primary" value="Alege ora"/>
</form>



</div>
</div>
</div>
</div>
 </div>
</body>
</html>