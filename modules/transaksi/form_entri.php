<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else { ?>
  <div class="container-fluid">
    <!-- judul halaman -->
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-clipboard-list fa-fw mr-2"></i>Transaksi</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Entri Data Transaksi</h6>
      </div>
      <div class="card-body">
        <!-- form entri data -->
        <form action="modules/transaksi/proses_simpan.php" method="post" class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <?php
                // membuat "id_transaksi"
                // sql statement untuk menampilkan 5 digit terakhir dari "id_transaksi" pada tabel "tbl_transaksi"
                $query = mysqli_query($mysqli, "SELECT RIGHT(id_transaksi,5) as nomor FROM tbl_transaksi ORDER BY id_transaksi DESC LIMIT 1")
                                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
                // ambil jumlah baris data hasil query
                $rows = mysqli_num_rows($query);

                // cek hasil query
                // jika "id_transaksi" sudah ada
                if ($rows <> 0) {
                  // ambil data hasil query
                  $data = mysqli_fetch_assoc($query);
                  // nomor urut "id_transaksi" yang terakhir + 1
                  $nomor_urut = $data['nomor'] + 1;
                }
                // jika "id_transaksi" belum ada
                else {
                  // nomor urut "id_transaksi" = 1
                  $nomor_urut = 1;
                }

                // menambahkan karakter "TR" diawal dan karakter "0" disebelah kiri nomor urut
                $id_transaksi = "TR-" . str_pad($nomor_urut, 5, "0", STR_PAD_LEFT);
                ?>
                <label>ID Transaksi <span class="text-danger">*</span></label>
                <!-- tampilkan "id_transaksi" -->
                <input type="text" name="id_transaksi" class="form-control" value="<?php echo $id_transaksi; ?>" readonly>
              </div>
            </div>

            <div class="col-md-5 ml-auto">
              <div class="form-group">
                <label>Tanggal <span class="text-danger">*</span></label>
                <input type="text" name="tanggal" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?php echo date("d-m-Y"); ?>" required>
                <div class="invalid-feedback">Tanggal tidak boleh kosong.</div>
              </div>
            </div>
          </div>

          <hr class="mt-3 mb-4">

          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <label>Nama Pelanggan <span class="text-danger">*</span></label>
                <input type="text" name="nama_pelanggan" class="form-control" autocomplete="off" required>
                <div class="invalid-feedback">Nama pelanggan tidak boleh kosong.</div>
              </div>
            </div>

            <div class="col-md-5 ml-auto">
              <div class="form-group">
                <label>Plat Nomor Kendaraan <span class="text-danger">*</span></label>
                <input type="text" name="plat_nomor_kendaraan" class="form-control text-uppercase" autocomplete="off" required>
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
                  <option selected disabled value="">-- Pilih --</option>
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
                  <input type="text" id="biaya" name="biaya" class="form-control" readonly>
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