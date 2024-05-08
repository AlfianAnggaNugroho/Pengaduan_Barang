<?php
include "templates/header.php";
include "templates/sidebar-pengaduan.php";

if (isset($_POST['submit'])) {
  if (updatePengaduan($_POST) > 0) {
    echo "<script>alert('Update data successfully!'); window.location='data-pengaduan.php';</script>";
    } else {
        echo "<script>alert('Data update failed or you did not make any changes!'); window.location='data-pengaduan.php';</script>";
    }
  }

$id = $_GET['id'];
$data = query("SELECT * FROM pengaduan WHERE id = '$id'");
foreach ($data as $d) :
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
  // Ambil elemen status
  var statusElement = document.querySelector('input[name="status"]:checked');

  // Periksa status awal
  checkStatus(statusElement);

  // Tambahkan event listener untuk perubahan status
  document.querySelectorAll('input[name="status"]').forEach(function(statusInput) {
    statusInput.addEventListener("change", function() {
      checkStatus(this);
    });
  });

  // Fungsi untuk memeriksa dan menampilkan/menyembunyikan form
  function checkStatus(element) {
    var updatePengaduanForm = document.querySelector('.update-pengaduan');
    if (element.value === 'Selesai diproses') {
      updatePengaduanForm.style.display = 'block';
    } else {
      updatePengaduanForm.style.display = 'none';
    }
  }
});
</script>

<style>
/* Warna teks dan border untuk Belum Diambil */
#status_belum_diambil_label {
  color: red;
  border: 1px solid red;
  border-radius: 5px;
  padding: 3px;
  margin-right: 5px;
}

