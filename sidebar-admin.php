 <div class="sidebar">
  <ul>  
  <li><a href="registru.php?eveniment=programari_botez" class="logo"><img src="images\logo-parohiaonline.png" width="100%"></a></li>
  <li><a href="registru.php?eveniment=programari_botez">Registru Botezuri</a></li>
  <li><a href="registru.php?eveniment=programari_cununie">Registru Cununii</a></li>
  <!-- <li><a href="registru.php?eveniment=programari_spovedanie">Registru Spovedanie</a></li>
  <li><a href="registru.php?eveniment=programari_sfestanie">Registru Sfeștanie</a></li> -->
  <li><a href="zile-stabilite.php?pentru=botez" >Zile de Botez</a></li>
  <li><a href="zile-stabilite.php?pentru=cununie" >Zile de Cununie</a></li>
  <li><a href="zile-stabilite.php?pentru=cateheza_botez" >Zile de Cateheza Botez</a></li>
  <li><a href="zile-stabilite.php?pentru=cateheza_cununie" >Zile de Cateheza Cununie</a></li>



  <?php if (isset($_SESSION['message'])): ?>
        <div id="dispari" class="alert <?php echo $_SESSION['type'] ?>">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['type']);
          ?>
        </div>
        <?php endif;?>

 
        <a href="logout.php">Logout</a>
         
</ul>
</div>

<script src="js/main.js"></script>
