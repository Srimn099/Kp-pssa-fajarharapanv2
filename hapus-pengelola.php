<?php
include('koneksi.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare("DELETE FROM tb_pengelola WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='home-member.php?page=data-pengelola';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data! Error: " . $stmt->error . "'); window.location='home-member.php?page=data-pengelola';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID tidak valid atau tidak ditemukan!'); window.location='home-member.php?page=data-pengelola';</script>";
}

$koneksi->close();
