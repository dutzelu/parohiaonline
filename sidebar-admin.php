 <div class="sidebar">
  <ul>  
  <li><a href="registru.php?eveniment=programari_botez" class="logo"><img src="images\logo-parohiaonline" width="100%"></a></li>
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
        <?php if (!$_SESSION['verified']): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Trebuie să confirmi adresa ta de email!
            Conectați-vă la contul dvs. de e-mail și dați clic pe linkul de verificare pe care tocmai vi l-am trimis prin e-mail. 
            <strong><?php echo $_SESSION['email']; ?></strong>
          </div>
        <?php else: ?>
          <span class="email-verificat">Adresă de email verificată</span>
        <?php endif;?>
</ul>
</div>

<script src="js/main.js"></script>
