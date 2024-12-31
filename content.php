<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "config/database.php";

  // pemanggilan file halaman konten sesuai "module" yang dipilih
  // jika module yang dipilih "dashboard"
  if ($_GET['module'] == 'dashboard') {
    // panggil file tampil data dashboard
    include "modules/dashboard/tampil_data.php";
  }
  // jika module yang dipilih "layanan"
  elseif ($_GET['module'] == 'layanan') {
    // panggil file tampil data layanan
    include "modules/layanan/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_layanan"
  elseif ($_GET['module'] == 'form_entri_layanan') {
    // panggil file form entri layanan
    include "modules/layanan/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_layanan"
  elseif ($_GET['module'] == 'form_ubah_layanan') {
    // panggil file form ubah layanan
    include "modules/layanan/form_ubah.php";
  }
  // jika module yang dipilih "transaksi"
  elseif ($_GET['module'] == 'transaksi') {
    // panggil file tampil data transaksi
    include "modules/transaksi/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_transaksi"
  elseif ($_GET['module'] == 'form_entri_transaksi') {
    // panggil file form entri transaksi
    include "modules/transaksi/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_transaksi"
  elseif ($_GET['module'] == 'form_ubah_transaksi') {
    // panggil file form ubah transaksi
    include "modules/transaksi/form_ubah.php";
  }
  // jika module yang dipilih "laporan"
  elseif ($_GET['module'] == 'laporan') {
    // panggil file tampil data laporan
    include "modules/laporan/tampil_data.php";
  }
  // jika module yang dipilih "user" dan hak akses = Admin
  elseif ($_GET['module'] == 'user' && $_SESSION['hak_akses'] == 'Admin') {
    // panggil file tampil data user
    include "modules/user/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_user" dan hak akses = Admin
  elseif ($_GET['module'] == 'form_entri_user' && $_SESSION['hak_akses'] == 'Admin') {
    // panggil file form entri user
    include "modules/user/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_user" dan hak akses = Admin
  elseif ($_GET['module'] == 'form_ubah_user' && $_SESSION['hak_akses'] == 'Admin') {
    // panggil file form ubah user
    include "modules/user/form_ubah.php";
  }
  // jika module yang dipilih "form_ubah_password"
  elseif ($_GET['module'] == 'form_ubah_password') {
    // panggil file form ubah password
    include "modules/password/form_ubah.php";
  }
  // jika module yang dipilih "tentang"
  elseif ($_GET['module'] == 'tentang') {
    // panggil file tampil data tentang
    include "modules/tentang/tampil_data.php";
  }
}
