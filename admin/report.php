<?php
include "templates/header-report.php";
include "templates/sidebar-report.php";

// Inisialisasi tanggal awal dan akhir
$tglAwal = isset($_POST['tglAwal']) ? htmlspecialchars($_POST['tglAwal']) : date('Y-m-d');
$tglAkhir = isset($_POST['tglAkhir']) ? htmlspecialchars($_POST['tglAkhir']) : date('Y-m-d');

// Filter status pengajuan dan status pengambilan
$statusPengajuanFilter = isset($_POST['statusPengajuan']) ? htmlspecialchars($_POST['statusPengajuan']) : '';
$statusPengambilanFilter = isset($_POST['statusPengambilan']) ? htmlspecialchars($_POST['statusPengambilan']) : '';

// Logika untuk menampilkan data sesuai kondisi
if (isset($_POST['btnTampilkan'])) {
  // Query dengan filter status pengajuan dan status pengambilan
  $query = "SELECT * FROM pengaduan WHERE tgl_lapor BETWEEN '$tglAwal' AND '$tglAkhir'";

  // Tambahkan filter status pengajuan jika dipilih
  if (!empty($statusPengajuanFilter)) {
    $query .= " AND status = '$statusPengajuanFilter'";
  }

  // Tambahkan filter status pengambilan jika dipilih
  if (!empty($statusPengambilanFilter)) {
    $query .= " AND keterangan = '$statusPengambilanFilter'";
  }

  // Eksekusi query
  $data = query($query);
} else {
  // Jika tombol "Tampilkan" belum ditekan
  $data = [];
}

// Query untuk mendapatkan daftar status pengajuan dan status pengambilan unik dari database
$statusPengajuanOptions = query("SELECT DISTINCT status FROM pengaduan");
$statusPengambilanOptions = query("SELECT DISTINCT keterangan FROM pengaduan");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Report</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Report</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <!-- Form untuk memilih tanggal awal dan akhir -->
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" id="reportForm">
          <div class="col-md-12">
            <!-- Tanggal Awal dan Tanggal Akhir -->
            <div class="row mb-2">
              <div class="col-md-3">
                <label for="tglAwal">Periode Tanggal Awal</label>
                <input type="date" class="form-control" id="tglAwal" name="tglAwal" placeholder="Tanggal Awal"
                  value="<?= $tglAwal; ?>">
              </div>
              <div class="col-md-3">
                <label for="tglAkhir">Periode Tanggal Akhir</label>
                <input type="date" class="form-control" id="tglAkhir" name="tglAkhir" placeholder="Tanggal Akhir"
                  value="<?= $tglAkhir; ?>">
              </div>
              <div class="col-md-auto ml-auto">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-secondary btn-block" onclick="resetForm()"><i
                    style="margin-right:5px" class="fas fa-undo"></i>Reset</button>
              </div>
              <div class="col-md-2">
                <label>&nbsp;</label>
                <button name="btnTampilkan" type="submit" class="btn btn-primary btn-block">
                  <i style="margin-right:5px" class="fas fa-eye"></i>Tampilkan Data
                </button>
              </div>
            </div>


            <!-- Dropdown untuk filter status pengajuan dan status pengambilan -->
            <div class="row">
              <div class="col-md-3 mb-2">
                <label for="statusPengajuan" class="text-left">Status Pengajuan</label>
                <select class="form-control" id="statusPengajuan" name="statusPengajuan">
                  <option value="" selected>Semua Status Pengajuan</option>
                  <?php foreach ($statusPengajuanOptions as $option) : ?>
                  <option value="<?= $option['status']; ?>"><?= $option['status']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-3 mb-2">
                <label for="statusPengambilan" class="text-left">Status Pengambilan</label>
                <select class="form-control" id="statusPengambilan" name="statusPengambilan">
                  <option value="" selected>Semua Status Pengambilan</option>
                  <?php foreach ($statusPengambilanOptions as $option) : ?>
                  <option value="<?= $option['keterangan']; ?>"><?= $option['keterangan']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-2 ml-auto">
                <label>&nbsp;</label>
                <a id="cetakReportButton"
                  href="cetak.php?awal=<?= $tglAwal; ?>&akhir=<?= $tglAkhir; ?>&pengajuan=<?= $statusPengajuanFilter; ?>&pengambilan=<?= $statusPengambilanFilter; ?>"
                  target="_blank" class="btn btn-warning btn-block" role="button">
                  <i style="margin-right:5px" class="fas fa-print"></i> Cetak Report
                </a>
              </div>
            </div>
            <span style="color: red;">*</span><small>Sebelum mencetak harap pilih tanggal awal dan tanggal akhir setelah
              itu tekan tampilkan data untuk
              bisa mencetak!</small>
          </div>
        </form>


      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-report" id="table" width="100%">
            <thead>
              <th>Kode</th>
              <th>Nama Pelapor</th>
              <th>Tgl Lapor</th>
              <th>No Penerbangan</th>
              <th>Jenis Barang</th>
              <th>Status Pengajuan</th>
              <th>Status Pengambilan</th>
            </thead>
            <tbody>
              <?php foreach ($data as $d) : ?>
              <tr>
                <td><?= $d['id']; ?></td>
                <td><?= $d['n_pelapor']; ?></td>
                <td><?= $d['tgl_lapor']; ?></td>
                <td><?= $d['nopen']; ?></td>
                <td><?= $d['jenis_brg']; ?></td>
                <td><?= $d['status']; ?></td>
                <td><?= $d['keterangan']; ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </section>

  <script>
  function resetForm() {
    // Mengambil referensi ke elemen formulir dan tanggal awal/akhir
    var form = document.getElementById('reportForm');
    var tglAwalInput = document.getElementById('tglAwal');
    var tglAkhirInput = document.getElementById('tglAkhir');
    var statusPengajuanSelect = document.getElementById('statusPengajuan');
    var statusPengambilanSelect = document.getElementById('statusPengambilan');

    // Mengosongkan nilai tanggal awal, akhir, status pengajuan, dan status pengambilan
    tglAwalInput.value = '';
    tglAkhirInput.value = '';
    statusPengajuanSelect.value = '';
    statusPengambilanSelect.value = '';

    // Mengosongkan tabel
    var tableBody = document.querySelector('#table tbody');
    tableBody.innerHTML = ''; // Mengosongkan isi tabel

  }
  </script>

  <!-- /.content -->
</div>
<?php
include "templates/footer.php";
?>