 
 
 
  <div class="row justify-content-center">
    <div class="col-sm-9 mt-4 logo"><img src="<?php echo BASE_URL . 'images\logo-parohiaonline.png'; ?>" ></div>
 </div>

<div class="row justify-content-center">

  <div class="sidenav frontend">
    <a class="prima-pagina" href="<?php echo BASE_URL . 'admin-client.php'; ?>">Prima pagină</a>
    <button class="programari dropdown-btn">Programările mele<i class="fas fa-chevron-down" style="margin-left:10px; font-size:10px"></i></button>
    <ul class="dropdown-container">
      <li><a class="botezuri" href="<?php echo BASE_URL . 'home-botez.php';?>">Botezuri</a></li>
      <li><a class="cununii" href="<?php echo BASE_URL . 'home-cununie.php';?>">Cununii</a></li>
      <li><a class="spovedanii" href="<?php echo BASE_URL . 'home-spovedanie.php';?>">Spovedanii</a></li>
      <li><a class="sfestanii" href="<?php echo BASE_URL . 'home-sfestanie.php';?>">Sfeștanii</a></li>
      <li><a class="parastase" href="<?php echo BASE_URL . 'home-parastas.php';?>">Parastase</a></li>
    </ul>
    <a class="participare-slujbe" href="participare-slujbe-crestini.php">Participare la slujbe</a>
    <a class="rugaciuni" href="rugaciuni-in-comun.php">Rugăciuni în comun</a>
    <a class="pomelnic" href="<?php echo BASE_URL . 'pomelnic-online.php';?>">Pomelnic online</a>
    <button class="dropdown-btn">Informații utile<i class="fas fa-chevron-down" style="margin-left:10px; font-size:10px"></i></button>
    <ul class="dropdown-container">
      <li><a class="info" href="<?php echo BASE_URL . 'info-utile.php?id=1';?>">Info Botez</a></li>
      <li><a class="info" href="<?php echo BASE_URL . 'info-utile.php?id=2';?>">Info Cununiei</a></li>
      <li><a class="info" href="<?php echo BASE_URL . 'info-utile.php?id=3';?>">Info Spovedanie</a></li>
      <li><a class="info" href="<?php echo BASE_URL . 'info-utile.php?id=4';?>">Info Sfeștanie</a></li>
      <li><a class="info" href="<?php echo BASE_URL . 'info-utile.php?id=5';?>">Info Parastas</a></li>
    </ul>
    <a class="login" href="<?php echo BASE_URL . 'login/logout.php';?>">Logout</a>
        
  </div> 

</div>


<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>


