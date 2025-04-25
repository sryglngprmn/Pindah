<?php

$title = 'Penyedia';

include 'layout/header.php';

// periksa data pada tabel penyedia
$penyedia = select("SELECT * FROM penyedia ORDER BY id_penyedia ASC");

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
        <h3><i class="fas fa-dolly-flatbed mr-2"></i> Penyedia</h3>
        <hr>
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                class="fas fa-plus-circle"></i> Tambah</button>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penyedia</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1; ?>
                    <?php foreach ($penyedia as $data_penyedia) : ?>
                        <tr>
                            <td width="5%" class="text-center"><?= $no++; ?></td>
                            <td><?= $data_penyedia['nama_penyedia']; ?></td>
                            <td><?= $data_penyedia['alamat_penyedia']; ?></td>
                            <td><?= $data_penyedia['telpon_penyedia']; ?></td>
                            <td width="150px" class="text-center">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalUbah<?= $data_penyedia['id_penyedia']; ?>"><i
                                        class="fas fa-edit"></i>
                                    Ubah</button>
                                    <button class="btn btn-danger btn-hapus" data-id="<?= $data_penyedia['id_penyedia']; ?>" data-nama="<?= $data_penyedia['nama_penyedia']; ?>">
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Penyedia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-1">
                        <label for="nama_penyedia" class="form-label">Nama Penyedia</label>
                        <input type="text" name="nama_penyedia" id="nama_penyedia" class="form-control"
                            required></input>
                    </div>

                    <div class="mb-1">
                        <label for="alamat_penyedia" class="form-label">Alamat</label>
                        <input type="text" name="alamat_penyedia" id="alamat_penyedia" class="form-control"
                            required></input>
                    </div>

                    <div class="mb-3">
                        <label for="telpon_penyedia" class="form-label">Telepon</label>
                        <input type="text" name="telpon_penyedia" id="telpon_penyedia" class="form-control"
                            required></input>
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
<?php foreach ($penyedia as $data_penyedia) : ?>
    <div class="modal fade" id="modalUbah<?= $data_penyedia['id_penyedia']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Penyedia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_penyedia" value="<?= $data_penyedia['id_penyedia']; ?>"></input>

                        <div class="mb-1">
                            <label for="nama_penyedia" class="form-label">Nama Penyedia</label>
                            <input type="text" name="nama_penyedia" id="nama_penyedia" class="form-control"
                                value="<?= $data_penyedia['nama_penyedia']; ?>" required></input>
                        </div>

                        <div class="mb-1">
                            <label for="alamat_penyedia" class="form-label">Alamat</label>
                            <input type="text" name="alamat_penyedia" id="alamat_penyedia" class="form-control"
                                value="<?= $data_penyedia['alamat_penyedia']; ?>" required></input>
                        </div>

                        <div class="mb-3">
                            <label for="telpon_penyedia" class="form-label">Telepon</label>
                            <input type="text" name="telpon_penyedia" id="telpon_penyedia" class="form-control"
                                value="<?= $data_penyedia['telpon_penyedia']; ?>" required></input>
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
<?php foreach ($penyedia as $data_penyedia) : ?>
    <div class="modal fade" id="modalHapus<?= $data_penyedia['id_penyedia']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Penyedia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data penyedia : <?= $data_penyedia['nama_penyedia']; ?> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="penyedia-hapus.php?id_penyedia=<?= $data_penyedia['id_penyedia']; ?>"
                        class="btn btn-danger">Hapus</a>
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
            const id_penyedia = this.getAttribute("data-id");
            const nama_penyedia = this.getAttribute("data-nama");

            Swal.fire({
                title: "Hapus penyedia?",
                text: `Anda akan menghapus data: "${nama_penyedia}"`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `penyedia-hapus.php?id_penyedia=${id_masuk}`;
                }
            });
        });
    });
});
</script>

<?php
include 'layout/footer.php';
?>