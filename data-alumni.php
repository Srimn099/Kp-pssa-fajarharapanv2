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
<<<<<<< HEAD
$totalQuery = "SELECT COUNT(*) AS total FROM tb_siswa WHERE status_sekolah = 'Lulus' AND nama LIKE '%$search%'";
=======
$totalQuery = "SELECT COUNT(*) AS total FROM tb_siswa WHERE status_sekolah = 'Lulus' AND LOWER(nama) LIKE LOWER('%$search%')";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

<<<<<<< HEAD
// Query untuk mengambil data alumni (yang sudah "Lulus")
$sql = "SELECT id, nama, tmp_lahir, tgl_lahir, jk, pendidikan_terakhir, nama_ayah, nama_ibu, pk_ortu, tgl_masuk, tgl_keluar, status, status_sekolah,keterangan, alamat 
        FROM tb_siswa 
        WHERE status_sekolah = 'Lulus' AND LOWER(nama) LIKE LOWER('%$search%') 
        ORDER BY id ASC 
        LIMIT $start, $limit";
$result = $koneksi->query($sql);
=======
$sql = "SELECT id, nama, tmp_lahir, tgl_lahir, jk, pendidikan_terakhir, nama_ayah, nama_ibu, pk_ortu, tgl_masuk, tgl_keluar, alamat 
        FROM tb_siswa 
        WHERE status_sekolah = 'Lulus' 
        ORDER BY id ASC 
        LIMIT $start, $limit";

$result = $koneksi->query($sql) or die("Query Error: " . $koneksi->error);


>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f

// Proses membatalkan status lulus (mengubah ke Aktif)
if (isset($_GET['batal_lulus'])) {
    $id = (int)$_GET['batal_lulus'];
    $query = "UPDATE tb_siswa SET status_sekolah = 'Aktif' WHERE id = $id";
    if ($koneksi->query($query)) {
        echo "<script>alert('Status siswa berhasil dikembalikan ke Aktif!'); window.location='home-member.php?page=data-alumni';</script>";
    } else {
        echo "<script>alert('Gagal mengubah status!');</script>";
    }
}
?>


<<<<<<< HEAD
=======


>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</script>

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
<div class="container">
    <h2 class="mb-4 text-center">Data Alumni</h2>

