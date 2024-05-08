<?php
session_start();
session_destroy();
echo "<script>alert('Berhasil logout dari Findmine!'); window.location='../index.php';</script>";