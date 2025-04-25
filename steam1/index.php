<?php

session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Periksa apakah sesuai role
if ($_SESSION['role'] != 'ADMIN') {
   echo "<script>
   alert('Anda tidak memiliki akses ke halaman ini!');
   document.location.href = 'kendaraan.php';
   </script>";
   exit;
}

$title = 'Data CRUD';

include 'layout/header.php';


?>
<!-- Ini kode untuk membuat menu utama -->
<div class="col-md-10 p-5 pt-2">
    <!-- pengatur posisi halaman -->
    <h1 class="display-5 fw-bold text-center">Aplikasi Cuci Steam Motor & Mobil</h1>
    <p class="col-lg-8 mx-auto text-center">Ini adalah dashboard aplikasi data UMKM Cuci Steam Motor & Mobil sederhana.
        Silakan gunakan menu di sebelah kiri untuk mengakses fitur-fitur yang tersedia.</p>
    <h3><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></h3>
    <hr>
    <!-- membuat label info -->
    <div class="row text-white">

        <!-- data kendaraan -->
        <div class="card bg-warning ml-3 pt-2 mb-3" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-motorcycle mr-2"></i>
                </div>
                <h5 class="card-title">KENDARAAN</h5>
                <?php
                // Query untuk menghitung jumlah baris pada tabel kendaraan
                $query = "SELECT COUNT(*) AS jumlah_kendaraan FROM kendaraan";
                $result = mysqli_query($db, $query);

                // Periksa hasil query
                if ($result) {
                    // Ambil hasil sebagai array asosiatif
                    $row = mysqli_fetch_assoc($result);

                    // Tampilkan jumlah kendaraan
                    echo '<div class="display-3"><b>' . $row['jumlah_kendaraan'] . '</b></div>';
                } else {
                    // Tampilkan pesan kesalahan jika query gagal
                    echo "Error: " . mysqli_error($db);
                }
                ?>
                <a href="kendaraan.php">
                    <p class="card-text text-white">Lihat Detail<i class="fas fa-angle-double-right ml-2"></i></p>
                </a>
            </div>
        </div>

        <!-- data layanan -->
        <div class="card bg-primary ml-3 pt-2 mb-3" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-hands-helping mr-2"></i>
                </div>
                <h5 class="card-title">LAYANAN</h5>
                <?php
                // Query untuk menghitung jumlah baris pada tabel layanan
                $query = "SELECT COUNT(*) AS jumlah_layanan FROM layanan";
                $result = mysqli_query($db, $query);

                // Periksa hasil query
                if ($result) {
                    // Ambil hasil sebagai array asosiatif
                    $row = mysqli_fetch_assoc($result);

                    // Tampilkan jumlah layanan
                    echo '<div class="display-3"><b>' . $row['jumlah_layanan'] . '</b></div>';
                } else {
                    // Tampilkan pesan kesalahan jika query gagal
                    echo "Error: " . mysqli_error($db);
                }
                ?>
                <a href="layanan.php">
                    <p class="card-text text-white">Lihat Detail<i class="fas fa-angle-double-right ml-2"></i></p>
                </a>
            </div>
        </div>
        <!-- Data Transaksi -->
<div class="card bg-success ml-3 pt-2 mb-3" style="width: 18rem;">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fas fa-receipt mr-2"></i>
        </div>
        <h5 class="card-title text-white">TRANSAKSI</h5>
        <?php
        $query = "SELECT COUNT(*) AS jumlah_transaksi FROM transaksi";
        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo '<div class="display-3 text-white"><b>' . $row['jumlah_transaksi'] . '</b></div>';
        } else {
            echo "Error: " . mysqli_error($db);
        }
        ?>
        <a href="transaksi.php">
            <p class="card-text text-white">Lihat Detail<i class="fas fa-angle-double-right ml-2"></i></p>
        </a>
    </div>
</div>

<!-- Data Pegawai -->
<div class="card bg-danger ml-3 pt-2 mb-3" style="width: 18rem;">
    <div class="card-body">
        <div class="card-body-icon">
            <i class="fas fa-user-tie mr-2"></i>
        </div>
        <h5 class="card-title text-white">PEGAWAI</h5>
        <?php
        $query = "SELECT COUNT(*) AS jumlah_pegawai FROM pegawai";
        $result = mysqli_query($db, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo '<div class="display-3 text-white"><b>' . $row['jumlah_pegawai'] . '</b></div>';
        } else {
            echo "Error: " . mysqli_error($db);
        }
        ?>
        <a href="pegawai.php">
            <p class="card-text text-white">Lihat Detail<i class="fas fa-angle-double-right ml-2"></i></p>
        </a>
    </div>
</div>
  <!-- data penghasilan -->
  <div class="card bg-info ml-3 pt-2 mb-3" style="width: 18rem;">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-money-bill-wave mr-2"></i>
                </div>
                <h5 class="card-title">PENGHASILAN</h5>
                <?php
                // Query untuk menghitung total penghasilan dari tabel transaksi
                $query = "SELECT SUM(total_harga) AS total_penghasilan FROM transaksi";
                $result = mysqli_query($db, $query);
                $data = mysqli_fetch_assoc($result);
                $total_harga = $data['total_penghasilan'];
                ?>
                <p class="display-4 card-text">Rp <?= number_format($total_harga, 0, ',', '.'); ?></p>
            </div>
        </div>
        <!-- Statistik Section -->
        <div class="mt-5">
                <h4>Statistik Transaksi</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Rekap Transaksi</div>
                            <div class="card-body">
                                <p>Jumlah transaksi per hari.</p>
                                <canvas id="transaksiChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <   <!-- Chart Section -->
    <div class="mt-5">
        <h4>Statistik Transaksi</h4>
        <canvas id="transaksiChart"></canvas>
    </div>
</div>
                </div>
            </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    var transaksiData = <?= json_encode($transaksi_harian); ?>;
    </script>
<?php include 'layout/footer.php';?>