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
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-info-circle fa-fw mr-2"></i>Tentang Aplikasi</h1>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="py-3">
          <div class="d-flex align-items-start">
            <div class="flex-shrink-0">
              <i class="fas fa-hashtag icon-hashtag"></i>
            </div>
            <div>
              <h5 class="lh-2 text-dark mb-3">Copyright</h5>
              <p>&copy; 2021 - <a href="https://pustakakoding.com/" target="_blank" class="text-brand text-decoration-none">Pustaka Koding</a> - Indra Styawantoro. All rights reserved.</p>
            </div>
          </div>
        </div>
        <div class="py-3">
          <div class="d-flex align-items-start">
            <div class="flex-shrink-0">
              <i class="fas fa-hashtag icon-hashtag"></i>
            </div>
            <div>
              <h5 class="lh-2 text-dark mb-3">Permissions</h5>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Private use</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Modification</p>
            </div>
          </div>
        </div>
        <div class="py-3">
          <div class="d-flex align-items-start">
            <div class="flex-shrink-0">
              <i class="fas fa-hashtag icon-hashtag"></i>
            </div>
            <div>
              <h5 class="lh-2 text-dark mb-3">Limitations</h5>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Commercial use</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Distribution</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Liability</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Warranty</p>
            </div>
          </div>
        </div>
        <div class="py-3">
          <div class="d-flex align-items-start">
            <div class="flex-shrink-0">
              <i class="fas fa-hashtag icon-hashtag"></i>
            </div>
            <div>
              <h5 class="lh-2 text-dark mb-3">Requirements</h5>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> PHP 8.0.<small>x</small></p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> MySQL 5.7.<small>x</small></p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> MySQLi Extension</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Bootstrap 4 (SB Admin 2)</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Font Awesome v5.15.3</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> jQuery v3.6.0</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> jQuery Easing v1.4.1</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> jQuery maskMoney v3.1.1</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> DataTables v1.10.<small>x</small></p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Datepicker</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Chart.js v2.9.4</p>
              <p><i class="far fa-circle fa-xs text-brand mr-2"></i> Dompdf v1.0.2</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>