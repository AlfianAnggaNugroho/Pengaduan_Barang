<?php
require '../function.php';
$id = $_GET['id'];
    if (deleteUser($id) > 0) {
        echo "<script>alert('Data user berhasil dihapus.'); document.location.href='users.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus.'); document.location.href='users.php';</script>";
    }

?>