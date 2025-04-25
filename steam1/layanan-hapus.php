<?php
session_start();

include 'config/app.php';

// Periksa apakah parameter id ada dan valid
if (!isset($_GET['id_layanan']) || !is_numeric($_GET['id_layanan'])) {
  header("Location: layanan.php");
  exit;
}

$id_layanan = (int) $_GET['id_layanan']; // Pastikan id adalah angka

// Proses hapus data
if (hapus_layanan($id_layanan) > 0) {
  echo "<script>
        alert('Data berhasil dihapus!');
        window.location.href = 'layanan.php';
    </script>";
} else {
  echo "<script>
        alert('Data gagal dihapus! Silakan coba lagi.');
        window.location.href = 'layanan.php';
    </script>";
}

exit;
