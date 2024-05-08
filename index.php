<?php
include 'templates/header.php';

?>

<div class="angkasa">
  <h1 class="display-5">Barang Anda Hilang</h1>
  <h2 class="display-5">atau Tertinggal di Bandara?</h2>
  <p class="lead"><b>Jangan ambil pusing! Sampaikan kepada kami keluhan anda.</b> </p>
  <div class="jumbotron-search">
    <form action="search.php" method="POST">
      <p class="lead" style="margin-bottom: -1px;"><b>Cek status pengaduan Anda</b></p>
      <input type="text" name="keyword" id="keyword" placeholder="Masukkan nomor pengaduan Anda disini">
      <button type="submit" class="btn search-button" value="cari" style="background:#03619c; color:white"><span
          class="fas fa-search mr-2"></span>Cek</button>
    </form>
    <p class="lead mt-2"><b>atau ajukan pengaduan Anda</b></p>
    <a href="form-pengaduan.php" class="btn btn-success sub-button"><span
        class="fas fa-chevron-right mr-2"></span>Disini</a>
  </div>
</div>
<?php
include 'templates/footer2.php';
?>