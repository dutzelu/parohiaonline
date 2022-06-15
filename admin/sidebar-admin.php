

<div class="row justify-content-center">
  <div class="mt-4 logo"><img src="../images/logo-parohiaonline.png" ></div>
</div>


<div class="row justify-content-center">

<nav class="navbar navbar-expand-lg">
  
 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav admin">

        <li class="nav-item ">
          <a class="nav-link" href="<?php echo BASE_URL . 'admin/';?>admin.php">Prima pagină</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Stabilește zile pentru</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=botez">Botez</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=cateheza_botez">Cateheza Botez</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=cununie">Cununie</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=cateheza_cununie">Cateheza Cununie</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=parastas ">Parastas</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=spovedanie ">Spovedanie</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=sfestanie ">Sfeștanie</a>
          </div>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Registru</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item botezuri" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_botez">Botezuri</a>
            <a class="dropdown-item cununii" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_cununie">Cununii</a>
            <a class="dropdown-item spovedanii" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_spovedanie">Spovedanii</a>
            <a class="dropdown-item sfestanii" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_sfestanie">Sfeștanii</a>
            <a class="dropdown-item parastase" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_parastas">Parastase</a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link potir" href="<?php echo BASE_URL . 'admin/';?>program-liturgic.php">Programul liturgic</a>
        </li>
        <li class="nav-item">
          <a class="nav-link participare-slujbe" href="<?php echo BASE_URL . 'admin/';?>participare-slujbe.php">Participare la slujbe</a>
        </li>
        <li class="nav-item">
          <a class="nav-link pomelnic" href="<?php echo BASE_URL . 'admin/';?>pomelnice.php">Pomelnice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link membri" href="<?php echo BASE_URL . 'admin/';?>membri.php">Membri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link info" href="<?php echo BASE_URL . 'admin/';?>anunturi.php">Info utile</a>
        </li>

            
      </ul> 

    </div>

</nav>

</div>
 

