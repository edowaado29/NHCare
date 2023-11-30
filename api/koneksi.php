<?php

$hostname = "localhost";
$username = "tifcmyho_nhcare";
$password = "@JTIpolije2023";
$dbname = "tifcmyho_nhcare";

$koneksi = mysqli_connect($hostname, $username, $password, $dbname);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
} 
?>
