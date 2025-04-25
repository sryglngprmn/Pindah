
<?php

// Render halaman jadi JSON
header('Content-Type: application/json');

require '../config/app.php';
//menerima request put/delete
parse_str(file_get_contents('php://input'), $delete);

//menrima id yang akan dihapus
$id_kendaraan = $delete['id_kendaraan'];

// Query
$query  = "DELETE FROM kendaraan WHERE id_kendaraan = $id_kendaraan";
$result = mysqli_query($db, $query);

// Eksekusi query
if ($result) {
    echo json_encode(['pesan' => 'Data berhasil dihapus!']);
} else {
    echo json_encode(['pesan' => 'Data gagal dihapus!']);
}
?>