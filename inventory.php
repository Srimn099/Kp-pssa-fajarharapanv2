<<<<<<< HEAD
<?php include 'koneksi.php'; ?>

<title>Daftar Aset Tetap</title>
<!-- CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 24px;
    }

    h1 {
        font-size: 24px;
        font-weight: 600;
        color: #4e73df;
    }

    .btn-sm {
        font-size: 14px;
        padding: 3px 6px;
        border-radius: 6px;
    }

    .btn:hover {
        transform: scale(1.03);
    }

    .table th {
        background-color: #003366;
        color: white;
        text-align: center;
        vertical-align: middle;
    }

    .table th,
    .table td {
        font-size: 14px;
        text-align: center;
        vertical-align: middle;
        padding: 8px;
        border: 1px solid rgba(128, 128, 128, 0.5);

    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table-hover tbody tr:hover {
        background-color: #e9f0ff;
    }

    .badge-status {
        font-size: 13px;
        padding: 5px 10px;
        border-radius: 10px;
    }

    .badge-baik {
        background-color: #198754;
        color: white;
    }

    .badge-sedang {
        background-color: #ffc107;
        color: black;
    }

    .badge-kurang {
        background-color: #fd7e14;
        color: white;
    }

    .badge-rusak {
        background-color: #dc3545;
        color: white;
    }

    .judul {
        font-size: 28px;
        font-weight: bold;
        color: #343a40;
        text-align: center;
    }

    .dataTables_filter input {
        height: 30px !important;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }

    .kolom-manfaat {
        width: 50px;
    }

    .kolom-aksi {
        width: 70px;
    }
</style>

<div class="container">
    <div class="card p-4 shadow-sm position-relative">
        <!-- Tombol Kembali di kiri atas -->
        <a href="home-admin.php?page=form-fixedasset"
            class="btn btn-secondary position-absolute top-0 start-0 m-3">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

        <!-- Judul Tengah -->
        <h1 class="judul text-center mt-3 mb-3">Daftar Aset Tetap</h1>

        <!-- Tombol Tambah di bawah judul (posisi tengah) -->
        <div class="text-center mb-4">
            <a href="home-admin.php?page=tambah-inventory" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>

        <div class="table-responsive">
            <table id="tabel-data" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Register</th>
                        <th>Nama Barang</th>
                        <th>Kelompok</th>
                        <th>Tgl. Beli</th>
                        <th>Nilai</th>
                        <th class="kolom-manfaat">Masa Manfaat</th>
                        <th>Kondisi</th>
                        <th class="kolom-aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT inventory.*, kelbrg.nama AS namakelompok FROM inventory, kelbrg WHERE inventory.kelompok=kelbrg.kode ORDER BY inventory.inventno");
                    while ($data = $sql->fetch_assoc()) {
                        switch ($data['latitude']) {
                            case 'B':
                                $koko = "<span class='badge badge-status badge-baik'>BAIK</span>";
                                break;
                            case 'S':
                                $koko = "<span class='badge badge-status badge-sedang'>SEDANG</span>";
                                break;
                            case 'K':
                                $koko = "<span class='badge badge-status badge-kurang'>KURANG</span>";
                                break;
                            default:
                                $koko = "<span class='badge badge-status badge-rusak'>RUSAK</span>";
                        }
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['inventno']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td><?= $data['namakelompok']; ?></td>
                            <td><?= date('d-m-Y', strtotime($data['dbeli'])); ?></td>
                            <td>Rp<?= number_format($data['harga'], 0, ',', '.'); ?></td>
                            <td><?= $data['masa']; ?> bulan</td>
                            <td><?= $koko; ?></td>
                            <td>
                                <a href="home-admin.php?page=ubah-inventory&inventno=<?= $data['inventno']; ?>"
                                    class="btn btn-sm btn-info mb-1">
                                    <i class="fa fa-edit"></i> Ubah
                                </a>
                                <button class="btn btn-sm btn-danger btn-hapus" data-id="<?= $data['inventno']; ?>">
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


<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "›",
                    previous: "‹"
                },
            }
        });
    });

    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data akan hilang permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33', // Warna merah
                cancelButtonColor: '#3085d6' // Biru (opsional)
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX ke hapus-inventory.php
                    fetch('hapus-inventory.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'inventno=' + id
                        })
                        .then(response => response.text())
                        .then(response => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Dihapus!',
                                text: 'Data berhasil dihapus.',
                                timer: 1600,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); // reload halaman biar data hilang dari tabel
                            });
                        });
                }
            });
        });
    });
</script>
=======
<?php
include 'koneksi.php'; // Pastikan file ini ada dan menghubungkan ke database
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Aset Tetap</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="card p-4">
            <h1 class="text-center text-success mb-4">Daftar Aset Tetap</h1>
            <div class="mb-3">
                <a href="home-member.php?page=form-fixedasset" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                <a href="home-admin.php?page=tambah-inventory" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table id="tabel-data" class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>No. Register</th>
                            <th>Nama Barang</th>
                            <th>Kelompok</th>
                            <th>Tgl. Beli</th>
                            <th>Nilai Perolehan</th>
                            <th>Masa Manfaat</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("SELECT inventory.*, kelbrg.nama AS namakelompok FROM inventory, kelbrg WHERE inventory.kelompok=kelbrg.kode ORDER BY inventory.inventno");
                        while ($data = $sql->fetch_assoc()) {
                            if ($data['latitude'] == 'B') {
                                $koko = 'BAIK';
                            } elseif ($data['latitude'] == 'S') {
                                $koko = 'SEDANG';
                            } elseif ($data['latitude'] == 'K') {
                                $koko = 'KURANG BAIK';
                            } else {
                                $koko = 'RUSAK';
                            }
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['inventno']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['namakelompok']; ?></td>
                                <td><?php echo $data['dbeli']; ?></td>
                                <td><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo $data['masa']; ?></td>
                                <td><?php echo $koko; ?></td>
                                <td>
                                    <a href="home-admin.php?page=ubah-inventory&inventno=<?php echo $data['inventno']; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="home-admin.php?page=hapus-inventory&inventno=<?php echo $data['inventno']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable();
        });
    </script>
</body>

</html>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
