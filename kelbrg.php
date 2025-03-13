<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            text-align: center;
        }

        .table {
            border: 1px solid gray;
        }

        .table th,
        .table td {
            vertical-align: middle;
            color: black;
            border: 1px solid gray;
            /* Menambahkan border agar lebih terlihat */
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }

        .header h1 {
            margin: 0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .table th {
            background-color: #003366;
            /* Warna lebih gelap untuk header */
            color: white;
            /* Warna teks putih */
            border: 1px solid gray;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #e0e0e0;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #cfcfcf;
        }

        .table-hover tbody tr:hover {
            background-color: #17a2b8;
            color: white;
            /* font-weight: bold; */
        }
    </style>
</head>


<?php
include 'koneksi.php';
?>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header text-center">
                <h1><label class="label label-success">Kelompok Aktiva Tetap</label></h1>
                <a href="?page=tambah-kelbrg" class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i> Tambah Data</a>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table id="kelompokAktivaTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Akun Inventory</th>
                                <th>Akun Akumulasi Penyusutan</th>
                                <th>Akun Biaya Penyusutan</th>
                                <th>Status Penyusutan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM kelbrg ORDER BY kode");
                            while ($data = $sql->fetch_assoc()) {
                                $susut = ($data['lflag'] == 'Y') ? "Disusutkan" : "Tidak Disusutkan";
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['kode']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['accbarang']; ?></td>
                                    <td><?php echo $data['accakumsusut']; ?></td>
                                    <td><?php echo $data['accbisusut']; ?></td>
                                    <td><?php echo $susut; ?></td>
                                    <td class="text-center">
                                        <a href="?page=ubah-kelbrg&kode=<?php echo $data['kode']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                                        <a onclick="return confirm('Anda Yakin akan menghapus Data ini?')" href="?page=hapus-kelbrg&kode=<?php echo $data['kode']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kelompokAktivaTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada entri tersedia",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>