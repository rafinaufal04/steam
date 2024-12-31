<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk insert
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data hasil submit dari form
  if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $nama_layanan  = mysqli_real_escape_string($mysqli, trim($_POST['nama_layanan']));
    $biaya         = mysqli_real_escape_string($mysqli, $_POST['biaya']);

    // hilangkan titik sebelum disimpan ke database
    $biaya_layanan = str_replace('.', '', $biaya);

    // sql statement untuk insert data ke tabel "tbl_layanan"
    $insert = mysqli_query($mysqli, "INSERT INTO tbl_layanan(nama_layanan, biaya) 
                                     VALUES('$nama_layanan', '$biaya_layanan')")
                                     or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
    // cek query
    // jika proses insert berhasil
    if ($insert) {
      // alihkan ke halaman layanan dan tampilkan pesan berhasil simpan data
      header('location: ../../main.php?module=layanan&pesan=1');
    }
  }
}
