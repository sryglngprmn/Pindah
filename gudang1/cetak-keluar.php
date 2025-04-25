<?php
session_start();
include 'config/app.php';
$title = 'Cetak Barang Keluar';


// periksa data pada tabel keluar
$keluar = select("
    SELECT barang_keluar.*, alatbahan.nama_barang
    FROM barang_keluar
    JOIN alatbahan ON barang_keluar.id_barang = alatbahan.id_barang 
    ORDER BY barang_keluar.id_keluar DESC
");

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
            <h3><i class="fas fa-reply mr-2"></i> Barang Keluar</h3>
            <hr>

            <div class="mt-2 pt-2">
                <table class="table table-bordered table-striped table-sm" id="export">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Tanggal Keluar</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Penerima</th>

                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $no = 1; ?>
                        <?php foreach ($keluar as $data_keluar) : ?>
                        <tr>
                            <td width="5%" class="text-center"><?= $no++; ?></td>
                            <td><?= $data_keluar['nama_barang']; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($data_keluar['tgl_keluar'])); ?></td>
                            <td class="text-center"><?= $data_keluar['jml_keluar']; ?></td>
                            <td><?= $data_keluar['penerima']; ?></td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="mb-3 col-13">
                <a href="cetak.php" class="btn btn-secondary">Kembali</a>
            </div>
        </section>

    </div>


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