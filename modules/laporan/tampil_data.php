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
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-file-alt fa-fw mr-2"></i>Laporan</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Filter Data Transaksi</h6>
      </div>
      <div class="card-body">
        <!-- form filter data -->
        <form action="modules/laporan/cetak.php" method="post" target="_blank" class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal Awal <span class="text-danger">*</span></label>
                <input type="text" name="tanggal_awal" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                <div class="invalid-feedback">Tanggal awal tidak boleh kosong.</div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal Akhir <span class="text-danger">*</span></label>
                <input type="text" name="tanggal_akhir" class="form-control date-picker" data-date-format="dd-mm-yyyy" autocomplete="off" required>
                <div class="invalid-feedback">Tanggal akhir tidak boleh kosong.</div>
              </div>
            </div>
          </div>

          <hr class="mt-4">

          <div class="form-group pt-3">
            <!-- button cetak laporan -->
            <button type="submit" class="btn btn-info btn-icon-split">
              <span class="icon"><i class="fas fa-print"></i></span>
              <span class="text pl-4 pr-4">Cetak</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>