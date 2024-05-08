<?php
include "templates/header.php";
include "templates/sidebar-barang.php";

if (isset($_POST['submit'])) {
    if (updateBarang($_POST) > 0) {
        echo "<script>alert('Update data successfully!'); window.location='data-barang.php';</script>";
    } else {
        echo "<script>alert('Data update failed or you did not make any changes!'); window.location='data-barang.php';</script>";
    }
}

$id_barang = $_GET['id_barang'];
$data = query("SELECT * FROM barang WHERE id_barang = '$id_barang'");
foreach ($data as $d) :
?>

<style>
.hidden-input {
  display: none;
}
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Barang Ditemukan (<?= $d['jenis_brg']; ?>)</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
            <li class="breadcrumb-item active">Detail Barang</li>
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
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="text" name="id_barang" id="id_barang" class="form-control mb-3 hidden-input"
            value="<?= $d['id_barang']; ?>" readonly>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-2">
                <label for="tanggal">Tanggal Penemuan :</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control mb-3" value="<?= $d['tanggal']; ?>">
              </div>
              <div class="col-md-6">
                <label for="lok_pen">Lokasi Penemuan :</label>
                <input type="text" name="lok_pen" id="lok_pen" class="form-control mb-3" value="<?= $d['lok_pen']; ?>">
              </div>
              <div class="col-md-4">
                <label for="jenis_brg">Jenis Barang :</label>
                <input type="text" name="jenis_brg" id="jenis_brg" class="form-control mb-3"
                  value="<?= $d['jenis_brg']; ?>">
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <label for="isi_brg">Isi Barang</label>
                <textarea name="isi_brg" id="isi_brg" class="form-control" placeholder="- Isi Barang" rows="4"
                  required><?= $d['isi_brg']; ?></textarea>
              </div>
              <div class="col-md-2">
                <label for="warna_brg">Warna Barang :</label>
                <input type="text" name="warna_brg" id="warna_brg" class="form-control mb-3"
                  value="<?= $d['warna_brg']; ?>">
              </div>
              <div class="col-md-2">
                <label for="merk_brg">Merk Barang :</label>
                <input type="text" name="merk_brg" id="merk_brg" class="form-control mb-3"
                  value="<?= $d['merk_brg']; ?>">
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-md-6">
                <label for="ket_penyimpanan">Keterangan Lokasi Penyimpanan</label>
                <textarea name="ket_penyimpanan" id="ket_penyimpanan" class="form-control" placeholder="- Isi Barang"
                  rows="4" required><?= $d['ket_penyimpanan']; ?></textarea>
              </div>
              <div class="col-md-2"
                style="border-radius: 5px; border: 1px solid <?php echo ($d['status'] == 'Belum Diambil') ? 'red;' : 'green;'; ?>">
                <p><b>Status :</b></p>
                <?php
                  if ($d['status'] == 'Belum Diambil') {
                  ?>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Belum Diambil" id="opt1" name="status" class="custom-control-input"
                    checked>
                  <label class="custom-control-label text-danger" for="opt1">Belum Diambil</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Sudah Diambil" id="opt2" name="status" class="custom-control-input">
                  <label class="custom-control-label text-success" for="opt2">Sudah Diambil</label>
                </div>
                <?php
                  } elseif ($d['status'] == 'Sudah Diambil') {
                  ?>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Belum Diambil" id="opt1" name="status" class="custom-control-input">
                  <label class="custom-control-label text-danger" for="opt1">Belum Diambil</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Sudah Diambil" id="opt2" name="status" class="custom-control-input"
                    checked>
                  <label class="custom-control-label text-success" for="opt2">Sudah Diambil</label>
                </div>
                <?php
                }
                ?>
              </div>
              <div class="col-md-4">
                <label for="foto_brg">Foto Barang :</label>
                <?php
                  $gambarPath = 'uploads/' . $d['foto_brg'];
                  if (empty($d['foto_brg']) || !file_exists($gambarPath)) {
                      $gambarPath = '../assets/dist/img/default-150x150.png';
                  }
                  ?>
                <img src="<?= $gambarPath; ?>" alt="user image" width="150" height="140" style="border: 1px;">
              </div>
            </div>

            <div class="row">
              <div class="col-md-8 mt-4">
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
      <?php
        endforeach;
        ?>

    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<?php
include "templates/footer.php";
?>