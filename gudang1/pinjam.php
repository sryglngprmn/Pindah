<?php

$title = 'Peminjaman';

include 'layout/header.php';



// Memuat koneksi baru
$koneksi = new mysqli("localhost", "root", "", "gudang");

$pinjam = SELECT("
    SELECT pinjam_alat.*, alatbahan.nama_barang, user.nama
    FROM pinjam_alat 
    JOIN alatbahan ON pinjam_alat.id_barang = alatbahan.id_barang 
    JOIN user ON pinjam_alat.id_user = user.id_user
    ORDER BY pinjam_alat.id_pinjam DESC
");

// Jika tombol "tambah" ditekan
if (isset($_POST['tambah'])) {
    if (tambah_pinjam($_POST) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'peminjam berhasil ditambahkan',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = 'pinjam.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Barang pinjam gagal ditambahkan',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        </script>";
    }
}


?>

<!-- Ini kode untuk membuat menu utama -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content ml-5 pt-3 col-10">
        <h3><i class="fas fa-sync-alt mr-2"></i> Peminjaman</h3>
        <hr>
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                class="fas fa-plus-circle"></i> Tambah</button>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="text-center">Nama Peminjam</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Tanggal Pinjam</th>
                        <th class="text-center">Pinjam</th>
                        <th class="text-center">Tanggal Kembali</th>
                        <th class="text-center">Kembali</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1; ?>
                    <?php foreach ($pinjam as $data_pinjam) : ?>
                        <tr>
                            <td width="5%" class="text-center"><?= $no++; ?></td>
                            <td><?= $data_pinjam['nama']; ?></td>
                            <td><?= $data_pinjam['nama_barang']; ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($data_pinjam['tgl_pinjam'])); ?></td>
                            <td class="text-center"><?= $data_pinjam['jml_barang']; ?></td>
                            <td class="text-center">
                                <?= ($data_pinjam['tgl_kembali'] == '0000-00-00' || $data_pinjam['tgl_kembali'] == NULL) ? '-' : date('d-m-Y', strtotime($data_pinjam['tgl_kembali'])); ?>
                            </td>
                            <td class="text-center"><?= $data_pinjam['jml_kembali']; ?></td>
                            <td width="150px" class="text-center">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalUbah<?= $data_pinjam['id_pinjam']; ?>"><i
                                        class="fas fa-sync-alt"></i></button>
                                       <button class="btn btn-danger btn-hapus" 
    data-id="<?= $data_pinjam['id_pinjam']; ?>" 
    data-nama="<?= htmlspecialchars($data_pinjam['nama']); ?>">
    <i class="fas fa-trash-alt"></i> Hapus
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Peminjaman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-1">
                        <label for="id_user" class="form-label">Nama Peminjam</label>
                        <select name="id_user" id="id_user" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Penerima --</option>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM user ORDER BY id_user");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='{$data['id_user']}'>{$data['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" required></input>
                    </div>

                    <div class="mb-1">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" id="id_barang" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Barang --</option>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM alatbahan ORDER BY id_barang");
                            while ($barang = $sql->fetch_assoc()) {
                                // Menambahkan satuan pada opsi select
                                echo "<option value='{$barang['id_barang']}'>
              {$barang['nama_barang']} </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jml_barang" class="form-label">Jumlah</label>
                        <input type="number" name="jml_barang" id="jml_barang" class="form-control" required></input>
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
<?php foreach ($pinjam as $data_pinjam) : ?>
    <div class="modal fade" id="modalUbah<?= $data_pinjam['id_pinjam']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah pinjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_pinjam" value="<?= $data_pinjam['id_pinjam']; ?>"></input>

                        <div class="mb-1">
                            <label for="id_user" class="form-label">Nama Peminjam</label>
                            <input type="text" id="id_user" class="form-control"
                                value="<?= htmlspecialchars($data_pinjam['nama']); ?>" readonly>

                            <!-- Input hidden untuk mengirim id_user -->
                            <input type="hidden" name="id_user" value="<?= htmlspecialchars($data['id_user']); ?>">
                        </div>


                        <div class="mb-1">
                            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                            <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control"
                                value="<?= $data_pinjam['tgl_pinjam']; ?>" readonly></input>
                        </div>

                        <div class="mb-1">
                            <label for="id_barang" class="form-label">Nama Barang</label>
                            <input name="id_barang" id="id_barang" class="form-control"
                                value="<?= $data_pinjam['nama_barang']; ?>" readonly></input>
                        </div>

                        <div class="mb-1">
                            <label for="jml_barang" class="form-label">Jumlah Pinjam</label>
                            <input type="number" name="jml_barang" id="jml_barang" class="form-control"
                                value="<?= $data_pinjam['jml_barang']; ?>" readonly></input>
                        </div>

                        <div class="mb-1">
                            <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control"
                                value="<?= $data_pinjam['tgl_kembali']; ?>" required></input>
                        </div>

                        <div class="mb-3">
                            <label for="jml_kembali" class="form-label">Jumlah Kembali</label>
                            <input type="number" name="jml_kembali" id="jml_kembali" class="form-control"
                                value="<?= $data_pinjam['jml_kembali']; ?>" required></input>
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
<?php foreach ($pinjam as $data_pinjam) : ?>
    <div class="modal fade" id="modalHapus<?= $data_pinjam['id_pinjam']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus pinjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus data pinjam : <?= $data_pinjam['nama_barang']; ?> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="pinjam-hapus.php?id_pinjam=<?= $data_pinjam['id_pinjam']; ?>" class="btn btn-danger">Hapus</a>
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
            const id_pinjam = this.getAttribute("data-id");
            const nama_user = this.getAttribute("data-nama"); // Ambil nama peminjam dari atribut data-nama

            Swal.fire({
                title: "Hapus Peminjaman?",
                text: `Anda akan menghapus data peminjaman dengan nama peminjam: "${nama_user}"`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke file pinjam-hapus.php dengan parameter id_pinjam
                    window.location.href = `pinjam-hapus.php?id_pinjam=${id_pinjam}`;
                }
            });
        });
    });
});
</script>
<?php
include 'layout/footer.php';
?>