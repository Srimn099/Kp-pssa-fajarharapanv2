<?php
include 'koneksi.php';

$search = $_GET['search'] ?? '';
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$limit = 10;
$start = ($halaman - 1) * $limit;

$query = "SELECT * FROM tb_siswa WHERE status_sekolah = 'Lulus'";

// Filter pencarian jika ada
if (!empty($search)) {
    $search = $koneksi->real_escape_string($search);
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
        LOWER(alamat) LIKE LOWER('%$search%') OR
        LOWER(keterangan) LIKE LOWER('%$search%')
    )";
}


// Hitung total data untuk pagination
$totalQuery = "SELECT COUNT(*) as total FROM tb_siswa WHERE status_sekolah = 'Lulus'";
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Tambah order dan limit
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
        <td><div style='display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; cursor: pointer;' onclick=\"showAlamat('" . htmlspecialchars(addslashes($row['alamat'])) . "')\" title='Klik untuk lihat alamat lengkap'>{$row['alamat']}</div></td>
        <td>{$row['keterangan']}</td>
        <td>
            <a href='home-member.php?page=ubah-siswa&id={$row['id']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i></a>
            <button class='btn btn-danger btn-sm' onclick='confirmDelete({$row['id']})'><i class='fas fa-trash'></i></button>
        </td>
    </tr>";
    $no++;
}
?>

<!-- Output pagination -->
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