<?php
session_start();

$title = 'Transaksi';
include 'layout/header.php';

// Memuat Kode Transaksi dan Layanan
$koneksi = new mysqli("localhost", "root", "", "steam_motor");

// Query untuk mendapatkan kode terakhir
$query = "SELECT kode_transaksi FROM transaksi ORDER BY CAST(SUBSTRING(kode_transaksi, 5) AS UNSIGNED) DESC LIMIT 1";
$result = $koneksi->query($query);

// Cek jika ada kode sebelumnya
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $lastCode = $data['kode_transaksi'];
    $urut = (int) substr($lastCode, 4); // Ambil angka terakhir
    $urut++; // Tambah 1
} else {
    $urut = 1; // Jika tidak ada data, mulai dari 1
}

// Format kode supplier baru
$kode_transaksi = "TRX-" . str_pad($urut, 2, "0", STR_PAD_LEFT);

// Kode tambah transaksi
if (isset($_POST['tambah'])) {
    if (tambah_transaksi($_POST) > 0) {
        echo "<script> alert('Data berhasil ditambahkan');
      document.location.href = 'transaksi.php';
      </script>";
    } else {
        echo "<script> alert('Data gagal ditambahkan');
      document.location.href = 'transaksi.php';
      </script>";
    }
}

?>

<div class="col-md-10 p-5 pt-2">
    <div class="container mt-2">
        <h2><i class="fas fa-plus-circle mr-2"></i> Tambah Transaksi</h2>
        <hr>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="kode_transaksi" class="form-label">Kode Transaksi</label>
                    <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi"
                        value="<?php echo $kode_transaksi; ?>" readonly></input>
                </div>
                <div class="mb-3 col-6">
                    <label for="id_layanan" class="form-label">Paket Layanan</label>
                    <select name="id_layanan" id="id_layanan" class="form-control select2" required>
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
                    <button type="submit" name="tambah" class="btn btn-primary float-end">Tambah</button>
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