<!DOCTYPE html>
<html>

<head>
  <title>Report Data Pengaduan</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/dist/img/IconAngkasa.png">

  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <style>
  @page {
    size: auto;
  }

  /* Gaya tampilan cetak */
  body {
    font-family: Arial, sans-serif;
  }

  .header {
    display: flex;
    align-items: center;
    margin-top: 20px;
    margin-bottom: -10px;
  }

  .logo-left,
  .logo-right {
    width: 100px;
    height: auto;
  }

  .alamat {
    text-align: center;
    font-size: 15pt;
  }

  .title {
    font-size: 38px;
    text-align: center;
    flex-grow: 1;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th,
  td {
    border: 1px solid black;
    padding: 8px;
    font-size: 14pt;
  }

  .font-tabel {
    font-size: 18pt;
  }

  .date {
    text-align: right;
    margin-top: 20px;
    font-size: 18pt;
  }

  .signature {
    font-size: 18pt;
  }

  .page-break {
    page-break-before: always;
  }

  /* Responsif */
  @media screen and (max-width: 768px) {
    .header {
      flex-direction: column;
      align-items: center;
    }

    .logo-left,
    .logo-right {
      width: 70px;
    }

    .alamat {
      font-size: 12pt;
    }

    .title {
      font-size: 28px;
    }

    .font-tabel {
      font-size: 14pt;
    }

    .date {
      margin-top: 10px;
      font-size: 14pt;
    }

    .signature {
      font-size: 14pt;
    }

    .mr-auto,
    .ml-auto {
      margin-left: 0;
      margin-right: 0;
      text-align: center;
    }
  }
  </style>
</head>

<body>
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

    // Peroleh tanggal awal dan akhir dari parameter URL
    $awalTgl = isset($_GET['awal']) ? $_GET['awal'] : date('Y-m-d');
    $akhirTgl = isset($_GET['akhir']) ? $_GET['akhir'] : date('Y-m-d');
    // Filter status pengajuan dan status pengambilan
    $statusPengajuanFilter = isset($_GET['pengajuan']) ? htmlspecialchars($_GET['pengajuan']) : '';
    $statusPengambilanFilter = isset($_GET['pengambilan']) ? htmlspecialchars($_GET['pengambilan']) : '';

    // Query dengan filter tanggal
    $sql = "SELECT * FROM pengaduan WHERE tgl_lapor BETWEEN '$awalTgl' AND '$akhirTgl'";

    // Tambahkan filter status pengajuan jika dipilih
    if (!empty($statusPengajuanFilter)) {
      $sql .= " AND status = '$statusPengajuanFilter'";
    }

    // Tambahkan filter status pengambilan jika dipilih
    if (!empty($statusPengambilanFilter)) {
      $sql .= " AND keterangan = '$statusPengambilanFilter'";
    }

    // Eksekusi query
    $result = $mysqli->query($sql);

    // Periksa apakah query berhasil dieksekusi
    if ($result === false) {
      echo "Error: " . $mysqli->error;
    } else {
      // Ambil data sebagai array
      $data = $result->fetch_all(MYSQLI_ASSOC);
    }
    ?>

  <div class="header">
    <img class="logo-left" src="../assets/dist/img/IconAngkasa.png" alt="Logo Left">
    <div class="title" style="text-align: center;">
      <span style="font-size:23pt;">BANDAR UDARA ANGKASA PURA II</span><br>
      <b>FINDMINE</b>
    </div>
    <img class="logo-right" src="../assets/dist/img/IconAngkasa.png" alt="Logo Right">
  </div>

  <p class="alamat">Alamat : Candi Mas, Natar, South Lampung Regency, Lampung 35362</p>
  <hr style="color: black;border: 1px solid black;">
  <div style="text-align: center; font-size:18pt">
    <strong>(REPORT DATA PENGADUAN)</strong>
  </div>

  <p>
  <div style="font-size: 14pt;">
    <div class="row">
      <div class="col-sm-3">Bandara</div>
      <div class="col-sm-9">: <b>Angkasa Pura II</b></div>
    </div>
    <div class="row">
      <div class="col-sm-3">Pimpinan</div>
      <div class="col-sm-9">: <b>..............?</b></div>
    </div>
    <div class="row">
      <div class="col-sm-3">Periode</div>
      <div class="col-sm-9">: <b><?php echo date('d F Y', strtotime($awalTgl)); ?> s/d
          <?php echo date('d F Y', strtotime($akhirTgl)); ?></b></div>
    </div>
  </div>
  </p>



  <div class="font-tabel">
    <table>
      <thead
        style="background: linear-gradient(to left, #642EFE, blue); color: white; text-align: center; font-size: 14pt;">
        <tr>
          <th>Kode</th>
          <th>Nama Pelapor</th>
          <th>Tgl Lapor</th>
          <th>No Penerbangan</th>
          <th>Jenis Barang</th>
          <th>Status Pengajuan</th>
          <th>Status Pengambilan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $d) : ?>
        <tr>
          <td><?= $d['id']; ?></td>
          <td><?= $d['n_pelapor']; ?></td>
          <td><?= $d['tgl_lapor']; ?></td>
          <td style="text-align:center;"><?= $d['nopen']; ?></td>
          <td><?= $d['jenis_brg']; ?></td>
          <td><?= $d['status']; ?></td>
          <td><?= $d['keterangan']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" style="text-align:center;"><b>TOTAL DATA</b></td>
          <td colspan="4" style="text-align:center;"><b><?= count($data); ?></b></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- Form tanda tangan -->
  <div class="date">
    <div>
      <p>Natar, <?= date("d F Y") ?></p>
    </div>
  </div>

  <div class="signature">
    <div class="row" style="text-align: center;">
      <div class="col-sm-auto" style="font-size: 18pt; ">
        <p>Mengetahui,</p>
        <p>Pimpinan</p>
        <div style="margin-top:100px; color:transparent">Pimpinan</div>
        <div style="border-bottom: 1px solid grey; width: 308px;"></div>
        <div style="text-align:left">NIP/NIK.</div>
      </div>
      <div class="col-sm-auto ml-auto" style="font-size: 18pt;">
        <p style="color: transparent;">Petugas Bandara</p>
        <p>Petugas Bandara</p>
        <div style="margin-top:100px; color:transparent">Petugas Bandara</div>
        <div style="border-bottom: 1px solid grey; width: 308px;"></div>
        <div style="text-align:left">NIP/NIK. </div>
      </div>
    </div>
  </div>

  <?php
    // Tutup koneksi database
    $mysqli->close();
    ?>
</body>
<script>
// Otomatis memanggil fungsi cetak setelah halaman dimuat
window.onload = function() {
  window.print();
  setTimeout(function() {
    window.close();
  }, 100);
};
</script>

</html>