<?php

if ($pentru == 'spovedanie' || $pentru == 'sfestanie') {
    $y = 4;
} else {
    $y = 6;
}

echo '<p class="mt-2 mb-2">';
for ($x = 1; $x <= $y; $x++) {

    if ($x == $numar_pas) {
        echo '<span class="btn btn-success">Pasul ' . $x . "</span>";
    } else {
        echo '<span class="btn btn-light disabled">Pasul ' . $x . "</span>";
    }
}
echo '</p>';

?>




