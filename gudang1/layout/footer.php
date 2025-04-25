<footer class="main-footer">
    <strong>Copyright &copy; 2025 <a href="#">SIJA SMK-IK</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const logoutButton = document.querySelector(".btn-logout");

    logoutButton.addEventListener("click", function() {
        Swal.fire({
            title: "Yakin ingin keluar?",
            text: "Anda akan keluar dari sesi ini.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Keluar",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan animasi loading
                document.getElementById("loading-screen").style.display = "flex";

                // Redirect ke logout.php setelah 1 detik
                setTimeout(() => {
                    window.location.href = "logout.php";
                }, 1000);
            }
        });
    });
});
</script>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php if (isset($_SESSION['access_denied']) && $_SESSION['access_denied'] === true): ?>
        Swal.fire({
            title: "Akses Ditolak!",
            text: "Anda tidak memiliki akses ke halaman ini.",
            icon: "error",
            confirmButtonText: "OK"
        });
        <?php unset($_SESSION['access_denied']); // Hapus tanda akses ditolak setelah ditampilkan ?>
    <?php endif; ?>
});
</script>

<script>
    document.getElementById("fullscreen-button").addEventListener("click", function(event) {
        event.preventDefault();
        if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(err => {
                console.log(`Error attempting to enable full-screen mode: ${err.message}`);
            });
        } else {
            document.exitFullscreen();
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#id_kendaraan').select2({
            placeholder: "-- Pilih Kendaraan --",
            allowClear: true
        });
        $('#table').DataTable();
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const logoutButton = document.querySelector(".btn-logout");

    logoutButton.addEventListener("click", function() {
        Swal.fire({
            title: "Yakin ingin keluar?",
            text: "Anda akan keluar dari sesi ini.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Keluar",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke logout.php
                window.location.href = "logout.php";
            }
        });
    });
});
</script>
</body>

</html>