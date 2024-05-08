<?php
include 'templates/header.php';
require 'function.php';

// Ambil data chat dari database
$data2 = query("SELECT * FROM chat WHERE id = 1"); // Sesuaikan id dengan kondisi yang sesuai

?>
<style>
td {
  width: 300px;
}

.scroll-form {
  max-height: 430px;
  overflow-y: auto;
  padding: 10px;
  border: 1px solid #ddd;
  background-color: rgba(255, 255, 255, 0.7);
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  scrollbar-width: thin;
}

/* Hapus scrollbar default */
.scroll-form::-webkit-scrollbar {
  width: 12px;
  /* Atur lebar scrollbar */
}

/* Hapus track scrollbar */
.scroll-form::-webkit-scrollbar-track {
  background: transparent;
}

/* Gaya thumb scrollbar */
.scroll-form::-webkit-scrollbar-thumb {
  background-color: transparent;
  border: 3px solid transparent;
  border-radius: 10px;
}

/* Hover state pada thumb scrollbar */
.scroll-form::-webkit-scrollbar-thumb:hover {
  background-color: #ddd;
}

table {
  border-collapse: collapse;
}

#chatForm {
  display: none;
  /* Sembunyikan formulir chat secara default */
}

.chat-buttons {
  float: right;
  /* Agar div ditempatkan di sebelah kanan */
}

.chat-buttons button {
  margin-left: 5px;
  /* Memberikan jarak antara tombol WhatsApp dan Telegram */
}
</style>


<h2 class="display-5" style="margin-top: -50px; "><b>Status Pengaduan Anda</b></h2>
<div class="row">
  <div class="col-md-6">
    <?php
    $keyword = $_POST['keyword'];
    $data = query("SELECT * FROM pengaduan WHERE id = '$keyword'");

    if ($data) {
    ?>
    <div class="scroll-form">
      <table class="table table-bordered">
        <?php foreach ($data as $d) : ?>
        <tr>
          <th>Status</th>
          <td>:
            <?php if (isset($d['status']) && $d['status'] == 'Sedang diajukan') : ?>
            <span class="text-danger"><b><?= $d['status']; ?></b></span>
            <?php elseif (isset($d['status']) && $d['status'] == 'Sedang diproses') : ?>
            <span class="text-warning"><b><?= $d['status']; ?></b></span>
            <?php elseif (isset($d['status']) && $d['status'] == 'Selesai diproses') : ?>
            <span class="text-success"><b><?= $d['status']; ?></b></span>
            <?php endif; ?>
          </td>
        </tr>

        <tr>
          <th>Nomor Pengaduan</th>
          <td>: <?= isset($d['id']) ? $d['id'] : ''; ?></td>
        </tr>
        <tr>
          <th>Tanggal Pengaduan</th>
          <td>: <?= isset($d['tgl_lapor']) ? $d['tgl_lapor'] : ''; ?></td>
        </tr>
        <tr>
          <th>Nama Pelapor</th>
          <td>: <?= isset($d['n_pelapor']) ? $d['n_pelapor'] : ''; ?></td>
        </tr>

        <?php if (isset($d['status']) && $d['status'] == 'Selesai diproses') : ?>
        <!-- Tampilkan semua informasi jika status "Selesai diproses" -->
        <tr>
          <th>Lokasi Penemuan</th>
          <td>: <?= isset($d['lok_pen']) ? $d['lok_pen'] : ''; ?></td>
        </tr>
        <tr>
          <th>Jenis Barang</th>
          <td>: <?= isset($d['jenis_brg']) ? $d['jenis_brg'] : ''; ?></td>
        </tr>
        <tr>
          <th>Warna Barang</th>
          <td>: <?= isset($d['warna_brg']) ? $d['warna_brg'] : ''; ?></td>
        </tr>
        <tr>
          <th>Merk Barang</th>
          <td>: <?= isset($d['merk_brg']) ? $d['merk_brg'] : ''; ?></td>
        </tr>
        <tr>
          <th>Isi Barang</th>
          <td>: <?= isset($d['isi_brg']) ? $d['isi_brg'] : ''; ?></td>
        </tr>
        <tr>
          <th>Lokasi Penyimpanan Barang</th>
          <td>: <?= isset($d['ket_penyimpanan']) ? $d['ket_penyimpanan'] : ''; ?></td>
        </tr>

        <!-- Tambahkan warna teks berdasarkan status pengambilan -->
        <tr>
          <th>Status Pengambilan Barang</th>
          <td>:
            <?php if (isset($d['keterangan'])) : ?>
            <?php if ($d['keterangan'] == 'Sudah Diambil') : ?>
            <span class="text-success"><b><?= $d['keterangan']; ?></b></span>
            <a href="admin/cetak-bukti.php?id=<?= $d['id']; ?>" target="_blank" class="btn btn-sm btn-warning"
              style="font-size: 15px;">
              <i class="fas fa-print"></i> Cetak Bukti
            </a>
            <?php elseif ($d['keterangan'] == 'Belum Diambil') : ?>
            <span class="text-danger"><b><?= $d['keterangan']; ?></b></span>
            <!-- Tidak menampilkan tombol cetak jika belum diambil -->
            <?php endif; ?>
            <?php endif; ?>
          </td>
        </tr>

        <?php endif; ?>
        <?php endforeach; ?>
      </table>
    </div>

    <div class="mt-3">
      <a href="index.php" class="btn btn-sm btn-warning" style="width: 80px;">
        <span class="fas fa-arrow-left mr-2"></span>Back
      </a>

      <div class="chat-buttons">
        Chat Now
        <?php foreach ($data2 as $d2) : ?>
        <button class="btn btn-sm btn-success"
          onclick="redirectToWhatsApp('<?= isset($d2['whatsapp']) ? $d2['whatsapp'] : ''; ?>')">
          <span class="fab fa-whatsapp mr-2"></span>WhatsApp
        </button>
        <button class="btn btn-sm btn-primary"
          onclick="redirectToTelegram('<?= isset($d2['telegram']) ? $d2['telegram'] : ''; ?>')">
          <span class="fab fa-telegram-plane mr-2"></span>Telegram
        </button>
        <?php endforeach; ?>
      </div>
    </div>

    <?php
    } else {
      echo "<p>Data pengaduan tidak ditemukan.</p>";
    }
    ?>
  </div>
</div>

<script defer>
function redirectToWhatsApp(phoneNumber) {
  window.open("https://api.whatsapp.com/send?phone=" + phoneNumber, "_blank");
}

function redirectToTelegram(username) {
  window.open("https://t.me/" + username, "_blank");
}
</script>

<?php
include 'templates/footer.php';
?>