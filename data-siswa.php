<?php
<<<<<<< HEAD
include('koneksi.php');

if (isset($_GET['lulus'])) {
    $id = (int) $_GET['lulus'];
    $queryLulus = "UPDATE tb_siswa SET status_sekolah = 'Lulus' WHERE id = $id";

    if ($koneksi->query($queryLulus)) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Siswa berhasil dipindahkan ke Alumni!',
                confirmButtonText: 'OK',
                confirmButtonColor: '#28a745' // Warna hijau (Bootstrap green)
            }).then(() => {
                window.location = 'home-member.php?page=data-siswa';
            });
        </script>
        ";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memperbarui status siswa.',
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#dc3545' // Warna merah (Bootstrap red)
            });
        </script>
        ";
    }
}

// Ambil input dari URL
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$statusFilter = isset($_GET['status_filter']) ? $_GET['status_filter'] : '';
$jkFilter = isset($_GET['jk_filter']) ? $_GET['jk_filter'] : '';
$halaman = isset($_GET['halaman']) && $_GET['halaman'] > 0 ? (int)$_GET['halaman'] : 1;
$limit = 10;
$start = max(0, ($halaman - 1) * $limit);

// Siapkan query awal
$query = "SELECT * FROM tb_siswa WHERE 1=1";
$totalQuery = "SELECT COUNT(*) AS total FROM tb_siswa WHERE 1=1";

// =============================
// 🔍 Tambahkan filter pencarian
// =============================
if (!empty($search)) {
    $searchCondition = " AND (
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
    $query .= $searchCondition;
    $totalQuery .= $searchCondition;
}

// ============================
// 🏫 Tambahkan filter status
// ============================
if ($statusFilter === 'all') {
    // tidak ditambah kondisi
} elseif (!empty($statusFilter)) {
    $query .= " AND status_sekolah = '" . mysqli_real_escape_string($koneksi, $statusFilter) . "'";
    $totalQuery .= " AND status_sekolah = '" . mysqli_real_escape_string($koneksi, $statusFilter) . "'";
} else {
    // Default: status Aktif
    $query .= " AND status_sekolah = 'Aktif'";
    $totalQuery .= " AND status_sekolah = 'Aktif'";
}

// ============================
// 👤 Tambahkan filter jenis kelamin
// ============================
if (!empty($jkFilter)) {
    $query .= " AND jk = '" . mysqli_real_escape_string($koneksi, $jkFilter) . "'";
    $totalQuery .= " AND jk = '" . mysqli_real_escape_string($koneksi, $jkFilter) . "'";
}

// ============================
// 📄 Tambahkan limit dan order
// ============================
$query .= " ORDER BY id DESC LIMIT $start, $limit";

// ============================
// 🚀 Eksekusi Query
// ============================
$result = $koneksi->query($query);
if (!$result) {
    die("Query Error: " . $koneksi->error);
}

$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

=======
// Memasukkan file koneksi database
include('koneksi.php');

// Jika ada siswa yang diklik untuk dipindahkan ke alumni
if (isset($_GET['lulus'])) {
    $id = (int) $_GET['lulus']; // Pastikan ID aman dari SQL Injection
    $query = "UPDATE tb_siswa SET status_sekolah = 'Lulus' WHERE id = $id";


    if ($koneksi->query($query)) {
        echo "<script>
                alert('Siswa berhasil dipindahkan ke Alumni!');
                window.location='home-member.php?page=data-siswa';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui status!');</script>";
    }
}

// Konfigurasi Pagination
$limit = 10; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) && $_GET['halaman'] > 0 ? (int)$_GET['halaman'] : 1;
$start = max(0, ($halaman - 1) * $limit);

// Mengambil keyword pencarian jika ada
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// Query untuk menghitung total data
$totalQuery = "SELECT COUNT(*) AS total FROM tb_siswa WHERE LOWER(nama) LIKE LOWER('%$search%') AND status_sekolah != 'Lulus'";
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Query untuk mengambil data siswa
$sql = "SELECT id, nama, tmp_lahir, tgl_lahir, jk, pendidikan_terakhir, nama_ayah, nama_ibu, pk_ortu, tgl_masuk, tgl_keluar, status, status_sekolah, alamat
FROM tb_siswa
WHERE LOWER(nama) LIKE LOWER('%$search%') AND status_sekolah != 'Lulus'
ORDER BY id ASC
LIMIT $start, $limit";

