<?php
require '../function.php';
$id_barang = $_GET['id_barang'];
    if (deleteBarang($id_barang) > 0) {
        echo "<script>alert('Data Barang berhasil dihapus.'); document.location.href='data-barang.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus.'); document.location.href='data-barang.php';</script>";
    }

?>