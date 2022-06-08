<?php include "header-admin.php"; 


$continut = NULL;

if (isset($_POST['anunt'])) {
    $titlu = $_POST['titlu'];
    $continut = $_POST['continut'];

    $query = 'INSERT INTO articole (parohie_id, titlu, continut, tip_articol) Values (?,?,?,"anunt")';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $id, $titlu, $continut);
    $result = $stmt->execute();
}
?>

<title>Anunțuri</title>

</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>
        
        <div class="row mt-3 ultimele-programari">
              <p class="fw-bold">Info și anunțuri</p>

              <div class="col-sm">

                <p>Informații utile pentru credincioși înainte de săvârșirea slujbelor:</p>
                
                <p><a class="btn btn-outline-primary" href="info-slujbe.php?tip=botez" role="button">Taina Botezului</a> <a class="btn btn-outline-primary" href="info-slujbe.php?tip=cununie" role="button">Taina Cununiei</a> <a class="btn btn-outline-primary" href="info-slujbe.php?tip=spovedanie" role="button">Taina Spovedaniei</a> <a class="btn btn-outline-primary" href="info-slujbe.php?tip=sfestanie" role="button">Sfeștanie</a> <a class="btn btn-outline-primary" href="info-slujbe.php?tip=parastas" role="button">Parastas</a></p>
                  
                  
                <p>Publicați un anunț pentru credincioșii din parohie</p>
                <p><a class="btn btn-outline-primary" href="anunt-nou.php" role="button">Adaugă un anunț</a>  </p>

                    <?php


                    if (isset($_GET['sters'])) {
                        echo '<p id="dispari">Anunțul a fost șters cu succes</p>';
                    }

                    $query = 'Select * From articole WHERE tip_articol LIKE "anunt" AND parohie_id =' . $id . ' ORDER BY id DESC';

                    $stmt = $conn->prepare($query);
                    $rezultat = $stmt->execute();
                    $rezultat = $stmt->get_result();

                     echo '<ul class="anunt">';

                        while ($data = mysqli_fetch_assoc($rezultat)) {

                            $continut_scurt = substr($data['continut'],0,100).'...';
                            $continut_scurt = strip_tags ($continut_scurt);
                            $data_articolului =  date("d M. Y", strtotime($data["data"]));

                            echo '<a class="fs-6" href=anunt-unic.php?id=' . $data['id'] . '><li>';
                                echo '<p class="titlu-anunt">' . $data['titlu'] .'</p>';
                                echo '<p class="data">' . $data_articolului .'</p>';
                                echo '<div class="continut mb-2">' . $continut_scurt .'</div>';
                            echo '</li></a>' ; 
                        }
                    
                      echo "</ul>";

                    ?>
     
 

              </div>

   
 
 
 
</div>    
</div>

</div>
  
</div>


 



</body>
</html>

 