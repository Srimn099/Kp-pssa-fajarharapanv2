<<<<<<< HEAD
<title>Mata Anggaran</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<!-- Tambahan CSS kustom -->
<!-- Tambahan di bagian <style> -->
<style>
    body {
        background-color: #f8f9fa;
    }


    .judul-halaman {
        font-size: 28px;
        font-weight: 700;
        color: #343a40;
        text-transform: uppercase;
        position: relative;
        padding-bottom: 10px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .judul-halaman::after {
        content: "";
        position: absolute;
        width: 60px;
        height: 4px;
        background: linear-gradient(to right, #6f42c1, #8e44ad);
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .card-custom {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-group-custom {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .btn {
        transition: 0.2s ease-in-out;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .btn-kembali {
        position: relative;
        top: -70px;
        z-index: 1;
    }

    .btn-tambah {
        position: relative;
        top: -10px;
    }

    /* 🌟 Tabel border dan hover highlight */
    table.dataTable {
        border: 1px solid #dee2e6;
    }


    table.dataTable th,
    table.dataTable td {
        border: 1px solid #b1b3b5;
        padding: 10px;
        vertical-align: middle;
        /* Rata tengah vertikal (atas-bawah) */

    }

    table.dataTable th {
        background-color: #cccccc;
    }

    /* Tambahan fix hover */
    table.dataTable tbody tr:hover td {
        background-color: #e6e6e6;
        transition: background-color 0.3s ease;
    }


    /* ⬇️ Kolom aksi dipersempit */
    table.dataTable td:first-child,
    table.dataTable th:first-child {
        text-align: center;
    }

    /* ⬇️ Kolom aksi dipersempit */
    table.dataTable td:last-child,
    table.dataTable th:last-child {
        width: 80px;
        /* atur sesuai kebutuhan */
        text-align: center;
    }

    table.dataTable td:nth-child(3),
    table.dataTable th:nth-child(3) {
        width: 500px;
    }


    /* 🎨 Tombol ubah & hapus */
    .btn-sm i {
        margin-right: 5px;
    }

    .btn-aksi {
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
    }
</style>



<?php include 'koneksi.php'; ?>

<div class="container mt-4">
    <!-- Judul -->
    <div class="text-center">
        <h2 class="judul-halaman"><i class="fas fa-coins me-2"></i>Data Mata Anggaran</h2>
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-start">
            <a href="?page=form-anggaran" class="btn btn-warning shadow btn-kembali">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <!-- HTML -->
    <div class="btn-group-custom btn-tambah">
        <a href="?page=tambah-anggaran" class="btn btn-success shadow">
            <i class="fa fa-plus"></i> Tambah Data
        </a>
    </div>

    <!-- Card hanya untuk tabel -->
    <div class="card card-custom">
        <div class="card-body">

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="tabel-data" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Mata Anggaran</th>
                            <th>Kelompok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("SELECT mstanggaran.*, kelanggaran.deskripsi AS kelanggaran FROM mstanggaran, kelanggaran WHERE mstanggaran.kodekel = kelanggaran.kodekel ORDER BY mstanggaran.kode");
                        while ($data = $sql->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['kode']; ?></td>
                                <td><?= $data['deskripsi']; ?></td>
                                <td><?= $data['kelanggaran']; ?></td>
                                <td>
                                    <a href="?page=ubah-anggaran&kode=<?= $data['kode']; ?>" class="btn btn-sm btn-warning btn-aksi">
                                        <i class="fa fa-edit"></i> Ubah
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-hapus"
                                        data-kode="<?= $data['kode']; ?>">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/Indonesian.json"
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const hapusButtons = document.querySelectorAll('.btn-hapus');

        hapusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const kode = this.getAttribute('data-kode');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data ini tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim AJAX ke hapus-anggaran.php
                        fetch('hapus-anggaran.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'kode=' + encodeURIComponent(kode)
                            })
                            .then(response => response.text())
                            .then(result => {
                                if (result === 'success') {
                                    Swal.fire('Berhasil!', 'Data berhasil dihapus.', 'success')
                                        .then(() => {
                                            location.reload(); // refresh tabel
                                        });
                                } else if (result === 'used') {
                                    Swal.fire('Gagal!', 'Data sudah digunakan dan tidak bisa dihapus.', 'error');
                                } else {
                                    Swal.fire('Error!', 'Terjadi kesalahan saat menghapus.', 'error');
                                }
                            });
                    }
                });
            });
        });
    });
</script>
<?php if (isset($_GET['status'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if ($_GET['status'] == 'deleted'): ?>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data Mata Anggaran berhasil dihapus.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php elseif ($_GET['status'] == 'used'): ?>
            Swal.fire({
                title: 'Gagal!',
                text: 'Data Mata Anggaran sudah digunakan dan tidak bisa dihapus.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>
<?php endif; ?>
=======
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mata Anggaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <?php include 'koneksi.php'; ?>

    <!-- <div class="card shadow-lg"> -->
    <div class="card-header bg-primary text-white text-center">
        <h3></i> Mata Anggaran</h3>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <a href="?page=tambah-anggaran" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
            <a href="?page=form-anggaran" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="table-responsive">
            <table id="tabel-data" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Mata Anggaran</th>
                        <th>Kelompok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT mstanggaran.*, kelanggaran.deskripsi AS kelanggaran FROM mstanggaran, kelanggaran WHERE mstanggaran.kodekel = kelanggaran.kodekel ORDER BY mstanggaran.kode");
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['kode']; ?></td>
                            <td><?php echo $data['deskripsi']; ?></td>
                            <td><?php echo $data['kelanggaran']; ?></td>
                            <td>
                                <a href="?page=ubah-anggaran&kode=<?php echo $data['kode']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                <a href="?page=hapus-anggaran&kode=<?php echo $data['kode']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.3/i18n/Indonesian.json"
                }
            });
        });
    </script>
</body>

</html>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
