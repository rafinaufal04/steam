<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // mengecek data GET "id_transaksi"
  if (isset($_GET['id'])) {
    // ambil data GET dari button ubah
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
  <div class="container-fluid">
    <!-- judul halaman -->
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-clipboard-list fa-fw mr-2"></i>Transaksi</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Ubah Data Transaksi</h6>
      </div>
      <div class="card-body">
        <!-- form ubah data -->
        <form action="modules/transaksi/proses_ubah.php" method="post" class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>ID Transaksi <span class="text-danger">*</span></label>
                <input type="text" name="id_transaksi" class="form-control" value="<?php echo $data['id_transaksi']; ?>" readonly>
              </div>
            </div>

            <div class="col-md-5 ml-auto">
              <div class="form-group">
                <label>Tanggal <span class="text-danger">*</span></label>
                <input type="text" name="tanggal" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?php echo date('d-m-Y', strtotime($data['tanggal'])); ?>" required>
                <div class="invalid-feedback">Tanggal tidak boleh kosong.</div>
              </div>
            </div>
          </div>

          <hr class="mt-3 mb-4">

          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>Nama Pelanggan <span class="text-danger">*</span></label>
                <input type="text" name="nama_pelanggan" class="form-control" autocomplete="off" value="<?php echo $data['nama_pelanggan']; ?>" required>
                <div class="invalid-feedback">Nama pelanggan tidak boleh kosong.</div>
              </div>
            </div>

            <div class="col-md-5 ml-auto">
              <div class="form-group">
                <label>Plat Nomor Kendaraan <span class="text-danger">*</span></label>
                <input type="text" name="plat_nomor_kendaraan" class="form-control text-uppercase" autocomplete="off" value="<?php echo $data['plat_nomor_kendaraan']; ?>" required>
                <div class="invalid-feedback">Plat nomor kendaraan tidak boleh kosong.</div>
              </div>
            </div>
          </div>

          <hr class="mt-3 mb-4">

          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>Layanan <span class="text-danger">*</span></label>
                <select id="layanan" name="layanan" class="form-control" autocomplete="off" required>
                  <option value="<?php echo $data['layanan']; ?>"><?php echo $data['nama_layanan']; ?></option>
                  <option disabled value="">-- Pilih --</option>
                  <?php
                  // sql statement untuk menampilkan data dari tabel "tbl_layanan"
                  $query_layanan = mysqli_query($mysqli, "SELECT id_layanan, nama_layanan FROM tbl_layanan ORDER BY nama_layanan ASC")
                                                          or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
                  // ambil data hasil query
                  while ($data_layanan = mysqli_fetch_assoc($query_layanan)) {
                    // tampilkan data
                    echo "<option value='$data_layanan[id_layanan]'>$data_layanan[nama_layanan]</option>";
                  }
                  ?>
                </select>
                <div class="invalid-feedback">Layanan tidak boleh kosong.</div>
              </div>
            </div>

            <div class="col-md-5 ml-auto">
              <div class="form-group">
                <label>Biaya <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                  <input type="text" id="biaya" name="biaya" class="form-control" value="<?php echo number_format($data['total_biaya'], 0, '', '.'); ?>" readonly>
                </div>
              </div>
            </div>
          </div>

          <hr class="mt-5">

          <div class="form-group pt-3">
            <!-- button simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-info pl-4 pr-4 mr-2">
            <!-- button kembali ke halaman tampil data -->
            <a href="?module=transaksi" class="btn btn-secondary pl-4 pr-4">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      // menampilkan data layanan dari select box ke textfield
      $('#layanan').change(function() {
        // mengambil value dari "id_layanan"
        var id_layanan = $('#layanan').val();

        $.ajax({
          type: "GET",                                // mengirim data dengan method GET 
          url: "modules/transaksi/get_layanan.php",   // proses get data berdasarkan "id_layanan"
          data: {id_layanan: id_layanan},             // data yang dikirim
          dataType: "JSON",                           // tipe data JSON
          success: function(result) {                 // ketika proses get data selesai
            // tampilkan data ke textfield biaya
            $('#biaya').val(result);
          }
        });
      });
    });
  </script>
<?php } ?>