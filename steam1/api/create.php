<?php

//render halaman jadi json
header('Content-Type: application/json');

require '../config/app.php';

// menerima input
$plat_nomor = $_POST['plat_nomor'];
$jenis = $_POST['jenis'];
$merk = $_POST['merk'];
$model = $_POST['model'];
$pemilik = $_POST['pemilik'];
$telepon = $_POST['telepon'];

//validasi
if($plat_nomor == null){
    echo json_encode(['pesan' => 'Plat nomor tidak boleh kosong!']);
    exit;
}

// query
$query = "INSERT INTO kendaraan (plat_nomor, jenis, merk, model, pemilik, telepon) 
          VALUES ('$plat_nomor', '$jenis', '$merk', '$model', '$pemilik', '$telepon')";
  mysqli_query($db, $query);

// eksekusi query
if ($query) {
    echo json_encode(['pesan' => 'Data berhasil ditambahkan!']);
} else {
    echo json_encode(['pesan' => 'Data gagal ditambahkan!']);
}


