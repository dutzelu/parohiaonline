 
 <div class="row justify-content-center">
    <div class="col-sm-9 mt-4 logo"><img src="../images/logo-parohiaonline.png" ></div>
 </div>

<div class="row justify-content-center">

  <div class="sidenav admin">
    <a class="prima-pagina" href="<?php echo BASE_URL . 'admin/';?>admin.php">Prima pagină</a>
    <a class="membri" href="<?php echo BASE_URL . 'admin/';?>membri.php">Membri</a>
    <a class="potir" href="<?php echo BASE_URL . 'admin/';?>programul-slujbelor.php">Programul slujbelor</a>
    <button class="zile dropdown-btn">Zile rânduite <i class="fas fa-chevron-down" style="margin-left:10px; font-size:10px"></i></button>
    <ul class="dropdown-container">
      <li><a href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=spovedanie ">Spovedanie</a></li>
      <li><a href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=sfestanie ">Sfeștanie</a></li>
      <li><a href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=parastas ">Parastas</a></li>
      <li><a href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=botez">Botez</a></li>
      <li><a href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=cununie">Cununie</a></li>
      <li><a href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=cateheza_botez">Cateheza Botez</a></li>
      <li><a href="<?php echo BASE_URL . 'admin/';?>zile-stabilite.php?pentru=cateheza_cununie">Cateheza Cununie</a></li>
    </ul>
    <a class="botezuri" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_botez">Botezuri</a>
    <a class="cununii" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_cununie">Cununii</a>
    <a class="spovedanii" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_spovedanie">Spovedanii</a>
    <a class="sfestanii" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_sfestanie">Sfeștanii</a>
    <a class="parastase" href="<?php echo BASE_URL . 'admin/';?>registru.php?eveniment=programari_parastas">Parastase</a>
    <a class="participare-slujbe" href="<?php echo BASE_URL . 'admin/';?>participare-slujbe.php">Participare la slujbe</a>
    <!-- <a class="rugaciuni" href="rugaciuni-in-comun.php">Rugăciuni în comun</a> -->
    <a class="info" href="<?php echo BASE_URL . 'admin/';?>info-slujbe.php">Info slujbe</a>
    <a class="pomelnic" href="<?php echo BASE_URL . 'admin/';?>pomelnice.php">Pomelnice</a>
    <a class="info" href="<?php echo BASE_URL . 'admin/';?>anunturi.php">Anunțuri</a>
    <a class="calendar" href="<?php echo BASE_URL . 'admin/';?>calendar-complet.php">Calendar complet</a>
    <a href="<?php echo BASE_URL;?>login/logout.php">Logout</a>
        
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


