<?php include "header-admin.php"; 
$user_id = $_SESSION['parohie_id'];

?>
<title>Adaugă anunț nou</title>

<script src="https://cdn.tiny.cloud/1/ywpqronwp4p5zyx3ymuriis579s5rjamd0k04eqknrk9pd4c/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "header-mic-admin.php";?>
        
        <div class="row mt-3 ultimele-programari">
              <p class="fw-bold">Adaugă anunț nou</p>

              <div class="col-sm">

                    <form action="anunturi.php" method="POST">

                        <div class="row mb-2">
                            <div class="col-sm ">    
                            <input type="text" name="titlu" class="form-control" placeholder="Titlu anunțului">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm">
                                    <textarea name="continut" placeholder="Adăugați conținutul anunțului."></textarea>       
                            </div>               
                        </div>
                        <button type="submit" name="anunt" class="btn btn-primary">Salvează</button>
                        
                    </form>
                        
                    
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

 