<?php include "../header-frontend.php"; 
 


if (isset($_GET['tip'])) {
    $tip = $_GET['tip'];

    switch ($tip) {
        case 1:
            $titlu_pomelnic = "Pomelnic pentru vii (Sfânta Liturghie)";
            break;
        case 2:
            $titlu_pomelnic = "Pomelnic pentru adormiți (Sfânta Liturghie)";
            break;
        case 3:
            $titlu_pomelnic = "Pomelnic pentru Sfântul Maslu";
            break;
        case 4:
            $titlu_pomelnic = "Pomelnic pentru Acatist";
            break;
        case 5:
            $titlu_pomelnic = "Pomelnic pentru Parastas";
            break;
    }
}


?>

<title><?php echo $titlu_pomelnic;?></title>
</head>

<body>


<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-lg-3 sidebar-admin"><?php include "../sidebar-frontend.php"?></div>

        <div class="col-lg-9 p-4 zona-principala">
            
            <?php include "../header-mic-frontend.php";?>
        
        <div class="row mt-3 ultimele-programari">
              <p class="fw-bold"><?php echo $titlu_pomelnic;?></p>

              <div class="col-sm-6 pomelnic">

                <?php  if (isset($_GET['succes'])) 
                {
                    echo "<p id='dispari' class='btn btn-success'>Pomelnicul a fost trimis cu succes.</p>";}?>
  

                    <form  method="POST" action="update-pomelnic.php?tip=<?php echo $tip;?>">

                    <div class="input-group mb-2">
                        <span class="input-group-text">Listă nume *</span>
                        <textarea name="lista_nume" class="form-control" cols="20" rows="10" placeholder="Ex: Ioan, Aneta, Gheorghe, Irina, Florin, Andra." required></textarea>
                    </div>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Durata</span>
                        <select name="durata_in_zile" class="form-control" placeholder="Selectează perioada" value="1"> 
                            <option value="1">O zi</option>
                            <option value="7">O săptămână</option>
                            <option value="30" selected>O lună</option>
                            <option value="40">40 de zile</option>
                            <option value="365">Un an</option>
                        </select>
                    </div>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Numele tău *</span>
                        <input type="text" class="form-control" name="nume_si_prenume" required>
                    </div>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Telefon *</span>
                        <input type="tel" class="form-control" name="telefon" required>
                    </div>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Email</span>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="input-group mb-2">
                        <span class="input-group-text">Data începerii *</span>
                        <input type="date" class="form-control" name="data_inceperii" required>
                    </div>

                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="cu_donatie" name="cu_donatie">
                        <label class="form-check-label" for="cu_donatie">
                            cu donație
                        </label>
                    </div>

                    
                    <input type="submit" value="Trimite pomelnicul" class="btn btn-primary" name="pomelnic">

                    </form>
     
              </div>
              <div class="col-sm-6 explicatie">

              <p>Acest pomelnic se pomenește la Sfânta Liturghie și la cele Șapte Laude. Nu se pot pomeni la Sfânta Liturghie decât persoanele botezate ortodoxe. Dacă treceți pe pomelnic persoane de altă religie vă rugăm să precizați în dreptul lor că nu sunt ortodocși pentru a-i pomeni la alte slujbe la care pot fi și aceștia pomeniți.</p>

              <p class="rosu"><strong>Donație</strong></p>
              <p>Opțional puteți face donații cu orice sumă prin virament bancar în contul parohiei:</p>
              <p><strong>Titular:</strong> Parohia Sfântul Ambrozie</p>
              <p><strong>Cont lei:</strong> R056 UGBI 3012 1142 6621 4RON</p>
              <p><strong>Cont euro:</strong> R012 UGBI 4012 1212 8745 1EUR</p>
              <p><strong>Banca:</strong> Garanti Bank BBVA</p>

              </div>
 
 
</div>    
</div>

</div>
  
</div>

</body>
</html>

 