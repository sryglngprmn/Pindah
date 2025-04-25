<?php
session_start();
$title = 'layanan';
include 'layout/header.php';

// Ambil ID dari URL
$id = (int)$_GET['id_layanan'];

// Ambil data layanan berdasarkan ID
$data_layanan = select("SELECT * FROM layanan WHERE id_layanan = '$id'")[0];

// Kode ubah data layanan
if (isset($_POST['ubah'])) {
    if (ubah_layanan($_POST) > 0) {
        echo "<script> 
            alert('Data layanan berhasil diubah');
            document.location.href = 'layanan.php';
          </script>";
    } else {
        echo "<script> 
            alert('Data layanan gagal diubah');
            document.location.href = 'layanan.php';
          </script>";
    }
}

?>


<div class="col-md-10 p-5 pt-2">
    <div class="container mt-2">
        <h2><i class="fas fa-edit mr-2"></i> Ubah layanan</h2>
        <hr>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_layanan" value="<?= $data_layanan['id_layanan']; ?>">

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="nama_layanan">Nama Layanan</label>
                    <input type="text" class="form-control" name="nama_layanan"
                        value="<?= $data_layanan['nama_layanan']; ?>">
                </div>

                <div class="mb-3 col-6">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" name="harga" value="<?= $data_layanan['harga']; ?>">
                </div>

               
                <div class="mb-3 col-12">
                    <a href="layanan.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="ubah" class="btn btn-warning float-end"> Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>