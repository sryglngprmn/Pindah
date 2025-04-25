
<?php

// Render halaman jadi JSON
header('Content-Type: application/json');

require '../config/app.php';

parse_str(file_get_contents('php://input'), $put);

// Menerima input
$id_kendaraan = isset($put['id_kendaraan']) ? $put['id_kendaraan'] : null;
$plat_nomor = isset($put['plat_nomor']) ? $put['plat_nomor'] : null;
$jenis = isset($put['jenis']) ? $put['jenis'] : null;
$merk = isset($put['merk']) ? $put['merk'] : null;
$model = isset($put['model']) ? $put['model'] : null;
$pemilik = isset($put['pemilik']) ? $put['pemilik'] : null;
$telepon = isset($put['telepon']) ? $put['telepon'] : null;

// Validasi
if ($plat_nomor == null) {
    echo json_encode(['pesan' => 'Plat nomor tidak boleh kosong!']);
    exit;
}

// Query
$query  = "UPDATE kendaraan SET
plat_nomor = '$plat_nomor', 
jenis = '$jenis',
merk = '$merk',
model = '$model',
pemilik = '$pemilik',
telepon = '$telepon'
WHERE id_kendaraan = '$id_kendaraan'";
$result = mysqli_query($db, $query);

// Eksekusi query
if ($result) {
    echo json_encode(['pesan' => 'Data berhasil diubah!']);
} else {
    echo json_encode(['pesan' => 'Data gagal diubah!']);
}
?>