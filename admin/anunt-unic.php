<?php include "header-admin.php"; 


$continut = NULL;

if (isset($_GET['id'])) {
    $id_articol = $_GET['id'];
}


if (isset($_POST['anunt'])) {
    $titlu = $_POST['titlu'];
    $continut = $_POST['continut'];

    $query = "UPDATE articole SET titlu = ?, continut = ? WHERE id = ? AND tip_articol LIKE 'anunt';";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $titlu, $continut, $id_articol);
    $result = $stmt->execute();
}
?>

<title>Modifică anunț</title>

<script src="https://cdn.tiny.cloud/1/ywpqronwp4p5zyx3ymuriis579s5rjamd0k04eqknrk9pd4c/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>
        
        <div class="row mt-3 ultimele-programari">
              <div class="col-sm">
               

                    <p class='butoane'>

                    Modifică anunț <a href="anunturi.php"><i class="fas fa-chevron-circle-left"></i> Înapoi</a>

                    <a href="actiuni.php?eveniment=anunt&stergeid= <?php echo $id_articol; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');">
                    <i class="rosu fas fa-trash-alt"></i> Șterge</a>

                   <?php

                    '<form method="POST">
                        <div class="mb-2">';

                        $query = "Select * FROM articole WHERE id = ? AND tip_articol LIKE 'anunt'";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('i', $id_articol);
                        $result = $stmt->execute();
                        $result  = $stmt->get_result();
                        while ($row = mysqli_fetch_assoc($result)) { ?>
 
                 

                       <form  action="anunt-unic.php?id=<?php echo $id_articol;?>" method="POST">
    
                            <div class="row mb-2">
                                <div class="col-sm">    
                                <input type="text" name="titlu" class="form-control" placeholder="Titlu anunțului" value="<?php echo $row['titlu'];?> ">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm">
                                        <textarea class="form-control" name="continut"><?php echo $row['continut'];}?></textarea>       
                                </div>               
                            </div>
                            <button type="submit" name="anunt" class="btn btn-primary">Salvează</button>
                            
                        </form>
                        
                    
                

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

 