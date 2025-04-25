<?php

$title = 'Daftar Barang';

include 'layout/header.php';

// periksa data pada tabel barang
$barang = select("SELECT * FROM alatbahan ORDER BY id_barang ASC");

// Jika tombol "tambah" ditekan
if (isset($_POST['tambah'])) {
    if (tambah_barang($_POST) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'Barang barang berhasil ditambahkan',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = 'barang.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Barang barang gagal ditambahkan',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        </script>";
    }
}

// Jika tombol "ubah" ditekan
if (isset($_POST['ubah'])) {
    if (ubah_barang($_POST) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'Barang barang berhasil diubah',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'barang.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Barang barang gagal diubah',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'barang.php';
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
        <h3><i class="fas fa-list-ul mr-2"></i> Daftar Barang</h3>
        <hr>
        <?php if (isset($_SESSION['level']) && $_SESSION['level'] == "superadmin" ): ?>
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                class="fas fa-plus-circle"></i> Tambah</button>
                <?php endif; ?>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Spesifikasi</th>
                        <th>Lokasi</th>
                        <th>Kondisi</th>
                        <th>Sumber Dana</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1; ?>
                    <?php foreach ($barang as $data_barang) : ?>
                        <tr>
                            <td width="5%" class="text-center"><?= $no++; ?></td>
                            <td><?= $data_barang['nama_barang']; ?></td>
                            <td width="20%"><?= $data_barang['spesifikasi']; ?></td>
                            <td><?= $data_barang['lokasi']; ?></td>
                            <td><?= $data_barang['kondisi']; ?></td>
                            <td><?= $data_barang['sumber_dana']; ?></td>
                            <td width="150px" class="text-center">
                            <?php if (isset($_SESSION['level']) && $_SESSION['level'] == "superadmin" ): ?>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalUbah<?= $data_barang['id_barang']; ?>"><i class="fas fa-edit"></i>
                                    Ubah</button>
                                    <button class="btn btn-danger btn-hapus" data-id="<?= $data_barang['id_barang']; ?>" data-nama="<?= $data_barang['nama_barang']; ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            </td>
                            <?php endif; ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-1">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" required></input>
                    </div>

                    <div class="mb-1">
                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                        <input type="text" name="spesifikasi" id="spesifikasi" class="form-control" required></input>
                    </div>

                    <div class="mb-1">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" class="form-control" required></input>
                    </div>

                    <div class="mb-1">
                        <label for="kondisi" class="form-label">Kondisi</label>
                        <select class="form-control" name="kondisi" id="kondisi" required>
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="butuh perbaikan">Butuh perbaikan</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label for="sumber_dana" class="form-label">Sumber Dana</label>
                        <input type="text" name="sumber_dana" id="sumber_dana" class="form-control" required></input>
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
<?php foreach ($barang as $data_barang) : ?>
    <div class="modal fade" id="modalUbah<?= $data_barang['id_barang']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_barang" value="<?= $data_barang['id_barang']; ?>"></input>

                        <div class="mb-1">
                            <label for="nama_barang" class="form-label">Nama barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                                value="<?= $data_barang['nama_barang']; ?>" required></input>
                        </div>

                        <div class="mb-1">
                            <label for="spesifikasi" class="form-label">Spesifikasi</label>
                            <input type="text" name="spesifikasi" id="spesifikasi" class="form-control"
                                value="<?= $data_barang['spesifikasi']; ?>" required></input>
                        </div>

                        <div class="mb-1">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi" class="form-control"
                                value="<?= $data_barang['lokasi']; ?>" required></input>
                        </div>
                        <div class="mb-1">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select name="kondisi" id="kondisi" class="form-control" required>
                                <option value="baik" <?= $data_barang['kondisi'] == 'baik' ? 'selected' : '' ?>>Baik
                                </option>
                                <option value="rusak" <?= $data_barang['kondisi'] == 'rusak' ? 'selected' : '' ?>>Rusak
                                </option>
                                <option value="butuh perbaikan"
                                    <?= $data_barang['kondisi'] == 'butuh perbaikan' ? 'selected' : '' ?>>Butuh Perbaikan
                                </option>
                            </select>
                        </div>

                        <div class="mb-1">
                            <label for="sumber_dana" class="form-label">Sumber Dana</label>
                            <input type="text" name="sumber_dana" id="sumber_dana" class="form-control"
                                value="<?= $data_barang['sumber_dana']; ?>" required></input>
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

<!-- Modal Hapus -->
<?php foreach ($barang as $data_barang) : ?>
    <div class="modal fade" id="modalHapus<?= $data_barang['id_barang']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data barang : <?= $data_barang['nama_barang']; ?> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="barang-hapus.php?id_barang=<?= $data_barang['id_barang']; ?>" class="btn btn-danger">Hapus</a>
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
            const id_barang = this.getAttribute("data-id");
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
                    window.location.href = `barang-hapus.php?id_barang=${id_barang}`;
                }
            });
        });
    });
});
</script>

<?php
include 'layout/footer.php';
?>