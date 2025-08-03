<?php
include 'koneksi.php'; // Sesuaikan dengan koneksi kamu

$namaDepan = ['Fajar', 'Lulu', 'Dian', 'Reza', 'Gita', 'Yoga', 'Salma', 'Tomi', 'Citra', 'Wawan', 'Yuli', 'Eka', 'Fahmi', 'Mega', 'Tari'];
$namaBelakang = ['Susanto', 'Amalia', 'Ramdani', 'Syahputra', 'Kartika', 'Saputri', 'Irawan', 'Maulana', 'Rohmah', 'Sembiring'];


$jkOptions = ['Laki-laki', 'Perempuan'];
$pendOptions = ['SD', 'SMP', 'SMA'];
$keteranganOptions = [
    "Rajin dan bertanggung jawab.",
    "Memiliki semangat belajar tinggi.",
    "Aktif dalam kegiatan sekolah.",
    "Perlu bimbingan tambahan.",
    "Berprestasi di bidang seni.",
    "Sopan dan ramah.",
    "Sering membantu teman."
];

for ($i = 1; $i <= 30; $i++) {
    $nama = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
    $tmp_lahir = "Kota" . rand(1, 10);
    $tgl_lahir = date('Y-m-d', strtotime("-" . rand(10, 17) . " years -" . rand(0, 365) . " days"));
    $jk = $jkOptions[array_rand($jkOptions)];
    $pendidikan_terakhir = $pendOptions[array_rand($pendOptions)];
    $nama_ayah = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
    $nama_ibu = $namaDepan[array_rand($namaDepan)] . ' ' . $namaBelakang[array_rand($namaBelakang)];
    $pk_ortu = "Petani";

    // Tanggal masuk antara 1 Jan 2018 - 31 Des 2020
    $tgl_masuk = date('Y-m-d', rand(strtotime('2018-01-01'), strtotime('2020-12-31')));

    // Tanggal keluar di tahun 2025, antara Januari–Desember
    $tgl_keluar = date('Y-m-d', rand(strtotime('2025-01-01'), strtotime('2025-12-31')));

    $status_sekolah = 'Aktif'; // Masih aktif
    $status_siswa = 'reguler'; // Semua reguler

    $alamat = "Jl. Mawar No." . rand(1, 200) . ", RT " . rand(1, 5) . "/RW " . rand(1, 10);
    $keterangan = $keteranganOptions[array_rand($keteranganOptions)];

    $query = "INSERT INTO tb_siswa 
        (nama, tmp_lahir, tgl_lahir, jk, pendidikan_terakhir, nama_ayah, nama_ibu, pk_ortu, tgl_masuk, tgl_keluar, status_sekolah, status, alamat, keterangan) 
        VALUES 
        ('$nama', '$tmp_lahir', '$tgl_lahir', '$jk', '$pendidikan_terakhir', '$nama_ayah', '$nama_ibu', '$pk_ortu', '$tgl_masuk', '$tgl_keluar', '$status_sekolah', '$status_siswa', '$alamat', '$keterangan')";

    if ($koneksi->query($query)) {
        echo "Data siswa ke-$i ($nama) berhasil ditambahkan.<br>";
    } else {
        echo "Gagal menambahkan siswa ke-$i ($nama): " . $koneksi->error . "<br>";
    }
}

$koneksi->close();
