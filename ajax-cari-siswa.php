<?php
include 'koneksi.php';

$search = $_GET['search'] ?? '';
$statusFilter = $_GET['status_filter'] ?? '';
$jkFilter = $_GET['jk_filter'] ?? '';
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$limit = 10;
$start = ($halaman - 1) * $limit;

// Query dengan semua filter
$query = "SELECT * FROM tb_siswa WHERE 1=1";

if (!empty($search)) {
    $query .= " AND (
        LOWER(nama) LIKE LOWER('%$search%') OR
        LOWER(tmp_lahir) LIKE LOWER('%$search%') OR
        LOWER(tgl_lahir) LIKE LOWER('%$search%') OR
        LOWER(jk) LIKE LOWER('%$search%') OR
        LOWER(pendidikan_terakhir) LIKE LOWER('%$search%') OR
        LOWER(nama_ayah) LIKE LOWER('%$search%') OR
        LOWER(nama_ibu) LIKE LOWER('%$search%') OR
        LOWER(pk_ortu) LIKE LOWER('%$search%') OR
        LOWER(tgl_masuk) LIKE LOWER('%$search%') OR
        LOWER(tgl_keluar) LIKE LOWER('%$search%') OR
        LOWER(status) LIKE LOWER('%$search%') OR
        LOWER(status_sekolah) LIKE LOWER('%$search%') OR
        LOWER(alamat) LIKE LOWER('%$search%') OR
        LOWER(keterangan) LIKE LOWER('%$search%')
    )";
}

if (!empty($statusFilter) && $statusFilter !== 'all') {
    $query .= " AND status_sekolah = '$statusFilter'";
} else if (empty($statusFilter)) {
    $query .= " AND status_sekolah = 'Aktif'";
}

if (!empty($jkFilter)) {
    $query .= " AND jk = '$jkFilter'";
}

// Hitung total data untuk pagination
$totalQuery = str_replace('*', 'COUNT(*) AS total', explode('LIMIT', $query)[0]);
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

$query .= " ORDER BY id DESC LIMIT $start, $limit";

$result = $koneksi->query($query);
$no = ($halaman - 1) * $limit + 1;

// Output data
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td style='text-align: center;'>{$no}</td>
        <td>{$row['nama']}</td>
        <td>{$row['tmp_lahir']}, {$row['tgl_lahir']}</td>
        <td>{$row['jk']}</td>
        <td>{$row['pendidikan_terakhir']}</td>
        <td>{$row['nama_ayah']}</td>
        <td>{$row['nama_ibu']}</td>
        <td>{$row['pk_ortu']}</td>
        <td>{$row['tgl_masuk']}</td>
        <td>{$row['tgl_keluar']}</td>
        <td>{$row['status']}</td>
        <td>{$row['status_sekolah']}</td>
        <td><div style='display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; cursor: pointer;' onclick=\"showAlamat('" . htmlspecialchars(addslashes($row['alamat'])) . "')\" title='Klik untuk lihat alamat lengkap'>{$row['alamat']}</div></td>
        <td>{$row['keterangan']}</td>
        <td>
            <a href='home-member.php?page=ubah-siswa&id={$row['id']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>
            <button class='btn btn-danger btn-sm' onclick='confirmDelete({$row['id']})'><i class='fas fa-trash'></i></button>";

    if ($row['status_sekolah'] != 'Lulus') {
        echo "<a href='?page=data-siswa&lulus={$row['id']}' class='btn btn-info btn-sm p-1 fs-'><i class='fas fa-graduation-cap'></i> Lulus</a>";
    }

    echo "</td>
    </tr>";
    $no++;
}


// Output pagination HTML
?>
<nav>
    <ul class="pagination justify-content-center">
        <?php if ($halaman > 1): ?>
            <li class="page-item">
                <a class="page-link pagination-link" href="#" data-page="<?= ($halaman - 1) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
                <a class="page-link pagination-link" href="#" data-page="<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>

        <?php if ($halaman < $totalPages): ?>
            <li class="page-item">
                <a class="page-link pagination-link" href="#" data-page="<?= ($halaman + 1) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<?php
echo '`;
updateActivePage(' . $halaman . ');
</script>';
?>