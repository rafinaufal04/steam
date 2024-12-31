<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // pengecekan hak akses untuk menampilkan menu sesuai dengan hak akses
  // jika hak akses = Admin, tampilkan menu
  if ($_SESSION['hak_akses'] == 'Admin') {
    // pengecekan menu aktif
    // jika menu dashboard dipilih, menu dashboard aktif
    if ($_GET['module'] == 'dashboard') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu dashboard tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu layanan (tampil data / form entri / form ubah) dipilih, menu layanan aktif
    if ($_GET['module'] == 'layanan' || $_GET['module'] == 'form_entri_layanan' || $_GET['module'] == 'form_ubah_layanan') { ?>
      <div class="sidebar-heading">Data</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=layanan">
          <i class="fas fa-fw fa-clone"></i>
          <span>Layanan</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu layanan tidak aktif
    else { ?>
      <div class="sidebar-heading">Data</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=layanan">
          <i class="fas fa-fw fa-clone"></i>
          <span>Layanan</span>
        </a>
      </li>
    <?php
    }

    // jika menu transaksi (tampil data / form entri / form ubah) dipilih, menu transaksi aktif
    if ($_GET['module'] == 'transaksi' || $_GET['module'] == 'form_entri_transaksi' || $_GET['module'] == 'form_ubah_transaksi') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=transaksi">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Transaksi</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu transaksi tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=transaksi">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Transaksi</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu laporan dipilih, menu laporan aktif
    if ($_GET['module'] == 'laporan') { ?>
      <div class="sidebar-heading">Laporan</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=laporan">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Laporan</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu laporan tidak aktif
    else { ?>
      <div class="sidebar-heading">Laporan</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=laporan">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Laporan</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu manajemen user (tampil data / form entri / form ubah) dipilih, menu manajemen user aktif
    if ($_GET['module'] == 'user' || $_GET['module'] == 'form_entri_user' || $_GET['module'] == 'form_ubah_user') { ?>
      <div class="sidebar-heading">Pengaturan</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=user">
          <i class="fas fa-fw fa-user"></i>
          <span>Manajemen User</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu manajemen user tidak aktif
    else { ?>
      <div class="sidebar-heading">Pengaturan</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=user">
          <i class="fas fa-fw fa-user"></i>
          <span>Manajemen User</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
  }
  // jika hak akses = User, tampilkan menu
  elseif ($_SESSION['hak_akses'] == 'User') {
    // pengecekan menu aktif
    // jika menu dashboard dipilih, menu dashboard aktif
    if ($_GET['module'] == 'dashboard') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu dashboard tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu layanan (tampil data / form entri / form ubah) dipilih, menu layanan aktif
    if ($_GET['module'] == 'layanan' || $_GET['module'] == 'form_entri_layanan' || $_GET['module'] == 'form_ubah_layanan') { ?>
      <div class="sidebar-heading">Data</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=layanan">
          <i class="fas fa-fw fa-clone"></i>
          <span>Layanan</span>
        </a>
      </li>
    <?php
    }
    // jika tidak dipilih, menu layanan tidak aktif
    else { ?>
      <div class="sidebar-heading">Data</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=layanan">
          <i class="fas fa-fw fa-clone"></i>
          <span>Layanan</span>
        </a>
      </li>
    <?php
    }

    // jika menu transaksi (tampil data / form entri / form ubah) dipilih, menu transaksi aktif
    if ($_GET['module'] == 'transaksi' || $_GET['module'] == 'form_entri_transaksi' || $_GET['module'] == 'form_ubah_transaksi') { ?>
      <li class="nav-item active">
        <a class="nav-link" href="?module=transaksi">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Transaksi</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu transaksi tidak aktif
    else { ?>
      <li class="nav-item">
        <a class="nav-link" href="?module=transaksi">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Transaksi</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }

    // jika menu laporan dipilih, menu laporan aktif
    if ($_GET['module'] == 'laporan') { ?>
      <div class="sidebar-heading">Laporan</div>

      <li class="nav-item active">
        <a class="nav-link" href="?module=laporan">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Laporan</span>
        </a>
      </li>

      <hr class="sidebar-divider">
    <?php
    }
    // jika tidak dipilih, menu laporan tidak aktif
    else { ?>
      <div class="sidebar-heading">Laporan</div>

      <li class="nav-item">
        <a class="nav-link" href="?module=laporan">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Laporan</span>
        </a>
      </li>
    <?php
    }
  }
}
?>