<?php
$dbserver = 'localhost';
$dbuser = 'root';
$dbname = 'damsmsdb';
$dbpass = '';

$connection = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);

if (mysqli_connect_errno($connection)) {
    die("Connection failed: " . mysqli_connect_error());
}

// Nastavení kódování na UTF-8
mysqli_set_charset($connection, "utf8");
?>