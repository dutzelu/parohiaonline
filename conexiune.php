<?php


$dbServerName = 'localhost';
$dbUser = 'ambrozie_dutzelu';
$dbPassword = 'parola92';
$dbName = 'ambrozie_parohiaonline';

$conn = mysqli_connect ($dbServerName, $dbUser, $dbPassword, $dbName);
mysqli_set_charset($conn, "utf8");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


?>