<?php 
      include "header-admin.php"; 
      $ziua = null;
      $ultima_zi = null;


      if (isset($_GET['idprog'])) {
          $id_selectat = $_GET['idprog'];
      } else {
            // dacă nu este selectat niciun id atunci ia idul cel mai recent
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

            <div class="row ultimele-programari edit-programul">

            <h4 class="h4 mb-4"> Programul slujbelor</h4>

            <?php 
                if(isset($_GET['adaugat'])) {
                    echo '<p class="bg-primary text-light" id="dispari">Programul a fost adăugat cu succes.</p>';
                }
            
            ?>

            <div class="col-sm-12">

            <?php

                $query = "Select * From program_liturgic Where id = ?;";

                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $id_selectat);
                $rezultat = $stmt->execute();
                $rezultat = $stmt->get_result();
                $rowcount = mysqli_num_rows($rezultat);

                while ($data = mysqli_fetch_assoc($rezultat)) {
                    $program_json = $data['program'];
                    $nume_program = $data['nume'];
                    $prog_decod = json_decode($program_json);
                }
                if($rowcount != 0) {
                    echo '<p class="">' . $prog_decod->nume_program . "<span class='rosu'> [Edit] </span></p>"; 
                }
                
                echo '<p><a href="program-liturgic.php?idprog=' . $id_selectat . '"><i class="fas fa-chevron-circle-left"></i> Renunță</a> ';
                echo ' <button type="submit" form="editeaza" name ="editeaza" class="m-2 btn salveaza"><i class="fas fa-save albastru-inchis"></i> Salveaza</button></p>';
                
                ?>
               

                    <form id="editeaza" action="update-program-edit.php?idprog=<?php echo $id_selectat; ?>" method="POST">
                    <table class="table">
    
                    <div class="input-grup">
                        <input type="text" name="nume_program" value="<?php echo $nume_program;?> " class="form-control mb-4">
                    </div>


                        <?php
                            if($rowcount != 0) { ?>
                                
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Ziua</th>
                                        <th scope="col" class="text-center">Ora</th>
                                        <th scope="col" class="text-center">Slujba</th>
                                        <th scope="col" class="text-center">Text opțional</th>
                                        <th scope="col" class="text-center">Observații</th>
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
                                    <?php  $ziua = ucfirst($prog_decod->$ziua_saptamanii);
                                    if ($ultima_zi != $ziua){echo "subliniat"; }?>">

                                <td  width="15%" class="ziua">
                                    <?php 
                                        $ultima_zi = $ziua;
                                        // dacă e zi a săptămânii
                                        if(preg_match("/[a-z]/i", $ziua)){
                                            ?>
                                             
                                            <select name="ziua_saptamanii<?php echo $i;?>" class="form-select" value="<?php echo $ziua;?>">
                                                <option value="Luni" <?php if($ziua == "Luni"){echo "selected";};?>>Luni</option>
                                                <option value="Marți" <?php if($ziua == "Marți"){echo "selected";};?>>Marți</option>
                                                <option value="Miercuri" <?php if($ziua == "Miercuri"){echo "selected";};?>>Miercuri</option>
                                                <option value="Joi" <?php if($ziua == "Joi"){echo "selected";};?>>Joi</option>
                                                <option value="Vineri" <?php if($ziua == "Vineri"){echo "selected";};?>>Vineri</option>
                                                <option value="Sâmbătă" <?php if($ziua == "Sâmbătă"){echo "selected";};?>>Sâmbătă</option>
                                                <option value="Duminică" <?php if($ziua == "Duminică"){echo "selected";};?>>Duminică</option>
                                            </select>

                                        <?php } 
                                         // dacă e zi calendaristică
                                        else {
                                             echo '<input type="date" name="ziua_saptamanii' . $i . '" class="form-control" value="' . $ziua . '">';
                                        }
                                    
                                    
                                    ?>

                   
                                </td>

                                <td width="10%">

                                <input type="text" name="ora_start<?php echo $i;?>" value="<?php echo $prog_decod->$ora_start;?> " class="form-control">
                                
                                </td>
                                <td width="20%">

                                    <select class="form-control" name="slujba<?php echo $i;?>" id="slujba" value="<?php $prog_decod->$slujba;?>">
                                    <optgroup label="Liturgice">
                                        <option value="Sfânta Liturghie" <?php if($prog_decod->$slujba == "Sfânta Liturghie"){echo "selected";};?>>Sfânta Liturghie</option>
                                        <option value="Vecernia" <?php if($prog_decod->$slujba == "Vecernia"){echo "selected";};?>>Vecernia</option>
                                        <option value="Pavecernita"  <?php if($prog_decod->$slujba == "Pavecernita"){echo "selected";};?>>Pavecernița</option>
                                        <option value="Utrenia"  <?php if($prog_decod->$slujba == "Utrenia"){echo "selected";};?>>Utrenia</option>
                                        <option value="Litia" <?php if($prog_decod->$slujba == "Litia"){echo "selected";};?>>Litia</option>
                                        <option value="Pomenirea morților" <?php if($prog_decod->$slujba == "Pomenirea morților"){echo "selected";};?>>Pomenirea morților</option>
                                        <option value="Miezonoptica" <?php if($prog_decod->$slujba == "Miezonoptica"){echo "selected";};?>>Miezonoptica</option>
                                        <option value="Obednița" <?php if($prog_decod->$slujba == "Obednița"){echo "selected";};?>>Obednița</option>
                                        <option value="Priveghere de noapte" <?php if($prog_decod->$slujba == "Priveghere de noapte"){echo "selected";};?>>Priveghere de noapte</option>
                                    </optgroup>
                                    <optgroup label="Sfintele Taine">
                                        <option value="Taina Sfântului Botez"  <?php if($prog_decod->$slujba == "Taina Sfântului Botez"){echo "selected";};?>>Taina Sfântului Botez</option>
                                        <option value="Taina Sfintei Cununii"  <?php if($prog_decod->$slujba == "Taina Sfintei Cununii"){echo "selected";};?>>Taina Sfintei Cununii</option>
                                        <option value="Taina Sfântului Maslu" <?php if($prog_decod->$slujba == "Taina Sfântului Maslu"){echo "selected";};?>>Taina Sfântului Maslu</option>
                                        <option value="Taina Spovedaniei" <?php if($prog_decod->$slujba == "Taina Spovedaniei"){echo "selected";};?>>Taina Spovedaniei</option>option>
                                    </optgroup>
                                    <optgroup label="Sfinți">
                                        <option value="Acatistul" <?php if($prog_decod->$slujba == "Acatistul"){echo "selected";};?>>Acatistul</option>
                                        <option value="Paraclisul" <?php if($prog_decod->$slujba == "Paraclisul"){echo "selected";};?>>Paraclisul</option>
                                    </optgroup>
                                    <optgroup label="Rugăciuni">
                                        <option value="Rugăciunile de seară" <?php if($prog_decod->$slujba == "Rugăciunile de seară"){echo "selected";};?>>Rugăciunile de seară</option>
                                        <option value="Rugăciunile de dimineață" <?php if($prog_decod->$slujba == "Rugăciunile de dimineață"){echo "selected";};?>>Rugăciunile de dimineață</option>
                                        <option value="Ceasul I" <?php if($prog_decod->$slujba == "Ceasul I"){echo "selected";};?>>Ceasul I</option>
                                        <option value="Ceasul III" <?php if($prog_decod->$slujba == "Ceasul III"){echo "selected";};?>>Ceasul III</option>
                                        <option value="Ceasul VI" <?php if($prog_decod->$slujba == "Ceasul VI"){echo "selected";};?>>Ceasul VI</option>
                                        <option value="Ceasul IX" <?php if($prog_decod->$slujba == "Ceasul IX"){echo "selected";};?>>Ceasul IX</option>
                                    </optgroup>
                                    <optgroup label="Speciale">
                                        <option value="Denia" <?php if($prog_decod->$slujba == "Denia"){echo "selected";};?>>Denia</option>
                                        <option value="Slujba Învierii"  <?php if($prog_decod->$slujba == "Slujba Învierii"){echo "selected";};?>>Slujba Învierii</option>
                                        <option value="Cateheză" <?php if($prog_decod->$slujba == "Cateheză"){echo "selected";};?>>Cateheză</option>
                                        <option value="Seară biblică" <?php if($prog_decod->$slujba == "Seară biblică"){echo "selected";};?>>Seară biblică</option>
                                        <option value="Sfințirea Apei (Aghiazma)" <?php if($prog_decod->$slujba == "Sfințirea Apei (Aghiazma)"){echo "selected";};?>>Sfințirea Apei (Aghiazma)</option>
                                        <option value="Tedeum" <?php if($prog_decod->$slujba == "Tedeum"){echo "selected";};?>>Tedeum</option>
                                        <option value="Moliftele Sf. Vasile cel Mare" <?php if($prog_decod->$slujba == "Moliftele Sf. Vasile cel Mare"){echo "selected";};?>>Moliftele Sf. Vasile cel Mare</option>
                                        <option value="Citirea Psaltirii" <?php if($prog_decod->$slujba == "Citirea Psaltirii"){echo "selected";};?>>Citirea Psaltirii</option>
                                        <option value="Rugăciunea lui Iisus" <?php if($prog_decod->$slujba == "Rugăciunea lui Iisus"){echo "selected";};?>>Rugăciunea lui Iisus</option>
                                        <option value="Concert" <?php if($prog_decod->$slujba == "Concert"){echo "selected";};?>>Concert</option>
                                    </optgroup>
                                    </select>
                                 </td>
                                 <td width="25%">
                                 <input type="text" name="text_optional<?php echo $i;?>" class="form-control" value=" <?php echo $prog_decod->$text_optional ; ?>"></td>
                                

                                 <td width="30%"><textarea rows="1" cols="1" id="alte_observatii" name="alte_observatii<?php echo $i;?>" class="form-control" ><?php echo $prog_decod->$text_optional ; ?></textarea></td>

                            </tr>
                            <?php }} ?> 
                        </tbody>
                    </table>
                    </form>
                



            </div>
             
            
            
            
        </div>




</div>

</div>

</div>



</body>
</html>


