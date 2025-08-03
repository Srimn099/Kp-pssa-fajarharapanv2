<?php
include 'koneksi.php'; // Pastikan file koneksi sudah benar

$query = "TRUNCATE TABLE tb_siswa";
// atau gunakan TRUNCATE TABLE tb_siswa;

if ($koneksi->query($query)) {
    echo "Semua data siswa berhasil dihapus.";
} else {
    echo "Gagal menghapus data: " . $koneksi->error;
}

$koneksi->close();
