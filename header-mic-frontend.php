<?php 
 
$query_parohie = "Select * from users Where id = ?";
$stmt = $conn->prepare($query_parohie);
$stmt->bind_param('i', $_SESSION['user_id']);
$rez = $stmt->execute();
$rez = $stmt->get_result();

while ($row = mysqli_fetch_assoc($rez)) {
    $nume = $row['nume'];
    $prenume = $row['prenume'];
}
 
$query_parohie = "SELECT * FROM parohii WHERE id = (Select parohie_id from users Where id = ?);";
$stmt = $conn->prepare($query_parohie);
$stmt->bind_param('i', $_SESSION['user_id']);
$rez = $stmt->execute();
$rez = $stmt->get_result();

while ($data = mysqli_fetch_assoc($rez)) {

    $parohia = $data['nume_parohie'];
    $mitropolia = $data['mitropolia'];
    $episcopia = $data['episcopia'];
    $numele_preotului = $data['numele_preotului'];
}

?>

 

<div class="row header">
        
            <div class="row align-items-center gx-4 mb-5">
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 d-none d-sm-block icon-biserica "><img src="<?php echo BASE_URL . 'images/credinciosi.png'?>"></div>
                <div class="col-xl-10 col-lg-9 col-md-9 col-sm-8 col-12 titlu">

                <p class="preot"><?php echo $nume . " " . $prenume; ?></p>
                    <p class="parohie"><?php echo $parohia; ?></p>
                    <div class="setari">
                        <a href="#" ><i class="fas fa-cog"></i> Setări</a> 
                        <a href="../login/logout.php" ><i class="fas fa-user"></i> Logout</a>  
                    </div>
                </div>
            </div>

</div>