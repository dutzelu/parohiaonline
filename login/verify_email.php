<?php

include "conexiune.php";
session_start();

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET verified=1 WHERE token='$token'";

        if (mysqli_query($conn, $query)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['nume'] = $user['nume'];
            $_SESSION['prenume'] = $user['prenume'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;
            $_SESSION['message'] = 'Adresa dvs. de e-mail a fost verificată cu succes.';
            $_SESSION['type'] = 'alert-success';
            header('location: index.php');
            exit(0);
        }
    } else {
        echo "Utilizator negăsit!";
    }
} else {
    echo "Lipsește cheia token!";
}
