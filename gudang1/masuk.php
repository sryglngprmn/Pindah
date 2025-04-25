<?php


$title = 'Barang Masuk';

include 'layout/header.php';

// Memuat koneksi baru
$koneksi = new mysqli("localhost", "root", "", "gudang");

// periksa data pada tabel masuk
$masuk = SELECT("
    SELECT barang_masuk.*, alatbahan.nama_barang, penyedia.nama_penyedia
    FROM barang_masuk 
    JOIN alatbahan ON barang_masuk.id_barang = alatbahan.id_barang 
    JOIN penyedia ON barang_masuk.id_penyedia = penyedia.id_penyedia
    ORDER BY barang_masuk.id_masuk DESC
");

// Jika tombol "tambah" ditekan
if (isset($_POST['tambah'])) {
    if (tambah_masuk($_POST) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'Barang masuk berhasil ditambahkan',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = 'masuk.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Barang masuk gagal ditambahkan',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        </script>";
    }
}

// Jika tombol "ubah" ditekan
if (isset($_POST['ubah'])) {
    if (ubah_masuk($_POST) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'Barang masuk berhasil diubah',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'masuk.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Barang masuk gagal diubah',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'masuk.php';
                }
            });
        </script>";
    }
}

?>
<!-- Ini kode untuk membuat menu utama -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content ml-5 pt-3 col-9">
        <h3><i class="fas fa-share mr-2"></i> Barang Masuk</h3>
        <hr>
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                class="fas fa-plus-circle"></i> Tambah</button>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Tanggal Masuk</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Penyedia</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1; ?>
                    <?php foreach ($masuk as $data_masuk) : ?>
                    <tr>
                        <td width="5%" class="text-center"><?= $no++; ?></td>
                        <td><?= $data_masuk['nama_barang']; ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($data_masuk['tgl_masuk'])); ?></td>
                        <td class="text-center"><?= $data_masuk['jml_masuk']; ?></td>
                        <td><?= $data_masuk['nama_penyedia']; ?></td>
                        <td width="150px" class="text-center">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalUbah<?= $data_masuk['id_masuk']; ?>"><i class="fas fa-edit"></i>
                                Ubah</button>
                            <button class="btn btn-danger btn-hapus" data-id="<?= $data_masuk['id_masuk']; ?>" data-nama="<?= $data_masuk['nama_barang']; ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>


<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Barang Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-1">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" id="id_barang" class="form-control" required>
                            <option value="<?= $data_penyedia['nama_barang']; ?>" disabled selected>-- Pilih Barang --
                            </option>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM alatbahan ORDER BY id_barang");
                            while ($data = $sql->fetch_assoc()) {
                                // Menambahkan satuan pada opsi select
                                echo "<option value='{$data['id_barang']}'>{$data['nama_barang']} </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" required></input>
                    </div>

                    <div class="mb-1">
                        <label for="jml_masuk" class="form-label">Jumlah</label>
                        <input type="number" name="jml_masuk" id="jml_masuk" class="form-control" required></input>
                    </div>

                    <div class="mb-3">
                        <label for="id_penyedia" class="form-label">Nama Penyedia</label>
                        <select name="id_penyedia" id="id_penyedia" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Penyedia --</option>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM penyedia ORDER BY id_penyedia");
                            while ($data = $sql->fetch_assoc()) {
                                // Menambahkan satuan pada opsi select
                                echo "<option value='{$data['id_penyedia']}'>{$data['nama_penyedia']} </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($masuk as $data_masuk) : ?>
<div class="modal fade" id="modalUbah<?= $data_masuk['id_masuk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Barang Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id_masuk" value="<?= $data_masuk['id_masuk']; ?>"></input>

                    <div class="mb-1">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" id="id_barang" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Penyedia --</option>
                            <?php
                                $sql = $koneksi->query("SELECT * FROM alatbahan ORDER BY id_barang");
                                while ($data = $sql->fetch_assoc()) {
                                    // Cek apakah id_barang dari database sama dengan yang tersimpan di $data_masuk
                                    $selected = ($data['id_barang'] == $data_masuk['id_barang']) ? "selected" : "";
                                    echo "<option value='{$data['id_barang']}' $selected>{$data['nama_barang']}</option>";
                                }
                                ?>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label for="tgl_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control"
                            value="<?= $data_masuk['tgl_masuk']; ?>" required></input>
                    </div>

                    <div class="mb-1">
                        <label for="jml_masuk" class="form-label">Jumlah</label>
                        <input type="number" name="jml_masuk" id="jml_masuk" class="form-control"
                            value="<?= $data_masuk['jml_masuk']; ?>" required></input>
                    </div>

                    <div class="mb-3">
                        <label for="id_penyedia" class="form-label">Nama Penyedia</label>
                        <select name="id_penyedia" id="id_penyedia" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Penyedia --</option>
                            <?php
                                $sql = $koneksi->query("SELECT * FROM penyedia ORDER BY id_penyedia");
                                while ($data = $sql->fetch_assoc()) {
                                    // Cek apakah id_penyedia dari database sama dengan yang tersimpan di $data_masuk
                                    $selected = ($data['id_penyedia'] == $data_masuk['id_penyedia']) ? "selected" : "";
                                    echo "<option value='{$data['id_penyedia']}' $selected>{$data['nama_penyedia']}</option>";
                                }
                                ?>
                        </select>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" name="ubah" class="btn btn-warning">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Script Hapus -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const buttons = document.querySelectorAll(".btn-hapus");

    buttons.forEach(button => {
        button.addEventListener("click", function() {
            const id_masuk = this.getAttribute("data-id");
            const nama_barang = this.getAttribute("data-nama");

            Swal.fire({
                title: "Hapus Barang?",
                text: `Anda akan menghapus data: "${nama_barang}"`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `masuk-hapus.php?id_masuk=${id_masuk}`;
                }
            });
        });
    });
});
</script>

<?php
include 'layout/footer.php';
?>