
<p class="mb-5">

<?php

for ($x = 1; $x <= 6; $x++) {

    if ($x == $numar_pas) {
        echo '<span class="btn btn-success">Pasul ' . $x . "</span>";
    } else {
        echo '<span class="btn btn-light disabled">Pasul ' . $x . "</span>";
    }
}

?>

</p>  


