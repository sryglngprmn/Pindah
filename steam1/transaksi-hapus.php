<?php
session_start();

include 'config/app.php';

// Periksa apakah parameter id ada dan valid
if (!isset($_GET['id_transaksi']) || !is_numeric($_GET['id_transaksi'])) {
  header("Location: transaksi.php");
  exit;
}

$id_transaksi = (int) $_GET['id_transaksi']; // Pastikan id adalah angka

// Proses hapus data
if (hapus_transaksi($id_transaksi) > 0) {
  echo "<script>
        alert('Data berhasil dihapus!');
        window.location.href = 'transaksi.php';
    </script>";
} else {
  echo "<script>
        alert('Data gagal dihapus! Silakan coba lagi.');
        window.location.href = 'transaksi.php';
    </script>";
}

exit;
