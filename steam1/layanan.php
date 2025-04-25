<?php
session_start();

$title = 'Data layanan';

include 'layout/header.php';

$layanan = select("SELECT * FROM layanan ORDER BY id_layanan DESC");

?>
<!-- Ini kode untuk membuat menu utama -->
<div class="col-md-10 p-5 pt-2">
    <!-- pengatur posisi halaman -->
    <div class="container mt-2">
        <h1><i class="fas fa-hands-helping mr-2"></i> layanan</h1>
        <hr>
        <a href="layanan-tambah.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah</a>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped mt-3" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($layanan as $data_layanan) : ?>
                        <tr>
                            <td width="5%"><?= $no++; ?></td>
                            <td><?= $data_layanan['nama_layanan']; ?></td>
                            <td>Rp. <?= number_format($data_layanan['harga'], 0, ',', '.'); ?></td>
                            <td width="15%" class="text-center">
                                <a href="layanan-ubah.php? id_layanan=<?= $data_layanan['id_layanan']; ?>"
                                    class="btn btn-success"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="layanan-hapus.php? id_layanan=<?= $data_layanan['id_layanan']; ?>"
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