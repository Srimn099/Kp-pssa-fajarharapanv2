<?php
include('koneksi.php');

if (isset($_POST['tahun_masuk'])) {
    $tahun_masuk = (int)$_POST['tahun_masuk'];

    // Cek apakah ada siswa dengan tahun masuk tersebut
    $checkQuery = "SELECT COUNT(*) as total FROM tb_siswa WHERE YEAR(tgl_masuk) = $tahun_masuk AND status_sekolah = 'Aktif'";
    $checkResult = $koneksi->query($checkQuery);
    $row = $checkResult->fetch_assoc();

    if ($row['total'] > 0) {
        // Jika ada siswa, proses kelulusan
        $query = "UPDATE tb_siswa SET status_sekolah = 'Lulus' WHERE YEAR(tgl_masuk) = $tahun_masuk AND status_sekolah = 'Aktif'";

        if ($koneksi->query($query)) {
            $affected_rows = $koneksi->affected_rows;
            header("Location: home-member.php?page=data-siswa&notif=berhasil&tahun=$tahun_masuk&jumlah=$affected_rows");
        } else {
            header("Location: home-member.php?page=data-siswa&notif=gagal");
        }
    } else {
        // Jika tidak ada siswa
        header("Location: home-member.php?page=data-siswa&notif=tidak_ada&tahun=$tahun_masuk");
    }
} else {
    header("Location: home-member.php?page=data-siswa");
}
exit;
