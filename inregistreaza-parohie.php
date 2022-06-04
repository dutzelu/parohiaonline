<?php 

include "includes/functions.php";
include "controllers/authController-parohie.php";

if (isset($_GET['inregistrare'])) {
  $mesaj_inregistrare = "Înregistrarea a avut loc cu succes! Pentru a valida adresa dvs. de email v-am trimis un link de confirmare. Vă rugăm să dați click pe acel link și apoi vă puteți loga în panoul de administrare. ";
} else {$mesaj_inregistrare = '';}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/main.css">
  <title>Parohia Online - Login</title>
</head>

<body id="login">

  <div class="container">

  <div class="row">
      <div class="col-md-6 offset-md-6 form-wrapper auth">
        <p><img src="images/logo-parohiaonline.png" class="logo"/></p>
      
        <h3 class="text-center form-title">Înregistrare parohie nouă</h3>

        <?php echo "<p>" . $mesaj_inregistrare . "</p>";  ?>

        <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                             <li>  <?php echo $error; ?> </li>
                        <?php endforeach;?>
                    </div>
        <?php endif;?>

        <form action="inregistreaza-parohie.php" method="post" class="parohie">

        <div class="form-group">
          <input type="text" name="nume_parohie" class="form-control form-control-lg" value="<?php echo $nume_parohie; ?>" placeholder="Numele complet al parohiei" required>
        </div>
        
        <div class="form-group">           
    
          <select class="form-control js-select" name="mitropolia" required>
          <option hidden disabled selected value class="optiune_ca_label">Mitropolia</option>
            <option <?= ($mitropolia == "Mitropolia Munteniei și Dobrogei") ? 'selected="selected"' : "" ?> value = "Mitropolia Munteniei și Dobrogei">Mitropolia Munteniei și Dobrogei</option>
            <option <?= ($mitropolia == "Mitropolia Moldovei și Bucovinei") ? 'selected="selected"' : "" ?>value = "Mitropolia Moldovei și Bucovinei">Mitropolia Moldovei și Bucovinei</option>
            <option <?= ($mitropolia == "Mitropolia Ardealului") ? 'selected="selected"' : "" ?> value = "Mitropolia Ardealului">Mitropolia Ardealului</option>
            <option <?= ($mitropolia == "Mitropolia Clujului, Maramureșului și Sălajului") ? 'selected="selected"' : "" ?> value = "Mitropolia Clujului, Maramureșului și Sălajului">Mitropolia Clujului, Maramureșului și Sălajului</option>
            <option <?= ($mitropolia == "Mitropolia Olteniei") ? 'selected="selected"' : "" ?> value = "Mitropolia Olteniei">Mitropolia Olteniei</option>
            <option <?= ($mitropolia == "Mitropolia Banatului") ? 'selected="selected"' : "" ?> value = "Mitropolia Banatului">Mitropolia Banatului</option>
            <option <?= ($mitropolia == "Mitropolia Basarabiei") ? 'selected="selected"' : "" ?> value = "Mitropolia Basarabiei">Mitropolia Basarabiei</option>
            <option <?= ($mitropolia == "Mitropolia Ortodoxa Romana a Europei Occidentale și Meridionale") ? 'selected="selected"' : "" ?> value = "Mitropolia Ortodoxa Romana a Europei Occidentale și Meridionale">Mitropolia Ortodoxa Romana a Europei Occidentale și Meridionale</option>
            <option <?= ($mitropolia == "Mitropolia Ortodoxa Romana a Germaniei, Europei Centrale și de Nord") ? 'selected="selected"' : "" ?> value = "Mitropolia Ortodoxa Romana a Germaniei, Europei Centrale și de Nord">Mitropolia Ortodoxa Romana a Germaniei, Europei Centrale și de Nord</option>
            <option <?= ($mitropolia == "Mitropolia Ortodoxă Română a celor două Americi") ? 'selected="selected"' : "" ?> value = "Mitropolia Ortodoxă Română a celor două Americi">Mitropolia Ortodoxă Română a celor două Americi</option>
            <option <?= ($mitropolia == "Jurisdicția Directă a Patriarhiei Române") ? 'selected="selected"' : "" ?> value = "Jurisdicția Directă A Patriarhiei Române">Jurisdicția Directă a Patriarhiei Române</option>
          </select>

          </div>

          <div class="form-group"> 

          <select name="episcopia" class="form-control js-select" required>
          <option hidden disabled selected value>Episcopia</option>
                    <optgroup label = "MITROPOLIA MUNTENIEI ȘI DOBROGEI">
                        <option <?= ($episcopia == "Arhiepiscopia Bucureștilor") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Bucureștilor">Arhiepiscopia Bucureștilor</option>
                        <option <?= ($episcopia == "Arhiepiscopia Tomisului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Tomisului">Arhiepiscopia Tomisului</option>
                        <option <?= ($episcopia == "Arhiepiscopia Târgoviștei") ? 'selected="selected"' : "" ?>  value ="Arhiepiscopia Târgoviștei">Arhiepiscopia Târgoviștei</option>
                        <option <?= ($episcopia == "Arhiepiscopia Argeșului și Muscelului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Argeșului și Muscelului">Arhiepiscopia Argeșului și Muscelului</option>
                        <option <?= ($episcopia == "Arhiepiscopia Buzăului și Vrancei") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Buzăului și Vrancei">Arhiepiscopia Buzăului și Vrancei</option>
                        <option <?= ($episcopia == "Arhiepiscopia Dunării de Jos") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Dunării de Jos">Arhiepiscopia Dunării de Jos</option>
                        <option <?= ($episcopia == "Episcopia Sloboziei și Călărașilor") ? 'selected="selected"' : "" ?> value ="Episcopia Sloboziei și Călărașilor">Episcopia Sloboziei și Călărașilor</option>
                        <option <?= ($episcopia == "Episcopia Alexandriei și Teleormanului") ? 'selected="selected"' : "" ?> value ="Episcopia Alexandriei și Teleormanului">Episcopia Alexandriei și Teleormanului</option>
                        <option <?= ($episcopia == "Episcopia Giurgiului") ? 'selected="selected"' : "" ?> value ="Episcopia Giurgiului">Episcopia Giurgiului</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA MOLDOVEI ȘI BUCOVINEI">
                        <option <?= ($episcopia == "Arhiepiscopia Iașilor") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Iașilor">Arhiepiscopia Iașilor</option>
                        <option <?= ($episcopia == "Arhiepiscopia Sucevei și Rădăuților") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Sucevei și Rădăuților">Arhiepiscopia Sucevei și Rădăuților</option>
                        <option <?= ($episcopia == "Arhiepiscopia Romanului și Bacăului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Romanului și Bacăului">Arhiepiscopia Romanului și Bacăului</option>
                        <option <?= ($episcopia == "Episcopia Hușilor") ? 'selected="selected"' : "" ?> value ="Episcopia Hușilor">Episcopia Hușilor</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA ARDEALULUI">
                        <option <?= ($episcopia == "Arhiepiscopia Sibiului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Sibiului">Arhiepiscopia Sibiului</option>
                        <option <?= ($episcopia == "Arhiepiscopia Alba Iuliei") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Alba Iuliei">Arhiepiscopia Alba Iuliei</option>
                        <option <?= ($episcopia == "Episcopia Ortodoxă Română a Oradiei") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxă Română a Oradiei">Episcopia Ortodoxă Română a Oradiei</option>
                        <option <?= ($episcopia == "Episcopia Covasnei și Harghitei") ? 'selected="selected"' : "" ?> value ="Episcopia Covasnei și Harghitei">Episcopia Covasnei și Harghitei</option>
                        <option <?= ($episcopia == "Episcopia Devei și Hunedoarei") ? 'selected="selected"' : "" ?> value ="Episcopia Devei și Hunedoarei">Episcopia Devei și Hunedoarei</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA CLUJULUI, MARAMUREȘULUI ȘI SĂLAJULUI">
                        <option <?= ($episcopia == "Arhiepiscopia Vadului, Feleacului și Clujului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Vadului, Feleacului și Clujului">Arhiepiscopia Vadului, Feleacului și Clujului</option>
                        <option <?= ($episcopia == "Episcopia Ortodoxă Română a Maramureșului și Sătmarului") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxă Română a Maramureșului și Sătmarului">Episcopia Ortodoxă Română a Maramureșului și Sătmarului</option>
                        <option <?= ($episcopia == "Episcopia Sălajului") ? 'selected="selected"' : "" ?> value ="Episcopia Sălajului">Episcopia Sălajului</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA OLTENIEI">
                        <option <?= ($episcopia == "Arhiepiscopia Craiovei") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Craiovei">Arhiepiscopia Craiovei</option>
                        <option <?= ($episcopia == "Arhiepiscopia Râmnicului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Râmnicului">Arhiepiscopia Râmnicului</option>
                        <option <?= ($episcopia == "Episcopia Severinului și Strehaiei") ? 'selected="selected"' : "" ?> value ="Episcopia Severinului și Strehaiei">Episcopia Severinului și Strehaiei</option>
                        <option <?= ($episcopia == "Episcopia Slatinei și Romanaților") ? 'selected="selected"' : "" ?> value ="Episcopia Slatinei și Romanaților">Episcopia Slatinei și Romanaților</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA BANATULUI">
                        <option <?= ($episcopia == "Arhiepiscopia Timișoarei") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Timișoarei">Arhiepiscopia Timișoarei</option>
                        <option <?= ($episcopia == "Arhiepiscopia Aradului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Aradului">Arhiepiscopia Aradului</option>
                        <option <?= ($episcopia == "Episcopia Caransebeșului") ? 'selected="selected"' : "" ?> value ="Episcopia Caransebeșului">Episcopia Caransebeșului</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA BASARABIEI">
                        <option <?= ($episcopia == "Arhiepiscopia Chisinaului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Chisinaului">Arhiepiscopia Chisinaului</option>
                        <option <?= ($episcopia == "Episcopia de Bălți") ? 'selected="selected"' : "" ?> value ="Episcopia de Bălți">Episcopia de Bălți</option>
                        <option <?= ($episcopia == "Episcopia Basarabiei de Sud") ? 'selected="selected"' : "" ?> value ="Episcopia Basarabiei de Sud">Episcopia Basarabiei de Sud</option>
                        <option <?= ($episcopia == "Episcopia Ortodoxă a Dubăsarilor și a toată Transnistria") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxă a Dubăsarilor și a toată Transnistria">Episcopia Ortodoxă a Dubăsarilor și a toată Transnistria</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA ORTODOXA ROMANA A EUROPEI OCCIDENTALE SI MERIDIONALE ">
                      <option <?= ($episcopia == "Arhiepiscopia Ortodoxa Română a Europei Occidentale") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Ortodoxa Română a Europei Occidentale">Arhiepiscopia Ortodoxa Română a Europei Occidentale</option>
                      <option <?= ($episcopia == "Episcopia Ortodoxa Romana a Italiei") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxa Romana a Italiei">Episcopia Ortodoxa Romana a Italiei</option>
                      <option <?= ($episcopia == "Episcopia Ortodoxa Romana a Spaniei si Portugaliei") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxa Romana a Spaniei si Portugaliei">Episcopia Ortodoxa Romana a Spaniei si Portugaliei</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA ORTODOXA ROMANA A GERMANIEI, EUROPEI CENTRALE ȘI DE NORD">
                      <option <?= ($episcopia == "Arhiepiscopia Ortodoxa Romana a Germaniei, Austriei și Luxembourgului") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Ortodoxa Romana a Germaniei, Austriei și Luxembourgului">Arhiepiscopia Ortodoxa Romana a Germaniei, Austriei și Luxembourgului</option>
                      <option <?= ($episcopia == "Episcopia Ortodoxa Romana a Europei de Nord") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxa Romana a Europei de Nord">Episcopia Ortodoxa Romana a Europei de Nord</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA ORTODOXĂ ROMÂNĂ A CELOR DOUĂ AMERICI">
                    <option <?= ($episcopia == "Arhiepiscopia Ortodoxă Română a Statelor Unite ale Americii") ? 'selected="selected"' : "" ?> value ="Arhiepiscopia Ortodoxă Română a Statelor Unite ale Americii">Arhiepiscopia Ortodoxă Română a Statelor Unite ale Americii</option>
                    <option <?= ($episcopia == "Episcopia Ortodoxă Română a Canadei") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxă Română a Canadei">Episcopia Ortodoxă Română a Canadei</option>
                  </optgroup>
                  <optgroup label = "Jurisdicția directă a Patriarhiei Române">
                    <option <?= ($episcopia == "Episcopia Daciei Felix, cu sediul administrativ în Vârșeț") ? 'selected="selected"' : "" ?> value ="Episcopia Daciei Felix, cu sediul administrativ în Vârșeț">Episcopia Daciei Felix, cu sediul administrativ în Vârșeț</option>
                    <option <?= ($episcopia == "Episcopia Ortodoxă Română din Ungaria") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxă Română din Ungaria">Episcopia Ortodoxă Română din Ungaria</option>
                    <option <?= ($episcopia == "Episcopia Ortodoxă Română a Australiei și Noii Zeedande") ? 'selected="selected"' : "" ?> value ="Episcopia Ortodoxă Română a Australiei și Noii Zeedande">Episcopia Ortodoxă Română a Australiei și Noii Zeedande</option>
                    <option <?= ($episcopia == "Vicariatul Ortodox Ucrainean") ? 'selected="selected"' : "" ?> value ="Vicariatul Ortodox Ucrainean">Vicariatul Ortodox Ucrainean</option>
                  </optgroup>
                </select>

          </div>

          <div class="form-group">
            <select name="tara" class="form-control js-select" required>
              <?php include "lista-tarilor.php";?>
            </select>
          </div>

          <div class="form-group">
            <input type="text" name="localitatea" class="form-control form-control-lg" value="<?php echo $localitatea; ?>" placeholder="Localitatea" required>
          </div>

          <div class="form-group">
            <input type="text" name="adresa_bisericii" class="form-control form-control-lg" value="<?php echo $adresa_bisericii; ?>"  placeholder="Adresa completă a bisericii" required>
          </div>

          <div class="form-group">
            <input type="text" name="hramul_bisericii" class="form-control form-control-lg" value="<?php echo $hramul_bisericii; ?>"  placeholder="Hramul bisericii" required>
          </div>

          <div class="form-group">
            <input type="tel" name="telefon" class="form-control form-control-lg" value="<?php echo $telefon; ?>"  placeholder="Telefon" required>
          </div>

          <div class="form-group">
            <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $email; ?>" placeholder="Email" required>
          </div>

          <div class="form-group">
            <input type="text" name="numele_preotului" class="form-control form-control-lg" value="<?php echo $numele_preotului; ?>" placeholder="Numele preotului" required>
          </div>

          <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $utilizator; ?>"  placeholder="Nume utilizator" required>
          </div>
          
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Parolă" required>
          </div>
          <div class="form-group">
            <input type="password" name="conf_pass" class="form-control form-control-lg" placeholder="Confirmă parola" required>
          </div>
 
          <div class="form-group">
          <p class="toate_campurile">Toate câmpurile sunt obligatorii</p>
            <button type="submit" name="inregistrare_parohie" class="btn btn-lg btn-block">Înregistrează</button>
          </div>
        </form>
        
        <p>Ai deja un cont? <a href="index.php">Login</a></p>
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