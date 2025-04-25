<?php

session_start();

$title = 'Data Transaksi';

include 'layout/header.php';

$transaksi = select("
    SELECT transaksi.*, kendaraan.plat_nomor, layanan.nama_layanan 
    FROM transaksi 
    JOIN kendaraan ON transaksi.id_kendaraan = kendaraan.id_kendaraan 
    JOIN layanan ON transaksi.id_layanan = layanan.id_layanan
    ORDER BY transaksi.id_transaksi DESC
");

// Periksa apakah sesuai role
if ($_SESSION['role'] == 'TEKNISI') {
    echo "<script>
    alert('Anda tidak memiliki akses ke halaman ini!');
    document.location.href = 'kendaraan.php';
    </script>";
    exit;
}

?>
<!-- Ini kode untuk membuat menu utama -->
<div class="col-md-10 p-5 pt-2">
    <!-- pengatur posisi halaman -->
    <div class="container mt-2">
        <h1><i class="fas fa-file-invoice-dollar"></i> Transaksi</h1>
        <hr>
        <a href="transaksi-tambah.php" class="btn btn-primary mb-1"><i class="fas fa-plus-circle"></i> Tambah</a>
        <a href="cetak-transaksi.php" class="btn btn-warning mb-1 ml-1"><i class="fas fa-print"></i> Cetak</a>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped mt-3" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Kendaraan</th>
                        <th>Layanan</th>
                        <th>Total Harga</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($transaksi as $data_transaksi) : ?>
                        <tr>
                            <td width="5%"><?= $no++; ?></td>
                            <td><?= $data_transaksi['kode_transaksi']; ?></td>
                            <td><?= $data_transaksi['plat_nomor']; ?></td>
                            <td><?= $data_transaksi['nama_layanan']; ?></td>
                            <td>Rp. <?= number_format($data_transaksi['total_harga'], 0, ',', '.'); ?></td>
                            <td><?= $data_transaksi['metode_pembayaran']; ?></td>
                            <td width="15%" class="text-center">
                                <a href="transaksi-ubah.php? id_transaksi=<?= $data_transaksi['id_transaksi']; ?>"
                                    class="btn btn-success"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="transaksi-hapus.php? id_transaksi=<?= $data_transaksi['id_transaksi']; ?>"
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