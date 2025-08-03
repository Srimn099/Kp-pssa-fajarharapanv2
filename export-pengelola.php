<?php
include('koneksi.php');

// Ambil keyword pencarian jika ada
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// Set header untuk download file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Data_Pengelola.xls");

// Mulai HTML
echo "
<html>
<head>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .judul {
        font-size: 16pt;
        font-weight: bold;
        text-align: center;
    }
    .subjudul {
        font-size: 11pt;
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th {
        background-color: #C0C0C0;
        font-weight: bold;
        text-align: center;
    }
   td, th {
    border: 0.5pt solid black;
    padding: 5px;
    text-align: center;
    vertical-align: middle;
}
    td {
        font-size: 10pt;
    }

</style>
</head>
<body>
";

// =======================
// Judul TANPA Border
// =======================
echo "
<div class='judul'>LAPORAN DATA PENGELOLA</div>
<div class='subjudul'>LEMBAGA KESEJAHTERAAN ANAK (LKSA)</div>
<div class='subjudul'>PANTI SOSIAL ASUHAN ANAK FAJAR HARAPAN</div>
<div class='subjudul'>Perumnas Sukaluyu Blok E1 No.107 Telp. (022) 25030788 Bandung 40123</div>
<br><br>
";

// =======================
// Tabel Header
// =======================
echo "<table>";
echo "<tr>
        <th>No</th>
        <th>No KTP</th>
        <th>Nama</th>
        <th>JK</th>
        <th>Usia</th>
        <th>Jabatan</th>
        <th>Alamat</th>
    </tr>";

// =======================
// Ambil dan Tampilkan Data
// =======================
$sql = "SELECT * FROM tb_pengelola
        WHERE 
            LOWER(nama) LIKE LOWER('%$search%')
            OR LOWER(no_ktp) LIKE LOWER('%$search%')
            OR LOWER(jk) LIKE LOWER('%$search%')
            OR LOWER(alamat) LIKE LOWER('%$search%')
            OR LOWER(jabatan) LIKE LOWER('%$search%')
        ORDER BY id DESC";

$result = $koneksi->query($sql);
$no = 1;

while ($data = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";

    // Kolom KTP: teks agar tidak berubah jadi E+15
    echo "<td style='mso-number-format:\"\\@\"'>" . $data['no_ktp'] . "</td>";

    echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
    echo "<td>" . htmlspecialchars($data['jk']) . "</td>";
    echo "<td>" . htmlspecialchars($data['usia']) . "</td>";
    echo "<td>" . htmlspecialchars($data['jabatan']) . "</td>";
    echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
    echo "</tr>";
}

echo "</table>";

// Tutup body dan html
echo "</body></html>";

// Tutup koneksi
$koneksi->close();
