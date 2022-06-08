<?php 

$query_parohie = "Select * from parohii Where id = ?";

$stmt = $conn->prepare($query_parohie);
$stmt->bind_param('i', $_SESSION['parohie_id']);
$rez = $stmt->execute();
$rez = $stmt->get_result();

while ($data = mysqli_fetch_assoc($rez)) {

    $parohia = $data['nume_parohie'];
    $mitropolia = $data['mitropolia'];
    $episcopia = $data['episcopia'];
    $numele_preotului = $data['numele_preotului'];
}

?>


<div class="row p-3 justify-content-between align-items-center header noprint">
        <div class="col-sm-8 col-lg-9">
            <div class="row align-items-center">
                <div class="col-sm-5 icon-biserica col-xl-2"><img src="../images/parohie.png" width="130px"></div>
                <div class="col-sm-9 titlu">
                    <p class="mitropolia"><?php echo $mitropolia . ' » ' . $episcopia; ?></p>
                    <p class="parohie"><?php echo $parohia; ?></p>
                    <p class="preot"><?php echo "Preot: " . $numele_preotului; ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-lg-3 setari">
            <a href="#" ><i class="fas fa-cog" style="font-size:12px"></i> Setări</a> | <a href="#" ><i class="fas fa-user" style="font-size:12px"></i> Contul meu</a> | <a href="../login/logout.php" >Logout</a>
        </div>
</div>