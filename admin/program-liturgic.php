<?php 
      include "header-admin.php"; 
      $ziua = null;
      $ultima_zi = null;
      
// salvează rol program

    if (isset($_GET['idprog'])) {
          $id_selectat = $_GET['idprog'];
    } 
 
    elseif (isset($_GET['adaugat'])) {
            // dacă se adaugă program nou
            $sql = "SELECT * FROM program_liturgic WHERE parohie_id = $id ORDER BY id DESC LIMIT 1; ";
            $stmt = $conn->prepare($sql);
            $rezultat = $stmt->execute();
            $rezultat = $stmt->get_result();
            
            while($x = mysqli_fetch_assoc($rezultat)) {
                $id_selectat = $x['id'];
            }
        }

    elseif (isset($_GET ['program_ales'])) {
  
            $program_ales = $_GET["program_ales"];
            $query = "UPDATE program_liturgic SET status = 1 Where id = ? AND parohie_id = $id;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $program_ales);
            $result = $stmt->execute();

            
            $query = "UPDATE program_liturgic SET status = 0 Where id != ? AND parohie_id = $id;";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $program_ales);
            $result = $stmt->execute();

            $id_selectat = $program_ales;

  }

    else {
            // dacă nu este selectat niciun id atunci ia idul cel mai recent
            $sql = "SELECT * FROM program_liturgic WHERE parohie_id = $id;";
            $stmt = $conn->prepare($sql);
            $rezultat = $stmt->execute();
            $rezultat = $stmt->get_result();
            
            while($x = mysqli_fetch_assoc($rezultat)) {
                $id_selectat = $x['id'];
            }
        }
        
        
    ?>

<title>Programul slujbelor</title>


</head>

<body>
    
    <div class="container-fluid">
        
        <div class="row wrapper">
            <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>
            
            <div class="col-lg-9 p-4 zona-principala">
                <?php include "header-mic-admin.php";?>
                
                <div class="row ultimele-programari programul-slujbelor">
                    
                    <h1> Programul slujbelor</h1>

                    <?php
          

                    if (isset($_GET['sters'])) {
                      echo '<p id="dispari">Programarea a fost ștearsă cu succes</p>';
                    } ?>

                    <div class="mt-2 mb-2"><a href="program-saptamanal.php" ><i class="far fa-plus-square rosu mb-2"></i> Adaugă program "săptămânal"</a><br><a class="" href="program-calendaristic.php"><i class="far fa-plus-square rosu"></i> Adaugă program calendaristic</a></div>

                    <!-- Afișează programele liturgice salvate -->

                    <?php

                    $query = 'Select * From program_liturgic WHERE parohie_id =' . $id;

                    $stmt = $conn->prepare($query);
                    $rezultat = $stmt->execute();
                    $rezultat = $stmt->get_result();
                    $nr_randuri = mysqli_num_rows($rezultat);

                    if ( $nr_randuri!== 0) {
                        echo '<hr>';
                        echo "<p>Programe liturgice salvate:</p>";
                        
    

                        echo '<ul class="m-3 mt-0">';
                        while ($data = mysqli_fetch_assoc($rezultat)) {
                            $nume_program = $data['nume'];
                            $id_program = $data['id'];
                            echo '<li class="disc"><a href="program-liturgic.php?idprog=' .  $data['id'] . '">' . $nume_program .'</span></a>' ; 
                            if($data['status']==1) {echo '  <span class="badge bg-info"> oficial</span> ';}
                            echo '<li>';
                        }
                       
                        echo '</ul>';
                        echo '<hr>';
    
                        
                            if(isset($_GET['adaugat'])) {
                        echo '<p class="bg-primary text-light" id="dispari">Programul a fost adăugat cu succes.</p>';
                            }

                    }

 
                
                     ?>

                <div class="col-sm-12">

                    
                         <?php
                            
                            

                            $query = "Select * From program_liturgic Where id = ? AND parohie_id = ?;";

                            $stmt = $conn->prepare($query);
                            $stmt->bind_param('ii', $id_selectat, $id);
                            $rezultat = $stmt->execute();
                            $rezultat = $stmt->get_result();
                            $rowcount = mysqli_num_rows($rezultat);

                            while ($data = mysqli_fetch_assoc($rezultat)) {
                                
                                $program_json = $data['program'];
                                $nume_program_selectat = $data['nume'];
                                $prog_decod = json_decode($program_json);
                                $status = $data['status'];
                            }

                            if($rowcount !== 0) {?>

                            
    

                            <?php
                            if($status ==0) {alerta_program_oficial ($id);}

                                echo '<h5 class="mt-3">' . $nume_program_selectat . "</h5>";  ?>

                            <p>

                            <?php if($status ==1){echo '<span class="badge bg-primary">oficial</span>';}
                            else {echo '<span class="badge bg-secondary">salvat</span>';}?>
                            
                            <?php if($status ==0) {
                           
                               echo '<a href="program-liturgic.php?program_ales=' . $id_selectat . '" class="m-2">↵ Seteaza ca oficial</a>';
                             } ?>
                            <a href="program-edit.php?idprog=<?php echo $id_selectat;?>" class="m-2"><i class="albastru-inchis far fa-edit"></i> Modifică</a> 

                            <a href="actiuni.php?stergeid=<?php echo $id_selectat; ?>&eveniment=liturgic" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți aceast program?');"><i class="rosu fas fa-trash-alt"></i>Șterge</a> </p>


                            <?php } 
                            
                            else {
                                echo '<p>Până acum nu ai stabilit niciun program. Apasă "Adăugă program" pentru a stabili unul.</p>';
                            }  
                            
                            ?>

                            <div class="table-responsive">

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
                            
                                        <tr class="
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
            </div>
        
        
        </div>




</div>

</div>

</div>



</body>
</html>


