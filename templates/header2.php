<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Findmine</title>
  <!-- icon diskominfo -->
  <link rel="icon" href="assets/dist/img/IconAngkasa.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/plugins/bootstrap4/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
</head>

<style>
.jumbotron img {
  position: absolute;
  top: 60%;
  left: 70%;
  transform: translate(-50%, -50%);
  background-size: cover;
  z-index: 1;
}

/* Navbar styles */
.navbar {
  background-color: rgba(255, 255, 255, 0.9);
  /* Warna latar belakang navbar dengan transparansi */
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  /* Efek bayangan pada navbar */
  position: sticky;
  top: 0;
  z-index: 1000;
}


/* Navbar logo styles */
.navbar-brand img {
  max-height: 40px;
  /* Atur tinggi maksimum logo */
}

/* Navbar menu items styles */
.navbar-nav .nav-link {
  color: #03619c;
  /* Warna teks menu */
}

.navbar-nav .nav-link:hover {
  color: #004080;
  /* Warna teks menu saat dihover */
}


.login-button:hover {
  background: #004080;
  /* Warna latar belakang tombol saat dihover */
}

/* Header styles */
.jumbotron {
  background-size: cover;
  background-position: center;
  height: 100vh;
}
</style>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <img class="logo" src="assets/dist/img/LogoAngkasa.jpg">
      <a class="navbar-brand" href="index.php">Findmine</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form-pengaduan.php">Form Pengajuan</a>
          </li>
          <li class="nav-item">
            <a class="btn login-button" href="auth/login.php" style="background:#03619c; color:white">Log in</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- end navbar -->
  <!-- header -->
  <div class="jumbotron jumbotron-fluid"
    style="background: url('assets/img/bg1.jpg'); background-size: cover; background-position: center; height: 100vh;">
    <img src="assets/img/Angkasapura2.png" class="img-fluid logo d-none d-sm-block" alt="Responsive Image"
      style="max-height: 180px; max-width: 500px;">
    <div class="container">