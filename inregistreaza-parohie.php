<?php 
include "header-frontend.php";
include "update-inregistrare-parohie.php";

if (isset($_GET['inregistrare'])) {
  $mesaj_inregistrare = "Înregistrarea a avut loc cu succes! Pentru a valida adresa dvs. de email v-am trimis un link de confirmare. Vă rugăm să dați click pe acel link și apoi vă puteți loga în panoul de administrare. ";
}

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
          <input type="text" name="nume_parohie" class="form-control form-control-lg" value="<?php echo $nume; ?>" placeholder="Numele complet al parohiei" required>
        </div>
        
        <div class="form-group">           
    
          <select class="form-control" name="mitropolia" required>
          <option hidden disabled selected value class="optiune_ca_label">Alege mitropolia</option>
            <option value = "Mitropolia Munteniei și Dobrogei">Mitropolia Munteniei și Dobrogei</option>
            <option value = "Mitropolia Moldovei și Bucovinei">Mitropolia Moldovei și Bucovinei</option>
            <option value = "Mitropolia Ardealului">Mitropolia Ardealului</option>
            <option value = "Mitropolia Clujului, Maramureșului Și Sălajului">Mitropolia Clujului, Maramureșului și Sălajului</option>
            <option value = "Mitropolia Olteniei">Mitropolia Olteniei</option>
            <option value = "Mitropolia Banatului">Mitropolia Banatului</option>
            <option value = "Mitropolia Basarabiei">Mitropolia Basarabiei</option>
            <option value = "Mitropolia Ortodoxa Romana a Europei Occidentale și Meridionale">Mitropolia Ortodoxa Romana a Europei Occidentale și Meridionale</option>
            <option value = "Mitropolia Ortodoxa Romana a Germaniei, Europei Centrale și de Nord">Mitropolia Ortodoxa Romana a Germaniei, Europei Centrale și de Nord</option>
            <option value = "Mitropolia Ortodoxă Română a celor două Americi">Mitropolia Ortodoxă Română a celor două Americi</option>
            <option value = "Jurisdicția Directă A Patriarhiei Române">Jurisdicția Directă a Patriarhiei Române</option>
          </select>

          </div>

          <div class="form-group"> 

          <select name="episcopia" class="form-control" required>
          <option hidden disabled selected value>Alege episcopia</option>
                    <optgroup label = "MITROPOLIA MUNTENIEI ȘI DOBROGEI">
                        <option value ="Arhiepiscopia Bucureștilor">Arhiepiscopia Bucureștilor</option>
                        <option value ="Arhiepiscopia Tomisului">Arhiepiscopia Tomisului</option>
                        <option value ="Arhiepiscopia Târgoviștei">Arhiepiscopia Târgoviștei</option>
                        <option value ="Arhiepiscopia Argeșului și Muscelului">Arhiepiscopia Argeșului și Muscelului</option>
                        <option value ="Arhiepiscopia Buzăului și Vrancei">Arhiepiscopia Buzăului și Vrancei</option>
                        <option value ="Arhiepiscopia Dunării de Jos">Arhiepiscopia Dunării de Jos</option>
                        <option value ="Episcopia Sloboziei și Călărașilor">Episcopia Sloboziei și Călărașilor</option>
                        <option value ="Episcopia Alexandriei și Teleormanului">Episcopia Alexandriei și Teleormanului</option>
                        <option value ="Episcopia Giurgiului">Episcopia Giurgiului</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA MOLDOVEI ȘI BUCOVINEI">
                        <option value ="Arhiepiscopia Iașilor">Arhiepiscopia Iașilor</option>
                        <option value ="Arhiepiscopia Sucevei și Rădăuților">Arhiepiscopia Sucevei și Rădăuților</option>
                        <option value ="Arhiepiscopia Romanului și Bacăului">Arhiepiscopia Romanului și Bacăului</option>
                        <option value ="Episcopia Hușilor">Episcopia Hușilor</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA ARDEALULUI">
                        <option value ="Arhiepiscopia Sibiului">Arhiepiscopia Sibiului</option>
                        <option value ="Arhiepiscopia Alba Iuliei">Arhiepiscopia Alba Iuliei</option>
                        <option value ="Episcopia Ortodoxă Română a Oradiei">Episcopia Ortodoxă Română a Oradiei</option>
                        <option value ="Episcopia Covasnei și Harghitei">Episcopia Covasnei și Harghitei</option>
                        <option value ="Episcopia Devei și Hunedoarei">Episcopia Devei și Hunedoarei</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA CLUJULUI, MARAMUREȘULUI ȘI SĂLAJULUI">
                        <option value ="Arhiepiscopia Vadului, Feleacului și Clujului">Arhiepiscopia Vadului, Feleacului și Clujului</option>
                        <option value ="Episcopia Ortodoxă Română a Maramureșului și Sătmarului">Episcopia Ortodoxă Română a Maramureșului și Sătmarului</option>
                        <option value ="Episcopia Sălajului">Episcopia Sălajului</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA OLTENIEI">
                        <option value ="Arhiepiscopia Craiovei">Arhiepiscopia Craiovei</option>
                        <option value ="Arhiepiscopia Râmnicului">Arhiepiscopia Râmnicului</option>
                        <option value ="Episcopia Severinului și Strehaiei">Episcopia Severinului și Strehaiei</option>
                        <option value ="Episcopia Slatinei și Romanaților">Episcopia Slatinei și Romanaților</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA BANATULUI">
                        <option value ="Arhiepiscopia Timișoarei">Arhiepiscopia Timișoarei</option>
                        <option value ="Arhiepiscopia Aradului">Arhiepiscopia Aradului</option>
                        <option value ="Episcopia Caransebeșului">Episcopia Caransebeșului</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA BASARABIEI">
                        <option value ="Arhiepiscopia Chisinaului">Arhiepiscopia Chisinaului</option>
                        <option value ="Episcopia de Bălți">Episcopia de Bălți</option>
                        <option value ="Episcopia Basarabiei de Sud">Episcopia Basarabiei de Sud</option>
                        <option value ="Episcopia Ortodoxă a Dubăsarilor și a toată Transnistria">Episcopia Ortodoxă a Dubăsarilor și a toată Transnistria</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA ORTODOXA ROMANA A EUROPEI OCCIDENTALE SI MERIDIONALE ">
                      <option value ="Arhiepiscopia Ortodoxa Română a Europei Occidentale">Arhiepiscopia Ortodoxa Română a Europei Occidentale</option>
                      <option value ="Episcopia Ortodoxa Romana a Italiei">Episcopia Ortodoxa Romana a Italiei</option>
                      <option value ="Episcopia Ortodoxa Romana a Spaniei si Portugaliei">Episcopia Ortodoxa Romana a Spaniei si Portugaliei</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA ORTODOXA ROMANA A GERMANIEI, EUROPEI CENTRALE ȘI DE NORD">
                      <option value ="Arhiepiscopia Ortodoxa Romana a Germaniei, Austriei și Luxembourgului">Arhiepiscopia Ortodoxa Romana a Germaniei, Austriei și Luxembourgului</option>
                      <option value ="Episcopia Ortodoxa Romana a Europei de Nord">Episcopia Ortodoxa Romana a Europei de Nord</option>
                    </optgroup>
                    <optgroup label = "MITROPOLIA ORTODOXĂ ROMÂNĂ A CELOR DOUĂ AMERICI">
                    <option value ="Arhiepiscopia Ortodoxă Română a Statelor Unite ale Americii">Arhiepiscopia Ortodoxă Română a Statelor Unite ale Americii</option>
                    <option value ="Episcopia Ortodoxă Română a Canadei">Episcopia Ortodoxă Română a Canadei</option>
                  </optgroup>
                  <optgroup label = "Jurisdicția directă a Patriarhiei Române">
                    <option value ="Episcopia Daciei Felix, cu sediul administrativ în Vârșeț">Episcopia Daciei Felix, cu sediul administrativ în Vârșeț</option>
                    <option value ="Episcopia Ortodoxă Română din Ungaria">Episcopia Ortodoxă Română din Ungaria</option>
                    <option value ="Episcopia Ortodoxă Română a Australiei și Noii Zeedande">Episcopia Ortodoxă Română a Australiei și Noii Zeedande</option>
                    <option value ="Vicariatul Ortodox Ucrainean">Vicariatul Ortodox Ucrainean</option>
                  </optgroup>
                </select>

          </div>

          <div class="form-group">
            <select name="tara" class="form-control" required>
              <?php include "lista-tarilor.php";?>
            </select>
          </div>

          <div class="form-group">
            <input type="text" name="localitatea" class="form-control form-control-lg" placeholder="Localitatea" required>
          </div>

          <div class="form-group">
            <input type="text" name="adresa_bisericii" class="form-control form-control-lg" placeholder="Adresa completă a bisericii" required>
          </div>

          <div class="form-group">
            <input type="text" name="hramul_bisericii" class="form-control form-control-lg" placeholder="Hramul bisericii" required>
          </div>

          <div class="form-group">
            <input type="tel" name="telefon" class="form-control form-control-lg" placeholder="Telefon" required>
          </div>

          <div class="form-group">
            <input type="text" name="email" class="form-control form-control-lg" placeholder="Email" required>
          </div>

          <div class="form-group">
            <input type="text" name="numele_preotului" class="form-control form-control-lg" placeholder="Numele preotului" required>
          </div>

          <div class="form-group">
            <input type="text" name="username" class="form-control form-control-lg" placeholder="Nume utilizator" required>
          </div>
          
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Parolă" required>
          </div>
          <div class="form-group">
            <input type="password" name="conf_pass" class="form-control form-control-lg" placeholder="Confirmă parola" required>
          </div>
 
          <div class="form-group">
          <p class="mb-2">Toate câmpurile sunt obligatorii</p>
            <button type="submit" name="inregistrare_parohie" class="btn btn-lg btn-block">Înregistrează</button>
          </div>
        </form>
        
        <p>Ai deja un cont? <a href="index.php">Login</a></p>
      </div>
    </div>

  </div>
     
  </div>

</body>
</html>