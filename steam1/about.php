<?php
session_start();
$title = 'Tentang';
include 'layout/header.php';

?>

<!-- Ini kode untuk membuat menu utama -->
<div class="col-md-8 p-5 pt-2">
    <!-- pengatur posisi halaman -->
    <div class="container mt-3">
        <h1><img src="image/logo.png" alt="Logo" width="auto" height="50"> SteamTrack</h1>
        <h2>Aplikasi UMKM untuk Cuci Steam Motor dan Mobil</h2>
        <br>
        <p>
            Halo, pelajar! Selamat datang di <b>SteamTrack</b>, aplikasi yang dirancang khusus untuk membantu Kamu
            memahami dan mempelajari sistem informasi manajemen usaha cuci steam dengan lebih mudah dan interaktif.
            Aplikasi ini bertujuan memberikan wawasan mendalam tentang <b>pengelolaan transaksi, pencatatan pelanggan,
                manajemen layanan, serta pelaporan operasional</b> secara sederhana dan menyenangkan.
        </p>
        <p>
            <b>Masukan dan Saran:</b>
            Kami mengundang Kamu untuk berbagi ide, saran, atau masukan agar <b>SteamTrack</b> dapat menjadi alat
            pembelajaran dan manajemen usaha yang lebih bermanfaat. Dukungan dan partisipasi Kamu sangat berarti bagi
            pengembangan aplikasi ini. <b>Selamat belajar dan semoga sukses! </b>
        </p>
        <button type="button" class="btn btn-success mr-2"><a href="https://wa.me/+85211504465" class="whatsapp"
                target="_blank" style="color: #fff; text-decoration: none;"><i class="fab fa-whatsapp"></i>
                WhatsApp</a></button>
        <button type="button" class="btn btn-primary mr-2"><a href="https://facebook.com/Surya Gilang Permana" class="facebook"
                target="_blank" style="color: #fff; text-decoration: none;"><i class="fab fa-facebook-f"></i>
                Facebook</a></button>
        <button type="button" class="btn btn-danger mr-2"><a href="https://instagram.com/sryglngprmn"
                class="instagram" target="_blank" style="color: #fff; text-decoration: none;"><i
                    class="fab fa-instagram"></i> Instagram</a></button>
    </div>

    <!-- end content -->
</div>
</div>



<?php include 'layout/footer.php'; ?>