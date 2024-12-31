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

    // sql statement untuk update data di tabel "tbl_transaksi" berdasarkan "id_transaksi"
    $update = mysqli_query($mysqli, "UPDATE tbl_transaksi 
                                     SET tanggal='$tanggal_transaksi', nama_pelanggan='$nama_pelanggan', plat_nomor_kendaraan='$plat_nomor_kendaraan', layanan='$layanan', total_biaya='$total_biaya' 
                                     WHERE id_transaksi='$id_transaksi'")
                                     or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
    // cek query
    // jika proses update berhasil
    if ($update) {
      // alihkan ke halaman transaksi dan tampilkan pesan berhasil ubah data
      header('location: ../../main.php?module=transaksi&pesan=2');
    }
  }
}
