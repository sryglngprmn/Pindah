<?php
session_start();
$title = 'Data layanan';
include 'layout/header.php';

// Kode tambah layanan
if (isset($_POST['tambah'])) {
    if (tambah_layanan($_POST) > 0) {
        echo "<script> alert('Data berhasil ditambahkan');
      document.location.href = 'layanan.php';
      </script>";
    } else {
        echo "<script> alert('Data gagal ditambahkan');
      document.location.href = 'layanan.php';
      </script>";
    }
}


?>

<div class="col-md-10 p-5 pt-2">
    <div class="container mt-2">
        <h2><i class="fas fa-plus-circle mr-2"></i> Tambah Data layanan</h2>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="nama_layanan" class="form-label">Nama layanan</label>
                    <input type="text" class="form-control" name="nama_layanan" id="nama_layanan"
                        placeholder="Masukkan layanan" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" name="harga" id="harga"
                        placeholder="Masukan Harga layanan" required>
                </div>

                <div class="mb-3 col-12">
                    <a href="layanan.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="tambah" class="btn btn-primary float-end">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>