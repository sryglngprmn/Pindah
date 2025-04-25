<?php
include 'config/database.php'; // Pastikan ini menghubungkan ke database yang benar

$sql = "SELECT id_pegawai, password FROM pegawai";
$result = $db->query($sql);

while ($row = $result->fetch_assoc()) {
    // Cek apakah password sudah di-hash
    if (password_needs_rehash($row['password'], PASSWORD_DEFAULT)) {
        $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);
        $update_sql = "UPDATE pegawai SET password = ? WHERE id_pegawai = ?";
        $stmt = $db->prepare($update_sql);
        $stmt->bind_param("si", $hashed_password, $row['id_pegawai']);
        $stmt->execute();
    }
}

echo "Semua password telah dihash!";
?>
