<?php
require 'funct.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
  if (tambah_barang($_POST) > 0) {
      echo "<script>alert('Data Barang Anda berhasil terkirim.'); window.location='data-barang.php';</script>";
  } else {
      echo "<script>alert('Data Barang Anda gagal terkirim: " . mysqli_error($conn) . "'); window.location='tambah-barang.php';</script>";
  }
}

?>

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
          <h1>Tambah Data Barang Hilang/Tertinggal</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="data-barang.php">Barang</a></li>
            <li class="breadcrumb-item active">Tambah Data Barang Hilang/Tertinggal</li>
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
        <form action="" method="post" enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-2">
                <label for="tanggal">Tanggal Penemuan :</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control mb-3" style="cursor: default;">
              </div>
              <div class="col-md-6">
                <label for="lok_pen">Lokasi Penemuan :</label>
                <input type="text" name="lok_pen" id="lok_pen" class="form-control mb-3" style="cursor: default;">
              </div>
              <div class="col-md-4">
                <label for="jenis_brg">Jenis Barang :</label>
                <input type="text" name="jenis_brg" id="jenis_brg" class="form-control mb-3" style="cursor: default;">
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <label for="isi_brg">Isi Barang</label>
                <textarea name="isi_brg" id="isi_brg" class="form-control" placeholder="- Isi Barang" rows="4"
                  required></textarea>
              </div>
              <div class="col-md-2">
                <label for="warna_brg">Warna Barang :</label>
                <input type="text" name="warna_brg" id="warna_brg" class="form-control mb-3" style="cursor: default;">
              </div>
              <div class="col-md-2">
                <label for="merk_brg">Merk Barang :</label>
                <input type="text" name="merk_brg" id="merk_brg" class="form-control mb-3" style="cursor: default;">
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <label for="ket_penyimpanan">Keterangan Lokasi Penyimpanan</label>
                <textarea name="ket_penyimpanan" id="ket_penyimpanan" class="form-control" placeholder="- Isi Barang"
                  rows="4" required></textarea>
              </div>
              <div class="col-md-4">
                <label for="foto_brg">Foto Barang :</label>
                <input type="file" name="foto_brg" id="foto_brg" class="form-control mb-3" style="cursor: default;">
              </div>
            </div>

            <div class="row">
              <div class="col-md-8 mt-2">
                <button type="submit" value="submit" name="submit" class="btn btn-outline-success mr-2"
                  style="width: 100px;">
                  <span class="fas fa-check mr-2"></span>
                  Save
                </button>
                <button type="reset" value="reset" class="btn btn-outline-danger mr-2" style="width: 100px;">
                  <span class="fas fa-times mr-2"></span>
                  Reset
                </button>
                <a href="#" class="btn btn-outline-primary" onclick="history.back()" style="width: 100px;">
                  <span class="fas fa-arrow-left mr-2"></span>
                  Back
                </a>
              </div>
            </div>
          </div>
        </form>
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