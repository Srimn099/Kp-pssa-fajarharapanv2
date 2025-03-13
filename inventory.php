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