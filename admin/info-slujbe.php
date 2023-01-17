<?php include "header-admin.php"; 
 

$continut = NULL;
$tip = NULL;
$tip_complet = NULL;

if (isset($_GET['tip'])) {
    $tip = $_GET['tip'];
    
    switch ($tip) {
        
        case 'botez':
            $tip_complet = "Info Botez";
            $tip_articol = 1;
            break;
            
        case 'cununie':
            $tip_complet = "Info Cununie";
            $tip_articol = 2;
            break;
            
        case 'spovedanie':
            $tip_complet = "Info Spovedanie";
            $tip_articol = 3;
            break;
    
        case 'sfestanie':
            $tip_articol = 4;
            $tip_complet = "Sfeștanie";
            break;
        
        case 'parastas':
            $tip_complet = "Parastas";
            $tip_articol = 5;
            break;
    }
}

$query = "Select * from articole WHERE parohie_id = ? AND tip_articol = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id, $tip_articol);
$result = $stmt->execute();
$result = $stmt->get_result();
$rowcount = mysqli_num_rows($result); 


if($rowcount == 0) {
    
    if (isset($_POST['info-slujbe'])) {
        $continut = $_POST['continut'];
    
        $query = "INSERT INTO articole (parohie_id, titlu, continut, tip_articol) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('issi', $id, $tip_complet, $continut, $tip_articol);
        $result = $stmt->execute();
    }
} else {

    if (isset($_POST['info-slujbe'])) {
        $continut = $_POST['continut'];
    
        $query = "UPDATE articole SET titlu = ?, continut = ? WHERE parohie_id = ? AND tip_articol = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssii', $tip_complet, $continut, $id, $tip_articol);
        $result = $stmt->execute();
    }


}


?>

<title>Info slujbe</title>



</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>
        
        <div class="row mt-3 ultimele-programari">
             <h1>Info slujbe pentru credincioși</h1>
              <p>Informații utile pentru credincioși înainte de săvârșirea slujbelor:</p>
              <div class="col-sm-12">


     
                <?php if (isset($_GET['tip'])) {
                    
                    echo "<h3>" . $tip_complet . "</h3>";

                    echo 

                    '<form action="' . htmlentities($_SERVER['PHP_SELF']) . "?tip=" . $tip . '" method="POST">
                        <div class="mb-2">
                            <textarea name="continut" placeholder="Adăugați aici informațiile utile pentru fiecare creștin înainte de a participa la această slujbă.">'; 
                            
                            $query = "Select * FROM articole WHERE parohie_id = ? AND tip_articol = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('ii', $id, $tip_articol);
                            $result = $stmt->execute();
                            $result  = $stmt->get_result();
                            while ($row = mysqli_fetch_assoc($result)) { 

                                    echo $row['continut'];
                            }
                          echo '</textarea>                      
                        </div>
                        <button type="submit" name="info-slujbe" class="btn btn-primary">Salvează</button>
                    
                    </form>';
                    
                }
?>

              </div>
 
 
 
</div>    
</div>

</div>
  
</div>





<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
      toolbar_mode: 'floating',
    });
  </script>



</body>
</html>

 