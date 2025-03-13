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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM kelanggaran ORDER BY kodekel");
                    while ($data = $sql->fetch_assoc()) {
                        $jenis = ($data['jenis'] == 'D') ? 'PENDAPATAN' : 'BIAYA';
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['kodekel']); ?></td>
                            <td><?= htmlspecialchars($data['deskripsi']); ?></td>
                            <td><?= htmlspecialchars($jenis); ?></td>
                            <td>
                                <a href="home-admin.php?page=ubah-kelanggaran&kodekel=<?= $data['kodekel']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="home-admin.php?page=hapus-kelanggaran&kodekel=<?= $data['kodekel']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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