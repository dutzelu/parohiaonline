<?php afla_parohia(); ?>


<div class="row header mb-2">

        
            <div class="row align-items-center mb-2 ">
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 d-none d-sm-block icon-biserica "><img src="../images/parohie.png" ></div>
                <div class="col-xl-10 col-lg-9 col-md-9 col-sm-8 col-12 titlu">

                    <p class="preot"><?php echo "Preot: " . $numele_preotului; ?></p>
                    <p class="parohie"><?php echo $parohia; ?></p>
                    <div class="setari">
                        <a href="setari.php" ><i class="fas fa-cog"></i> Setări</a> 
                        <a href="../login/logout.php" ><i class="fas fa-user"></i> Logout</a>  
                    </div>
                </div>
            </div>

</div>