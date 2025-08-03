php
<?php
include('koneksi.php');

// Check database connection
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Get student data with filtering capability
$tahun_masuk = isset($_POST['tahun_masuk']) ? $_POST['tahun_masuk'] : 'all';
$status_sekolah = isset($_POST['status_sekolah']) ? $_POST['status_sekolah'] : 'all';
$jk = isset($_POST['jk']) ? $_POST['jk'] : 'all';
$tahun_keluar = $_POST['tahun_keluar'] ?? 'all';

$sql = "SELECT * FROM tb_siswa WHERE 1=1";

if ($tahun_masuk !== 'all') {
    $sql .= " AND YEAR(tgl_masuk) = '" . mysqli_real_escape_string($koneksi, $tahun_masuk) . "'";
}

if ($status_sekolah !== 'all') {
    $sql .= " AND status_sekolah = '" . mysqli_real_escape_string($koneksi, $status_sekolah) . "'";
}

if ($jk !== 'all') {
    $sql .= " AND jk = '" . mysqli_real_escape_string($koneksi, $jk) . "'";
}
if ($tahun_keluar !== 'all') {
    $sql .= " AND tgl_keluar = '" . mysqli_real_escape_string($koneksi, $tgl_keluar) . "'";
}


$sql .= " ORDER BY id ASC";
$result = $koneksi->query($sql);

if (!$result) {
    die("Error dalam eksekusi query: " . $koneksi->error);
}

if ($result->num_rows === 0) {
    die("Tidak ada data siswa yang ditemukan.");
}

// Set headers for Excel download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_siswa_" . date('Y-m-d') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Start HTML table with enhanced styling
echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Data Siswa</x:Name>
                    <x:WorksheetOptions>
                        <x:DisplayGridlines/>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
    <style>
    body {
        font-family: Arial, sans-serif;
        
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
    }
    th, td {
        border: 1px solid #000000;
        padding: 5px;
        text-align: center;
        vertical-align: middle;
        font-size: 9pt;
    }
    th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
        font-size: 9pt;

    }
    tr:nth-child(even) {
        background-color: #f8f8f8;
    }
    .header-title {
        text-align: center;
        font-weight: bold;
        font-size: 14pt;
        margin-bottom: 5px;
    }
    .header-subtitle {
        text-align: center;
        font-size: 10pt;
        margin-bottom: 15px;
    }
    .number-cell {
        mso-number-format: "0";
    }
    .date-cell {
        mso-number-format: "dd\\-mm\\-yyyy";
    }
</style>
</head>
<body>';

// Add title and subtitle
echo '<div class="header-title">DATA SISWA</div>
<div class="header-subtitle">
    LEMBAGA KESEJAHTERAAN ANAK (LKSA)<br>
    PANTI SOSIAL ASUHAN ANAK FAJAR HARAPAN<br>
    Perumnas Sukaluyu Blok E1 No.107 Telp. (022) 25030788 Bandung 40123
</div>';

// Start table
echo '<table>
    <thead>
        <tr>
            <th width="30">No</th>
            <th>Nama Lengkap</th>
            <th>Tempat, Tanggal Lahir</th>
            <th width="30">JK</th>
            <th>Pendidikan</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Pekerjaan Orang Tua</th>
            <th width="110">Tgl Masuk</th>
            <th width="80">Tgl Keluar</th>
            <th>Status Siswa</th>
            <th>Status Sekolah</th>
            <th>Alamat</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
while ($row = $result->fetch_assoc()) {
    $jk = ($row['jk'] == 'Laki-laki') ? 'L' : 'P';
    $tgl_lahir = date('d-m-Y', strtotime($row['tgl_lahir']));
    $tgl_masuk = date('d-m-Y', strtotime($row['tgl_masuk']));
    $tgl_keluar = !empty($row['tgl_keluar']) ? date('d-m-Y', strtotime($row['tgl_keluar'])) : '-';

    echo '<tr>
            <td class="number-cell">' . $no . '</td>
            <td>' . htmlspecialchars($row['nama']) . '</td>
            <td>' . htmlspecialchars($row['tmp_lahir']) . ', ' . $tgl_lahir . '</td>
            <td>' . $jk . '</td>
            <td>' . htmlspecialchars($row['pendidikan_terakhir']) . '</td>
            <td>' . htmlspecialchars($row['nama_ayah']) . '</td>
            <td>' . htmlspecialchars($row['nama_ibu']) . '</td>
            <td>' . htmlspecialchars($row['pk_ortu']) . '</td>
            <td class="date-cell">' . $tgl_masuk . '</td>
            <td class="date-cell">' . $tgl_keluar . '</td>
            <td>' . htmlspecialchars($row['status']) . '</td>
            <td>' . htmlspecialchars($row['status_sekolah']) . '</td>
            <td>' . htmlspecialchars($row['alamat']) . '</td>
            <td>' . htmlspecialchars($row['keterangan']) . '</td>
        </tr>';
    $no++;
}

echo '</tbody></table></body></html>';

$koneksi->close();
?>