$result = $koneksi->query($sql);

if (!$result) {
    die("Query Error: " . $koneksi->error);
}
?>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data siswa ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim permintaan penghapusan ke server
                fetch("home-member.php?page=hapus-siswa&id=" + id)
                    .then(response => response.text())
                    .then(data => {
                        // Jika berhasil, tampilkan SweetAlert sukses
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil dihapus!",
                            icon: "success",
                            confirmButtonColor: "#28a745", // Warna hijau
                            confirmButtonText: "OK"
                        }).then(() => {
                            // Reload halaman setelah konfirmasi
                            location.reload();
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            title: "Error!",
                            text: "Terjadi kesalahan saat menghapus data.",
                            icon: "error"
                        });
                    });
            }
        });
    }
<<<<<<< HEAD
</script>

<script>
    function showAlamat(alamat) {
        Swal.fire({
            title: 'Alamat Lengkap',
            text: alamat,
            icon: 'info',
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#3085d6',
            customClass: {
                popup: 'swal-wide'
=======

    function confirmLulus(id) {
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin memindahkan siswa ini ke Alumni?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, pindahkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Arahkan ke halaman PHP yang akan memproses perpindahan siswa
                window.location.href = "home-member.php?page=data-siswa&lulus=" + id;
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            }
        });
    }
</script>
<<<<<<< HEAD
<script>
    function showKeterangan(keterangan) {
        Swal.fire({
            title: 'Keterangan',
            text: keterangan,
            icon: 'info',
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#3085d6',
            customClass: {
                popup: 'swal-wide'
            }
        });
    }
</script>
<style>
    /* Opsional: bikin lebar pop-up lebih besar */
    .swal-wide {
        width: 500px;
    }

    /* Ubah ukuran ikon bawaan SweetAlert2 */
    .swal2-icon {
        transform: scale(0.7);
        /* kecilkan menjadi 70% */
    }
</style>
=======
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f

<style>
    .swal2-popup {
        font-size: 14px !important;
    }

    .swal2-title {
        font-size: 16px !important;
    }

    .swal2-confirm,
    .swal2-cancel {
        font-size: 14px !important;
        /* Ubah ukuran font tombol */
        padding: 9px 10px !important;
        /* Sesuaikan padding agar lebih kecil */
    }
</style>
<<<<<<< HEAD

<div class="container">
    <h2 class="mb-4 text-center">Data Siswa</h2>

    <div class="d-flex align-items-center mb-3 gap-2 flex-wrap">
        <a href="home-member.php?page=tambah-siswa" class="btn btn-primary btn-tambah">
            <i class="fas fa-user-plus"></i> Tambah Siswa
        </a>
        <a href="cetaksiswapdf.php?search=<?= urlencode($search) ?>" target="_blank" class="btn btn-success">
            <i class="fas fa-file-pdf"></i> Cetak PDF
        </a>
        <!-- Button Trigger Modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
            <i class="fa fa-file-excel"></i> Export Excel
        </button>

        <!-- Export Modal -->
        <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exportModalLabel">
                            <i class="fas fa-file-export me-2"></i>Filter Export Excel
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="export-siswa.php" target="_blank">
                        <div class="modal-body">
                            <div class="row g-3">
                                <!-- Tahun Masuk -->
                                <div class="col-md-6">
                                    <label for="export_tahun_masuk" class="form-label">Tahun Masuk</label>
                                    <select name="tahun_masuk" id="export_tahun_masuk" class="form-select border border-secondary">
                                        <option value="all">Semua Tahun</option>
                                        <?php
                                        $tahunSekarang = date('Y');
                                        for ($i = $tahunSekarang; $i >= $tahunSekarang - 10; $i--) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Tahun Keluar -->
                                <div class="col-md-6">
                                    <label for="export_tahun_keluar" class="form-label">Tahun Keluar</label>
                                    <select name="tahun_keluar" id="export_tahun_keluar" class="form-select border border-secondary">
                                        <option value="all">Semua Tahun</option>
                                        <?php
                                        $tahunSekarang = date('Y');
                                        for ($i = $tahunSekarang; $i >= $tahunSekarang - 10; $i--) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Status Sekolah -->
                                <div class="col-md-6">
                                    <label for="export_status" class="form-label">Status Sekolah</label>
                                    <select name="status_sekolah" id="export_status" class="form-select border border-secondary">
                                        <option value="all">Semua Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Lulus">Lulus</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="col-md-6">
                                    <label for="export_jk" class="form-label">Jenis Kelamin</label>
                                    <select name="jk" id="export_jk" class="form-select border border-secondary">
                                        <option value="all">Semua</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-file-export me-1"></i> Export
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>
            .modal-header {
                padding: 12px 20px;
            }

            .modal-title {
                font-size: 18px;
            }

            .form-label {
                font-weight: 500;
                margin-bottom: 5px;
            }

            .modal-footer .btn {
                padding: 8px 16px;
            }
        </style>
    </div>

=======
<div class="container">
    <h2 class="mb-4 text-center">Data Siswa</h2>


    <a href="home-member.php?page=tambah-siswa" class="btn btn-primary btn-tambah mb-3">
        <i class="fas fa-user-plus"></i> Tambah Siswa
    </a>
    <a href="cetaksiswapdf.php?search=<?= urlencode($search) ?>" target="_blank" class="btn btn-success mb-3">
        <i class="fas fa-file-pdf"></i> Cetak
    </a>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f

    <style>
        .search-input {
            border: 1px solid #696969 !important;
            /* Warna border biru */
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
        }

        .search-input:focus {
            border-color: #28a745 !important;
            /* Warna hijau saat fokus */
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }

        .table {
            table-layout: fixed;
            width: 100%;
            word-wrap: break-word;
            white-space: normal;
        }

        .table th {
            padding: 10px;
            text-align: center;
            font-weight: bold;
            color: white;
            font-size: 12px;
            border: 1px solid #A9A9A9 !important;
            background-color: #696969;
            text-align: center;
            /* Rata tengah horizontal */
            vertical-align: middle;
            /* Rata tengah vertikal */
        }

        .table td {
            border: 1px solid #A9A9A9 !important;
            font-size: 12px;
            /* Border di dalam tabel */
            overflow: hidden;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }

        .table th:first-child,
        .table td:first-child {
            width: 40px;
            /* Sesuaikan sesuai kebutuhan */
            text-align: center;
            white-space: nowrap;
        }

        .btn {
            font-size: 11px;
            /* Memperkecil ukuran tombol */
            padding: 6px 5px;
        }

        .btn-tambah {
            font-size: 14px;
            /* Ukuran teks */
            padding: 8px 15px;
            /* Padding agar lebih besar */

        }

        .btn-success {
            font-size: 14px;
            /* Ukuran teks */
            padding: 8px 15px;
            /* Padding agar lebih besar */

        }
<<<<<<< HEAD

        .btn-secondary {
            font-size: 14px;
            padding: 8px 15px;

        }

        .btn-filter-custom {
            height: 34px;
            /* atur tinggi tombol */
            white-space: nowrap;
            /* cegah teks turun ke bawah */
            font-size: 13px;
            /* ukuran teks */
        }
    </style>

    <div class="row g-2 mb-3 align-items-center">
        <!-- Search and Status Filter Section -->
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-2">
                <!-- Status Filter -->
                <div class="d-flex align-items-center">
                    <label for="statusFilter" class="form-label mb-0 me-2">Tampilkan siswa yang:</label>
                    <select name="status_filter" id="statusFilter" class="form-select form-select-sm border border-secondary" style="width: 100px;">
                        <option value="" <?= $statusFilter === '' ? 'selected' : '' ?>>Aktif</option>
                        <option value="Lulus" <?= $statusFilter === 'Lulus' ? 'selected' : '' ?>>Lulus</option>
                        <option value="Nonaktif" <?= $statusFilter === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        <option value="all" <?= $statusFilter === 'all' ? 'selected' : '' ?>>Semua</option>
                    </select>
                </div>

                <!-- Search Input -->
                <div class="flex-grow-1">
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" id="liveSearch" class="form-control form-control-sm border border-secondary" placeholder="Cari..." value="<?= htmlspecialchars($search) ?>">
                        <button class="btn btn-outline-secondary border border-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Advanced Filter Button -->
                <button type="button" class="btn btn-outline-primary btn-sm border border-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="fas fa-filter"> Filter</i>
                </button>
            </div>
        </div>

        <!-- Bulk Graduation Section -->
        <div class="col-md-5">
            <form method="POST" action="luluskan-massal.php" class="d-flex align-items-center justify-content-end gap-2" id="formLulusMassal">
                <div class="d-flex align-items-center">
                    <label for="tahun_masuk" class="form-label mb-0 me-2">Luluskan siswa masuk tahun:</label>
                    <select name="tahun_masuk" id="tahun_masuk" class="form-select form-select-sm border border-secondary" style="width: 80px;">
                        <?php
                        $tahunSekarang = date('Y');
                        for ($i = $tahunSekarang; $i >= $tahunSekarang - 10; $i--) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="button" onclick="confirmLulusMassal()" class="btn btn-success btn-sm border border-secondary">
                    <i class="fas fa-graduation-cap"></i> Proses
                </button>
            </form>
        </div>
        <!-- Modal Filter -->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form method="GET" action="" class="modal-content border-0 shadow-sm">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="filterModalLabel">
                            <i class="fas fa-filter me-2 text-primary"></i> Filter Data Siswa
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="page" value="data-siswa">
                        <input type="hidden" name="halaman" value="1">

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="status_filter" class="form-label fw-semibold">Status Sekolah</label>
                                <select name="status_filter" class="form-select red-border">
                                    <option value="" <?= $statusFilter === '' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="Lulus" <?= $statusFilter === 'Lulus' ? 'selected' : '' ?>>Lulus</option>
                                    <option value="Nonaktif" <?= $statusFilter === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                                    <option value="all" <?= $statusFilter === 'all' ? 'selected' : '' ?>>Semua</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="jk_filter" class="form-label fw-semibold">Jenis Kelamin</label>
                                <select name="jk_filter" class="form-select red-border">
                                    <option value="" <?= $jkFilter === '' ? 'selected' : '' ?>>Semua</option>
                                    <option value="Laki-laki" <?= $jkFilter === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="Perempuan" <?= $jkFilter === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-success">
                            <i class=""></i> Terapkan
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class=""></i> Tutup
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
=======
    </style>
    <!-- Form Pencarian -->
    <form method="GET" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control search-input" placeholder="Cari Nama Siswa..." value="<?= htmlspecialchars($search) ?>">

        </div>
    </form>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f

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
<<<<<<< HEAD
                <th>Status Siswa</th>
                <th>Status Sekolah</th>
                <th>Alamat</th>
                <th>Ket</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
=======
                <th>Status</th>
                <th>Status Sekolah</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            <?php
            if ($result->num_rows > 0) {
                $no = $start + 1;
                while ($data = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td style='text-align: center;'>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
<<<<<<< HEAD
                    echo "<td>" . htmlspecialchars($data['tmp_lahir']) . ", " . (!empty($data['tgl_lahir']) ? date('d-m-Y', strtotime($data['tgl_lahir'])) : '-') . "</td>";
=======
                    echo "<td>" . htmlspecialchars($data['tmp_lahir']) . ", " . htmlspecialchars($data['tgl_lahir']) . "</td>";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    echo "<td>" . htmlspecialchars($data['jk']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['pendidikan_terakhir']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['nama_ayah']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['nama_ibu']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['pk_ortu']) . "</td>";
<<<<<<< HEAD
                    echo "<td>" . (!empty($data['tgl_masuk']) ? date('d-m-Y', timestamp: strtotime($data['tgl_masuk'])) : '-') . "</td>";
                    echo "<td>" . (!empty($data['tgl_keluar']) ? date('d-m-Y', strtotime($data['tgl_keluar'])) : '-') . "</td>";
                    echo "<td>" . htmlspecialchars($data['status'] ?? '-') . "</td>";
                    echo "<td>" . htmlspecialchars($data['status_sekolah'] ?? '-') . "</td>";
                    echo "<td><div style='display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; cursor: pointer;'onclick=\"showAlamat('" . htmlspecialchars(addslashes($data['alamat'])) . "')\"title='Klik untuk lihat alamat lengkap'>" . htmlspecialchars($data['alamat']) . "</div></td>";
                    echo "<td><div style='display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; cursor: pointer;'onclick=\"showKeterangan('" . htmlspecialchars(addslashes($data['keterangan'])) . "')\"title='Klik untuk lihat alamat lengkap'>" . htmlspecialchars($data['keterangan']) . "</div></td>";
=======
                    echo "<td>" . htmlspecialchars($data['tgl_masuk']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['tgl_keluar'] ?? '-') . "</td>";
                    echo "<td>" . htmlspecialchars($data['status'] ?? '-') . "</td>";
                    echo "<td>" . htmlspecialchars($data['status_sekolah'] ?? '-') . "</td>";
                    echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    echo "<td>
                        <a href='home-member.php?page=ubah-siswa&id=" . $data['id'] . "' class='btn btn-warning btn-sm'>
                            <i class='fas fa-edit'></i> 
                        </a>
                        <button class='btn btn-danger btn-sm' onclick='confirmDelete(" . $data['id'] . ")'>
                            <i class='fas fa-trash'></i> 
                        </button>";
<<<<<<< HEAD
                    // Jika siswa belum "Lulus", tampilkan tombol Lulus
                    if ($data['status'] != 'Lulus') {
                        echo "<a href='?page=data-siswa&lulus=" . $data['id'] . "' class='btn btn-info btn-sm p-1 fs-'>
                                <i class='fas fa-graduation-cap'></i> Lulus
                              </a>";
                    }
=======

                    echo "<button class='btn btn-info btn-sm p-1 fs-7' onclick='confirmLulus(" . $data['id'] . ")'>
                        <i class='fas fa-graduation-cap'></i> Lulus
                      </button>";

>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
<<<<<<< HEAD
                echo "<tr><td colspan='15' class='text-center'>Tidak ada data siswa</td></tr>";
=======
                echo "<tr><td colspan='13' class='text-center'>Tidak ada data siswa</td></tr>";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            }
            ?>
        </tbody>
    </table>

<<<<<<< HEAD
    <!-- Navigation Pagination -->
    <nav>
        <ul class="pagination justify-content-center" id="pagination-container">
            <?php if ($halaman > 1): ?>
                <li class="page-item">
                    <a class="page-link pagination-link" href="#" data-page="<?= ($halaman - 1) ?>" aria-label="Previous">
                        &laquo; Previous
=======

    <!-- Navigation Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($halaman > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=data-siswa&halaman=<?= $halaman - 1 ?>&search=<?= urlencode($search) ?>" aria-label="Previous" title="Previous Page">
                        <span aria-hidden="true">&laquo; Previous</span>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
<<<<<<< HEAD
                    <a class="page-link pagination-link" href="#" data-page="<?= $i ?>">
                        <?= $i ?>
                    </a>
=======
                    <a class="page-link" href="?page=data-siswa&halaman=<?= $i ?>&search=<?= urlencode($search) ?>" title="Page <?= $i ?>"><?= $i ?></a>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                </li>
            <?php endfor; ?>

            <?php if ($halaman < $totalPages): ?>
                <li class="page-item">
<<<<<<< HEAD
                    <a class="page-link pagination-link" href="#" data-page="<?= ($halaman + 1) ?>" aria-label="Next">Next
                        <span aria-hidden="true">&raquo;</span>
=======
                    <a class="page-link" href="?page=data-siswa&halaman=<?= $halaman + 1 ?>&search=<?= urlencode($search) ?>" aria-label="Next" title="Next Page">
                        <span aria-hidden="true">Next &raquo;</span>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<<<<<<< HEAD
    <style>
        .pagination {
            margin: 10px 0;
        }

        .page-item.active .page-link {
            background-color: #007bff !important;
            border-color: #007bff !important;
            color: white !important;
        }

        .page-link {
            padding: 2px 8px;
            margin: 0 5px;
            border-radius: 5px;
            border: 1px solid #007bff;
            color: #007bff;
            transition: background-color 0.3s, color 0.3s;
            font-size: 13px;
        }

        .page-link:hover {
            background-color: #0056b3;
            color: white;
        }

        .custom-border {
            border: 1px solid #696969 !important;
            /* Warna border biru */
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
        }

        .red-border {
            border: 1px solid #696969;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("liveSearch");
            const statusFilter = document.getElementById("statusFilter");
            const jkFilter = document.querySelector("select[name='jk_filter']");
            const resultBox = document.getElementById("table-body");
            let debounceTimer;

            // Fungsi untuk memuat data
            function loadData(page = 1) {
                const params = new URLSearchParams();
                params.append('search', searchInput.value);
                params.append('status_filter', statusFilter.value);
                params.append('jk_filter', jkFilter.value);
                params.append('halaman', page);

                fetch("home-member.php?page=data-siswa&" + params.toString())
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        // Update tabel
                        resultBox.innerHTML = doc.getElementById('table-body').innerHTML;

                        // Update pagination
                        const newPagination = doc.getElementById('pagination-container');
                        if (newPagination) {
                            document.getElementById('pagination-container').innerHTML = newPagination.innerHTML;
                        }

                        // Update URL
                        window.history.pushState({}, '', `?page=data-siswa&${params.toString()}`);
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        resultBox.innerHTML = "<tr><td colspan='15' class='text-danger'>Gagal memuat data.</td></tr>";
                    });
            }

            // Tangani klik pagination
            document.addEventListener('click', function(e) {
                if (e.target.closest('.page-link')) {
                    e.preventDefault();
                    const page = e.target.closest('.page-link').dataset.page;
                    loadData(page);
                }
            });

            // Realtime search
            searchInput.addEventListener("input", function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => loadData(1), 300);
            });

            // Filter change
            statusFilter.addEventListener("change", () => loadData(1));
            jkFilter.addEventListener("change", () => loadData(1));
        });
    </script>

    <?php
    // Menutup koneksi
    $koneksi->close();
    ?>
    <?php if (isset($_GET['notif'])): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                <?php if ($_GET['notif'] === 'berhasil'): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        html: 'Sebanyak <b><?= htmlspecialchars($_GET['jumlah']) ?></b> siswa tahun <b><?= htmlspecialchars($_GET['tahun']) ?></b> telah diluluskan.',
                        confirmButtonColor: '#28a745'
                    });
                <?php elseif ($_GET['notif'] === 'gagal'): ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat meluluskan siswa.',
                        confirmButtonColor: '#dc3545'
                    });
                <?php elseif ($_GET['notif'] === 'tidak_ada'): ?>
                    Swal.fire({
                        icon: 'info',
                        title: 'Tidak Ada Data',
                        html: 'Tidak ditemukan siswa aktif yang masuk pada tahun <b><?= htmlspecialchars($_GET['tahun']) ?></b>.',
                        confirmButtonColor: '#17a2b8'
                    });
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>
    <script>
        function confirmLulusMassal() {
            const tahun = document.getElementById('tahun_masuk').value;

            // Cek dulu via AJAX apakah ada data
            fetch(`cek-siswa.php?tahun=${tahun}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Jika ada data, tampilkan konfirmasi
                        Swal.fire({
                            title: 'Konfirmasi',
                            html: `Anda akan meluluskan ${data.count} siswa yang masuk pada tahun <b>${tahun}</b>.<br><br>Apakah Anda yakin?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Luluskan',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('formLulusMassal').submit();
                            }
                        });
                    } else {
                        // Jika tidak ada data
                        Swal.fire({
                            icon: 'error',
                            title: 'Tidak Ada Data',
                            html: `Tidak ditemukan siswa aktif yang masuk pada tahun <b>${tahun}</b>.`,
                            confirmButtonColor: '#28a745'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memeriksa data siswa.',
                        confirmButtonColor: '#dc3545'
                    });
                });
        }
    </script>
=======


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let searchInput = document.querySelector("input[name='search']");
            let tableRows = document.querySelectorAll("tbody tr");

            searchInput.addEventListener("keyup", function() {
                let searchValue = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    let rowData = row.innerText.toLowerCase();
                    row.style.display = rowData.includes(searchValue) ? "" : "none";
                });
            });
        });
    </script>




    <?php
    // Menutup koneksi
    $koneksi->close();
    ?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
