<?php

$title = 'Barang Keluar';

include 'layout/header.php';

// Memuat koneksi baru
$koneksi = new mysqli("localhost", "root", "", "gudang");

// periksa data pada tabel keluar
$keluar = select("
    SELECT barang_keluar.*, alatbahan.nama_barang
    FROM barang_keluar
    JOIN alatbahan ON barang_keluar.id_barang = alatbahan.id_barang 
    ORDER BY barang_keluar.id_keluar DESC
");

// Jika tombol "tambah" ditekan
if (isset($_POST['tambah'])) {
    if (tambah_keluar($_POST) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'Barang keluar berhasil ditambahkan',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = 'keluar.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Barang keluar gagal ditambahkan',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
        </script>";
    }
}

// Jika tombol "ubah" ditekan
if (isset($_POST['ubah'])) {
    if (ubah_keluar($_POST) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'Barang keluar berhasil diubah',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'keluar.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Barang keluar gagal diubah',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'keluar.php';
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
        <h3><i class="fas fa-reply mr-2"></i> Barang Keluar</h3>
        <hr>
        <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                class="fas fa-plus-circle"></i> Tambah</button>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped table-sm" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Tanggal Keluar</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Penerima</th>
                        <th class="text-center">Aksi</th>
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
                            <td width="150px" class="text-center">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalUbah<?= $data_keluar['id_keluar']; ?>"><i class="fas fa-edit"></i>
                                    Ubah</button>
                                    <button class="btn btn-danger btn-hapus" data-id="<?= $data_keluar['id_keluar']; ?>" data-nama="<?= $data_keluar['nama_barang']; ?>">
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
                <h5 class="modal-title" id="exampleModalLabel">Barang keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">

                    <div class="mb-1">
                        <label for="id_barang" class="form-label">Nama Barang</label>
                        <select name="id_barang" id="id_barang" class="form-control" required>
                            <option value="<?= $data_keluar['nama_barang']; ?>" disabled selected>-- Pilih Barang --
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
                        <label for="tgl_keluar" class="form-label">Tanggal keluar</label>
                        <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control" required></input>
                    </div>

                    <div class="mb-1">
                        <label for="jml_keluar" class="form-label">Jumlah</label>
                        <input type="number" name="jml_keluar" id="jml_keluar" class="form-control" required></input>
                    </div>

                    <div class="mb-3">
                        <label for="penerima" class="form-label">Nama Penerima</label>
                        <select name="penerima" id="penerima" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Penerima --</option>
                            <?php
                            $sql = $koneksi->query("SELECT * FROM user ORDER BY id_user");
                            while ($data = $sql->fetch_assoc()) {
                                echo "<option value='{$data['nama']}'>{$data['nama']}</option>";
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
<?php foreach ($keluar as $data_keluar) : ?>
    <div class="modal fade" id="modalUbah<?= $data_keluar['id_keluar']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Barang keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="hidden" name="id_keluar" value="<?= $data_keluar['id_keluar']; ?>"></input>

                        <div class="mb-1">
                            <label for="id_barang" class="form-label">Nama Barang</label>
                            <select name="id_barang" id="id_barang" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Penyedia --</option>
                                <?php
                                $sql = $koneksi->query("SELECT * FROM alatbahan ORDER BY id_barang");
                                while ($data = $sql->fetch_assoc()) {
                                    // Cek apakah id_barang dari database sama dengan yang tersimpan di $data_keluar
                                    $selected = ($data['id_barang'] == $data_keluar['id_barang']) ? "selected" : "";
                                    echo "<option value='{$data['id_barang']}' $selected>{$data['nama_barang']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-1">
                            <label for="tgl_keluar" class="form-label">Tanggal keluar</label>
                            <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control"
                                value="<?= $data_keluar['tgl_keluar']; ?>" required></input>
                        </div>

                        <div class="mb-1">
                            <label for="jml_keluar" class="form-label">Jumlah</label>
                            <input type="number" name="jml_keluar" id="jml_keluar" class="form-control"
                                value="<?= $data_keluar['jml_keluar']; ?>" required></input>
                        </div>

                        <div class="mb-3">
                            <label for="penerima" class="form-label">Nama Penerima</label>
                            <select name="penerima" id="penerima" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Penerima --</option>
                                <?php
                                // Pastikan $data_keluar sudah didefinisikan sebelumnya
                                $sql = $koneksi->query("SELECT * FROM user ORDER BY id_user");
                                while ($data = $sql->fetch_assoc()) {
                                    // Hindari error jika $data_keluar['penerima'] belum terdefinisi
                                    $selected = (isset($data_keluar['penerima']) && $data['nama'] == $data_keluar['penerima']) ? "selected" : "";
                                    echo "<option value='" . htmlspecialchars($data['nama'], ENT_QUOTES) . "' $selected>" . htmlspecialchars($data['nama'], ENT_QUOTES) . "</option>";
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

<!-- Modal Hapus -->
<?php foreach ($keluar as $data_keluar) : ?>
    <div class="modal fade" id="modalHapus<?= $data_keluar['id_keluar']; ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Barang keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin menghapus barang keluar : <?= $data_keluar['nama_barang']; ?> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="keluar-hapus.php?id_keluar=<?= $data_keluar['id_keluar']; ?>" class="btn btn-danger">Hapus</a>
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
            const id_keluar = this.getAttribute("data-id");
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
                    window.location.href = `keluar-hapus.php?id_keluar=${id_keluar}`;
                }
            });
        });
    });
});
</script>

<?php
include 'layout/footer.php';
?>