<?php include 'header-admin.php';
$user_id = $_SESSION['id'];

if ($_GET['id']) {
    $id_slujba = $_GET['id'];

    $query="SELECT * FROM participare_slujbe WHERE id = ? AND parohie_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_slujba, $id);
    $rezultate = $stmt->execute();
    $rezultate = $stmt->get_result();
}

$i = 1;

;?>

<title></title>
  
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">

        <div class="col-sm-3 sidebar-admin noprint"><?php include "sidebar-admin.php"?></div>
        <div class="col-sm-9 p-4 zona-principala">

             <?php include "header-mic-admin.php";?>

            <div class="row zile-stabilite print">
                    <h1 class="h1 mb-2">Lista participanților pentru slujbă</h1>
                    
                    <?php

                    while ($data = mysqli_fetch_assoc($rezultate)){   
                                
                        $participanti = $data['participanti'];
                        $iduri_participanti = explode(',', $participanti);
                        $slujba = $data['slujba'];
                        $data_start = $data['data_start'];
                        $data_final = $data['data_final'];
                        $numar_persoane = $data['numar_persoane'];
                        $rezervari = $data['rezervari'];
                     
                        echo "<p class='rosu'>" . $slujba . " | " .  date("d M. Y", strtotime($data["data_start"])) . " | " .  date("H:i", strtotime($data["data_start"]));
                        
                    }
                echo '<div class="col-xl-6">';
                    echo '<table class="table">';
                    echo '
                        <thead>
                            <tr>
                                <th scope="col">Nr.</th>
                                <th scope="col">Nume</th>
                            </tr>
                        </thead> 
                    ';
                    echo '<tbody>';


                    foreach ($iduri_participanti as $id_user) {
                        
                        $query="SELECT * FROM users WHERE id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('i', $id_user);
                        $rez = $stmt->execute();
                        $rez = $stmt->get_result();
                        
                        while ($datas = mysqli_fetch_assoc($rez)){   
                      
                                echo "<tr>";
                                echo "<td>"  . $i . ".</td>";
                                echo "<td>"  . $datas['nume'] . " " . $datas['prenume'] . "</td>";
                                
                                echo '</tr>';
                        
                        } $i++;
                    }  

                    echo '</tbody>';
                    echo '</table>';
                    ?>

                    <button class="btn btn-outline-primary noprint" onclick="window.print()">Printează lista</button>
                 </div>
            </div>
        </div>

</body>
</html>