<?php
// Memasukkan file koneksi.php
include('koneksi.php');

// Konfigurasi Pagination
$limit = 10; // Jumlah data per halaman
$halaman = isset($_GET['halaman']) && $_GET['halaman'] > 0 ? (int)$_GET['halaman'] : 1;
$start = max(0, ($halaman - 1) * $limit);


// Mengambil keyword pencarian jika ada
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// Query untuk menghitung total data (dengan pencarian tidak peka huruf besar/kecil)
$totalQuery = "SELECT COUNT(*) AS total FROM tb_pengelola WHERE nama LIKE '%$search%'";
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Query untuk mengambil data pengelola (dengan pencarian tidak peka huruf besar/kecil)
$sql = "SELECT id, foto, no_ktp, nama, jk, usia, alamat, jabatan
        FROM tb_pengelola 
<<<<<<< HEAD
        WHERE 
            LOWER(nama) LIKE LOWER('%$search%')
            OR LOWER(no_ktp) LIKE LOWER('%$search%')
            OR LOWER(jk) LIKE LOWER('%$search%')
            OR LOWER(alamat) LIKE LOWER('%$search%')
            OR LOWER(jabatan) LIKE LOWER('%$search%')
        ORDER BY id DESC
=======
        WHERE LOWER(nama) LIKE LOWER('%$search%') 
        ORDER BY id ASC 
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
        LIMIT $start, $limit";
$result = $koneksi->query($sql);
if (!$result) {
    die("Query Error: " . $koneksi->error);
}
?>


<<<<<<< HEAD
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

=======

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data pengelola ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Kirim permintaan penghapusan ke server
                fetch("home-member.php?page=hapus-pengelola&id=" + id)
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


<div class="container">
    <h2 class="mb-4 text-center">Data Pengelola</h2>


    <a href="home-member.php?page=tambah-pengelola" class="btn btn-primary btn-tambah mb-3">
        <i class="fas fa-user-plus"></i> Tambah Pengelola
    </a>
<<<<<<< HEAD
    <a href="cetakpengelola.php?search=<?= urlencode($search) ?>" target="_blank" class="btn btn-success mb-3">
        <i class="fas fa-file-pdf"></i> Cetak PDF
    </a>
    <a href="export-pengelola.php?search=<?= urlencode($search) ?>" target="_blank" class="btn btn-success mb-3">
        <i class="fas fa-file-excel"></i> Export Excel
=======
    <a href="cetakpengelolapdf.php?search=<?= urlencode($search) ?>" target="_blank" class="btn btn-success mb-3">
        <i class="fas fa-file-pdf"></i> Cetak
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    </a>
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
            width: 100%;
            table-layout: auto;
            /* Lebar kolom menyesuaikan isi */
            word-wrap: break-word;
        }

        .table th {
            white-space: normal;
            max-width: 150px;
            /* Sesuaikan lebar maksimum kolom */
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            border: 1px solid #A9A9A9;
            background-color: #696969;
            color: white;

        }


        .table td {
            border: 1px solid #A9A9A9;
            font-size: 12px;
            text-align: center;
            word-wrap: break-word;
        }

<<<<<<< HEAD
        .table td:nth-child(7),
        /* Kolom Alamat */
        .table th:nth-child(7) {
            max-width: 120px;
            /* ✅ Lebar maksimum */
            white-space: normal;
            /* ✅ Izinkan teks turun baris */
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }

        .table td:nth-child(8),
        .table th:nth-child(8) {
            max-width: 190px;
            /* ✅ Batasi lebar maksimum */
            white-space: normal;
            /* ✅ Izinkan teks turun baris */
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }

        .table td:nth-child(1),
        .table th:nth-child(1) {
            /* ✅ Batasi lebar maksimum */
            white-space: normal;
            /* ✅ Izinkan teks turun baris */
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }

        .table td:nth-child(3),
        .table th:nth-child(3) {
            max-width: 140px;
            /* ✅ Batasi lebar maksimum */
            white-space: normal;
            /* ✅ Izinkan teks turun baris */
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }

        .table td:nth-child(4),
        .table th:nth-child(4) {
            max-width: 180px;
            /* ✅ Batasi lebar maksimum */
            white-space: normal;
            /* ✅ Izinkan teks turun baris */
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }

        .table td:nth-child(5),
        .table th:nth-child(5) {
            max-width: 70px;
            /* ✅ Batasi lebar maksimum */
            white-space: normal;
            /* ✅ Izinkan teks turun baris */
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }

        .table td:nth-child(6),
        .table th:nth-child(6) {
            max-width: 70px;
            /* ✅ Batasi lebar maksimum */
            white-space: normal;
            /* ✅ Izinkan teks turun baris */
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }

