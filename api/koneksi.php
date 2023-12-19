<?php

// $hostname = "nhcare.tifc.myhost.id";
// $username = "tifcmyho_nhcare";
// $password = "@JTIpolije2023";
// $dbname = "tifcmyho_nhcare";

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "db_nhcare";

$koneksi = mysqli_connect($hostname, $username, $password, $dbname);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} 
?>