<?php
include('koneksi.php'); // Pastikan file ini berisi koneksi mysqli $koneksi

$dataDummy = [
    ['3174021101980001', 'Siti Rahmawati', 'Perempuan', 24, 'Jl. Cempaka Raya No. 12, Jakarta', 'Administrasi'],
    ['3201040503900002', 'Budi Setiawan', 'Laki-laki', 35, 'Jl. Melati No. 5, Bandung', 'Kepala Sekolah'],
    ['3302052207820003', 'Lina Marlina', 'Perempuan', 42, 'Jl. Merdeka No. 7, Yogyakarta', 'Guru PAUD'],
    ['3401091605910004', 'Joko Prasetyo', 'Laki-laki', 33, 'Jl. Ahmad Yani No. 21, Sleman', 'Satpam'],
    ['3174100806850005', 'Desi Anggraini', 'Perempuan', 38, 'Jl. Sudirman No. 3, Jakarta', 'Bendahara'],
    ['3273050101990006', 'Heri Nugroho', 'Laki-laki', 25, 'Jl. Kebon Jeruk No. 9, Tangerang', 'Staf TU'],
    ['3210092107880007', 'Dian Puspitasari', 'Perempuan', 36, 'Jl. Mawar No. 14, Bekasi', 'Guru TK'],
    ['3174050502790008', 'Ahmad Fauzi', 'Laki-laki', 46, 'Jl. Pondok Indah No. 17, Jakarta', 'Kebersihan'],
    ['3301061208910009', 'Indah Lestari', 'Perempuan', 33, 'Jl. Kamboja No. 2, Magelang', 'Administrasi'],
    ['3211050301990010', 'Ridwan Kamiludin', 'Laki-laki', 26, 'Jl. Bintaro Utama No. 19, Tangsel', 'Keamanan'],
    ['3273082212900011', 'Putri Aulia', 'Perempuan', 29, 'Jl. Kemang No. 88, Jakarta Selatan', 'Guru SD'],
    ['3302091701870012', 'Hendri Susanto', 'Laki-laki', 39, 'Jl. Wijaya Kusuma No. 10, Solo', 'Wakil Kepala'],
    ['3401072309890013', 'Melani Wijaya', 'Perempuan', 34, 'Jl. Veteran No. 4, Bantul', 'Staf TU'],
    ['3174082506900014', 'Taufik Hidayat', 'Laki-laki', 31, 'Jl. Tebet Timur No. 5, Jakarta', 'Guru TK'],
    ['3273051103970015', 'Lailatul Maulida', 'Perempuan', 28, 'Jl. Cinere Raya No. 7, Depok', 'Guru PAUD']
];

foreach ($dataDummy as $data) {
    $no_ktp = $data[0];
    $nama = $data[1];
    $jk = $data[2];
    $usia = $data[3];
    $alamat = $data[4];
    $jabatan = $data[5];
    $foto = 'sri.png'; // Semua pakai sri.png

    $query = "INSERT INTO tb_pengelola (foto, no_ktp, nama, jk, usia, alamat, jabatan) 
              VALUES ('$foto', '$no_ktp', '$nama', '$jk', $usia, '$alamat', '$jabatan')";

    if ($koneksi->query($query) === TRUE) {
        echo "Data untuk $nama berhasil dimasukkan.<br>";
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