/* Warna teks dan border untuk Sudah Diambil */
#status_sudah_diambil_label {
  color: green;
  border: 1px solid green;
  border-radius: 5px;
  padding: 3px;
  margin-right: 5px;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Pengaduan <?= $d['id']; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Report</a></li>
            <li class="breadcrumb-item active">Bulanan</li>
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
        <form action="" method="POST">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-2">
                <label for="id">Nomor Pengaduan :</label>
                <input type="text" name="id" id="id" class="form-control mb-3 bg-blue" style="cursor: default;"
                  value="<?= $d['id']; ?>" readonly>
              </div>
              <div class="col-md-2">
                <label for="tgl">Tanggal Pengaduan :</label>
                <input type="text" name="tgl" id="tgl" class="form-control mb-3" style="cursor: default;"
                  value="<?= $d['tgl_lapor']; ?>" readonly>
              </div>
              <div class="col-md-4">
                <label for="np">Nama Pelapor :</label>
                <input type="text" name="np" id="np" class="form-control mb-3" style="cursor: default;"
                  value="<?= $d['n_pelapor']; ?>" readonly>
              </div>
              <div class="col-md-4">
                <label for="npb">Nama Pemilik Barang :</label>
                <input type="text" name="npb" id="npb" class="form-control mb-3" style="cursor: default;"
                  value="<?= $d['n_pemilik']; ?>" readonly>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <label for="no_telp">Telephone (WhatsApp) :</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control mb-3" style="cursor: default;"
                  value="<?= $d['no_telp']; ?>" readonly>
              </div>
              <div class="col-md-2">
                <label for="tglkej">Tanggal Kejadian :</label>
                <input type="text" name="tglkej" id="tglkej" class="form-control mb-3" style="cursor: default;"
                  value="<?= $d['tgl_kjd']; ?>" readonly>
              </div>
              <div class="col-md-4">
                <label for="maskapai">Maskapai Penerbangan :</label>
                <input type="text" name="maskapai" id="maskapai" class="form-control mb-3" style="cursor: default;"
                  value="<?= $d['maskapai']; ?>" readonly>
              </div>
              <div class="col-md-4">
                <label for="nopen">Nomor Penerbangan :</label>
                <input type="text" name="nopen" id="nopen" class="form-control mb-3" style="cursor: default;"
                  value="<?= $d['nopen']; ?>" readonly>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <label for="detail_lok">Detail Lokasi Kejadian :</label>
                <textarea name="detail_lok" id="detail_lok" class="form-control mb-3" style="cursor: default;" rows="4"
                  readonly><?= $d['detail_lok']; ?></textarea>
              </div>
              <div class="col-md-4">
                <label for="ciri_barang">Detail Barang :</label>
                <textarea name="ciri_barang" id="ciri_barang" class="form-control mb-3" style="cursor: default;"
                  rows="4" readonly><?= $d['ciri_barang']; ?></textarea>
              </div>
              <div class="col-md-4">
                <label for="gambar">Foto Barang :</label>
                <?php
                  $gambarPath = '../assets/upload/' . $d['foto_brg'];
                  if (empty($d['foto_brg']) || !file_exists($gambarPath)) {
                      $gambarPath = '../assets/dist/img/default-150x150.png';
                  }
                  ?>
                <img src="<?= $gambarPath; ?>" alt="user image" width="230" height="140" style="border: 1px;">
              </div>

            </div>

            <div class="row">
              <div class="col-md-4"
                style="border: 1px solid #ced4da; border-radius: 5px; margin: 7px 7px; padding: 7px 10px;">
                <p><b>Status :</b></p>
                <?php
                    if ($d['status'] == 'Sedang diajukan') {
                  ?>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Sedang diajukan" id="opt1" name="status" class="custom-control-input"
                    checked>
                  <label class="custom-control-label" for="opt1">Sedang diajukan</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Sedang diproses" id="opt2" name="status" class="custom-control-input">
                  <label class="custom-control-label" for="opt2">Sedang diproses</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Selesai diproses" id="opt3" name="status" class="custom-control-input">
                  <label class="custom-control-label" for="opt3">Selesai diproses</label>
                </div>
                <?php
                    } elseif ($d['status'] == 'Sedang diproses') {
                    ?>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Sedang diajukan" id="opt1" name="status" class="custom-control-input">
                  <label class="custom-control-label" for="opt1">Sedang diajukan</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Sedang diproses" id="opt2" name="status" class="custom-control-input"
                    checked>
                  <label class="custom-control-label" for="opt2">Sedang diproses</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Selesai diproses" id="opt3" name="status" class="custom-control-input">
                  <label class="custom-control-label" for="opt3">Selesai diproses</label>
                </div>
                <?php                
                        } else {
                        ?>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Sedang diajukan" id="opt1" name="status" class="custom-control-input">
                  <label class="custom-control-label" for="opt1">Sedang diajukan</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Sedang diproses" id="opt2" name="status" class="custom-control-input">
                  <label class="custom-control-label" for="opt2">Sedang diproses</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" value="Selesai diproses" id="opt3" name="status" class="custom-control-input"
                    checked>
                  <label class="custom-control-label" for="opt3">Selesai diproses</label>
                </div>
                <?php
                        }
                        ?>
              </div>
            </div>

            <div class="update-pengaduan">
              <div class="row">
                <div class="col-md-4">
                  <label for="lok_pen">Lokasi Penemuan :</label>
                  <input type="text" name="lok_pen" id="lok_pen" class="form-control mb-3" style="cursor: default;"
                    value="<?= $d['lok_pen']; ?>">
                </div>
                <div class="col-md-4">
                  <label for="jenis_brg">Jenis Barang :</label>
                  <input type="text" name="jenis_brg" id="jenis_brg" class="form-control mb-3" style="cursor: default;"
                    value="<?= $d['jenis_brg']; ?>">
                </div>
                <div class="col-md-2">
                  <label for="warna_brg">Warna Barang :</label>
                  <input type="text" name="warna_brg" id="warna_brg" class="form-control mb-3" style="cursor: default;"
                    value="<?= $d['warna_brg']; ?>">
                </div>
                <div class="col-md-2">
                  <label for="merk_brg">Merk Barang :</label>
                  <input type="text" name="merk_brg" id="merk_brg" class="form-control mb-3" style="cursor: default;"
                    value="<?= $d['merk_brg']; ?>">
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mt-2">
                  <label for="isi_brg">Isi Barang :</label>
                  <textarea name="isi_brg" id="isi_brg" class="form-control mb-2"><?= $d['isi_brg']; ?></textarea>
                </div>
                <div class="col-md-4 mt-2">
                  <label for="ket_penyimpanan">Keterangan Lokasi Penyimpanan Barang :</label>
                  <textarea name="ket_penyimpanan" id="ket_penyimpanan"
                    class="form-control mb-2"><?= $d['ket_penyimpanan']; ?></textarea>
                </div>
                <div class="col-md-2 mt-2">
                  <label>Status Pengambilan :</label>
                  <div class="form-check mb-1">
                    <input type="radio" id="status_belum_diambil" name="keterangan" value="Belum Diambil"
                      class="form-check-input" <?= ($d['keterangan'] == 'Belum Diambil') ? 'checked' : ''; ?>>
                    <label id="status_belum_diambil_label" for="status_belum_diambil" class="form-check-label"><b>Belum
                        Diambil</b></label>
                  </div>
                  <div class="form-check">
                    <input type="radio" id="status_sudah_diambil" name="keterangan" value="Sudah Diambil"
                      class="form-check-input" <?= ($d['keterangan'] == 'Sudah Diambil') ? 'checked' : ''; ?>>
                    <label id="status_sudah_diambil_label" for="status_sudah_diambil" class="form-check-label"><b>Sudah
                        Diambil</b></label>
                  </div>
                </div>
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