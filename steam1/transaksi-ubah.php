<?php
session_start();

$title = 'Transaksi';
include 'layout/header.php';

// Memuat Kode Transaksi dan Layanan
$koneksi = new mysqli("localhost", "root", "", "steam_motor");

// Ambil ID dari URL
$id = (int)$_GET['id_transaksi'];

// Ambil data transaksi berdasarkan ID
$data_transaksi = select("SELECT * FROM transaksi WHERE id_transaksi = '$id'")[0];

// Kode ubah data transaksi
if (isset($_POST['ubah'])) {
    if (ubah_transaksi($_POST) > 0) {
        echo "<script> 
            alert('Data transaksi berhasil diubah');
            document.location.href = 'transaksi.php';
          </script>";
    } else {
        echo "<script> 
            alert('Data transaksi gagal diubah');
            document.location.href = 'transaksi.php';
          </script>";
    }
}

?>


<div class="col-md-10 p-5 pt-2">
    <div class="container mt-2">
        <h2><i class="fas fa-edit mr-2"></i> Ubah Transaksi</h2>
        <hr>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_transaksi" value="<?= $data_transaksi['id_transaksi']; ?>">

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="kode_transaksi">Kode Transaksi</label>
                    <input type="text" class="form-control" name="kode_transaksi"
                        value="<?= $data_transaksi['kode_transaksi']; ?>" readonly></input>
                </div>
                <div class="mb-3 col-6">
                    <label for="id_layanan" class="form-label">Paket Layanan</label>
                    <select name="id_layanan" id="id_layanan" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Layanan --</option>
                        <?php
                        $sql = $koneksi->query("SELECT * FROM layanan ORDER BY id_layanan");
                        while ($data = $sql->fetch_assoc()) {
                            // Menambahkan satuan pada opsi select
                            echo "<option value='{$data['id_layanan']}'>
              {$data['nama_layanan']} </option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3 col-6">
                    <label for="id_kendaraan" class="form-label">Kendaraan</label>
                    <select name="id_kendaraan" id="id_kendaraan" class="form-control select2" required>
                        <option value="" disabled selected>-- Pilih Kendaraan --</option>
                        <?php
                        $sql = $koneksi->query("SELECT * FROM kendaraan ORDER BY id_kendaraan");
                        while ($data = $sql->fetch_assoc()) {
                            echo "<option value='{$data['id_kendaraan']}'>
                {$data['plat_nomor']} | {$data['pemilik']}
            </option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3 col-6">
                    <label for="total_harga" class="form-label">Total Biaya</label>
                    <input type="number" name="total_harga" id="harga" class="form-control" readonly>
                </div>

                <div class="mb-3 col-6">
                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                    <select class="form-control" name="metode_pembayaran" id="metode_pembayaran" required>
                        <option value="" disabled selected>-- Pilih Metode Bayar --</option>
                        <option value="tunai">Tunai</option>
                        <option value="transfer">Transfer</option>
                        <option value="e-wallet">e-wallet</option>
                    </select>
                </div>

                <div class="mb-3 col-12">
                    <a href="transaksi.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="ubah" class="btn btn-warning float-end"> Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('id_layanan').addEventListener('change', function() {
        let idLayanan = this.value;

        // Kirim permintaan AJAX ke get_harga.php
        fetch('get_harga.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id_layanan=' + idLayanan
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('harga').value = data.harga || 0;
            })
            .catch(error => console.error('Error:', error));
    });
</script>

<?php include 'layout/footer.php'; ?>