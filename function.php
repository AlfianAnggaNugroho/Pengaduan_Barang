<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_finemine";

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function insertPengaduan($data) {
    global $conn;
    date_default_timezone_set('Asia/Jakarta');
    $id = $data['id'];
    $np = htmlspecialchars($data["nama"]);
    $npb = htmlspecialchars($data["pemilik"]);
    $em = htmlspecialchars($data["email"]);
    $nt = htmlspecialchars($data["notelp"]);
    $tgl = htmlspecialchars($data["tglkejadian"]);
    $dtllok = htmlspecialchars($data["detaillok"]);
    $rute = htmlspecialchars($data["rute"]);
    $mask = htmlspecialchars($data["maskapai"]);
    $nopen = htmlspecialchars($data["nopen"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $pos = htmlspecialchars($data["pos"]);
    $ciri = htmlspecialchars($data["ciri"]);
    $cirib = htmlspecialchars($data["ciribrg"]);
    $gambar = uploadGambar();
    if (!$gambar) {
        // Gagal upload gambar, tambahkan logika atau pesan error sesuai kebutuhan
    }

    //$ket = mysqli_real_escape_string($conn, $data["ket"]);
    $status = "Sedang diajukan";
    $keterangan = "Belum Diambil";
    $isi_brg = "-";
    $lok_pen = "-";
    $jenis_brg = "-";
    $warna_brg = "-";
    $merk_brg = "-";
    $ket_penyimpanan = "-";
    $tgl_lapor = date("Y-m-d");

    mysqli_query($conn, "INSERT INTO pengaduan VALUES('$id', '$np', '$npb', '$em', '$nt', '$tgl', '$dtllok', '$rute', '$mask', '$nopen', '$alamat', '$pos', '$ciri', '$cirib', '$gambar', '$status', '$isi_brg', '$lok_pen', '$jenis_brg', '$warna_brg', '$merk_brg', '$ket_penyimpanan', '$keterangan', '$tgl_lapor')");
    return mysqli_affected_rows($conn);
}

function uploadGambar() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        return null; // Tidak ada gambar yang diupload
    }

    // Pastikan yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Ekstensi gambar tidak valid!');</script>";
        return null; // Ekstensi gambar tidak valid
    }

    // Batasi ukuran gambar (jika perlu)
    if ($ukuranFile > 5048000) { // Contoh batasan ukuran 5 MB
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return null; // Ukuran gambar terlalu besar
    }

    // Generate nama gambar baru
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;

    // Pindahkan gambar ke folder tertentu
    if (!move_uploaded_file($tmpName, 'assets/upload/' . $namaFileBaru)) {
        echo "<script>alert('Gagal mengupload gambar!');</script>";
        return null; // Gagal upload gambar
    }

    return $namaFileBaru;
}


function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $name = htmlspecialchars($data["name"]);
    $nip = htmlspecialchars($data["nip"]);
    $img = "default.jpg";
    $status = "0";

    $cek = mysqli_query($conn, "SELECT username, user_id FROM user WHERE username = '$username' OR user_id = '$nip'");

    if (mysqli_fetch_assoc($cek)) {
        echo "<script>alert('Username $username or NIP $nip was already registered!');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user VALUES('$nip', '$username', '$password', '$name', '$img', '$status')");

    return mysqli_affected_rows($conn);
}

function updatePass($data) {
    global $conn;
    
    $id = $data['id'];
    $password_baru = mysqli_real_escape_string($conn, $data["password_baru"]);
    $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE user SET password='$password_baru' WHERE user_id='$id'"); 

    return mysqli_affected_rows($conn);
}

function updatePengaduan($data) {
    global $conn;
    
    $id = $data['id'];
    $status = $data['status'];
    $ket_penyimpanan = $data['ket_penyimpanan'];
    $keterangan = $data['keterangan'];
    $lok_pen = $data['lok_pen'];
    $jenis_brg = $data['jenis_brg'];
    $warna_brg = $data['warna_brg'];
    $merk_brg = $data['merk_brg'];
    $isi_brg = $data['isi_brg'];

    // Perbarui data pada tabel pengaduan
    mysqli_query($conn, "UPDATE pengaduan SET status = '$status', ket_penyimpanan='$ket_penyimpanan', keterangan='$keterangan', lok_pen='$lok_pen', jenis_brg='$jenis_brg', warna_brg='$warna_brg', merk_brg='$merk_brg', isi_brg='$isi_brg' WHERE id='$id'"); 

    return mysqli_affected_rows($conn);
}

function updateBarang($data) {
    global $conn;

    $id_barang = $data['id_barang'];
    $status = $data['status'];
    $tanggal = $data['tanggal'];
    $lok_pen = $data['lok_pen'];
    $jenis_brg = $data['jenis_brg'];
    $warna_brg = $data['warna_brg'];
    $merk_brg = $data['merk_brg'];
    $isi_brg = $data['isi_brg'];
    $ket_penyimpanan = $data['ket_penyimpanan'];

    // Validate and sanitize data
    // ...

    // Perbarui data pada tabel barang
    $query = "UPDATE barang SET status = '$status', tanggal = '$tanggal', lok_pen = '$lok_pen', jenis_brg = '$jenis_brg', warna_brg = '$warna_brg', merk_brg = '$merk_brg', isi_brg = '$isi_brg', ket_penyimpanan = '$ket_penyimpanan' WHERE id_barang = '$id_barang'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<script>alert('Error updating data: " . mysqli_error($conn) . "');</script>";
    }

    return mysqli_affected_rows($conn);
}




function updatePhoto($data) {
    global $conn;
    
    $id = $_SESSION['login']['user_id'];
        
        $rand = rand();
        $ekstensi =  array('png','jpg','jpeg');
        $filename = $_FILES['foto']['name'];
        $ukuran = $_FILES['foto']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if(!in_array($ext,$ekstensi) ) {
            echo "<script>alert('Ekstensi tidak diperbolehkan atau Anda belum memilih file apapun.'); window.location='profil.php';</script>";
        }else{
            if($ukuran < 2044070){		
                $xx = $rand.'_'.$filename;
                move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/profile/'.$rand.'_'.$filename);

                mysqli_query($conn, "UPDATE user SET img = '$xx' WHERE user_id='$id'"); 
        
            } else {
                echo "<script>alert('Size file terlalu beasr! Size yang diperbolehkan tidak melebihi 2 MB.'); window.location='profil.php';</script>";
            }
        }
    return mysqli_affected_rows($conn);
}

function updateContact($data) {
    global $conn;

    $id = $data['id'];
    $whatsapp = $data['whatsapp'];
    $telegram = $data['telegram'];

    $query = "UPDATE chat SET whatsapp = '$whatsapp', telegram = '$telegram' WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo "<script>alert('Error updating data: " . mysqli_error($conn) . "');</script>";
    }

    return mysqli_affected_rows($conn);
}

function deleteUser($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE user_id = '$id'");
    return mysqli_affected_rows($conn);
}

function deletePengaduan($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM pengaduan WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

function deleteBarang($id_barang) {
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang = '$id_barang'");
    return mysqli_affected_rows($conn);
}

function searchPengaduan($keyword) {
    global $conn;
    $data = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id = '$keyword'");
    return mysqli_affected_rows($conn);
}

?>