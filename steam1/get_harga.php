<?php
$koneksi = new mysqli("localhost", "root", "", "steam_motor");

if (isset($_POST['id_layanan'])) {
    $id_layanan = $_POST['id_layanan'];

    $query = $koneksi->query("SELECT harga FROM layanan WHERE id_layanan = '$id_layanan'");
    $data = $query->fetch_assoc();

    echo json_encode($data); // Mengembalikan data dalam format JSON
}
