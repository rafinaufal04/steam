<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk cetak nota
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data GET "id_transaksi" 
  if (isset($_GET['id'])) {
    // ambil data GET dari button cetak nota
    $id_transaksi = $_GET['id'];

    // sql statement untuk menampilkan data dari tabel "tbl_transaksi" dan tabel "tbl_layanan" berdasarkan "id_transaksi"
    $query = mysqli_query($mysqli, "SELECT a.id_transaksi, a.tanggal, a.nama_pelanggan, a.plat_nomor_kendaraan, a.layanan, a.total_biaya, b.nama_layanan
                                    FROM tbl_transaksi as a INNER JOIN tbl_layanan as b ON a.layanan=b.id_layanan 
                                    WHERE a.id_transaksi='$id_transaksi'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Kasir Jasa Cuci Mobil dan Motor">
    <meta name="author" content="Indra Styawantoro">
    <!-- Title -->
    <title>Aplikasi Kasir Jasa Cuci Mobil dan Motor</title>
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="../../assets/img/favicon.png" type="image/x-icon">
  </head>

  <body onload="window.print()">
    <table>
      <tr>
        <td colspan="3" align="center"><b>TORO WASH</b></td>
      </tr>
      <tr>
        <td colspan="3" align="center">Cuci Mobil dan Motor</td>
      </tr>
      <tr>
        <td colspan="3" align="center">Jl. Nusantara No. 1, Bandar Lampung</td>
      </tr>
      <tr>
        <td colspan="3">=================================</td>
      </tr>
      <tr>
        <td>ID Transaksi </td>
        <td>:</td>
        <td align="right"><?php echo $data['id_transaksi']; ?></td>
      </tr>
      <tr>
        <td>Tanggal </td>
        <td>:</td>
        <td align="right"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
      </tr>
      <tr>
        <td colspan="3">=================================</td>
      </tr>
      <tr>
        <td>Pelanggan </td>
        <td>:</td>
        <td align="right"><?php echo $data['nama_pelanggan']; ?></td>
      </tr>
      <tr>
        <td>Plat Nomor </td>
        <td>:</td>
        <td align="right"><?php echo $data['plat_nomor_kendaraan']; ?></td>
      </tr>
      <tr>
        <td>Layanan </td>
        <td>:</td>
        <td align="right"><?php echo $data['nama_layanan']; ?></td>
      </tr>
      <tr>
        <td colspan="3">=================================</td>
      </tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr>
        <td><strong>Total</strong></td>
        <td>:</td>
        <td align="right"><strong>Rp. <?php echo number_format($data['total_biaya'], 0, '', '.'); ?></strong></td>
      </tr>
      <tr>
        <td colspan="3">=================================</td>
      </tr>
      <tr>
        <td align="center" colspan="3">Terima kasih</td>
      </tr>
    </table>
  </body>

  </html>
<?php } ?>