<<<<<<< HEAD
    <!-- Tombol Cetak & Export -->
    <div class="mb-3 d-flex gap-2">
        <a href="cetakalumni.php?search=<?= urlencode($search) ?>" target="_blank" class="btn btn-success">
            <i class="fas fa-file-pdf"></i> Cetak
        </a>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportModal">
            <i class="fa fa-file-excel"></i> Export Excel
        </button>
    </div>

    <!-- Modal Export -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Header Modal -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exportModalLabel">
                        <i class="fas fa-file-export me-2"></i> Filter Export Excel
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <!-- Form Filter -->
                <form method="post" action="export-alumni.php" target="_blank">
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
                                    for ($i = $tahunSekarang; $i >= $tahunSekarang - 10; $i--) {
                                        echo "<option value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Pendidikan Terakhir -->
                            <div class="col-md-6">
                                <label for="export_pendidikan" class="form-label">Pendidikan Terakhir</label>
                                <select name="pendidikan_terakhir" id="export_pendidikan" class="form-select border border-secondary">
                                    <option value="all">Semua</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
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

                    <!-- Footer Modal -->
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


    .btn-secondary {
        font-size: 14px;
        padding: 8px 15px;

    }

    .btn-success {
        font-size: 14px;
        /* Ukuran teks */
        padding: 8px 15px;
        /* Padding agar lebih besar */
    }

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
</style>

<!-- FORM Live Search untuk Data Alumni -->
<form id="form-search" method="GET" onsubmit="return false;">
    <input type="hidden" name="page" value="data-alumni">
    <div class="flex-grow-1 mb-3" style="max-width: 300px; margin-top: -4px;">
        <div class="input-group input-group-sm">
            <input type="text"
                name="search"
                id="liveSearch"
                class="form-control form-control-sm border border-secondary"
                placeholder="Masukkan kata kunci..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                autocomplete="off"
                style="font-size: 14px; height: 32px;">
            <span class="input-group-text border border-secondary bg-white">
                <i class="fas fa-search text-secondary"></i>
            </span>
        </div>
    </div>
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
            <th>Status Siswa</th>
            <th>Status Sekolah</th>
            <th>Alamat</th>
            <th>Ket</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="table-body">

        <?php
        if ($result->num_rows > 0) {
            $no = $start + 1;
            while ($data = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='text-align: center;'>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($data['tmp_lahir']) . ", " . (!empty($data['tgl_lahir']) ? date('d-m-Y', strtotime($data['tgl_lahir'])) : '-') . "</td>";
                echo "<td>" . htmlspecialchars($data['jk']) . "</td>";
                echo "<td>" . htmlspecialchars($data['pendidikan_terakhir']) . "</td>";
                echo "<td>" . htmlspecialchars($data['nama_ayah']) . "</td>";
                echo "<td>" . htmlspecialchars($data['nama_ibu']) . "</td>";
                echo "<td>" . htmlspecialchars($data['pk_ortu']) . "</td>";
                echo "<td>" . (!empty($data['tgl_masuk']) ? date('d-m-Y', timestamp: strtotime($data['tgl_masuk'])) : '-') . "</td>";
                echo "<td>" . (!empty($data['tgl_keluar']) ? date('d-m-Y', strtotime($data['tgl_keluar'])) : '-') . "</td>";
                echo "<td>" . htmlspecialchars($data['status'] ?? '-') . "</td>";
                echo "<td>" . htmlspecialchars($data['status_sekolah'] ?? '-') . "</td>";
                echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
                echo "<td>" . htmlspecialchars($data['keterangan'] ?? '') . "</td>";
                echo "<td>
=======
    <a href="cetaksiswapdf.php?search=<?= urlencode($search) ?>" target="_blank" class="btn btn-success mb-3">
        <i class="fas fa-file-pdf"></i> Cetak
    </a>

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
    </style>
    <!-- Form Pencarian -->
    <form method="GET" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control search-input" placeholder="Cari Nama Siswa..." value="<?= htmlspecialchars($search) ?>">

        </div>
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    <a href='?page=data-alumni&batal_lulus=" . $data['id'] . "' class='btn btn-warning btn-sm' onclick='return confirm(\"Yakin ingin mengaktifkan kembali siswa ini?\")'>
                        <i class='fas fa-undo'></i> Batalkan Lulus
                    </a>
                </td>";
<<<<<<< HEAD
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='15' class='text-center'>Tidak ada data alumni</td></tr>";
        }
        ?>
    </tbody>
</table>


<nav id="pagination-container">
    <ul class="pagination justify-content-center">
        <?php if ($halaman > 1): ?>
            <li class="page-item">
                <a class="page-link" href="#" data-page="<?= $halaman - 1 ?>" aria-label="Previous">
                    &laquo; Prev
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
                <a class="page-link" href="#" data-page="<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($halaman < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="#" data-page="<?= $halaman + 1 ?>" aria-label="Next">
                    Next &raquo;
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("liveSearch");
        const resultBox = document.getElementById("table-body"); // pastikan <tbody> punya id="table-body"
        let debounceTimer;

        function loadData(page = 1) {
            const params = new URLSearchParams();
            params.append('page', 'data-alumni');
            params.append('search', searchInput.value);
            params.append('halaman', page);

            fetch("home-member.php?" + params.toString())
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Ganti isi tabel
                    resultBox.innerHTML = doc.getElementById('table-body').innerHTML;

                    // Ganti pagination kalau ada
                    const newPagination = doc.getElementById('pagination-container');
                    if (newPagination) {
                        document.getElementById('pagination-container').innerHTML = newPagination.innerHTML;
                    }

                    // Update URL browser
                    window.history.replaceState({}, '', `?${params.toString()}`);
                })
                .catch(error => {
                    console.error("Gagal load data:", error);
                    resultBox.innerHTML = "<tr><td colspan='100%' class='text-danger'>Gagal memuat data.</td></tr>";
                });
        }

        // Deteksi input ketik (dengan debounce)
        searchInput.addEventListener("input", function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => loadData(1), 300);
        });

        // Pagination tetap pakai delegasi
        document.addEventListener('click', function(e) {
            if (e.target.closest('.page-link')) {
                e.preventDefault();
                const page = e.target.closest('.page-link').dataset.page;
                if (page) loadData(page);
            }
        });
    });
</script>
=======
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12' class='text-center'>Tidak ada data alumni</td></tr>";
            }
            ?>
        </tbody>
    </table>


    <!-- Navigation Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($halaman > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=data-siswa&halaman=<?= $halaman - 1 ?>&search=<?= urlencode($search) ?>" aria-label="Previous" title="Previous Page">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=data-siswa&halaman=<?= $i ?>&search=<?= urlencode($search) ?>" title="Page <?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($halaman < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=data-siswa&halaman=<?= $halaman + 1 ?>&search=<?= urlencode($search) ?>" aria-label="Next" title="Next Page">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>


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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f




<<<<<<< HEAD

<?php
// Menutup koneksi
$koneksi->close();
?>
=======
    <?php
    // Menutup koneksi
    $koneksi->close();
    ?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
