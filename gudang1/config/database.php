<?php
$server = "localhost";
$database = "gudang";
$username = "root";
$password = "";

// membuat koneksi
$db = mysqli_connect($server, $username, $password, $database);

// mengecek koneksi
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
