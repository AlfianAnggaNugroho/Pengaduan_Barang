<?php
include "templates/header-report.php";
include "templates/sidebar-report.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Report Tahunan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Report</a></li>
            <li class="breadcrumb-item active">Report Tahunan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-book mr-3"></i>Data Pengaduan Kehilangan Barang</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="table-report" width="100%">
            <thead align="center" style="background: linear-gradient(to left, #642EFE, #000066); color: white;">
              <th>Kode.</th>
              <th>Nama Pelapor</th>
              <th>Tanggal Lapor</th>
              <th>Nomor Penerbangan</th>
              <th>Jenis Barang</th>
              <th>Status</th>
              <th>Lokasi Penyimpanan</th>
              <th>Status Pengambilan</th>
            </thead>
            <tbody align="center">
              <?php
                $year1 = $_POST['year1'];
                $year2 = $_POST['year2'];
                $data = query("SELECT * FROM pengaduan WHERE YEAR(tgl_lapor) BETWEEN '$year1' AND '$year2' ORDER BY tgl_lapor DESC");
                foreach ($data as $d) :
                ?>
              <tr>
                <td><?= $d['id']; ?></td>
                <td><?= $d['n_pelapor']; ?></td>
                <td><?= $d['tgl_lapor']; ?></td>
                <td><?= $d['nopen']; ?></td>
                <td><?= $d['jenis_brg']; ?></td>
                <td><?= $d['status']; ?></td>
                <td><?= $d['ket_penyimpanan']; ?></td>
                <td><?= $d['keterangan']; ?></td>
              </tr>
              <?php
                endforeach;
                ?>
            </tbody>
            <tfoot align="center">
              <th>Kode.</th>
              <th>Nama Pelapor</th>
              <th>Tanggal Lapor</th>
              <th>Nomor Penerbangan</th>
              <th>Jenis Barang</th>
              <th>Status</th>
              <th>Lokasi Penyimpanan</th>
              <th>Status Pengambilan</th>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<?php
include "templates/footer.php";
?>