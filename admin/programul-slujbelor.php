<?php 
      include "header-admin.php"; 
      $ziua = null;
      $ultima_zi = null;
      
    if (isset($_POST['salveaza_rol_program'])) {
  
              $program_ales = $_POST["program_ales"];
              $query = "UPDATE programul_slujbelor SET status = 1 Where id = ? AND parohie_id = $id;";
              $stmt = $conn->prepare($query);
              $stmt->bind_param('i', $program_ales);
              $result = $stmt->execute();
  
              
              $query = "UPDATE programul_slujbelor SET status = 0 Where id != ? AND parohie_id = $id;";
              $stmt = $conn->prepare($query);
              $stmt->bind_param('i', $program_ales);
              $result = $stmt->execute();
  
    }

    if (isset($_GET['idprog'])) {
          $id_selectat = $_GET['idprog'];
    } 
 
    elseif (isset($_GET['adaugat'])) {
            // dacă se adaugă program nou
            $sql = "SELECT * FROM programul_slujbelor WHERE parohie_id = $id ORDER BY id DESC LIMIT 1; ";
            $stmt = $conn->prepare($sql);
            $rezultat = $stmt->execute();
            $rezultat = $stmt->get_result();
            
            while($x = mysqli_fetch_assoc($rezultat)) {
                $id_selectat = $x['id'];
            }
        }

    else {
            // dacă nu este selectat niciun id atunci ia idul cel mai recent
            $sql = "SELECT * FROM programul_slujbelor WHERE status = 1 AND parohie_id = $id;";
            $stmt = $conn->prepare($sql);
            $rezultat = $stmt->execute();
            $rezultat = $stmt->get_result();
            
            while($x = mysqli_fetch_assoc($rezultat)) {
                $id_selectat = $x['id'];
            }
        }
        
        
    ?>

<title>Panoul de control</title>


</head>

