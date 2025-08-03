<?php
// dummy-data.php
// File ini untuk mengisi data dummy ke tabel tabkira Anda

// Sertakan file koneksi database Anda
include "koneksi.php";

// Pastikan koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Hapus semua data yang ada di tabel tabkira terlebih dahulu
// Ini opsional, bisa dihilangkan jika Anda ingin menambahkan data tanpa menghapus yang lama
// Namun, untuk tujuan dummy data, ini biasanya dilakukan agar hasilnya bersih
$koneksi->query("TRUNCATE TABLE tabkira");

echo "<h2>Mengisi Data Dummy ke Tabel 'tabkira'...</h2>";

$data_to_insert = [
    // Akun Aktiva (A)
    ['CNO_KIRA' => '1000', 'CNAMA_KIRA' => 'AKTIVA', 'CHEAD_DET' => 'H', 'CGROUP' => 'A', 'CACCTPARENT' => null],
    ['CNO_KIRA' => '1100', 'CNAMA_KIRA' => 'Kas & Bank', 'CHEAD_DET' => 'H', 'CGROUP' => 'A', 'CACCTPARENT' => '1000'],
    ['CNO_KIRA' => '1101', 'CNAMA_KIRA' => 'Kas Kecil', 'CHEAD_DET' => 'D', 'CGROUP' => 'A', 'CACCTPARENT' => '1100'],
    ['CNO_KIRA' => '1102', 'CNAMA_KIRA' => 'Bank BCA', 'CHEAD_DET' => 'D', 'CGROUP' => 'A', 'CACCTPARENT' => '1100'],
    ['CNO_KIRA' => '1200', 'CNAMA_KIRA' => 'Piutang Usaha', 'CHEAD_DET' => 'D', 'CGROUP' => 'A', 'CACCTPARENT' => '1000'],
    ['CNO_KIRA' => '1300', 'CNAMA_KIRA' => 'Persediaan Barang Dagang', 'CHEAD_DET' => 'D', 'CGROUP' => 'A', 'CACCTPARENT' => '1000'],

    // Akun Biaya (B)
    ['CNO_KIRA' => '5000', 'CNAMA_KIRA' => 'BEBAN', 'CHEAD_DET' => 'H', 'CGROUP' => 'B', 'CACCTPARENT' => null],
    ['CNO_KIRA' => '5100', 'CNAMA_KIRA' => 'Beban Gaji & Upah', 'CHEAD_DET' => 'H', 'CGROUP' => 'B', 'CACCTPARENT' => '5000'],
    ['CNO_KIRA' => '5101', 'CNAMA_KIRA' => 'Beban Gaji Karyawan Tetap', 'CHEAD_DET' => 'D', 'CGROUP' => 'B', 'CACCTPARENT' => '5100'],
    ['CNO_KIRA' => '5102', 'CNAMA_KIRA' => 'Beban Honor Kontraktor', 'CHEAD_DET' => 'D', 'CGROUP' => 'B', 'CACCTPARENT' => '5100'],
    ['CNO_KIRA' => '5200', 'CNAMA_KIRA' => 'Beban Sewa', 'CHEAD_DET' => 'D', 'CGROUP' => 'B', 'CACCTPARENT' => '5000'],

    // Akun Pasiva (S)
    ['CNO_KIRA' => '2000', 'CNAMA_KIRA' => 'PASIVA', 'CHEAD_DET' => 'H', 'CGROUP' => 'S', 'CACCTPARENT' => null],
    ['CNO_KIRA' => '2100', 'CNAMA_KIRA' => 'Utang Usaha', 'CHEAD_DET' => 'D', 'CGROUP' => 'S', 'CACCTPARENT' => '2000'],
    ['CNO_KIRA' => '3000', 'CNAMA_KIRA' => 'MODAL', 'CHEAD_DET' => 'H', 'CGROUP' => 'S', 'CACCTPARENT' => null],
    ['CNO_KIRA' => '3100', 'CNAMA_KIRA' => 'Modal Pemilik', 'CHEAD_DET' => 'D', 'CGROUP' => 'S', 'CACCTPARENT' => '3000'],

    // Akun Pendapatan (D)
    ['CNO_KIRA' => '4000', 'CNAMA_KIRA' => 'PENDAPATAN', 'CHEAD_DET' => 'H', 'CGROUP' => 'D', 'CACCTPARENT' => null],
    ['CNO_KIRA' => '4100', 'CNAMA_KIRA' => 'Pendapatan Penjualan Jasa', 'CHEAD_DET' => 'D', 'CGROUP' => 'D', 'CACCTPARENT' => '4000'],
    ['CNO_KIRA' => '4200', 'CNAMA_KIRA' => 'Pendapatan Bunga Bank', 'CHEAD_DET' => 'D', 'CGROUP' => 'D', 'CACCTPARENT' => '4000'],

    // Akun Administratif (default, jika ada)
    ['CNO_KIRA' => '6000', 'CNAMA_KIRA' => 'ADMINISTRATIF', 'CHEAD_DET' => 'H', 'CGROUP' => 'X', 'CACCTPARENT' => null] // Menggunakan 'X' untuk kelompok default
];

$inserted_count = 0;
foreach ($data_to_insert as $data) {
    // Menggunakan Prepared Statements untuk keamanan
    $stmt = $koneksi->prepare("INSERT INTO tabkira (CNO_KIRA, CNAMA_KIRA, CHEAD_DET, CGROUP, CACCTPARENT) VALUES (?, ?, ?, ?, ?)");

    // Tipe data untuk bind_param: s=string, i=integer, d=double, b=blob
    // Karena semua kolom yang diisi di sini adalah string, kita gunakan 'sssss'
    $stmt->bind_param(
        "sssss",
        $data['CNO_KIRA'],
        $data['CNAMA_KIRA'],
        $data['CHEAD_DET'],
        $data['CGROUP'],
        $data['CACCTPARENT']
    );

    if ($stmt->execute()) {
        $inserted_count++;
        // echo "Berhasil memasukkan data: " . htmlspecialchars($data['CNAMA_KIRA']) . "<br>";
    } else {
        echo "Gagal memasukkan data: " . htmlspecialchars($data['CNAMA_KIRA']) . " - Error: " . $stmt->error . "<br>";
    }
    $stmt->close();
}

echo "<br><h3>Proses Selesai. " . $inserted_count . " data berhasil dimasukkan.</h3>";

// Tutup koneksi database
$koneksi->close();
