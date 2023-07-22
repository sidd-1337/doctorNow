<?php
// $dbserver='localhost';
// $dbuser='root';
// $dbname='damsmsdb';
// $dbpass='';
$dbserver='sql211.infinityfree.com';
$dbuser='epiz_34276745';
$dbname='epiz_34276745_channelcare';
$dbpass='p8PtIKcmeWgE';

$connection =mysqli_connect($dbserver,$dbuser,$dbpass,$dbname);

// if(mysqli_connect_error($connection)){
//     die.mysqli_connect_errno();
// }
if(mysqli_connect_errno($connection)) {
    die("Connection failed: " . mysqli_connect_error());
}
?>