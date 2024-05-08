<?php
include 'templates/header2.php';
require 'function.php';

if (isset($_POST['submit'])) {
    if (insertPengaduan($_POST) > 0) {
        echo "<script>alert('Data pengaduan Anda berhasil terkirim.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Data pengaduan Anda gagal terkirim.'); window.location='form-pengaduan.php';</script>";
    }
}

$query = mysqli_query($conn, "SELECT max(id) as kodeTerbesar FROM pengaduan");
$r = mysqli_fetch_array($query);
$kodeBarang = $r['kodeTerbesar'];

$urutan = (int) substr($kodeBarang, 4, 4);
$urutan++;

$huruf = "NP";
$kodeBarang = $huruf . sprintf("%04s", $urutan);
?>

<style>
/* Gaya CSS lainnya */
.scroll-form {
  max-height: 430px;
  overflow-y: auto;
  margin-top: 20px;
  padding: 20px;
  /* Sesuaikan padding dengan preferensi desain Anda */
  background-color: rgba(255, 255, 255, 0.5);
  /* Warna hitam dengan tingkat kejernihan 0.5 (transparan) */
  border-radius: 10px;
  /* Tambahkan border-radius untuk sudut yang lebih lembut */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  /* Tambahkan efek bayangan */
  scrollbar-width: thin;
}

/* Gaya CSS khusus untuk Webkit (Chrome, Safari) */
.scroll-form::-webkit-scrollbar {
  width: 5px;
}

.scroll-form::-webkit-scrollbar-thumb {
  background-color: transparent;
}

.scroll-form::-webkit-scrollbar-track {
  background-color: transparent;
}

.btn-outline-success,
.btn-outline-danger {
  width: 130px;
}

/* Gaya CSS lainnya */
@media (max-width: 576px) {
  .logo {
    max-width: 100%;
  }

  .navbar-brand img {
    max-height: 40px;
  }
}

.text-code {
  font-size: 10pt;
}
</style>

<h1 style="margin-top: -40px;">Form Pengaduan Kehilangan Barang</h1>

<form action="" method="POST" enctype="multipart/form-data">
  <div class="scroll-form col-md-6">
    <div class="form-row">
      <div class="form-group">
        <label for="id">Nomor Pengaduan</label><span style="color: red;">*</span>
        <input type="text" name="id" id="id" class="form-control" value="<?= $kodeBarang; ?>"
          style="cursor: default; font-weight: bold; color:red" readonly>

        <p class="text-sm"><b class="text-code">Harap catat kode diatas untuk
            melakukan pengecekan
            sendiri
            melalui kolom pencarian</b>.</p>

        <div class="form-row">
          <div class="col-md-6">
            <label for="nama">Nama Pelapor</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="pemilik">Nama Pemilik Barang (Penumpang)</label>
            <input type="text" name="pemilik" id="pemilik" class="form-control" required>
          </div>
        </div>

        <div class="form-row mt-2">
          <div class="col-md-6">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
          </div>
          <div class="col-md-6">
            <label for="notelp">No Telephone (WhatsApp)</label>
            <input type="number" name="notelp" id="notelp" class="form-control" placeholder="08123456789" required>
          </div>
        </div>

        <div class="form-group mt-2">
          <label for="tglkejadian">Tanggal Kejadian</label>
          <div class="form-row ml-0">
            <span class="input-group-text fas fa-calendar-alt bg-dark"></span>
            <div class="col-md-5" style="margin-left:-6px;">
              <input type="date" name="tglkejadian" id="tglkejadian" class="form-control" style="cursor: pointer;"
                placeholder="Tanggal Kejadian" required>
            </div>
            <small class="form-text text-muted">Select Tanggal</small>
          </div>

          <div class="mt-2">
            <label for="detaillok">Detail Lokasi Kejadian</label>
            <textarea name="detaillok" id="detaillok" class="form-control" required></textarea>
          </div>
        </div>

        <div class="form-row mt-2">
          <div class="col-md-6">
            <label for="rute">Rute Penerbangan</label>
            <input type="text" name="rute" id="rute" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="maskapai">Maskapai Penerbangan</label>
            <input type="text" name="maskapai" id="maskapai" class="form-control" required>
          </div>
        </div>

        <div class="form-group mt-2">
          <label for="nopen">Nomor Penerbangan</label>
          <input type="text" name="nopen" id="nopen" class="form-control" required>
        </div>

        <div class="form-row mt-2">
          <div class="col-md-8">
            <label for="alamat">Alamat Lengkap</label>
            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
          </div>
          <div class="col-md-4">
            <label for="pos">Kode POS (Pelapor)</label>
            <input type="number" name="pos" id="pos" class="form-control" required>
          </div>
        </div>

        <div class="form-group mt-2">
          <label for="ciri">Ciri-Ciri Pemilik Barang/Penumpang</label>
          <textarea name="ciri" id="ciri" class="form-control"
            placeholder="- Tinggi dan Berat Badan&#10;- Jenis Kelamin&#10;- Jenis/Warna Pakaian yang Digunakan&#10;- Warna Rambut&#10;- Jenis Rambut"
            rows="5" required></textarea>
        </div>

        <div class="form-group">
          <label for="ciribrg">Ciri-Ciri Barang Hilang/Tertinggal</label>
          <textarea name="ciribrg" id="ciribrg" class="form-control"
            placeholder="- Jenis Barang (jelaskan secara terperinci termasuk : nama, warna, merk dan ukuran barang terkait)&#10;- Kronologi Kejadian"
            rows="5" required></textarea>
        </div>

        <div class="form-group">
          <label for="gambar">Gambar Barang (Opsional)</label>
          <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" style="height: 45px;">
          <small class="form-text text-muted">Informasi Tambahan (gambar atau foto barang terkait) *Optional</small>
        </div>
      </div>
    </div>
    <div class="form-row">
      <button class="btn btn-success mt-3 mr-3" type="submit" name="submit" style="width: 100px;"><span
          class="fas fa-paper-plane mr-2"></span>Kirim</button>
      <button class="btn btn-danger mt-3" type="reset" name="reset" style="width: 130px;"><span
          class="fas fa-undo mr-2"></span>Reset Form</button>
    </div>
  </div>

</form>



<?php
include 'templates/footer.php';
?>