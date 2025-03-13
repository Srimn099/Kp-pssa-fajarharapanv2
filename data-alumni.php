<?php
// Memasukkan file koneksi.php
include('koneksi.php');

// Konfigurasi Pagination
$limit = 10; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) && $_GET['halaman'] > 0 ? (int)$_GET['halaman'] : 1;
$start = max(0, ($halaman - 1) * $limit);

// Mengambil keyword pencarian jika ada
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// Query untuk menghitung total data alumni
$totalQuery = "SELECT COUNT(*) AS total FROM tb_siswa WHERE status = 'Lulus' AND nama LIKE '%$search%'";
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Query untuk mengambil data alumni (yang sudah "Lulus")
$sql = "SELECT id, nama, tmp_lahir, tgl_lahir, jk, pendidikan_terakhir, nama_ayah, nama_ibu, pk_ortu, tgl_masuk, tgl_keluar, alamat 
        FROM tb_siswa 
        WHERE status = 'Lulus' AND LOWER(nama) LIKE LOWER('%$search%') 
        ORDER BY id ASC 
        LIMIT $start, $limit";
$result = $koneksi->query($sql);

// Proses membatalkan status lulus (mengubah ke Aktif)
if (isset($_GET['batal_lulus'])) {
    $id = (int)$_GET['batal_lulus'];
    $query = "UPDATE tb_siswa SET status = 'Aktif' WHERE id = $id";
    if ($koneksi->query($query)) {
        echo "<script>alert('Status siswa berhasil dikembalikan ke Aktif!'); window.location='home-member.php?page=data-alumni';</script>";
    } else {
        echo "<script>alert('Gagal mengubah status!');</script>";
    }
}
?>

<h2>Data Alumni</h2>

<!-- Form Pencarian -->
<form method="GET" action="">
    <input type="hidden" name="page" value="data-alumni">
    <input type="text" name="search" placeholder="Cari nama..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Cari</button>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tempat tanggal lahir</th>
            <th>JK</th>
            <th>Pend. Terakhir</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Pekerjaan Ortu</th>
            <th>Tgl Masuk</th>
            <th>Tgl Keluar</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            $no = $start + 1;
            while ($data = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='text-align: center;'>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($data['tmp_lahir']) . ", " . htmlspecialchars($data['tgl_lahir']) . "</td>";
                echo "<td>" . htmlspecialchars($data['jk']) . "</td>";
                echo "<td>" . htmlspecialchars($data['pendidikan_terakhir']) . "</td>";
                echo "<td>" . htmlspecialchars($data['nama_ayah']) . "</td>";
                echo "<td>" . htmlspecialchars($data['nama_ibu']) . "</td>";
                echo "<td>" . htmlspecialchars($data['pk_ortu']) . "</td>";
                echo "<td>" . htmlspecialchars($data['tgl_masuk']) . "</td>";
                echo "<td>" . htmlspecialchars($data['tgl_keluar'] ?? '-') . "</td>";
                echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
                echo "<td>
                    <a href='?page=data-alumni&batal_lulus=" . $data['id'] . "' class='btn btn-warning btn-sm' onclick='return confirm(\"Yakin ingin mengaktifkan kembali siswa ini?\")'>
                        <i class='fas fa-undo'></i> Batalkan Lulus
                    </a>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12' class='text-center'>Tidak ada data alumni</td></tr>";
        }
        ?>
    </tbody>
</table>


<!-- Navigasi Pagination -->
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
                <a class="page-link" href="?page=data-alumni&halaman=<?= $i ?>&search=<?= htmlspecialchars($search) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>