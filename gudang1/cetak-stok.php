<?php
session_start();
$title = 'Cetak Stok';

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "gudang");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query stok barang
$stok = "SELECT 
            a.id_barang,
            a.nama_barang,
            COALESCE((SELECT SUM(jml_masuk) FROM barang_masuk WHERE id_barang = a.id_barang), 0) AS jml_masuk,
            COALESCE((SELECT SUM(jml_keluar) FROM barang_keluar WHERE id_barang = a.id_barang), 0) AS jml_keluar,
            COALESCE((SELECT SUM(jml_barang) FROM pinjam_alat WHERE id_barang = a.id_barang), 0) AS jml_dipinjam,
            COALESCE((SELECT SUM(jml_kembali) FROM pinjam_alat WHERE id_barang = a.id_barang), 0) AS jml_kembali,
            COALESCE((SELECT SUM(jml_masuk) FROM barang_masuk WHERE id_barang = a.id_barang), 0) 
            - COALESCE((SELECT SUM(jml_keluar) FROM barang_keluar WHERE id_barang = a.id_barang), 0)
            - COALESCE((SELECT SUM(jml_barang) FROM pinjam_alat WHERE id_barang = a.id_barang), 0)
            + COALESCE((SELECT SUM(jml_kembali) FROM pinjam_alat WHERE id_barang = a.id_barang), 0)
            AS stok_tersedia
        FROM alatBahan a";

$result = $conn->query($stok);

?>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
    </script>

    <title><?= $title; ?></title>

</head>

<body>
    <!-- Ini kode untuk membuat menu utama -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content ml-5 pt-3 col-9">
            <h3><i class="fas fa-warehouse mr-2"></i> Stok Barang</h3>
            <hr>
            <div class="mt-2 pt-2">
                <table class="table table-bordered table-striped table-sm" id="export">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th class="text-center">Masuk</th>
                            <th class="text-center">Keluar</th>
                            <th class="text-center">Dipinjam</th>
                            <th class="text-center">Kembali</th>
                            <th class="text-center">Total Stok</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $no = 1; ?>
                        <?php while ($data_stok = $result->fetch_assoc()) : ?>
                        <tr>
                            <td width="5%" class="text-center"><?= $no++; ?></td>
                            <td><?= $data_stok['nama_barang']; ?></td>
                            <td class="text-center"><?= $data_stok['jml_masuk']; ?></td>
                            <td class="text-center"><?= $data_stok['jml_keluar']; ?></td>
                            <td class="text-center"><?= $data_stok['jml_dipinjam']; ?></td>
                            <td class="text-center"><?= $data_stok['jml_kembali']; ?></td>
                            <td class="text-center"><?= $data_stok['stok_tersedia']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="mb-3 col-13">
                <a href="cetak.php" class="btn btn-secondary">Kembali</a>
            </div>
        </section>

    </div>

    <?php
    $conn->close();
    ?>

    <script>
    $(document).ready(function() {
        $('#export').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

</body>

</html>