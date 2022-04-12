<?php 

include "header-admin.php"; 
$id = $_SESSION['id'];
?>

<title>Membri</title>
</head>

<body>

<div class="container-fluid">

    <div class="row wrapper">
        <div class="col-sm-3 sidebar-admin"><?php include "sidebar-admin.php"?></div>

        <div class="col-sm-9 p-4 zona-principala">

        <?php include "header-mic-admin.php";?>


        <div class="row mt-3 ultimele-programari">
          <div class="col-sm-12">
            <p class="fw-bold">Membrii înregistrați ai parohiei</p>

            <?php
                  if (isset($_GET['sters'])) {
                      echo '<p id="dispari">Membrul a fost șters cu succes</p>';
                  }

                  if (isset($_GET['blocat'])) {
                      echo '<p id="dispari">Membrul a fost blocat.</p>';
                  }

                  if (isset($_GET['deblocat'])) {
                      echo '<p id="dispari">Membrul a fost deblocat.</p>';
                  }
            ?>
            
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nume</th>
                  <th scope="col">Prenume</th>
                  <th scope="col">Telefon</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Verificat</th>
                  <th scope="col">Status</th>
                  <th scope="col">Acțiuni</th>
                </tr>
              </thead>
              <tbody >

            <?php 

            // paginatia 

                if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                  $page_no = $_GET['page_no'];
                  } else {$page_no = 1;}

                  $total_records_per_page = 10; // numar de randuri pe pagina
                  $offset = ($page_no-1) * $total_records_per_page;
                  $previous_page = $page_no - 1;
                  $next_page = $page_no + 1;
                  $adjacents = "2"; 

                  $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM users WHERE parohie_id = $id");
                  $total_records = mysqli_fetch_array($result_count);
                  $total_records = $total_records['total_records'];
                  $total_no_of_pages = ceil($total_records / $total_records_per_page);
                  $second_last = $total_no_of_pages - 1; // total page minus 1


            // datele

          
         
                $altele = $offset . ',' . $total_records_per_page; // Limit și Offset
                $sql="SELECT * FROM users WHERE parohie_id = ? ORDER BY id DESC Limit " . $altele;
                $stmt = $conn->prepare($sql);
                $stmt->bind_param ("i", $id);
                $result = $stmt->execute();
                $result = $stmt->get_result();

                $nr_randuri = mysqli_num_rows ($result);
                
                
                while ($row = mysqli_fetch_assoc($result)) { 
                    
                ?>

                <tr>
                  <td><?php echo $row['nume'];?></td>
                  <td><?php echo $row['prenume'];?></td>
                  <td><?php echo $row['telefon'];?></td>
                  <td><?php echo $row['username'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <td><?php if ($row['verified'] == 1){echo '<img src="../images/check.png">  ';} else {echo '<img src="../images/xbutton.png">';};?></td>
                  <td><?= ($row['blocat'] == 1) ? "<span class='red'>blocat</span>" :  "activ"; ?></td>
                  

                  <td>
                      <a href="actiuni.php?eveniment=membri&stergeid=<?php echo $row['id']; ?>" class="sterge" onclick="return confirm('Sunteți sigur că vreți să ștergeți această programare?');" >
                      <img class="m-1" src="../images/bin.png" title="Șterge"></a> 

                      <?= ($row['blocat'] == 0) ? 
                      '<a href="actiuni.php?blocheaza_id=' . $row['id'] .'"><img src="../images/lock.png" title="Blochează"></a>' : 
                      '<a href="actiuni.php?deblocheaza_id=' . $row['id'] .'"><img src="../images/unlock.png" title="Deblochează"></a>'?>
                     
                  </td>
                </tr>

            <?php } 
            
            
            
            ?>
            
              </tbody>
            </table>


            <?php $link_paginatie = '?'; include "../includes/paginatie.php";?>


            
        </div>
                </div>
                </div>
    </div>
</div>

</body>
</html>



