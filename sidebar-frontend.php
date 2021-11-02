<div class="sidebar">
  <ul>  
  <li><a href="home.php" class="logo"><img src="images\logo-parohiaonline.png" width="100%"></a></li>
  <li><a href="home.php">Programările mele</a></li>
  <li><a href="info-botez.php">Info Botez</a></li>
  <li><a href="info-cununie.php">Info Cununie</a></li>
  <li><a href="frontend.php?pentru=botez">Programări Botez</a></li>
  <li><a href="frontend.php?pentru=cununie">Programări Cununie</a></li>

  
 

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


