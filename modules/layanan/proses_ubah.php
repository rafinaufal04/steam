<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk update
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data hasil submit dari form
  if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $id_layanan    = mysqli_real_escape_string($mysqli, $_POST['id_layanan']);
    $nama_layanan  = mysqli_real_escape_string($mysqli, trim($_POST['nama_layanan']));
    $biaya         = mysqli_real_escape_string($mysqli, $_POST['biaya']);

    // hilangkan titik sebelum disimpan ke database
    $biaya_layanan = str_replace('.', '', $biaya);

    // sql statement untuk update data di tabel "tbl_layanan" berdasarkan "id_layanan"
    $update = mysqli_query($mysqli, "UPDATE tbl_layanan
                                     SET nama_layanan='$nama_layanan', biaya='$biaya_layanan'
                                     WHERE id_layanan='$id_layanan'")
                                     or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
    // cek query
    // jika proses update berhasil
    if ($update) {
      // alihkan ke halaman layanan dan tampilkan pesan berhasil ubah data
      header('location: ../../main.php?module=layanan&pesan=2');
    }
  }
}
