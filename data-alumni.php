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
$totalQuery = "SELECT COUNT(*) AS total FROM tb_siswa WHERE status_sekolah = 'Lulus' AND LOWER(nama) LIKE LOWER('%$search%')";
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

$sql = "SELECT id, nama, tmp_lahir, tgl_lahir, jk, pendidikan_terakhir, nama_ayah, nama_ibu, pk_ortu, tgl_masuk, tgl_keluar, alamat 
        FROM tb_siswa 
        WHERE status_sekolah = 'Lulus' 
        ORDER BY id ASC 
        LIMIT $start, $limit";

$result = $koneksi->query($sql) or die("Query Error: " . $koneksi->error);



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




    <?php
    // Menutup koneksi
    $koneksi->close();
    ?>