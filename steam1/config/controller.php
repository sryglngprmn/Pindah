<?php

// fungsi koneksi panggil database
function select($query)
{
  // panggil koneksi database
  global $db;

  $result = mysqli_query($db, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


// ============ KENDARAAN ===========
// Fungsi untuk menambahkan data pada tabel kendaraan
function tambah_kendaraan($post)
{
  global $db;

  // Mendapatkan nilai dari array $post

  $plat_nomor   = strip_tags($post['plat_nomor']);
  $jenis  = strip_tags($post['jenis']);
  $merk = strip_tags($post['merk']);
  $model = strip_tags($post['model']);
  $pemilik = strip_tags($post['pemilik']);
  $telepon   = strip_tags($post['telepon']);


  // jalankan query INSERT
  $query = "INSERT INTO kendaraan (plat_nomor, jenis, merk, model, pemilik, telepon) 
          VALUES ('$plat_nomor', '$jenis', '$merk', '$model', '$pemilik', '$telepon')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// fungsi mengubah data pada kendaraan
function ubah_kendaraan($post)
{
  global $db;
  $id_kendaraan           = $post['id_kendaraan'];
  $plat_nomor   = strip_tags($post['plat_nomor']);
  $jenis        = strip_tags($post['jenis']);
  $merk        = strip_tags($post['merk']);
  $model        = strip_tags($post['model']);
  $pemilik      = strip_tags($post['pemilik']);
  $telepon      = strip_tags($post['telepon']);

  // query ubah data pada daftar surat
  $query  = "UPDATE kendaraan SET
  plat_nomor = '$plat_nomor', 
  jenis = '$jenis',
  merk = '$merk',
  model = '$model',
  pemilik = '$pemilik',
  telepon = '$telepon'
  WHERE id_kendaraan = '$id_kendaraan'";

  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// Fungsi menghapus data kendaraan dengan prepared statement
function hapus_kendaraan($id)
{
  global $db;

  $query = "DELETE FROM kendaraan WHERE id_kendaraan = ?";
  $stmt = mysqli_prepare($db, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $affected_rows;
  } else {
    return 0;
  }
}

// =================================================================================================================================================================================================================================================================================================================================

// ============ LAYANAN ===========
// Fungsi untuk menambahkan data pada tabel layanan
function tambah_layanan($post)
{
  global $db;

  // Mendapatkan nilai dari array $post

  $nama_layanan   = strip_tags($post['nama_layanan']);
  $harga  = strip_tags($post['harga']);



  // jalankan query INSERT
  $query = "INSERT INTO layanan (nama_layanan, harga) 
          VALUES ('$nama_layanan', '$harga')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// fungsi mengubah data pada layanan
function ubah_layanan($post)
{
  global $db;
  $id_layanan     = $post['id_layanan'];
  $nama_layanan   = strip_tags($post['nama_layanan']);
  $harga          = strip_tags($post['harga']);


  // query ubah data pada daftar surat
  $query  = "UPDATE layanan SET
  nama_layanan = '$nama_layanan', 
  harga = '$harga'
  WHERE id_layanan = '$id_layanan'";

  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// Fungsi menghapus data layanan dengan prepared statement
function hapus_layanan($id)
{
  global $db;

  $query = "DELETE FROM layanan WHERE id_layanan = ?";
  $stmt = mysqli_prepare($db, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $affected_rows;
  } else {
    return 0;
  }
}



// ============ PEGAWAI ===========
// Fungsi untuk menambahkan data pada tabel pegawai
function tambah_pegawai($post)
{
  global $db;

  // Mendapatkan nilai dari array $post

  $nama   = strip_tags($post['nama']);
  $email  = strip_tags($post['email']);
  $password = strip_tags($post['password']);
  $role = strip_tags($post['role']);

 // Hash password sebelum menyimpan ke database
 $hashed_password = password_hash($password, PASSWORD_DEFAULT);


  // jalankan query INSERT
  $query = "INSERT INTO pegawai (nama, email, password, role) 
          VALUES ('$nama', '$email', '$password', '$role')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// fungsi mengubah data pada pegawai
function ubah_pegawai($post)
{
  global $db;
  $id_pegawai     = $post['id_pegawai'];
  $nama   = strip_tags($post['nama']);
  $email  = strip_tags($post['email']);
  $password = strip_tags($post['password']);
  $role = strip_tags($post['role']);

   // Ambil password lama dari database
   $query = "SELECT password FROM pegawai WHERE id_pegawai = '$id_pegawai'";
   $result = mysqli_query($db, $query);
   $row = mysqli_fetch_assoc($result);
   $old_password = $row['password'];

   // Jika password diubah, hash password baru
   if (!empty($password)) {
       $hashed_password = password_hash($password, PASSWORD_DEFAULT);
   } else {
       $hashed_password = $old_password;
   }
   
  // query ubah data pada daftar surat
  $query  = "UPDATE pegawai SET
  nama = '$nama', 
  email = '$email',
  password = '$hashed_password',
  role = '$role'
  WHERE id_pegawai = '$id_pegawai'";

  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// Fungsi menghapus data pegawai dengan prepared statement
function hapus_pegawai($id)
{
  global $db;

  $query = "DELETE FROM pegawai WHERE id_pegawai = ?";
  $stmt = mysqli_prepare($db, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $affected_rows;
  } else {
    return 0;
  }
}


// ============ TRANSAKSI ===========
// Fungsi untuk menambahkan data pada tabel transaksi
function tambah_transaksi($post)
{
  global $db;

  // Mendapatkan nilai dari array $post

  $kode_transaksi   = strip_tags($post['kode_transaksi']);
  $id_kendaraan  = strip_tags($post['id_kendaraan']);
  $id_layanan = strip_tags($post['id_layanan']);
  $total_harga = strip_tags($post['total_harga']);
  $metode_pembayaran   = strip_tags($post['metode_pembayaran']);


  // jalankan query INSERT
  $query = "INSERT INTO transaksi (kode_transaksi, id_kendaraan, id_layanan, total_harga, metode_pembayaran) 
          VALUES ('$kode_transaksi', '$id_kendaraan', '$id_layanan', '$total_harga', '$metode_pembayaran')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// fungsi mengubah data pada transaksi
function ubah_transaksi($post)
{
  global $db;
  $id_transaksi     = $post['id_transaksi'];
  $kode_transaksi   = strip_tags($post['kode_transaksi']);
  $id_kendaraan  = strip_tags($post['id_kendaraan']);
  $id_layanan = strip_tags($post['id_layanan']);
  $total_harga = strip_tags($post['total_harga']);
  $metode_pembayaran   = strip_tags($post['metode_pembayaran']);


  // query ubah data pada daftar surat
  $query  = "UPDATE transaksi SET
  kode_transaksi = '$kode_transaksi',
  id_kendaraan = '$id_kendaraan',
  id_layanan = '$id_layanan',
  total_harga = '$total_harga',
  metode_pembayaran = '$metode_pembayaran'
  WHERE id_transaksi = '$id_transaksi'";


  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// Fungsi menghapus data transaksi dengan prepared statement
function hapus_transaksi($id)
{
  global $db;

  $query = "DELETE FROM transaksi WHERE id_transaksi = ?";
  $stmt = mysqli_prepare($db, $query);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    return $affected_rows;
  } else {
    return 0;
  }
}