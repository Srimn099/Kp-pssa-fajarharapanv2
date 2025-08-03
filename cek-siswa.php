<?php
include('koneksi.php');

header('Content-Type: application/json');

if (isset($_GET['tahun'])) {
    $tahun = (int)$_GET['tahun'];

    $query = "SELECT COUNT(*) as count FROM tb_siswa WHERE YEAR(tgl_masuk) = $tahun AND status_sekolah = 'Aktif'";
    $result = $koneksi->query($query);
    $row = $result->fetch_assoc();

    echo json_encode([
        'exists' => $row['count'] > 0,
        'count' => $row['count']
    ]);
} else {
    echo json_encode(['exists' => false, 'count' => 0]);
}

$koneksi->close();
