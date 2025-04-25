<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<!-- Your other scripts -->
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
    integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
</script>


<!-- kode search -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#id_kendaraan').select2({
            placeholder: "-- Pilih Kendaraan --",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#id_layanan').select2({
            placeholder: "-- Pilih layanan --",
            allowClear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 w-100">
    <div class="container">
        <p>&copy; <?= date('Y'); ?> Aplikasi Cuci Steam Motor & Mobil. All Rights Reserved.</p>
        <p>Follow us on:
            <a href="#" class="text-white"><i class="fab fa-facebook-f mx-2"></i></a>
            <a href="#" class="text-white"><i class="fab fa-twitter mx-2"></i></a>
            <a href="#" class="text-white"><i class="fab fa-instagram mx-2"></i></a>
        </p>
    </div>
</footer>
</body>

</html>