<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $query = "DELETE FROM tb_siswa WHERE id = '$id'";
    if ($koneksi->query($query) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='home-member.php?page=data-siswa';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='home-member.php?page=data-siswa';</script>";
    }
} else {
    echo "<script>alert('Akses ditolak!'); window.location='home-member.php?page=data-siswa';</script>";
}

$koneksi->close();
