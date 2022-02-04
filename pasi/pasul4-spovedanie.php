<?php 
include "../header-frontend.php"; 

 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$ora = '';

    if (!empty($_GET)) {
        $zi = $_GET['zi'];
        $month = $_GET['month'];
        $year = $_GET['year'];
        $pentru = $_GET['pentru'];
        $ora = $_GET['ora'];
    }

 $user_id = $_SESSION['id'];
 $data_si_ora = $year . "-" . $month . '-' . $zi . " " . $ora . ":00";
 $data_simpla = $year . "-" . $month . '-' . $zi;



 if (isset($_POST['date_personale'])) {

    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];

    $telefon = $_POST['telefon'];
    $email_crestin = $_POST['email'];

    $status = "în așteptare";
  
    $query = 'INSERT INTO programari_spovedanie SET 
    user_id=?, 
    eveniment=?,
    nume=?,
    prenume=?,
    telefon=?,
    email=?,
    data_si_ora=?,
    status=?
    ';

    $stmt = $conn->prepare($query);

    $stmt->bind_param('isssssss', $user_id, $eveniment, $nume, $prenume, $telefon, $email, $data_si_ora, $status);
    $result = $stmt->execute();

    $last_id = mysqli_insert_id($conn);


    $sql="UPDATE zile_stabilite
    SET rezervari = rezervari - 1
    WHERE tip_programare = 'spovedanie' AND data_start LIKE '%$data_simpla%' ";

    $rezultate = mysqli_query ($conn, $sql);

}

?>
</head>

<body>
    
    
    <div class="container-fluid">
        
        <div class="row wrapper">
            <div class="col-sm-3 sidebar-admin"><?php include "../sidebar-frontend.php"?></div>
            
            <div class="col-sm-9 p-4 zona-principala">
                
                <?php include "../header-mic-frontend.php";?>
                
                <div class="ultimele-programari">
                    
                    
                    <?php include "pasi.php";?>
                    
                    <h1 class="h1 mb-5">Cererea de programare pentru <span class="rosu"><?php echo $eveniment; ?></span> în data de <span class="rosu"><?php echo ' ' . $zi . '-' . $month . '-' . $year . ' ora: ' . $ora; ?></span> a fost înregistrată.</h1>
                    
                    
                </div>
                
            </div>
            
        </div>
    </div>
    
</body>
</html>

<?php
// detalii mail


$from = "contact@parohiaonline.ro";
$name = "Parohia Online";
 
 $subiect = "Programare: " . $eveniment . '  ' . date("d.m.Y", strtotime($data_si_ora)) . ' ora: ' . date("H:i", strtotime($data_si_ora));
 
 $mesaj_email = '
 <p>Doamne ajută!</p>
 <p>Cererea pentru programarea dvs. online de pe site-ul Parohiei X a fost acceptată.</p>
 <p>Pentru a anula această programare intrați în aplicația Parohia Online la "Programările mele", selectați programarea și apăsați "Anulează spovedania".
 </p>';
 
 phpmailer ($email_crestin, $from, $name, $subiect, $mesaj_email, "");
 
 ?>