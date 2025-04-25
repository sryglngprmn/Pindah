<?php


$title = 'Smart Gudang';
include 'layout/header.php';

?>
<!-- Ini kode untuk membuat menu utama -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content ml-3 pt-3">
        <h1 class="fw-bold text-center">Aplikasi Smart Gudang</h1>
        <p class="col-lg-6 mx-auto text-center">Ini adalah dashboard aplikasi gudang
            sederhana. Silakan gunakan menu di sebelah kiri untuk mengakses fitur-fitur yang tersedia.</p>
        <h3 class="ml-3"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></h3>
        <hr>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- stok barang -->
                    <div class="small-box bg-info">
                        <div class="card-body-icon">
                            <i class="fas fa-warehouse mr-2"></i>
                        </div>
                        <div class="inner">
                            <?php
                            // Query untuk menghitung jumlah total barang masuk
                            $query = "SELECT SUM(jml_masuk) AS jml_masuk FROM barang_masuk";
                            $result = mysqli_query($db, $query);

                            // Periksa hasil query
                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $total_masuk = $row['jml_masuk'] ?? 0; // Jika NULL, set ke 0
                                echo '<div class="display-3"><b>' . $total_masuk . '</b></div>';
                            } else {
                                echo "Error: " . mysqli_error($db);
                            }
                            ?>
                            <h4>Stok Barang</h4>
                        </div>

                        <a href="stok.php" class="small-box-footer">Lihat detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- daftar alat bahan -->
                    <div class="small-box bg-info">
                        <div class="card-body-icon">
                            <i class="fas fa-list-ul mr-2"></i>
                        </div>
                        <div class="inner">
                            <?php
                            // Query untuk menghitung jumlah baris pada tabel alatbahan
                            $query = "SELECT COUNT(*) AS jumlah_alatbahan FROM alatbahan";
                            $result = mysqli_query($db, $query);
                            // Periksa hasil query
                            if ($result) {
                                // Ambil hasil sebagai array asosiatif
                                $row = mysqli_fetch_assoc($result);
                                // Tampilkan jumlah alatbahan
                                echo '<div class="display-3"><b>' . $row['jumlah_alatbahan'] . '</b></div>';
                            } else {
                                // Tampilkan pesan kesalahan jika query gagal
                                echo "Error: " . mysqli_error($db);
                            }
                            ?>
                            <h4>Daftar Barang</h4>
                        </div>
                        <a href="barang.php" class="small-box-footer">Lihat detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- barang masuk -->
                    <div class="small-box bg-primary">
                        <div class="card-body-icon">
                            <i class="fas fa-share mr-2"></i>
                        </div>
                        <div class="inner">
                            <?php
                            // Query untuk menghitung jumlah baris pada tabel barang_masuk
                            $query = "SELECT COUNT(*) AS row_barang_masuk FROM barang_masuk";
                            $result = mysqli_query($db, $query);
                            // Periksa hasil query
                            if ($result) {
                                // Ambil hasil sebagai array asosiatif
                                $row = mysqli_fetch_assoc($result);
                                // Tampilkan jumlah barang_masuk
                                echo '<div class="display-3"><b>' . $row['row_barang_masuk'] . '</b></div>';
                            } else {
                                // Tampilkan pesan kesalahan jika query gagal
                                echo "Error: " . mysqli_error($db);
                            }
                            ?>
                            <h4>Barang Masuk</h4>
                        </div>
                        <a href="masuk.php" class="small-box-footer">Lihat detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- barang keluar -->
                    <div class="small-box bg-danger">
                        <div class="card-body-icon">
                            <i class="fas fa-reply mr-2"></i>
                        </div>
                        <div class="inner">
                            <?php
                            // Query untuk menghitung jumlah baris pada tabel barang_keluar
                            $query = "SELECT COUNT(*) AS row_barang_keluar FROM barang_keluar";
                            $result = mysqli_query($db, $query);
                            // Periksa hasil query
                            if ($result) {
                                // Ambil hasil sebagai array asosiatif
                                $row = mysqli_fetch_assoc($result);
                                // Tampilkan jumlah barang_keluar
                                echo '<div class="display-3"><b>' . $row['row_barang_keluar'] . '</b></div>';
                            } else {
                                // Tampilkan pesan kesalahan jika query gagal
                                echo "Error: " . mysqli_error($db);
                            }
                            ?>
                            <h4>Barang Keluar</h4>
                        </div>
                        <a href="keluar.php" class="small-box-footer">Lihat detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- peminjaman -->
                    <div class="small-box bg-success">
                        <div class="card-body-icon">
                            <i class="fas fa-sync-alt mr-2"></i>
                        </div>
                        <div class="inner">
                            <?php
                            // Query untuk menghitung jumlah baris pada tabel pinjam_alat
                            $query = "SELECT COUNT(*) AS jumlah_pinjam_alat FROM pinjam_alat";
                            $result = mysqli_query($db, $query);
                            // Periksa hasil query
                            if ($result) {
                                // Ambil hasil sebagai array asosiatif
                                $row = mysqli_fetch_assoc($result);
                                // Tampilkan jumlah pinjam_alat
                                echo '<div class="display-3"><b>' . $row['jumlah_pinjam_alat'] . '</b></div>';
                            } else {
                                // Tampilkan pesan kesalahan jika query gagal
                                echo "Error: " . mysqli_error($db);
                            }
                            ?>
                            <h4>Peminjaman</h4>
                        </div>
                        <a href="pinjam.php" class="small-box-footer">Lihat detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- penyedia -->
                    <div class="small-box bg-secondary">
                        <div class="card-body-icon">
                            <i class="fas fa-dolly-flatbed mr-2"></i>
                        </div>
                        <div class="inner">
                            <?php
                            // Query untuk menghitung jumlah baris pada tabel penyedia
                            $query = "SELECT COUNT(*) AS jumlah_penyedia FROM penyedia";
                            $result = mysqli_query($db, $query);
                            // Periksa hasil query
                            if ($result) {
                                // Ambil hasil sebagai array asosiatif
                                $row = mysqli_fetch_assoc($result);
                                // Tampilkan jumlah penyedia
                                echo '<div class="display-3"><b>' . $row['jumlah_penyedia'] . '</b></div>';
                            } else {
                                // Tampilkan pesan kesalahan jika query gagal
                                echo "Error: " . mysqli_error($db);
                            }
                            ?>
                            <h4>Penyedia</h4>
                        </div>
                        <a href="penyedia.php" class="small-box-footer">Lihat detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- pengguna -->
                    <div class="small-box bg-warning text-white">
                        <div class="card-body-icon">
                            <i class="fas fa-user mr-2"></i>
                        </div>
                        <div class="inner">
                            <?php
                            // Query untuk menghitung jumlah baris pada tabel user
                            $query = "SELECT COUNT(*) AS jumlah_user FROM user";
                            $result = mysqli_query($db, $query);
                            // Periksa hasil query
                            if ($result) {
                                // Ambil hasil sebagai array asosiatif
                                $row = mysqli_fetch_assoc($result);
                                // Tampilkan jumlah user
                                echo '<div class="display-3"><b>' . $row['jumlah_user'] . '</b></div>';
                            } else {
                                // Tampilkan pesan kesalahan jika query gagal
                                echo "Error: " . mysqli_error($db);
                            }
                            ?>
                            <h4>Pengguna</h4>
                        </div>
                        <a href="users.php" class="small-box-footer">Lihat detail <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>


<?php
include 'layout/footer.php';
?>