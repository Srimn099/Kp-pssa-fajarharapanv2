<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$dataDummy = [
    ['050', 'Kas Kecil', 'H', 'A', '', '100'],
    ['051', 'Bank BRI', 'D', 'A', '', '100'],
    ['052', 'Bank Mandiri', 'D', 'A', '', '100'],
    ['053', 'Piutang Usaha', 'D', 'A', '', '100'],
    ['054', 'Peralatan Kantor', 'D', 'A', '', '200'],
    ['055', 'Kendaraan Operasional', 'D', 'A', '', '200'],
    ['056', 'Hutang Usaha', 'D', 'S', '', '301'],
    ['057', 'Pinjaman Jangka Panjang', 'H', 'S', '', '302'],
    ['058', 'Modal Awal', 'H', 'S', '', '401'],
    ['059', 'Dana Donatur', 'D', 'S', '', '402'],
    ['060', 'Pendapatan Donasi', 'D', 'D', '', '501'],
    ['061', 'Pendapatan Jasa', 'D', 'D', '', '502'],
    ['062', 'Biaya Gaji Karyawan', 'D', 'B', '', '601'],
    ['063', 'Biaya Operasional', 'D', 'B', '', '601'],
    ['064', 'Biaya Administrasi', 'D', 'M', '', '602'],
    ['065', 'Biaya Transportasi', 'D', 'B', '', '601'],
    ['066', 'Biaya Listrik', 'D', 'B', '', '601'],
    ['067', 'Biaya Air', 'D', 'B', '', '601'],
    ['068', 'Sumbangan Terikat', 'D', 'S', '', '402'],
    ['069', 'Aset Terikat', 'H', 'S', '', '402'],
    ['070', 'Aset Tidak Terikat', 'H', 'S', '', '401'],
    ['071', 'Pendapatan Lainnya', 'D', 'D', '', '502'],
    ['072', 'Beban Lainnya', 'D', 'B', '', '602'],
    ['073', 'Piutang Sementara', 'D', 'A', '', '100'],
    ['074', 'Perlengkapan Kantor', 'D', 'A', '', '200'],
    ['075', 'Inventaris', 'D', 'A', '', '200'],
    ['076', 'Pendapatan Event', 'D', 'D', '', '501'],
    ['077', 'Biaya Event', 'D', 'B', '', '601'],
    ['078', 'Biaya Pemeliharaan', 'D', 'B', '', '601'],
    ['079', 'Kas Cabang', 'D', 'A', '', '100'],
    ['080', 'Dana Cadangan', 'H', 'S', '', '401'],
];

$berhasil = 0;

foreach ($dataDummy as $item) {
    list($kode, $nama, $tipe, $group, $parent, $kodebi) = $item;
    $cdk = ($group == 'A' || $group == 'B') ? 'D' : 'K';

    // Cek dulu apakah sudah ada
    $cek = $koneksi->query("SELECT * FROM tabkira WHERE CNO_KIRA = '$kode'");
    if ($cek->num_rows == 0) {
        $insert1 = $koneksi->query("INSERT INTO tabkira (CNO_KIRA, CNAMA_KIRA, CHEAD_DET, CGROUP, CACCTPARENT, KODEBI)
                                    VALUES ('$kode', '$nama', '$tipe', '$group', '$parent', '$kodebi')");

        $insert2 = $koneksi->query("INSERT INTO balance 
            SELECT DISTINCT dtgl, '$kode', 0, 0, '$cdk', 0, 0, '$cdk' FROM balance");

        if ($insert1 && $insert2) {
            $berhasil++;
        }
    }
}

// Tampilkan notifikasi jika berhasil
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Dummy</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?= $berhasil ?> data dummy berhasil ditambahkan.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'home-admin.php?page=perkiraan';
        });
    </script>
</body>

</html>