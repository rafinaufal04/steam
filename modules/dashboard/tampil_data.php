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
    <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-fw fa-tachometer-alt mr-2"></i>Dashboard</h1>
    <!-- menampilkan pesan selamat datang -->
    <div class="alert alert-info alert-dismissible fade show py-3 mb-4" role="alert">
      <i class="fas fa-user mr-2"></i>Selamat datang kembali <strong><?php echo $_SESSION['nama_user']; ?></strong> di Aplikasi Jasa Cuci Mobil dan Motor. Anda login sebagai <strong><?php echo $_SESSION['hak_akses']; ?></strong>.
    </div>

    <div class="row">
      <!-- menampilkan informasi jumlah data layanan -->
      <div class="col-lg-3 col-md-12 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-info mb-2">Layanan</div>
                <?php
                // sql statement untuk menampilkan jumlah data dari tabel "tbl_layanan"
                $query = mysqli_query($mysqli, "SELECT * FROM tbl_layanan")
                                                or die('Ada kesalahan pada query jumlah data layanan : ' . mysqli_error($mysqli));
                // ambil jumlah data dari hasil query
                $jumlah_layanan = mysqli_num_rows($query);
                ?>
                <!-- tampilkan jumlah data -->
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_layanan; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clone fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- menampilkan informasi jumlah data transaksi -->
      <div class="col-lg-3 col-md-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-warning mb-2">Transaksi</div>
                <?php
                // sql statement untuk menampilkan jumlah data dari tabel "tbl_transaksi"
                $query = mysqli_query($mysqli, "SELECT * FROM tbl_transaksi")
                                                or die('Ada kesalahan pada query jumlah data transaksi : ' . mysqli_error($mysqli));
                // ambil jumlah data dari hasil query
                $jumlah_transaksi = mysqli_num_rows($query);
                ?>
                <!-- tampilkan jumlah data -->
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_transaksi; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- menampilkan informasi jumlah total pendapatan -->
      <div class="col-lg-3 col-md-12 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-success mb-2">Total Pendapatan</div>
                <?php
                // sql statement untuk menampilkan jumlah "total_biaya" dari tabel "tbl_transaksi"
                $query = mysqli_query($mysqli, "SELECT SUM(total_biaya) as total_pendapatan FROM tbl_transaksi")
                                                or die('Ada kesalahan pada query jumlah total pendapatan : ' . mysqli_error($mysqli));
                // ambil data hasil query
                $data = mysqli_fetch_assoc($query);
                // buat variabel untuk menampilkan data
                $total_pendapatan = $data['total_pendapatan'];
                ?>
                <!-- tampilkan data -->
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo number_format($total_pendapatan, 0, '', '.'); ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- menampilkan informasi jumlah data pengguna aplikasi -->
      <div class="col-lg-3 col-md-12 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="font-weight-bold text-primary mb-2">Pengguna Aplikasi</div>
                <?php
                // sql statement untuk menampilkan jumlah data dari tabel "tbl_user"
                $query = mysqli_query($mysqli, "SELECT * FROM tbl_user")
                                                or die('Ada kesalahan pada query jumlah data user : ' . mysqli_error($mysqli));
                // ambil jumlah data dari hasil query
                $jumlah_user = mysqli_num_rows($query);
                ?>
                <!-- tampilkan jumlah data -->
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_user; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-user fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- grafik total pendapatan per layanan -->
      <div class="col-lg-6 col-md-12 mt-3 mb-5">
        <div class="card shadow">
          <div class="card-header py-3">
            <!-- judul grafik -->
            <h6 class="m-0 font-weight-bold ">Total Pendapatan Per Layanan</h6>
          </div>
          <div class="card-body">
            <div class="chart-bar">
              <!-- menampilkan grafik -->
              <canvas id="grafikPendapatan"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- grafik jumlah transaksi per layanan -->
      <div class="col-lg-6 col-md-12 mt-3 mb-5">
        <div class="card shadow">
          <div class="card-header py-3">
            <!-- judul grafik -->
            <h6 class="m-0 font-weight-bold ">Jumlah Transaksi Per Layanan</h6>
          </div>
          <div class="card-body">
            <div class="chart-bar">
              <!-- menampilkan grafik -->
              <canvas id="grafikTransaksi"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    <?php
    // sql statement untuk menampilkan data "nama_layanan" dari tabel "tbl_layanan"
    $query_layanan = mysqli_query($mysqli, "SELECT nama_layanan FROM tbl_layanan")
                                            or die('Ada kesalahan pada query tampil data layanan : ' . mysqli_error($mysqli));

    // sql statement untuk menampilkan jumlah "total_biaya" dari tabel "tbl_transaksi" berdasarkan "layanan"
    $query_pendapatan = mysqli_query($mysqli, "SELECT a.nama_layanan, SUM(b.total_biaya) as total_pendapatan
                                              FROM tbl_layanan as a LEFT JOIN tbl_transaksi as b ON a.id_layanan=b.layanan 
                                              GROUP BY a.id_layanan")
                                              or die('Ada kesalahan pada query jumlah total pendapatan : ' . mysqli_error($mysqli));
    ?>

    // grafik total pendapatan per layanan (Bar Chart)
    var ctx = document.getElementById("grafikPendapatan");
    var grafikPendapatan = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          <?php while ($data = mysqli_fetch_assoc($query_layanan)) {
            echo '"' . $data['nama_layanan'] . '",';
          } 
          ?>
        ],
        datasets: [{
          label: "Total Pendapatan",
          backgroundColor: ['#36b9cc', '#1cc88a', '#4e73df', '#f6c23e', '#e74a3b'],
          hoverBackgroundColor: ['#2c9faf', '#17a673', '#2e59d9', '#f4b619', '#e02d1b'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
          data: [
            <?php while ($data = mysqli_fetch_assoc($query_pendapatan)) {
              echo '"' . $data['total_pendapatan'] . '",';
            } 
            ?>
          ],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false,
              drawBorder: false
            },
            maxBarThickness: 70,
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
              maxTicksLimit: 5,
              padding: 10
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ' : Rp. ' + tooltipItem.yLabel;
            }
          }
        },
      }
    });

    <?php
    // sql statement untuk menampilkan data "nama_layanan" dari tabel "tbl_layanan"
    $query_layanan = mysqli_query($mysqli, "SELECT nama_layanan FROM tbl_layanan")
                                            or die('Ada kesalahan pada query tampil data layanan : ' . mysqli_error($mysqli));

    // sql statement untuk menampilkan jumlah data transaksi dari tabel "tbl_transaksi" berdasarkan "layanan"
    $query_transaksi = mysqli_query($mysqli, "SELECT a.nama_layanan, COUNT(b.id_transaksi) as jumlah 
                                              FROM tbl_layanan as a LEFT JOIN tbl_transaksi as b ON a.id_layanan=b.layanan 
                                              GROUP BY a.id_layanan")
                                              or die('Ada kesalahan pada query jumlah data transaksi : ' . mysqli_error($mysqli));
    ?>

    // grafik jumlah transaksi per layanan (Pie Chart)
    var ctx = document.getElementById("grafikTransaksi");
    var grafikTransaksi = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: [ 
          <?php 
          while ($data = mysqli_fetch_assoc($query_layanan)) {
            echo '"' . $data['nama_layanan'] . '",';
          } 
          ?>
        ],
        datasets: [{
          data: [
            <?php 
            while ($data = mysqli_fetch_assoc($query_transaksi)) {
              echo '"' . $data['jumlah'] . '",';
            } 
            ?>
          ],
          backgroundColor: ['#36b9cc', '#1cc88a', '#4e73df', '#f6c23e', '#e74a3b'],
          hoverBackgroundColor: ['#2c9faf', '#17a673', '#2e59d9', '#f4b619', '#e02d1b'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });
  </script>
<?php } ?>