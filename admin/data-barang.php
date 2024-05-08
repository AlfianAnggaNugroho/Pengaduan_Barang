<?php
include "templates/header.php";
include "templates/sidebar-barang.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Barang Hilang/Tertinggal</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Data Barang</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="col-md-4 mb-2"><a href="tambah-barang.php" class="btn btn-primary btn-sm"><i
          class="fas fa-database mr-3"></i>
        <i class="fas fa-plus" style="margin-right:5px;"></i> Tambah Data Barang Hilang/Tertinggal
      </a></div>
    <div class="card">
      <div class="card-header" style="background-color: rgba(255, 0, 0, 0.2);">
        <h3 class="card-title"><i class="fas fa-user-clock mr-3"></i>Belum Diambil</h3>
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
          <table class="table table-hover" id="table" width="100%">
            <thead align="center">
              <th>Tgl Penemuan</th>
              <th>Jenis Barang</th>
              <th>Warna Barang</th>
              <th>Lokasi Penemuan</th>
              <th width="160">Action</th>
            </thead>
            <tbody align="center">
              <?php
                $data = query("SELECT * FROM barang WHERE status='Belum Diambil'");
                foreach ($data as $d) :
                ?>

              <tr>
                <td><?= $d['tanggal']; ?></td>
                <td><?= $d['jenis_brg']; ?></td>
                <td><?= $d['warna_brg']; ?></td>
                <td><?= $d['lok_pen']; ?></td>
                <td><a href="detail-barang.php?id_barang=<?= $d['id_barang']; ?>"
                    class="btn btn-sm btn-outline-info mr-2" style="font-size: 15px; width: 80px;"><i
                      class="fas fa-search mr-1"></i>Detail</a>
                  <a href="delete-barang.php?id_barang=<?= $d['id_barang']; ?>" class="btn btn-sm btn-outline-danger"
                    style="font-size: 15px; width: 80px;"><i class="fas fa-trash-alt mr-1"></i>Delete</a>
                </td>
              </tr>
              <?php
                endforeach;
                ?>
            </tbody>
            <tfoot align="center">
              <th>Tgl Penemuan</th>
              <th>Jenis Barang</th>
              <th>Warna Barang</th>
              <th>Lokasi Penemuan</th>
              <th width="160">Action</th>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>

    <div class="card">
      <div class="card-header" style="background-color: rgba(0, 128, 0, 0.2);">
        <h3 class="card-title"><i class="fas fa-user-clock mr-3"></i>Sudah Diambil</h3>
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
          <table class="table table-hover" id="table2" width="100%">
            <thead align="center">
              <th>Tgl Penemuan</th>
              <th>Jenis Barang</th>
              <th>Warna Barang</th>
              <th>Lokasi Penemuan</th>
              <th width="160">Action</th>
            </thead>
            <tbody align="center">
              <?php
                $data = query("SELECT * FROM barang WHERE status='Sudah Diambil'");
                foreach ($data as $d) :
                ?>

              <tr>
                <td><?= $d['tanggal']; ?></td>
                <td><?= $d['jenis_brg']; ?></td>
                <td><?= $d['warna_brg']; ?></td>
                <td><?= $d['lok_pen']; ?></td>
                <td><a href="detail-barang.php?id_barang=<?= $d['id_barang']; ?>"
                    class="btn btn-sm btn-outline-info mr-2" style="font-size: 15px; width: 80px;"><i
                      class="fas fa-search mr-1"></i>Detail</a>
                  <a href="delete-barang.php?id_barang=<?= $d['id_barang']; ?>" class="btn btn-sm btn-outline-danger"
                    style="font-size: 15px; width: 80px;"><i class="fas fa-trash-alt mr-1"></i>Delete</a>
                </td>
              </tr>
              <?php
                endforeach;
                ?>
            </tbody>
            <tfoot align="center">
              <th>Tgl Penemuan</th>
              <th>Jenis Barang</th>
              <th>Warna Barang</th>
              <th>Lokasi Penemuan</th>
              <th width="160">Action</th>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </section>

  <!-- /.content -->
</div>
<?php
include "templates/footer.php";
?>