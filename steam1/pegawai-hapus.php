<?php
session_start();
include 'config/app.php';

// Periksa apakah parameter id ada dan valid
if (!isset($_GET['id_pegawai']) || !is_numeric($_GET['id_pegawai'])) {
  header("Location: pegawai.php");
  exit;
}

$id_pegawai = (int) $_GET['id_pegawai']; // Pastikan id adalah angka

// Proses hapus data
if (hapus_pegawai($id_pegawai) > 0) {
  echo "<script>
        alert('Data berhasil dihapus!');
        window.location.href = 'pegawai.php';
    </script>";
} else {
  echo "<script>
        alert('Data gagal dihapus! Silakan coba lagi.');
        window.location.href = 'pegawai.php';
    </script>";
}

exit;
