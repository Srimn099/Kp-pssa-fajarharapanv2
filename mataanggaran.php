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