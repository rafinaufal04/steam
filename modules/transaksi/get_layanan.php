<?php
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// jika ada ajax request
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data GET dari ajax
  if (isset($_GET['id_layanan'])) {
    // ambil data GET dari ajax
    $id_layanan = $_GET['id_layanan'];

    // sql statement untuk menampilkan data dari tabel "tbl_layanan" berdasarkan "id_layanan"
    $query = mysqli_query($mysqli, "SELECT biaya FROM tbl_layanan WHERE id_layanan='$id_layanan'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data  = mysqli_fetch_assoc($query);
    // tampilkan data dan ubah ke dalam format currency (menambahkan titik)
    $biaya = number_format($data['biaya'], 0, '', '.');

    // kirimkan data
    echo json_encode($biaya);
  }
}
// jika tidak ada ajax request
else {
  // alihkan ke halaman error 404
  header('location: ../../404.html');
}
