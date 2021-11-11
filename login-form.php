<div class="col-xl-4 col-lg-4 col-md-6 col-sm-8 form-wrapper auth login">
      <p><img src="images/logo-parohiaonline.png" class="logo"/></p>
        <h3 class="text-center form-title">Login</h3>
       
        <?php 

        foreach ($errors as $error) {
          echo '<p class="btn btn-danger">' . $error . '</p>';
        }

        echo '<p>' . $mesaj_inregistrare . '</p>';
        
        ?>

        <form action="login.php" method="post">
          <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $username; ?>" placeholder="Utilizator sau email">
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Parola">
          </div>
          <div class="form-group">
            <button type="submit" name="login-btn" class="btn btn-lg btn-block">Login</button>
          </div>
        </form>
        <div class="linkuri_login_form">
          <p>Nu ai încă un cont? <a href="signup.php">Înregistrează-te</a></p>
          <p>Ai uitat parola? <a href="recupereaza.php">Recupereaz-o</a></p>
       </div>
      </div>

    </div>