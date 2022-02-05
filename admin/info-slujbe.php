<?php include "header-admin.php"; 
$user_id = $_SESSION['id'];

$continut = NULL;
$tip = NULL;
$tip_complet = NULL;

if (isset($_GET['tip'])) {
    $tip = $_GET['tip'];
    
    switch ($tip) {
        
        case 'botez':
            $tip_complet = "Taina Botezului";
            $id_articol = 1;
            break;
            
        case 'cununie':
            $tip_complet = "Taina Cununiei";
            $id_articol = 2;
            break;
            
        case 'spovedanie':
            $tip_complet = "Taina Spovedaniei";
            $id_articol = 3;
            break;
    
        case 'sfestanie':
            $id_articol = 4;
            $tip_complet = "Sfeștania";
            break;
        
        case 'parastas':
            $tip_complet = "Parastas";
            $id_articol = 5;
            break;
    }
}



if (isset($_POST['info-slujbe'])) {
    $continut = $_POST['continut'];

    $query = "UPDATE articole SET continut = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $continut, $id_articol);
    $result = $stmt->execute();
}
?>

<title>Info slujbe</title>

<script src="https://cdn.tiny.cloud/1/ywpqronwp4p5zyx3ymuriis579s5rjamd0k04eqknrk9pd4c/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>
        
        <div class="row mt-3 ultimele-programari">
              <p class="fw-bold">Info slujbe pentru credincioși</p>

              <div class="col-sm-12">

                <p>Alegeți slujba pentru care vreți să adăugați informații utile pentru credincioși.</p>
               
                <p><a class="btn btn-outline-primary" href="info-slujbe.php?tip=botez" role="button">Taina Botezului</a> <a class="btn btn-outline-primary" href="info-slujbe.php?tip=cununie" role="button">Taina Cununiei</a> <a class="btn btn-outline-primary" href="info-slujbe.php?tip=spovedanie" role="button">Taina Spovedaniei</a> <a class="btn btn-outline-primary" href="info-slujbe.php?tip=sfestanie" role="button">Sfeștanie</a> <a class="btn btn-outline-primary" href="info-slujbe.php?tip=parastas" role="button">Parastas</a></p>
     
                <?php if (isset($_GET['tip'])) {
                    
                    echo "<h3>" . $tip_complet . "</h3>";

                    echo 

                    '<form action="' . htmlentities($_SERVER['PHP_SELF']) . "?tip=" . $tip . '" method="POST">
                        <div class="mb-2">
                            <textarea name="continut" placeholder="Adăugați aici informațiile utile pentru fiecare creștin înainte de a participa la această slujbă.">'; 
                            
                            $query = "Select * FROM articole WHERE id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('i', $id_articol);
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
  plugins: 'textcolor advlist autolink lists link image charmap print preview hr anchor pagebreak',
  toolbar: 'undo redo styleselect forecolor backcolor link bold italic underline alignleft aligncenter alignright bullist numlist outdent indent code',
  toolbar_mode: 'floating',
  height:400,
});
</script>



</body>
</html>

 