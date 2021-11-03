<?php include "header-frontend.php"; 
      include "sidebar-frontend.php";
      include "functions.php";


$user_id = $_SESSION['id'];
  
?>

<title>Ultimele programări</title>
</head>

<body>



<div class="mare">
  <div class="container-fluid">

     <h1 class="h1">Rezervări </h1>
     
     <?php

        $query = 'SELECT * FROM programari_botez WHERE user_id = ? ORDER BY data_si_ora ASC';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) !== 0 ) {
          echo '<h2 class="titlu">Taina Botezului</h2>';
       }

        while($data = $result->fetch_assoc()) {

          include "extras-programare.php";
          echo "<p>Status: " . $status . "<br>";
          echo '<a href="home-unic.php?id=' . $id .  '">' . ' ' . date("d.m.Y", strtotime($data_si_ora)) . ' - <span class="red">' . $eveniment . '</span> - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mama . ' ' . $prenume_mama .  '</a></p />';
        
        }

        /* afiseaza programari cununie */
    
        $query = 'SELECT * FROM programari_cununie WHERE user_id = ? ORDER BY data_si_ora ASC';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $result = $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) !== 0 ) {
           echo '<h2 class="titlu">Taina Cununiei</h2>';
        }

        while($data = $result->fetch_assoc()) {

          include "extras-programare-cununie.php";
          echo "<p>Status: " . $status . "<br>";
          echo '<a href="home-unic-cununie.php?id=' . $id_programare .  '">' . ' ' . date("d.m.Y", strtotime($data_si_ora)) . ' - <span class="red">' . $eveniment . '</span> - ora: ' . date("H:i", strtotime($data_si_ora)) . ' - '  . $nume_mire . ' ' . $prenume_mire .  '</a></p>';
        
        }


    ?>

 
  </div>
</div>


</body>
</html>