<?php 
      include "header-admin.php"; 
?>

<title>Panoul de control</title>


</head>

<body>

<div class="container-fluid">
 
    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            <?php include "header-mic-admin.php";?>

            <div class="row ultimele-programari">

            <h1>Adăugă un program de slujbe "SĂPTĂMÂNAL"</h1>

            <ul>
                <li class="badge bg-primary">fara zile calendaristice exacte | doar cu zile ale săptămânii</li>
                <li class="badge bg-info">se repeta pe perioade lungi de timp</li>
                <li class="badge bg-primary">stabilește oricâte zile vrei (7, 14, 30, etc.)</li>
            </ul>


                <div id="readroot" style="display: none">
                
                    <div class="input-group mb-2">
                        <span class="input-group-text">Alege o zi</span>
                        <label for="slujba"></label>
                        <select name="ziua_saptamanii" class="form-select" value="Luni">
                            <option value="Luni">Luni</option>
                            <option value="Marți">Marți</option>
                            <option value="Miercuri">Miercuri</option>
                            <option value="Joi">Joi</option>
                            <option value="Vineri">Vineri</option>
                            <option value="Sâmbătă">Sâmbătă</option>
                            <option value="Duminică">Duminică</option>
                        </select>
                    </div>
                    
                    
                    <div class="input-group mb-2">
                        <span class="input-group-text">Alege o slujbă</span>
                        <select class="form-control js-select" name="slujba" id="slujba" value="Sfânta Liturghie">
                            <optgroup label="Liturgice">
                                <option value="Sfânta Liturghie">Sfânta Liturghie</option>
                                <option value="Vecernia">Vecernia</option>
                                <option value="Pavecernita">Pavecernița</option>
                                <option value="Utrenia">Utrenia</option>
                                <option value="Litia">Litia</option>
                                <option value="Pomenirea morților">Pomenirea morților</option>
                                <option value="Miezonoptica">Miezonoptica</option>
                                <option value="Obednița">Obednița</option>
                                <option value="Priveghere de noapte">Priveghere de noapte</option>
                            </optgroup>
                            <optgroup label="Sfintele Taine">
                                <option value="Taina Sfântului Botez">Taina Sfântului Botez</option>
                                <option value="Taina Sfintei Cununii">Taina Sfintei Cununii</option>
                                <option value="Taina Sfântului Maslu">Taina Sfântului Maslu</option>
                                <option value="Taina Spovedaniei">Taina Spovedaniei</option>option>
                            </optgroup>
                            <optgroup label="Sfinți">
                                <option value="Acatistul">Acatistul</option>
                                <option value="Paraclisul">Paraclisul</option>
                            </optgroup>
                            <optgroup label="Rugăciuni">
                                <option value="Rugăciunile de seară">Rugăciunile de seară</option>
                                <option value="Rugăciunile de dimineață">Rugăciunile de dimineață</option>
                                <option value="Ceasul I">Ceasul I</option>
                                <option value="Ceasul III">Ceasul III</option>
                                <option value="Ceasul VI">Ceasul VI</option>
                                <option value="Ceasul IX">Ceasul IX</option>
                            </optgroup>
                            <optgroup label="Speciale">
                                <option value="Denia">Denia</option>
                                <option value="Slujba Învierii">Slujba Învierii</option>
                                <option value="Cateheză">Cateheză</option>
                                <option value="Seară biblică">Seară biblică</option>
                                <option value="Sfințirea Apei (Aghiazma)">Sfințirea Apei (Aghiazma)</option>
                                <option value="Sfințirea Apei (Aghiazma mare)">Sfințirea Apei (Aghiazma Mare)</option>
                                <option value="Tedeum">Tedeum</option>
                                <option value="Moliftele Sf. Vasile cel Mare">Moliftele Sf. Vasile cel Mare</option>
                                <option value="Citirea Psaltirii">Citirea Psaltirii</option>
                                <option value="Rugăciunea lui Iisus">Rugăciunea lui Iisus</option>
                                <option value="Concert">Concert</option>
                            </optgroup>
                        </select>
                    </div>
                    
                    <div class="input-group mb-2">
                        <span class="input-group-text">Adăugă text opțional</span>
                    <input type="text" name="text_optional" placeholder="precizări despre slujbă" class="form-control" value="">
                    <p class="m-2">Ex: [Sfânta Liturghie] <strong> în Duminica a 5-a după Rusalii,</strong><br> sau [Acatistul] <strong>Sfântului Nectarie,</strong> <br>sau [Paraclisul]<strong>Maicii Domnului,</strong> [Denia] <strong>Celor 12 Evanghelii</strong>.</p>
                </div>
                
                <div class="input-group mb-2">
                    <span class="input-group-text">Alte observații (opțional)</span>
                    <textarea rows="1" id="alte_observatii" name="alte_observatii" class="form-control" placeholder="Ex: Moșii de vară; Sfântul Grigorie Palama și Sf. Ap. Filip" value=""></textarea>
                </div>
                
                <div class="input-group mb-2">
                    <span class="input-group-text">Începe la:</span>
                    <input type="text" name="ora_start" value="09:00" class="form-control">
                </div>
                
                <input type="button" value="Elimină slujbă / zi" class="btn btn-outline-danger"
                onclick="this.parentNode.parentNode.removeChild(this.parentNode);" /><br /><br />
                
               
                
            </div>
            
            <form  action="update-program-adauga.php" method="POST">
                
                <div class="input-group mt-3 mb-2">
                    <span class="input-group-text">Numele programului:</span>
                    <input type="text" name="nume_program" placeholder="ex: Program obișnuit, program Săptămâna mare, program Postul Mare" class="form-control" required>
                </div>

                <hr>
                
                <span id="writeroot"></span>

                <input type="button" value="Adăugă încă o slujbă / o zi" class="btn btn-outline-primary" onclick="moreFields();"/>
                <input type="submit" value="Salvează program" class="btn btn-primary" name="salveazaProgram"/>
                
            </form>
            
            
            
        </div>




</div>

</div>

</div>

<script>
      $(document).ready(function() {
         $('.js-select').select2();
       });
</script>


</body>
</html>


