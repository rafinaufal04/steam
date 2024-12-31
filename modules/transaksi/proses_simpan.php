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
    $id_transaksi         = mysqli_real_escape_string($mysqli, $_POST['id_transaksi']);
    $tanggal              = mysqli_real_escape_string($mysqli, trim($_POST['tanggal']));
    $nama_pelanggan       = mysqli_real_escape_string($mysqli, trim($_POST['nama_pelanggan']));
    $plat_nomor_kendaraan = strtoupper(mysqli_real_escape_string($mysqli, trim($_POST['plat_nomor_kendaraan'])));
    $layanan              = mysqli_real_escape_string($mysqli, $_POST['layanan']);
    $biaya                = mysqli_real_escape_string($mysqli, $_POST['biaya']);

    // ubah format tanggal menjadi Tahun-Bulan-Hari (Y-m-d) sebelum disimpan ke database
    $tanggal_transaksi    = date('Y-m-d', strtotime($tanggal));
    // hilangkan titik sebelum disimpan ke database
    $total_biaya          = str_replace('.', '', $biaya);

    // sql statement untuk insert data ke tabel "tbl_transaksi"
    $insert = mysqli_query($mysqli, "INSERT INTO tbl_transaksi(id_transaksi, tanggal, nama_pelanggan, plat_nomor_kendaraan, layanan, total_biaya) 
                                     VALUES('$id_transaksi', '$tanggal_transaksi', '$nama_pelanggan', '$plat_nomor_kendaraan', '$layanan', '$total_biaya')")
                                     or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
    // cek query
    // jika proses insert berhasil
    if ($insert) {
      // alihkan ke halaman transaksi dan tampilkan pesan berhasil simpan data
      header('location: ../../main.php?module=transaksi&pesan=1');
    }
  }
}
