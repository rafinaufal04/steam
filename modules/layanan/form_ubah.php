<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // mengecek data GET "id_layanan"
  if (isset($_GET['id'])) {
    // ambil data GET dari button ubah
    $id_layanan = $_GET['id'];

    // sql statement untuk menampilkan data dari tabel "tbl_layanan" berdasarkan "id_layanan"
    $query = mysqli_query($mysqli, "SELECT * FROM tbl_layanan WHERE id_layanan='$id_layanan'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>
  <div class="container-fluid">
    <!-- judul halaman -->
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-clone fa-fw mr-2"></i>Layanan</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <!-- judul form -->
        <h6 class="m-0 font-weight-bold">Ubah Data Layanan</h6>
      </div>
      <div class="card-body">
        <!-- form ubah data -->
        <form action="modules/layanan/proses_ubah.php" method="post" class="needs-validation" novalidate>
          <input type="hidden" name="id_layanan" value="<?php echo $data['id_layanan']; ?>">

          <div class="form-group col-lg-5 pl-0">
            <label>Nama Layanan <span class="text-danger">*</span></label>
            <input type="text" name="nama_layanan" class="form-control" autocomplete="off" value="<?php echo $data['nama_layanan']; ?>" required>
            <div class="invalid-feedback">Nama layanan tidak boleh kosong.</div>
          </div>

          <div class="form-group col-lg-5 pl-0">
            <label>Biaya <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
              <input type="text" name="biaya" class="form-control mask_money" autocomplete="off" value="<?php echo number_format($data['biaya'], 0, '', '.'); ?>" required>
              <div class="invalid-feedback">Biaya tidak boleh kosong.</div>
            </div>
          </div>

          <hr class="mt-5">

          <div class="form-group pt-3">
            <!-- button simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-info pl-4 pr-4 mr-2">
            <!-- button kembali ke halaman tampil data -->
            <a href="?module=layanan" class="btn btn-secondary pl-4 pr-4">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>