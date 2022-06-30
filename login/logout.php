<?php

// session_start();

unset($_SESSION['user_id']);
unset($_SESSION['parohie_id']);
unset($_SESSION['parohie_user_id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['verify']);
session_destroy();

header("location: ../index.php");




