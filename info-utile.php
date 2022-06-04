<?php include "header-frontend.php"; 
$user_id = $_SESSION['id'];

$continut = NULL;
$tip = NULL;
$titlu = NULL;

if (isset($_GET['tip'])) {
    $tip_articol = $_GET['tip'];

    switch ($tip_articol) {
        
        case '1':
            $titlu = "Taina Botezului";
            break;
            
        case '2':
            $titlu = "Taina Cununiei";
            break;
            
        case '3':
            $titlu = "Taina Spovedaniei";
            break;
    
        case '4':
            $titlu = "Sfeștania";
            break;
        
        case '5':
            $titlu = "Parastas";
            break;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}


 
?>

<title>Info slujbe</title>

<script src="https://cdn.tiny.cloud/1/ywpqronwp4p5zyx3ymuriis579s5rjamd0k04eqknrk9pd4c/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-frontend"><?php include "sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-frontend.php";?>
        
        <div class="row mt-3 ultimele-programari">

              <?php if (isset($_GET['succes'])) { 
                echo '<p class="mb-2">Cererea ta de programare online s-a finalizat cu succes. În cel mai scurt timp vei primi un EMAIL privind starea cererii tale de programare. Dacă este cazul, ți se vor solicita detalii suplimentare. Dacă dorești să ceri lămuriri suplimentare privind cererea ta de programare făcută, te rugăm să suni la numărul de telefon 0744.185.581 sau să trimiți un mesaj la paroh@sfantulambrozie.ro</p>'
                ;
                $succes = $_GET['succes'];
                } else {$succes = '';} ?>

              <div class="col-sm-12">

                       
                <?php 
                
                echo "<h3>" . $titlu . "</h3>";

                if (isset($_GET['tip'])) {
                    
                    echo '<div class="mb-2">';
                           
                            $query = "Select * FROM articole WHERE parohie_id = ? AND tip_articol = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('ii', $parohie_id, $tip_articol);
                            $result = $stmt->execute();
                            $result  = $stmt->get_result();
                            while ($row = mysqli_fetch_assoc($result)) { 

                                
                                echo "<p>" .  date("d M. Y", strtotime($row["data"])) . "</p>";
                                echo "<div>" . $row['continut'] . "</div>";
                            }
                                       
                    echo '</div>';
                    
                }

                if (isset($_GET['id'])) {
                    
                    echo '<div class="mb-2">';
                           
                            $query = "Select * FROM articole WHERE parohie_id = ? AND id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('ii', $parohie_id, $id);
                            $result = $stmt->execute();
                            $result  = $stmt->get_result();
                            while ($row = mysqli_fetch_assoc($result)) { 

                                echo "<h3>" . $row['titlu'] . "</h3>";
                                echo "<p>" .  date("d M. Y", strtotime($row["data"])) . "</p>";
                                echo "<div>" . $row['continut'] . "</div>";
                            }
                                       
                    echo '</div>';
                    
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
  plugins: 'textcolor advlist autolink lists link image charmap print preview hr anchor pagebreak code',
  toolbar: 'undo redo styleselect forecolor backcolor link bold italic underline alignleft aligncenter alignright bullist numlist outdent indent code',
  toolbar_mode: 'floating',
  height:400,
});
</script>



</body>
</html>

 