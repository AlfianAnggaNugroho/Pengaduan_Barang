<?php
include "templates/header.php";
include "templates/sidebar-home.php";

// Buat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_finemine";

$mysqli = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Query untuk menghitung jumlah data berdasarkan status
$querySelesai = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE status = 'Selesai diproses'";
$querySedangDiproses = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE status = 'Sedang diproses'";
$queryBelumDiproses = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE status = 'Sedang diajukan'";

$resultSelesai = $mysqli->query($querySelesai);
$resultSedangDiproses = $mysqli->query($querySedangDiproses);
$resultBelumDiproses = $mysqli->query($queryBelumDiproses);

$dataSelesai = $resultSelesai->fetch_assoc();
$dataSedangDiproses = $resultSedangDiproses->fetch_assoc();
$dataBelumDiproses = $resultBelumDiproses->fetch_assoc();

// Tutup koneksi
$mysqli->close();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <!-- Info Boxes -->
        <div class="row">
          <?php generateInfoBox("Selesai Diproses", $dataSelesai['jumlah'], null, "linear-gradient(to left, #642EFE, green)", "data-pengaduan.php?status=selesai"); ?>
          <?php generateInfoBox("Sedang Diproses", $dataSedangDiproses['jumlah'], null, "linear-gradient(to left, #642EFE, blue)", "data-pengaduan.php?status=sedang"); ?>
          <?php generateInfoBox("Belum Diproses", $dataBelumDiproses['jumlah'], null, "linear-gradient(to left, #642EFE, red)", "data-pengaduan.php?status=belum"); ?>
        </div>
        <!-- Add a container for the chart -->
        <div class="chart-container">
          <canvas id="statusChart" width="400" height="150"></canvas>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Fetch data from the server
      fetch('function.php')
        .then(response => response.json())
        .then(data => {
          // Extracting data for Chart.js
          const labels = data.map(item => item.status);
          const values = data.map(item => item.jumlah);

          // Creating a bar chart
          const ctx = document.getElementById('statusChart').getContext('2d');
          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Diagram Data Pengaduan',
                data: values,
                backgroundColor: [
                  'rgba(25, 25, 112, 0.4)',
                  'rgba(25, 25, 112, 0.6)',
                  'rgba(25, 25, 112, 0.8)',
                  'rgba(25, 25, 112, 1)'
                ],
                borderColor: 'rgba(25, 25, 112, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                x: {
                  beginAtZero: true
                },
                y: {
                  beginAtZero: true
                }
              }
            }
          });

        });
    });
    </script>
  </section>
  <!-- /.content -->
</div>

<?php
include "templates/footer.php";
?>

<?php
function generateInfoBox($title, $value, $additionalInfo, $bgColor, $link = null)
{
?>
<div class="col-12 col-sm-6 col-md-4">
  <div class="info-box">
    <span class="info-box-icon elevation-1" style="background: <?php echo $bgColor; ?>; color: white;"><i
        class="fas fa-database"></i></span>
    <div class="info-box-content">
      <span class="info-box-text"><?php echo $title; ?></span>
      <span class="info-box-number">
        <?php if (!empty($value)) : ?>
        <?php echo $value; ?> Data Pengajuan
        <?php if (!is_null($additionalInfo)) : ?>
        <div style="font-size: 9pt;">Jumlah <b><?php echo $additionalInfo; ?></b> Data</div>
        <?php endif; ?>
        <?php else : ?>
        Belum ada data.
        <?php endif; ?>
      </span>
      <?php if (!empty($link)) : ?>
      <a href="<?php echo $link; ?>" style="font-size: 9pt; color:black;"><i class="fas fa-eye"></i> Lihat data</a>
      <?php endif; ?>
    </div>
    <!-- /.info-box-content -->
  </div>
  <!-- /.info-box -->
</div>
<?php
}
?>