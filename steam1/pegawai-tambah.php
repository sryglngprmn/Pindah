<?php
session_start();
$title = 'Data pegawai';
include 'layout/header.php';

// Kode tambah pegawai
if (isset($_POST['tambah'])) {
    if (tambah_pegawai($_POST) > 0) {
        echo "<script> alert('Data berhasil ditambahkan');
      document.location.href = 'pegawai.php';
      </script>";
    } else {
        echo "<script> alert('Data gagal ditambahkan');
      document.location.href = 'pegawai.php';
      </script>";
    }
}



?>

<div class="col-md-10 p-5 pt-2">
    <div class="container mt-2">
        <h2><i class="fas fa-plus-circle mr-2"></i> Tambah Data pegawai</h2>
        <hr>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="nama" class="form-label">Nama pegawai</label>
                    <input type="text" class="form-control" name="nama" id="nama"
                        placeholder="Masukkan pegawai" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                        placeholder="Masukkan email" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Masukkan password" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="role" class="form-label">Role </label>
                    <select class="form-control" name="role" id="role" required>
                        <option value="" disabled selected>Pilih role </option>
                        <option value="ADMIN">ADMIN</option>
                        <option value="KASIR">KASIR</option>
                        <option value="TEKNISI">TEKNISI</option>
                    </select>
                </div>
                    
                </div>

                <div class="mb-3 col-12">
                    <a href="pegawai.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="tambah" class="btn btn-primary float-end">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>