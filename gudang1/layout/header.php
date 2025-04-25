<?php
session_start();
include 'config/app.php';

$current_page = basename($_SERVER['PHP_SELF']);
 // Mendapatkan nama file saat ini


if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            title: '{$alert['title']}',
            text: '{$alert['text']}',
            icon: '{$alert['icon']}',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '{$alert['redirect']}';
        });
    </script>";
    unset($_SESSION['alert']); // Hapus pesan setelah ditampilkan
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['nama'])) {
    echo "<script>
        Swal.fire({
            title: 'Akses Ditolak!',
            text: 'Anda harus login terlebih dahulu.',
            icon: 'warning',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'login.php';
        });
    </script>";
    exit();
}

// Tentukan hak akses berdasarkan halaman
$allowedRoles = [
    'index.php' => ['superadmin', 'admin', 'user'],
    'stok.php' => ['superadmin', 'admin','user'],
    'barang.php' => ['superadmin', 'admin','user'],
    'masuk.php' => ['superadmin', 'admin'],
    'keluar.php' => ['superadmin', 'admin'],
    'pinjam.php' => ['superadmin', 'user'],
    'penyedia.php' => ['superadmin', 'admin'],
    'user.php' => ['superadmin'],
    'cetak.php' => [ 'admin'],
    'info.php' => ['superadmin', 'admin', 'user']
];

// Periksa apakah halaman saat ini memiliki hak akses
$current_page = basename($_SERVER['PHP_SELF']);
if (isset($allowedRoles[$current_page]) && !in_array($_SESSION['level'], $allowedRoles[$current_page])) {
    $_SESSION['access_denied'] = true; // Tandai akses ditolak
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- SweetAlert -->
    <script src="css/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title><?= $title; ?></title>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div id="loading-screen" style="display: none;">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>

<style>
    #loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        position: relative;
    }

    .double-bounce1, .double-bounce2 {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #007bff;
        opacity: 0.6;
        position: absolute;
        top: 0;
        left: 0;
        animation: bounce 2s infinite ease-in-out;
    }

    .double-bounce2 {
        animation-delay: -1s;
    }

    @keyframes bounce {
        0%, 100% {
            transform: scale(0);
        }
        50% {
            transform: scale(1);
        }
    }
</style>
    <div class="container-fluid">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
           
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link active">Aplikasi Gudang | <b>SMK Industri Kreatif</b></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
    <button class="btn btn-danger my-1 my-sm-0 btn-logout" type="button">
        <i class="fas fa-sign-out-alt"></i> Keluar
    </button>
</li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="info.php" class="brand-link">
                <img src="image/gudang1.png" alt="Logo" width="auto" height="40">
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="image/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $_SESSION['nama']; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link <?= $current_page == 'index.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="stok.php" class="nav-link <?= $current_page == 'stok.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>Stok Barang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="barang.php" class="nav-link <?= $current_page == 'barang.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-list-ul"></i>
                                <p>Daftar Barang</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="masuk.php" class="nav-link <?= $current_page == 'masuk.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-share"></i>
                                <p>Barang Masuk</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="keluar.php" class="nav-link <?= $current_page == 'keluar.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-reply"></i>
                                <p>Barang Keluar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="pinjam.php" class="nav-link <?= $current_page == 'pinjam.php' ? 'active' : ''; ?>">
                                <i class="fas fa-sync-alt ml-1 mr-2"></i>
                                <p>Peminjaman</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="penyedia.php" class="nav-link <?= $current_page == 'penyedia.php' ? 'active' : ''; ?>">
                                <i class="fas fa-dolly-flatbed ml-1 mr-2"></i>
                                <p>Penyedia</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="user.php" class="nav-link <?= $current_page == 'user.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Pengguna</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="cetak.php" class="nav-link <?= $current_page == 'cetak.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Cetak Laporan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="info.php" class="nav-link <?= $current_page == 'info.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-info"></i>
                                <p>Informasi</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div><!-- /.sidebar-menu -->
            </div><!-- /.sidebar -->
        </aside><!-- /.sidebar -->
        <!-- Footer -->