<?php
// filepath: /c:/xampp/htdocs/steam1/kendaraan.php

session_start();

$title = 'Data Kendaraan';

include 'layout/header.php';

$kendaraan = select("SELECT * FROM kendaraan ORDER BY id_kendaraan DESC");

// Kode tambah kendaraan
if (isset($_POST['tambah'])) {
    if (tambah_kendaraan($_POST) > 0) {
        echo "<script> alert('Data berhasil ditambahkan');
      document.location.href = 'kendaraan.php';
      </script>";
    } else {
        echo "<script> alert('Data gagal ditambahkan');
      document.location.href = 'kendaraan.php';
      </script>";
    }
}

// Kode ubah data kendaraan
if (isset($_POST['ubah'])) {
    if (ubah_kendaraan($_POST) > 0) {
        echo "<script> 
            alert('Data kendaraan berhasil diubah');
            document.location.href = 'kendaraan.php';
          </script>";
    } else {
        echo "<script> 
            alert('Data kendaraan gagal diubah');
            document.location.href = 'kendaraan.php';
          </script>";
    }
}

// Kode hapus kendaraan
if (isset($_POST['hapus'])) {
    if (hapus_kendaraan($_POST['id_kendaraan']) > 0) {
        echo "<script> 
            alert('Data kendaraan berhasil dihapus');
            document.location.href = 'kendaraan.php';
          </script>";
    } else {
        echo "<script> 
            alert('Data kendaraan gagal dihapus');
            document.location.href = 'kendaraan.php';
          </script>";
    }
}

?>
<!-- Ini kode untuk membuat menu utama -->
<div class="col-md-10 p-5 pt-2">
    <!-- pengatur posisi halaman -->
    <div class="container mt-2">
        <h1><i class="fas fa-motorcycle mr-2"></i> Kendaraan</h1>
        <hr>
        <button class="btn btn-primary mb-1" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-plus-circle"></i> Tambah</button>
        <div class="mt-2 pt-2">
            <table class="table table-bordered table-striped mt-3" id="table">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Plat Nomor</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Pemilik</th>
                        <th>No Telepon</th>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "ADMIN" ): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $no = 1; ?>
                    <?php foreach ($kendaraan as $data_kendaraan) : ?>
                        <tr>
                            <td width="5%"><?= $no++; ?></td>
                            <td><?= $data_kendaraan['plat_nomor']; ?></td>
                            <td><?= $data_kendaraan['jenis']; ?></td>
                            <td><?= $data_kendaraan['merk']; ?></td>
                            <td><?= $data_kendaraan['model']; ?></td>
                            <td><?= $data_kendaraan['pemilik']; ?></td>
                            <td><?= $data_kendaraan['telepon']; ?></td>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "ADMIN" ): ?>
                            <td width="20%" class="text-center">
                                <button class="btn btn-success" data-toggle="modal" data-target="#ubahModal" data-id="<?= $data_kendaraan['id_kendaraan']; ?>" data-plat="<?= $data_kendaraan['plat_nomor']; ?>" data-jenis="<?= $data_kendaraan['jenis']; ?>" data-merk="<?= $data_kendaraan['merk']; ?>" data-model="<?= $data_kendaraan['model']; ?>" data-pemilik="<?= $data_kendaraan['pemilik']; ?>" data-telepon="<?= $data_kendaraan['telepon']; ?>"><i class="fas fa-edit"></i> Ubah</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#hapusModal" data-id="<?= $data_kendaraan['id_kendaraan']; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="plat_nomor">Plat Nomor</label>
                        <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select class="form-control" name="jenis" id="jenis" required>
                            <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                            <option value="motor">Motor</option>
                            <option value="mobil">Mobil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                    <div class="form-group">
                        <label for="pemilik">Pemilik</label>
                        <input type="text" class="form-control" id="pemilik" name="pemilik" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">No Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<div class="modal fade" id="ubahModal" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahModalLabel">Ubah Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_kendaraan" name="id_kendaraan">
                    <div class="form-group">
                        <label for="plat_nomor">Plat Nomor</label>
                        <input type="text" class="form-control" id="plat_nomor_ubah" name="plat_nomor" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select class="form-control" name="jenis" id="jenis_ubah" required>
                            <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                            <option value="motor">Motor</option>
                            <option value="mobil">Mobil</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" class="form-control" id="merk_ubah" name="merk" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model_ubah" name="model" required>
                    </div>
                    <div class="form-group">
                        <label for="pemilik">Pemilik</label>
                        <input type="text" class="form-control" id="pemilik_ubah" name="pemilik" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">No Telepon</label>
                        <input type="text" class="form-control" id="telepon_ubah" name="telepon" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Hapus Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_kendaraan_hapus" name="id_kendaraan">
                    <p>Apakah Anda yakin ingin menghapus data kendaraan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#ubahModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var plat = button.data('plat');
        var jenis = button.data('jenis');
        var merk = button.data('merk');
        var model = button.data('model');
        var pemilik = button.data('pemilik');
        var telepon = button.data('telepon');

        var modal = $(this);
        modal.find('#id_kendaraan').val(id);
        modal.find('#plat_nomor_ubah').val(plat);
        modal.find('#jenis_ubah').val(jenis);
        modal.find('#merk_ubah').val(merk);
        modal.find('#model_ubah').val(model);
        modal.find('#pemilik_ubah').val(pemilik);
        modal.find('#telepon_ubah').val(telepon);
    });

    $('#hapusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var modal = $(this);
        modal.find('#id_kendaraan_hapus').val(id);
    });
</script>

<?php
include 'layout/footer.php';
?>