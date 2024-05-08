</div>
</div>
<!-- Footer -->
<?php
require 'function.php';
// Ambil data chat dari database
$data2 = query("SELECT * FROM chat WHERE id = 1"); // Sesuaikan id dengan kondisi yang sesuai

?>

<footer class="bg-dark text-white" style="margin-top:-50px;">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-6">
        <h4>PT Angkasa Pura II</h4>
        <p>Soekarno-Hatta International Airport<br>
          Building 600<br>
          PO BOX 1001/BUSH<br>
          Lampung Selatan<br>
          Indonesia<br>
          Telp: 138<br>
          <a href="https://center@angkasapura2.co.id">E-mail: contact.center@angkasapura2.co.id</a>
        </p>
      </div>
      <div class="col-md-6">
        <h4>Findmine</h4>
        <p>
          Aplikasi Pengaduan Barang Hilang/Tertinggal Pt Angkasa Pura II. Anda bisa menyampaikan keluhan anda terkait
          barang yang tertinggal. Anda
          juga bisa melihat status pengaduan anda, fasilitas dan informasi bandara hanya dengan satu sentuhan.
        </p>
        <div class="mt-3">
          <div class="chat-buttons">
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
      </div>
    </div>
    <hr class="my-4">
    <div class="row">
      <div class="col-md-4">
        <h5>Tentang Kami</h5>
        <ul>
          <li><a href="#">Sejarah</a></li>
          <li><a href="#">Visi & Misi</a></li>
          <li><a href="#">Garis Waktu</a></li>
          <!-- Tambahkan lebih banyak menu jika diperlukan -->
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Pengembangan Usaha</h5>
        <ul>
          <li><a href="#">Bisnis Aviasi</a></li>
          <li><a href="#">Peluang Bisnis</a></li>
          <li><a href="#">Kargo</a></li>
          <!-- Tambahkan lebih banyak menu jika diperlukan -->
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Hubungi Kami</h5>
        <ul>
          <li><a href="#">Karir</a></li>
          <li><a href="#">Hubungi Kami</a></li>
          <!-- Tambahkan lebih banyak menu jika diperlukan -->
        </ul>
      </div>
    </div>
  </div>
</footer>


<script defer>
function redirectToWhatsApp(phoneNumber) {
  window.open("https://api.whatsapp.com/send?phone=" + phoneNumber, "_blank");
}

function redirectToTelegram(username) {
  window.open("https://t.me/" + username, "_blank");
}
</script>
<!-- End Footer -->

<!-- JavaScript -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap4/js/bootstrap.min.js"></script>
</body>

</html>