 
 
 
  <div class="row justify-content-center">
    <div class="col-sm-9 mt-4 logo"><img src="<?php echo BASE_URL . 'images\logo-parohiaonline.png'; ?>" ></div>
 </div>

<div class="row justify-content-center">

  <div class="sidenav frontend">
    <a class="prima-pagina" href="<?php echo BASE_URL . 'admin-client.php'; ?>">Prima pagină</a>
    <a class="prima-pagina" href="<?php echo BASE_URL . 'home.php';?>">Programările mele</a>
    <button class="programari dropdown-btn">Programează<i class="fas fa-chevron-down" style="margin-left:10px; font-size:10px"></i></button>
        <ul class="dropdown-container">
          <li><a class="botezuri" href="<?php echo BASE_URL . 'frontend.php?pentru=botez';?>">Botez</a></li>
          <li><a class="cununii" href="<?php echo BASE_URL . 'frontend.php?pentru=cununie';?>">Cununie</a></li>
          <li><a class="parastase" href="<?php echo BASE_URL . 'frontend.php?pentru=parastas';?>">Parastas</a></li>
          <li><a class="sfestanii" href="<?php echo BASE_URL . 'frontend.php?pentru=sfestanie';?>">Sfeștanie</a></li>
        </ul>
    <a class="participare-slujbe" href="participare_la_slujbe.php">Participare la slujbe</a>
    <a class="rugaciuni" href="rugaciuni-in-comun.php">Rugăciuni în comun</a>
    <a class="pomelnic" href="pomelnic-online.php">Pomelnic online</a>
    <a href="<?php echo BASE_URL . 'info-botez.php';?>">Info Botez</a>
    <a href="<?php echo BASE_URL . 'info-cununie.php';?>">Info Cununie</a>
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


