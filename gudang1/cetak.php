<?php

$title = 'Daftar Barang';

include 'layout/header.php';

?>

<!-- Ini kode untuk membuat menu utama -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content ml-5 pt-3 col-4">
        <h3><i class="fas fa-file mr-2"></i> Cetak Laporan</h3>
        <hr>

        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped table-sm">
                <p>Silakan pilih file yang ingin dicetak dibawah ini:</p>
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Daftar Laporan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="5%" class="text-center">1</td>
                        <td>Stok Alat & Barang</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='cetak-stok.php'">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </td>

                    </tr>

                    <tr>
                        <td width="5%" class="text-center">2</td>
                        <td>Alat & Barang</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='cetak-barang.php'">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td width="5%" class="text-center">3</td>
                        <td>Barang Masuk</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='cetak-masuk.php'">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td width="5%" class="text-center">4</td>
                        <td>Barang Keluar</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='cetak-keluar.php'">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td width="5%" class="text-center">5</td>
                        <td>Peminjaman Alat & Barang</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='cetak-pinjam.php'">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td width="5%" class="text-center">6</td>
                        <td>Penyedia Alat & Barang</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='cetak-penyedia.php'">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td width="5%" class="text-center">7</td>
                        <td>Daftar Pengguna</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary"
                                onclick="window.location.href='cetak-user.php'">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </section>
</div>


<?php
include 'layout/footer.php';
?>