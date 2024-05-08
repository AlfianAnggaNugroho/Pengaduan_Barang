<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_finemine";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function tambahuser($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $name = htmlspecialchars($data["name"]);
    $img = "default.jpg";
    $status = 1;

    $cek = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($cek)) {
        echo "<script>alert('Username $username was already registered!');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user (username, password, name, img, status) VALUES ('$username', '$password', '$name', '$img', '$status')";

    if(mysqli_query($conn, $query)) {
        return mysqli_affected_rows($conn);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
        return false;
    }
}

function edituser($user_id, $newUsername, $newName, $newPassword) {
  global $conn;

  $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  $query = "UPDATE user SET username = '$newUsername', name = '$newName', password = '$newPassword' WHERE user_id = '$user_id'";
  
  if(mysqli_query($conn, $query)) {
    return true;
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
    return false;
  }
}

function tambah_barang($data) {
  global $conn;
  date_default_timezone_set('Asia/Jakarta');
  $tanggal = $data["tanggal"];
  $lok_pen = htmlspecialchars($data["lok_pen"]);
  $jenis_brg = htmlspecialchars($data["jenis_brg"]);
  $isi_brg = htmlspecialchars($data["isi_brg"]);
  $warna_brg = htmlspecialchars($data["warna_brg"]);
  $merk_brg = htmlspecialchars($data["merk_brg"]);
  $ket_penyimpanan = htmlspecialchars($data["ket_penyimpanan"]);
  
  // Mendapatkan nama file foto
  $foto_brg = uploadFoto();

  if (!$foto_brg) {
      return false;
  }
  $status = "Belum Diambil";

  // Query untuk menambahkan data barang
  $query = "INSERT INTO barang (tanggal, lok_pen, jenis_brg, isi_brg, warna_brg, merk_brg, ket_penyimpanan, foto_brg, status) 
            VALUES ('$tanggal', '$lok_pen', '$jenis_brg', '$isi_brg', '$warna_brg', '$merk_brg', '$ket_penyimpanan', '$foto_brg', '$status')";

  // Cetak query untuk debugging
  echo "Query: $query";

  if (mysqli_query($conn, $query)) {
      return mysqli_affected_rows($conn);
  } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
      return false;
  }
}


function uploadFoto() {
  $namaFile = $_FILES['foto_brg']['name'];
  $ukuranFile = $_FILES['foto_brg']['size'];
  $error = $_FILES['foto_brg']['error'];
  $tmpName = $_FILES['foto_brg']['tmp_name'];

  // Cek apakah ada file yang diunggah
  if ($error === 4) {
      // Tidak ada file yang diunggah
      return null;
  }

  // Pastikan hanya file gambar yang diizinkan
  $ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
  $ekstensiFoto = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

  if (!in_array($ekstensiFoto, $ekstensiFotoValid)) {
      echo "<script>alert('Upload failed! Please upload a valid image file.');</script>";
      return null;
  }

  // Batasi ukuran file (misalnya, maksimal 2MB)
  $maxSize = 2 * 1024 * 1024; // 2 MB

  if ($ukuranFile > $maxSize) {
      echo "<script>alert('Upload failed! Image size exceeds 2MB limit.');</script>";
      return null;
  }

  // Generate nama file baru untuk mencegah nama file yang sama
  $namaFileBaru = uniqid() . '.' . $ekstensiFoto;

  // Pindahkan file ke direktori yang diinginkan
  $uploadDir = 'uploads/'; // Sesuaikan dengan direktori tempat menyimpan file
  $tujuanFile = $uploadDir . $namaFileBaru;

  if (move_uploaded_file($tmpName, $tujuanFile)) {
      // File berhasil diupload
      return $namaFileBaru;
  } else {
      // Gagal mengupload file
      echo "<script>alert('Upload failed! Please try again.');</script>";
      return null;
  }
}

?>