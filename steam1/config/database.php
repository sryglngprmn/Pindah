<?php
$server = "localhost";
$database = "steam_motor";
$username = "root";
$password = "";

// membuat koneksi
$db = mysqli_connect($server, $username, $password, $database);

// mengecek koneksi
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}