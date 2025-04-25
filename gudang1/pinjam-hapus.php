<?php
session_start();
include 'config/app.php';

if (isset($_GET['id_pinjam'])) {
    $id_pinjam = $_GET['id_pinjam'];

    // Query untuk menghapus data peminjaman
    $query = "DELETE FROM pinjam_alat WHERE id_pinjam = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $id_pinjam);

    if ($stmt->execute()) {
        $_SESSION['alert'] = [
            'title' => 'Berhasil!',
            'text' => 'Data peminjaman berhasil dihapus.',
            'icon' => 'success',
            'redirect' => 'pinjam.php'
        ];
    } else {
        $_SESSION['alert'] = [
            'title' => 'Gagal!',
            'text' => 'Data peminjaman gagal dihapus.',
            'icon' => 'error',
            'redirect' => 'pinjam.php'
        ];
    }

    header("Location: pinjam.php");
    exit();
} else {
    header("Location: pinjam.php");
    exit();
}
?>