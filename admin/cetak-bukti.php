<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_finemine";

// Buat koneksi ke database
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Ambil ID pengaduan dari parameter URL
$id_pengaduan = $_GET['id'];

// Query data pengaduan berdasarkan ID dengan prepared statement
$result = $mysqli->query("SELECT * FROM pengaduan WHERE id = '$id_pengaduan'");

// Periksa apakah query berhasil dieksekusi
if ($result === false) {
    echo "Error: " . $mysqli->error;
} else {
    // Ambil data sebagai array asosiatif
    $data = $result->fetch_assoc();
}

// Tutup koneksi setelah pengambilan data
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bukti Pengambilan Barang</title>
  <!-- Sertakan Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  #tabel {
    border-collapse: collapse;
  }

  .row {
    font-size: 20pt;
  }

  .logo-left,
  .logo-right {
    width: 90px;
    height: auto;
    margin-top: 30px;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    margin-bottom: -25px;
    font-size: 22pt;
  }

  .date {
    text-align: right;
    margin-top: 50px;
    font-size: 16pt;
  }

  .signature {
    font-size: 16pt;
  }
  </style>

</head>

<body style="font-family: Tahoma;">
  <div class="header">
    <img class="logo-left" src="../assets/dist/img/IconAngkasa.png" alt="Logo Left">
    <div class="title" style="text-align: center;">
      <span>BANDAR UDARA ANGKASA PURA II</span><br>
      <b style="font-size:26pt">FINDMINE</b>
    </div>

    <img class="logo-right" src="../assets/dist/img/IconAngkasa.png" alt="Logo Right">
  </div>

  <div style="color: black; text-align: center; font-size: 16pt; margin-bottom:60px;">
    Alamat : Candi Mas, Natar, South Lampung Regency, Lampung 35362
  </div>
  <hr style="color: black;border: 1px solid black;">
  <p>
  <div class="row">
    <div class="col-sm-3">Tanggal Cetak</div>
    <div class="col-sm-3">: <?= date("d/m/Y") ?></div>
    <div class="col-sm-6 ml-auto" style="text-align: right;"><strong><u>Tanda Bukti Pengambilan Barang</u>
      </strong>
    </div>
  </div>
  </p>

  <div class="row">
    <div class="col-sm-3">Kode Pengajuan</div>
    <div class="col-sm-9">: <?= $data['id']; ?></div>
  </div>
  <div class="row">
    <div class="col-sm-3">Nama Pelapor</div>
    <div class="col-sm-9">: <?= $data['n_pelapor']; ?></div>
  </div>
  <div class="row">
    <div class="col-sm-3">No. Penerbangan</div>
    <div class="col-sm-9">: <?= $data['nopen']; ?></div>
  </div>
  <p>
  <div class="row">
    <div class="col-sm-7">Sebagai bukti telah mengambil barang yang terkait</div>
  </div>
  </p>

  <table id="example2" class="table table-bordered table-hover text-nowrap"
    style="font-size:16pt; border: 1px solid black;">
    <thead>
      <tr class="text-center">
        <th>Tanggal Lapor</th>
        <th>Status Pengajuan</th>
        <th>Status Pengambilan</th>
      </tr>
    </thead>
    <tbody>
      <tr class="text-center">
        <td style="vertical-align: middle;">
          <?php
                            setlocale(LC_TIME, 'id_ID'); // Set lokal ke Bahasa Indonesia
                            echo strftime('%d %B %Y', strtotime($data['tgl_lapor']));
                            ?>
        </td>
        <td><?= $data['status']; ?></td>
        <td><?= $data['keterangan']; ?> ✔</td>
      </tr>
    </tbody>
  </table>

  <!-- Form tanda tangan -->
  <div class="date">
    <div>
      <p>Natar, <?= date("d F Y") ?></p>
    </div>
  </div>

  <div class="signature">
    <div class="row" style="text-align: center;">
      <div class="col-sm-auto" style="font-size: 18pt;">
        <p>Mengetahui,</p>
        <p>Petugas Bandara</p>
        <div style="margin-top:100px; color:transparent">Petugas Bandara</div>
        <div style="border-bottom: 1px solid grey; width: 308px;"></div>
        <div style="text-align:left;">NIP.</div>
      </div>
      <div class="col-sm-auto ml-auto" style="font-size: 18pt;">
        <p style="color: transparent;">Penerima barang,</p>
        <p>Penerima barang,</p>
        <div style="margin-top:100px; color:transparent">Petugas</div>
        <div style="border-bottom: 1px solid grey; width: 308px;"></div>
      </div>
    </div>
  </div>


  <script>
  // Otomatis memanggil fungsi cetak setelah halaman dimuat
  window.onload = function() {
    window.print();
    setTimeout(function() {
      window.close();
    }, 100);
  };
  </script>

  <script>
  window.onbeforeunload = function() {
    window.opener.location.href = '<?= site_url('data-pengaduan'); ?>';
  };
  </script>

</body>

</html>