<?php
session_start();
$title = 'pegawai';
include 'layout/header.php';

// Ambil ID dari URL
$id = (int)$_GET['id_pegawai'];

// Ambil data pegawai berdasarkan ID
$data_pegawai = select("SELECT * FROM pegawai WHERE id_pegawai = '$id'")[0];

// Kode ubah data pegawai
if (isset($_POST['ubah'])) {
    if (ubah_pegawai($_POST) > 0) {
        echo "<script> 
            alert('Data pegawai berhasil diubah');
            document.location.href = 'pegawai.php';
          </script>";
    } else {
        echo "<script> 
            alert('Data pegawai gagal diubah');
            document.location.href = 'pegawai.php';
          </script>";
    }
}

?>


<div class="col-md-10 p-5 pt-2">
    <div class="container mt-2">
        <h2><i class="fas fa-edit mr-2"></i> Ubah pegawai</h2>
        <hr>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pegawai" value="<?= $data_pegawai['id_pegawai']; ?>">

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="nama">Nama pegawai</label>
                    <input type="text" class="form-control" name="nama"
                        value="<?= $data_pegawai['nama']; ?>">
                </div>

                <div class="mb-3 col-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email"
                        value="<?= $data_pegawai['email']; ?>">
                </div>

                <div class="mb-3 col-6">
                    <label for="password" class="form-label">Password <small>(masukan password baru)</small></label>
                    <input type="text" class="form-control" name="password">
                </div>

                <div class="mb-3 col-6">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" name="role" value="<?= $data_pegawai['role']; ?>">
                </div>

                <div class="mb-3 col-12">
                    <a href="pegawai.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="ubah" class="btn btn-warning float-end"> Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>