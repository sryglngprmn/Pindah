<?php
session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION['nama'])) {
  header("Location: login.php");
  exit();
}

include 'config/app.php';

// Memastikan ID yang diterima valid
$id = isset($_GET['id_penyedia']) ? (int)$_GET['id_penyedia'] : 0;

if ($id <= 0) {
    die("ID tidak valid: $id");
}

// Jalankan fungsi hapus_penyedia() sebelum mengeluarkan output HTML
$status = hapus_penyedia($id);

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hapus Barang penyedia</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      Swal.fire({
        title: "<?php echo ($status > 0) ? 'Sukses!' : 'Gagal!'; ?>",
        text: "<?php echo ($status > 0) ? 'Barang penyedia berhasil dihapus' : 'Barang penyedia gagal dihapus'; ?>",
        icon: "<?php echo ($status > 0) ? 'success' : 'error'; ?>",
        confirmButtonText: "OK",
        timer: 2000, // Alert akan otomatis tertutup dalam 2 detik
        showConfirmButton: false, // Sembunyikan tombol OK
        willClose: () => {
          // Redirect setelah SweetAlert2 tertutup, baik karena timer habis atau pengguna menutup manual
          window.location.href = 'penyedia.php';
        }
      });
    });
  </script>

</body>


</html>