<body>
    
    <div class="container-fluid">
        
        <div class="row wrapper">
            <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>
            
            <div class="col-sm-9 p-4 zona-principala">
                <?php include "header-mic-admin.php";?>
                
                <div class="row ultimele-programari programul-slujbelor">
                    
                    <h4 class="h4 mb-4 rosu"> Programul slujbelor</h4>

                    <?php 
                if(isset($_GET['adaugat'])) {
                    echo '<p class="bg-primary text-light" id="dispari">Programul a fost adăugat cu succes.</p>';
                }
                
                ?>

                <div class="col-sm-9">

                    
                         <?php

                            $query = "Select * From programul_slujbelor Where id = ? AND parohie_id = $id;";

                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('i', $id_selectat);
                            $rezultat = $stmt->execute();
                            $rezultat = $stmt->get_result();
                            $rowcount = mysqli_num_rows($rezultat);

                            while ($data = mysqli_fetch_assoc($rezultat)) {
                                
                                $program_json = $data['program'];
                                $nume_program_selectat = $data['nume'];
                                $prog_decod = json_decode($program_json);
                                $status = $data['status'];
                            }
                            if($rowcount != 0) {?>

                            <div class="program-selectat mb-2">

                                <div class="row justify-content-end align-items-center">

                                    <div class="col-sm-5">
                                        <p>Alege un <strong>program oficial</strong> din cele salvate, care va fi public tuturor credincioșilor.
                                    </div>

                                    <div class="col-sm-7">
                                        
                                        <div class="input-group mb-2">
                                            <form id="role_program" method="POST" action="programul-slujbelor.php">
                                            <?php
                                            $query = 'Select * From programul_slujbelor Where parohie_id = ' . $id;

                                            $stmt = $conn->prepare($query);
                                            $rezultat = $stmt->execute();
                                            $rezultat = $stmt->get_result();

                                            echo '<select name="program_ales" class="form-control">';
                                                    while ($data = mysqli_fetch_assoc($rezultat)) {
                                                        $nume_program = $data['nume'];
                                                        $id_program = $data['id'];
                                                        echo '<option value="' . $id_program .'">' . $nume_program . '</option>';
                                                    }?>
                                                </select>
                                            </form>
                                            <button form="role_program" name="salveaza_rol_program" class= "btn btn-primary">Alege</button>
                                        </div>
                                        


                                    </div>

                                </div>

                            </div> 
    

                            <?php
                                echo '<h5 class="mt-3">' . $nume_program_selectat . "</h5>";  ?>

                            <p>
                            <?php if($status ==1){echo '<span class="badge bg-primary">oficial</span>';}
                            else {echo '<span class="badge bg-secondary">salvat</span>';}?>
                            
                            <a href="program-edit.php?idprog=<?php echo $id_selectat;?>" class="m-2"><i class="albastru-inchis far fa-edit"></i> Modifică</a> 

                            <a href="program-edit.php?idprog=<?php echo $id_selectat; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți aceast program?');"><i class="rosu fas fa-trash-alt"></i>Șterge</a> </p>


                            <?php } else {
                                echo '<p>Până acum nu ai stabilit niciun program. Apasă "Adăugă program" pentru a stabili unul.</p>';
                            }
                            
                            ?>
                            <table class="table">
                                
                                
                                <?php
                            if($rowcount != 0) { ?>
                                
                                <thead>
                                    <tr>
                                        <th scope="col">Ziua</th>
                                        <th scope="col">Ora</th>
                                        <th scope="col">Slujba</th>
                                        <th scope="col">Observații</th>
                                    </tr>
                                </thead>
                                
                                <tbody >
                        <?php
                                $data = json_decode($program_json, true);
                                $nr_slujbe = (count($data)-2)/5;

                                for ($i=1; $i <= $nr_slujbe ; $i++) {

                                $ziua_saptamanii = 'ziua_saptamanii'.$i;
                                $slujba = 'slujba'.$i;
                                $text_optional = 'text_optional'.$i;
                                $alte_observatii = 'alte_observatii'.$i;
                                $ora_start = 'ora_start'.$i;

                                ?>
                
                            <tr  class="
                                    <?php  $ziua = $prog_decod->$ziua_saptamanii;
                                    if ($ultima_zi != $ziua){echo "subliniat"; } ?>">

                                <td class="ziua">
                                    <?php if ($ultima_zi != $ziua)
                                    {
                                        $ultima_zi = $ziua;
                                        // dacă e zi a săptămânii
                                        if(preg_match("/[a-z]/i", $ziua)){
                                            echo $ziua; 
                                        } 
                                        // dacă e zi calendaristică
                                        else {
                                            $time = strtotime($ziua);
                                            echo strftime('%A',$time) . ', ' . strftime('%e %b %Y',$time);
                                        }
                                    }?>
                                </td>

                                <td><?php echo $prog_decod->$ora_start; ?></td>
                                <td class="slujba_colorata"><?php 


                                    echo '<span class="p-1 albastru-inchis">' . $prog_decod->$slujba . ' ' . $prog_decod->$text_optional . '</span>' ; ?>
                                </td>

                                 <td><?php echo $prog_decod->$alte_observatii; ?></td>

                            </tr>
                            <?php }} ?> 
                        </tbody>
                    </table>



            </div>
            <div class="col-sm-3">
                <p><a href="program-saptamanal.php" ><i class="far fa-plus-square rosu mb-2"></i> Adaugă program "săptămânal"</a><br>
                 <a href="program-calendaristic.php"><i class="far fa-plus-square rosu"></i> Adaugă program calendaristic</a></p>
                   
                    <hr>
                    <p>Program public acum:<br>

                    <?php

                    $query = 'Select * From programul_slujbelor WHERE status = 1';

                    $stmt = $conn->prepare($query);
                    $rezultat = $stmt->execute();
                    $rezultat = $stmt->get_result();

                    while ($data = mysqli_fetch_assoc($rezultat)) {
                        $nume_program = $data['nume'];
                        $id_program = $data['id'];
                        echo '<span class="rosu">' . $nume_program .'</span></p>' ; 
                    }
                    ?>
                    </p>
                 
                 
                    <hr>
                    <p class="fw-bold">Programe salvate</p>
                    <hr>
                    <ul class="m-3 programe-salvate">
                    <?php 
    
                    
                    $query = 'Select * From programul_slujbelor WHERE parohie_id =' . $id . ' ORDER BY id DESC';

                    $stmt = $conn->prepare($query);
                    $rezultat = $stmt->execute();
                    $rezultat = $stmt->get_result();

                    while ($data = mysqli_fetch_assoc($rezultat)) {
                        $nume_program = $data['nume'];
                        $id_program = $data['id'];
                        echo '<li><a href="programul-slujbelor.php?idprog=' . $id_program . '">' . $nume_program . '</a></li>';
                    }
                
                    ?>
                </ul>
               

                

            </div>
             
            
            
            
        </div>




</div>

</div>

</div>



</body>
</html>


