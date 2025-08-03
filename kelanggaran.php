<<<<<<< HEAD
<?php include "koneksi.php"; ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<!-- JS Datatables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3a0ca3;
        --accent-color: #f72585;
        --light-bg: #f8f9fa;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }


    .page-title {
        font-weight: 600;
        color: #343a40;
    }

    .table thead th {
        background-color: #4e73df !important;
        color: white;
        vertical-align: middle;
        text-align: center;
    }



    .table td,
    .table th {
        text-align: center;
        vertical-align: middle;
        border: 1px solid #cccac4;
    }

    /* Kolom No. */
    .table th:first-child,
    .table td:first-child {
        width: 20px;
        text-align: center;
    }

    /* Kolom KODE */
    .table th:nth-child(2),
    .table td:nth-child(2) {
        width: 70px;
        text-align: center;
    }

    /* Kolom KODE */
    .table th:nth-child(3) {
        width: 600px;
        text-align: center;
    }

    .table td:nth-child(3) {
        text-align: left;
    }

    /* Kolom KODE */
    .table th:nth-child(4) {
        width: 150px;
        text-align: center;
    }


    /* Kolom KODE */
    .table th:nth-child(5),
    .table td:nth-child(5) {
        text-align: center;

    }

    .btn {
        border-radius: 8px;
    }


    .btn i {
        margin-right: 5px;
    }

    .card-custom {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 6px;
        border: 1px solid #909499;

    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
        border: 1px solid #909499;
        padding: 3px 25px;
    }



    .dataTables_info {
        font-size: 13px !important;
    }

    /* Add this for the buttons */
    .btn-warning.btn-sm,
    .btn-danger.btn-sm {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        letter-spacing: 0.3px;
    }
</style>

<div class="container mt-2">
    <div class="card-custom">
        <div class="d-flex justify-content-between mb-3"> <!-- Baris tombol pertama -->
            <a href="?page=form-anggaran" class="btn btn-warning align-self-start">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>

        <h2 class="text-center page-title mb-4"><i class="fa fa-layer-group text-primary"></i> Kelompok Anggaran</h2>
        <div class="text-center mb-3"> <!-- Baris tombol kedua khusus untuk Tambah Data -->
            <a href="?page=tambah-kelanggaran" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
        </div>

        <div class="table-responsive">
            <table id="tabel-data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
=======
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok Anggaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">

        <h2 class="text-center text-primary">Kelompok Anggaran</h2>
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <a href="?page=tambah-kelanggaran" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                <a href="?page=form-anggaran" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="tabel-data" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>NO.</th>
                        <th>KODE</th>
                        <th>DESKRIPSI</th>
                        <th>JENIS</th>
                        <th>AKSI</th>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    </tr>
                </thead>
                <tbody>
                    <?php
<<<<<<< HEAD
=======
                    include "koneksi.php";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM kelanggaran ORDER BY kodekel");
                    while ($data = $sql->fetch_assoc()) {
                        $jenis = ($data['jenis'] == 'D') ? 'PENDAPATAN' : 'BIAYA';
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['kodekel']); ?></td>
                            <td><?= htmlspecialchars($data['deskripsi']); ?></td>
<<<<<<< HEAD
                            <td>
                                <span class="text-<?= $data['jenis'] == 'D' ? 'success' : 'danger'; ?>">
                                    <?= $jenis; ?>
                                </span>
                            </td>
                            <td>
                                <a href="home-admin.php?page=ubah-kelanggaran&kodekel=<?= $data['kodekel']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> Ubah
                                </a>
                                <a href="#"
                                    class="btn btn-danger btn-sm btn-hapus"
                                    data-kode="<?= $data['kodekel']; ?>">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>

=======
                            <td><?= htmlspecialchars($jenis); ?></td>
                            <td>
                                <a href="home-admin.php?page=ubah-kelanggaran&kodekel=<?= $data['kodekel']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="home-admin.php?page=hapus-kelanggaran&kodekel=<?= $data['kodekel']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<<<<<<< HEAD
</div>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "›",
                    previous: "‹"
                }
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.btn-hapus').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const kode = this.dataset.kode;

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('hapus-kelanggaran.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'kodekel=' + encodeURIComponent(kode)
                            })
                            .then(response => response.text())
                            .then(response => {
                                if (response.trim() === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil dihapus.',
                                        timer: 1500,
                                        showConfirmButton: false
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else if (response.trim() === 'used') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Menghapus!',
                                        text: 'Data sudah digunakan di kelompok anggaran.'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Terjadi Kesalahan!',
                                        text: 'Gagal menghapus data.'
                                    });
                                }
                            });
                    }
                });
            });
        });
    });
</script>
=======
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable();
        });
    </script>
</body>

</html>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
