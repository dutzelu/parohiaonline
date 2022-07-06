 
<div class="row">
  <div class="col-12">
    <div class="mt-4  d-none 	d-md-none d-lg-block d-sm-block d-sm-none d-md-block logo"><img src="<?php echo BASE_URL;?>/images/logo-parohiaonline.png" ></div>
 </div>
 <div class="col-12" style="padding:0">
 <nav class="navbar navbar-dark navbar-expand-lg" >
 
    <a class="navbar-brand p-2  d-xxl-none d-xxl-block d-xl-none d-lg-none d-xl-block" href="admin-client.php"><img src="<?php echo BASE_URL;?>images/logo-PO-mobil.png" width="170"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon bg-outline-primary"></span>
        </button>
          
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav admin p-4">

          <li class="nav-item ">
             <a class="nav-link" href="<?php echo BASE_URL . 'admin-client.php'; ?>">Prima pagină</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Programările mele</a>
              <div class="dropdown-menu registru" aria-labelledby="navbarDropdown">
            <a class="dropdown-item botezuri" href="<?php echo BASE_URL . 'home-botez.php';?>">Botezuri</a>
            <a class="dropdown-item cununii" href="<?php echo BASE_URL . 'home-cununie.php';?>">Cununii</a>
            <a class="dropdown-item spovedanii" href="<?php echo BASE_URL . 'home-spovedanie.php';?>">Spovedanii</a>
            <a class="dropdown-item sfestanii" href="<?php echo BASE_URL . 'home-sfestanie.php';?>">Sfeștanii</a>
            <a class="dropdown-item parastase" href="<?php echo BASE_URL . 'home-parastas.php';?>">Parastase</a>
            </div>
            </li>
    
            <li class="nav-item">
              <a class="nav-link participare-slujbe" href="<?php echo BASE_URL . 'participare-slujbe-crestini.php';?>">Participare la slujbe</a>
            </li>
            <li class="nav-item">
              <a class="nav-link pomelnic" href="<?php echo BASE_URL . 'pomelnic-online.php';?>">Pomelnic online</a>
              </li>

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informații utile</a>
              <div class="dropdown-menu registru" aria-labelledby="navbarDropdown">
            <a class="dropdown-item info" href="<?php echo BASE_URL . 'info-utile.php?tip=1';?>">Info Botez</a>
            <a class="dropdown-item info" href="<?php echo BASE_URL . 'info-utile.php?tip=2';?>">Info Cununiei</a>
            <a class="dropdown-item info" href="<?php echo BASE_URL . 'info-utile.php?tip=3';?>">Info Spovedanie</a>
            <a class="dropdown-item info" href="<?php echo BASE_URL . 'info-utile.php?tip=4';?>">Info Sfeștanie</a>
            <a class="dropdown-item info" href="<?php echo BASE_URL . 'info-utile.php?tip=5';?>">Info Parastas</a>
              </div>
            </li>
            </ul> 
      </div> 
    </nav>
</div>
</div>