<?php
session_start();
$title = 'Data pegawai';

include 'layout/header.php';

$pegawai = select("SELECT * FROM pegawai ORDER BY id_pegawai DESC");

// Periksa apakah sesuai role
if ($_SESSION['role'] != 'ADMIN') {
    if ($_SESSION['role'] == 'TEKNISI') {
        echo "<script>
        alert('Anda tidak memiliki akses ke halaman ini!');
        document.location.href = 'kendaraan.php';
        </script>";
    } elseif ($_SESSION['role'] == 'KASIR') {
        echo "<script>
        alert('Anda tidak memiliki akses ke halaman ini!');
        document.location.href = 'transaksi.php';
        </script>";
    } else {
        echo "<script>
        alert('Anda tidak memiliki akses ke halaman ini!');
        document.location.href = 'index.php';
        </script>";
    }
    exit;
}


?>
<!-- Ini kode untuk membuat menu utama -->
<div class="col-md-10 p-5 pt-2">
    <!-- pengatur posisi halaman -->
    <div class="container mt-2">
        <h1><i class="fas fa-users mr-2"></i> pegawai</h1>
        <hr>
        <a href="pegawai-tambah.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah</a>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped mt-3" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama pegawai</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pegawai as $data_pegawai) : ?>
                        <tr>
                            <td width="5%"><?= $no++; ?></td>
                            <td><?= $data_pegawai['nama']; ?></td>
                            <td><?= $data_pegawai['email']; ?></td>
                            <td><?= '🔒 Password Terkunci'; ?></td>
                            <td><?= $data_pegawai['role'];?></td>
                            <td width="15%" class="text-center">
                                <a href="pegawai-ubah.php? id_pegawai=<?= $data_pegawai['id_pegawai']; ?>"
                                    class="btn btn-success"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="pegawai-hapus.php? id_pegawai=<?= $data_pegawai['id_pegawai']; ?>"
                                    class="btn btn-danger" onclick="return confirm('Yakin data dihapus ?');"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
include 'layout/footer.php';
?>