=======
        /* .table th:first-child,
        .table td:first-child {
            width: 40px;
            text-align: center;
            white-space: nowrap;
        }

        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 80px;
            text-align: center;
            white-space: nowrap;
        }


        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 60px;
            text-align: center;
            white-space: nowrap;
        }

        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 90px;
            text-align: center;
            white-space: nowrap;
        }

        .table th:nth-child(9),
        .table td:nth-child(9) {
            width: 60px;

            text-align: center;
            white-space: nowrap;
        } */
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f


        .table td img {
            max-width: 50px;
            height: auto;
            border-radius: 50%;
        }

        .container {
            overflow-x: auto;
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

        .pagination {
            margin: 10px 0;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
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
    <!-- Form Pencarian -->
<<<<<<< HEAD
    <div class="flex-grow-1" style="max-width: 300px; margin-bottom: 10px;">
        <div class="input-group input-group-sm">
            <input type="text"
                name="search"
                id="liveSearch"
                class="form-control form-control-sm border border-secondary"
                placeholder="Cari pengelola..."
                style="font-size: 14px; height: 32px;">
            <span class="input-group-text border border-secondary bg-white">
                <i class="fas fa-search text-secondary"></i>
            </span>
        </div>
    </div>
=======
    <form method="GET" action="" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control search-input" placeholder="Cari Pengelola..." value="<?= htmlspecialchars($search) ?>">

        </div>
    </form>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>No KTP</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Usia</th>
<<<<<<< HEAD
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="table-body">
=======
                <th>Alamat</th>
                <th>Jabatan</th>
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
                    echo "<td style='text-align: center;'>
         <img src='image/pengelola/" . htmlspecialchars($data['foto']) . "' alt='Foto' width='50' height='50' style='border-radius: 50%; object-fit: cover;'>
      </td>";
                    echo "<td>" . htmlspecialchars($data['no_ktp']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['jk']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['usia']) . "</td>";
<<<<<<< HEAD
                    echo "<td>" . htmlspecialchars($data['jabatan']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";

=======
                    echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['jabatan']) . "</td>";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    echo "<td>
                    <a href='home-member.php?page=ubah-pengelola&id=" . $data['id'] . "' class='btn btn-warning btn-sm'>
                        <i class='fas fa-edit'></i> 
                    </a>
                    <button class='btn btn-danger btn-sm' onclick='confirmDelete(" . $data['id'] . ")'>
                        <i class='fas fa-trash'></i> 
                    </button>
                </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13' class='text-center'>Tidak ada data pengelola</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Navigation Pagination -->
<<<<<<< HEAD
    <nav id="pagination-container">
        <ul class="pagination justify-content-center">
            <?php if ($halaman > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="#" data-page="<?= $halaman - 1 ?>" aria-label="Previous">
=======
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($halaman > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=data-pengelola&halaman=<?= $halaman - 1 ?>&search=<?= urlencode($search) ?>" aria-label="Previous" title="Previous Page">
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
<<<<<<< HEAD
                    <a class="page-link" href="#" data-page="<?= $i ?>" title="Page <?= $i ?>">
                        <?= $i ?>
                    </a>
=======
                    <a class="page-link" href="?page=data-pengelola&halaman=<?= $i ?>&search=<?= urlencode($search) ?>" title="Page <?= $i ?>"><?= $i ?></a>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                </li>
            <?php endfor; ?>

            <?php if ($halaman < $totalPages): ?>
                <li class="page-item">
<<<<<<< HEAD
                    <a class="page-link" href="#" data-page="<?= $halaman + 1 ?>" aria-label="Next">
=======
                    <a class="page-link" href="?page=data-pengelola&halaman=<?= $halaman + 1 ?>&search=<?= urlencode($search) ?>" aria-label="Next" title="Next Page">
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<<<<<<< HEAD
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("liveSearch");
            const jkFilter = document.getElementById("jkFilter"); // Jika ada filter
            const resultBox = document.getElementById("table-body");
            let debounceTimer;

            function loadData(page = 1) {
                const params = new URLSearchParams();
                params.append('search', searchInput.value);
                if (jkFilter) {
                    params.append('jk_filter', jkFilter.value);
                }
                params.append('halaman', page);

                fetch("home-member.php?page=data-pengelola&" + params.toString())
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        // Update isi tabel
                        resultBox.innerHTML = doc.getElementById('table-body').innerHTML;

                        // Update pagination
                        const newPagination = doc.getElementById('pagination-container');
                        if (newPagination) {
                            document.getElementById('pagination-container').innerHTML = newPagination.innerHTML;
                        }

                        // Update URL agar bisa di-refresh atau dibookmark
                        window.history.pushState({}, '', `?page=data-pengelola&${params.toString()}`);
                    })
                    .catch(error => {
                        console.error("Gagal memuat data:", error);
                        resultBox.innerHTML = "<tr><td colspan='9' class='text-danger'>Gagal memuat data.</td></tr>";
                    });
            }

            // Pagination dynamic
            document.addEventListener('click', function(e) {
                if (e.target.closest('.page-link')) {
                    e.preventDefault();
                    const page = e.target.closest('.page-link').dataset.page;
                    loadData(page);
                }
            });

            // Live search
            searchInput.addEventListener("input", function() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => loadData(1), 300);
            });

            // Jika ada filter jenis kelamin
            if (jkFilter) {
                jkFilter.addEventListener("change", () => loadData(1));
            }
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
        });
    </script>


<<<<<<< HEAD

=======
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    <?php
    // Menutup koneksi
    $koneksi->close();
    ?>