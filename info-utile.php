<?php include "header-frontend.php"; 
$user_id = $_SESSION['id'];

$continut = NULL;
$tip = NULL;
$tip_complet = NULL;

if (isset($_GET['id'])) {
    $id_articol = $_GET['id'];
}



if (isset($_POST['info-utile'])) {
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
        <div class="col-sm-3 sidebar-frontend"><?php include "sidebar-frontend.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-frontend.php";?>
        
        <div class="row mt-3 ultimele-programari">

              <?php if (isset($_GET['succes'])) { 
                echo '<p class="red fs-5 mb-2">Cererea ta de programare online s-a finalizat cu succes. În cel mai scurt timp vei primi un EMAIL privind starea cererii tale de programare. Dacă este cazul, ți se vor solicita detalii suplimentare. Dacă dorești să ceri lămuriri suplimentare privind cererea ta de programare făcută, te rugăm să suni la numărul de telefon 0744.185.581 sau să trimiți un mesaj la paroh@sfantulambrozie.ro</p>'
                ;
                $succes = $_GET['succes'];
                } else {$succes = '';} ?>

              <div class="col-sm-12">

                    
                <?php if (isset($_GET['id'])) {
                    
                    

                    echo '<div class="mb-2">';
                           
                            $query = "Select * FROM articole WHERE id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('i', $id_articol);
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

 