<?php
session_start();      // mengaktifkan session

// panggil file "autoload.inc.php" untuk load dompdf, libraries, dan helper functions
require_once("../../assets/vendor/dompdf/autoload.inc.php");
// mereferensikan Dompdf namespace
use Dompdf\Dompdf;

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk cetak
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // ambil data hasil submit dari form filter dan ubah format tanggal menjadi Tahun-Bulan-Hari (Y-m-d)
  $tanggal_awal  = date('Y-m-d', strtotime($_POST['tanggal_awal']));
  $tanggal_akhir = date('Y-m-d', strtotime($_POST['tanggal_akhir']));

  // sql statement untuk menampilkan data dari tabel "tbl_transaksi" dan tabel "tbl_layanan" berdasarkan "tanggal"
  $query = mysqli_query($mysqli, "SELECT a.id_transaksi, a.tanggal, a.nama_pelanggan, a.plat_nomor_kendaraan, a.layanan, a.total_biaya, b.nama_layanan
	                              	FROM tbl_transaksi as a INNER JOIN tbl_layanan as b ON a.layanan=b.id_layanan 
	                              	WHERE a.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY a.id_transaksi ASC")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));

  // gunakan dompdf class
  $dompdf = new Dompdf();
  // setting options
  $options = $dompdf->getOptions();
  $options->setChroot(__DIR__ . '/../..'); // tentukan path direktori aplikasi
  $dompdf->setOptions($options);

  // halaman HTML yang akan diubah ke PDF
  $html = '<!DOCTYPE html>
					<html>
						<head>
							<title>Laporan Data Transaksi</title>
							<link href="../../assets/css/laporan.css" rel="stylesheet">
						</head>
						<body class="text-dark">
							<div class="text-center">
								<h4>LAPORAN DATA TRANSAKSI</h4>
								<span>Tanggal ' . $_POST['tanggal_awal'] . ' s.d. ' . $_POST['tanggal_akhir'] . '</span>
							</div>
							<hr>
							<div class="mt-4">
								<table class="table table-bordered" width="100%" cellspacing="0">
									<thead class="bg-info text-white text-center">
										<tr>
											<th>No.</th>
											<th>ID Transaksi</th>
											<th>Tanggal</th>
											<th>Nama Pelanggan</th>
											<th>Plat Nomor</th>
											<th>Layanan</th>
											<th>Total Biaya</th>
										</tr>
									</thead>
									<tbody class="text-dark">';
  // variabel untuk nomor urut tabel
  $no = 1;
  // variabel untuk total pendapatan
  $total_pendapatan = 0;
  // ambil data hasil query
  while ($data = mysqli_fetch_assoc($query)) {
    // tampilkan data
    $html .= '			<tr>
											<td class="text-center">' . $no++ . '</td>
											<td class="text-center">' . $data['id_transaksi'] . '</td>
											<td class="text-center">' . date('d-m-Y', strtotime($data['tanggal'])) . '</td>
											<td>' . $data['nama_pelanggan'] . '</td>
											<td class="text-center">' . $data['plat_nomor_kendaraan'] . '</td>
											<td>' . $data['nama_layanan'] . '</td>
											<td class="text-right">Rp. ' . number_format($data['total_biaya'], 0, '', '.') . '</td>
										</tr>';
    // jumlahkan total biaya untuk mendapatkan total pendapatan
    $total_pendapatan += $data['total_biaya'];
  }
  $html .= '				<tr>
											<td class="text-center font-weight-bold" colspan="6">Total Pendapatan</td>
											<td class="text-right font-weight-bold">Rp. ' . number_format($total_pendapatan, 0, '', '.') . '</td>
										</tr>';
  $html .= '			</tbody>
								</table>
							</div>
							<div class="text-right mt-5">Bandar Lampung, ' . date('d-m-Y') . '</div>
						</body>
					</html>';

  // load html
  $dompdf->loadHtml($html);
  // mengatur ukuran dan orientasi kertas
  $dompdf->setPaper('A4', 'landscape');
  // mengubah dari HTML menjadi PDF
  $dompdf->render();
  // menampilkan file PDF yang dihasilkan ke browser dan berikan nama file "Laporan-Data-Transaksi.pdf"
  $dompdf->stream('Laporan-Data-Transaksi.pdf', array('Attachment' => 0));
}
