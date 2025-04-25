
<?php
include 'config/app.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">

    <title><?= $title; ?></title>

</head>

<body>

    <!-- membuat navbar atas -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">
            <img src="image/SteamTrack.png" alt="Logo" width="200" height="40" class="d-inline-block align-top">
        </a>
        <form class="form-inline my-1 ml-auto" action="login.php" method="GET">
            <button class="btn btn-light my-1 my-sm-0"><i class="fas fa-user-circle mr-2"></i><?= $_SESSION['user']; ?></button>
        </form>

        <div class="icon ml-2">
            <form action="logout.php" method="POST" onclick="return confirm('Yakin ingin keluar ?')">
                <button class="btn btn-danger my-1 my-sm-0" type="submit">Keluar</button>
            </form>
        </div>
    </nav>

    <!-- Ini kode untuk membuat sidebar -->
    <div class="row no gutters mt-5">
        <div class="col-md-2 bg-dark mt-2 pr-2 pt-4 sidebar">
            <ul class="nav flex-column ml-3 mb-3">
                <li class="nav-item">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "ADMIN" ): ?>
                    <h5><a class="nav-link active text-white" href="index.php">
                            <i class="fas fa-chart-bar mr-2"></i>Dashboard</a></h5>
                    <hr class="bg-secondary">
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <h5><a class="nav-link text-white" href="kendaraan.php">
                            <i class="fas fa-motorcycle mr-2"></i>Kendaraan</a></h5>
                    <hr class="bg-secondary">
                </li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "KASIR" or $_SESSION['role'] == "ADMIN"): ?>
                <li class="nav-item">
                    <h5><a class="nav-link text-white" href="layanan.php">
                            <i class="fas fa-hands-helping"></i>Layanan</a></h5>
                    <hr class="bg-secondary">
                </li>
                <?php endif; ?> 
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "KASIR" or $_SESSION['role'] == "ADMIN"): ?>
                <li class="nav-item">
                    <h5><a class="nav-link text-white" href="transaksi.php">
                            <i class="fas fa-receipt"></i>Transaksi</a></h5>
                    <hr class="bg-secondary">
                </li>
                <?php endif; ?> 
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "ADMIN" ): ?>
                <li class="nav-item">
                    <h5><a class="nav-link text-white" href="pegawai.php">
                            <i class="fas fa-users"></i>Pegawai</a></h5>
                    <hr class="bg-secondary">
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <h5><a class="nav-link text-white" href="about.php">
                            <i class="fas fa-headset"></i>tentang</a></h5>
                    <hr class="bg-secondary">
                </li>
            </ul>
        </div>