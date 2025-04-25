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

// ================= BARANG ALATBAHAN =======================================
// Fungsi untuk menambahkan surat pada tabel barang
function tambah_barang($post)
{
  global $db;

  $nama_barang    = strip_tags($post['nama_barang']);
  $spesifikasi    = strip_tags($post['spesifikasi']);
  $lokasi         = strip_tags($post['lokasi']);
  $kondisi        = strip_tags($post['kondisi']);
  $sumber_dana    = strip_tags($post['sumber_dana']);

  // jalankan query INSERT
  $query = "INSERT INTO alatbahan VALUES
  (null, '$nama_barang', '$spesifikasi', '$lokasi', '$kondisi', '$sumber_dana')";
  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// fungsi mengubah data pada barang
function ubah_barang($post)
{
  global $db;
  $id_barang      = strip_tags($post['id_barang']);
  $nama_barang    = strip_tags($post['nama_barang']);
  $spesifikasi    = strip_tags($post['spesifikasi']);
  $lokasi         = strip_tags($post['lokasi']);
  $kondisi        = strip_tags($post['kondisi']);
  $sumber_dana    = strip_tags($post['sumber_dana']);

  // query ubah data pada daftar barang
  $query  = "UPDATE alatbahan SET
  nama_barang = '$nama_barang', 
  spesifikasi = '$spesifikasi',
  lokasi = '$lokasi',
  kondisi = '$kondisi',
  sumber_dana = '$sumber_dana'
  WHERE id_barang = '$id_barang'";

  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// ================= USER =======================================
// fungsi menampilkan data user pada daftar user
function tambah_user($post)
{
  global $db;
  $nama       = strip_tags($post['nama']);
  $username   = strip_tags($post['username']);
  $pass       = strip_tags($post['password']);
  $level      = strip_tags($post['level']);

  // query tambah data user pada daftar user
  $query  = "INSERT INTO user VALUES
  (null, '$nama', '$username', '$pass', '$level' )";

  mysqli_query($db, $query);
  return mysqli_affected_rows($db);
}

// fungsi mengubah data user pada daftar user
function ubah_user($post)
{
  global $db;
  $id_user    = $post['id_user'];
  $nama       = strip_tags($post['nama']);
  $username   = strip_tags($post['username']);
  $pass       = strip_tags($post['password']);
  $level      = strip_tags($post['level']);

  // query ubah data
  $query  = "UPDATE user SET
  nama ='$nama',
  username = '$username',
  password = '$pass',
  level = '$level'
  WHERE id_user = '$id_user'";

  if (!mysqli_query($db, $query)) {
      return mysqli_error($db); // Return the error message
  }
  return mysqli_affected_rows($db);
}

// Other functions...

?>
