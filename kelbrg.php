<<<<<<< HEAD
=======
<head>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
<<<<<<< HEAD
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

        .table {
            border: 1px solid rgba(128, 128, 128, 0.5);
=======
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            text-align: center;
        }

        .table {
            border: 1px solid gray;
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
        }

        .table th,
        .table td {
            vertical-align: middle;
            color: black;
<<<<<<< HEAD
            border: 1px solid rgba(128, 128, 128, 0.5);
            /* Warna gray dengan transparansi 30% */
            font-size: 13px;
=======
            border: 1px solid gray;
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            /* Menambahkan border agar lebih terlihat */
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 5px 5px 0 0;
        }

<<<<<<< HEAD

=======
        .header h1 {
            margin: 0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f

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
<<<<<<< HEAD

        /* Mengatur jarak antara kontrol DataTables dan tabel */
        .dataTables_length,
        .dataTables_filter {
            margin-top: 15px !important;
            margin-bottom: 10px !important;
        }

        @media (max-width: 768px) {

            .dataTables_length,
            .dataTables_filter {
                text-align: center;
            }
        }
    </style>


    <?php include 'koneksi.php'; ?>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header text-center">
                    <h2 class="mb-2">Kelompok Aktiva Tetap</h2>
                    <a href="?page=tambah-kelbrg" class="btn btn-success btn-sm">
                        <i class="fa fa-user-plus"></i> Tambah Data
                    </a>
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
                                $sql = $koneksi->query("SELECT * FROM kelbrg ORDER BY kode DESC"); // Menampilkan data terbaru di atas
                                while ($data = $sql->fetch_assoc()) {
                                    $susut = ($data['lflag'] == 'Y') ? "Disusutkan" : "Tidak Disusutkan";
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['kode']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= $data['accbarang']; ?></td>
                                        <td><?= $data['accakumsusut']; ?></td>
                                        <td><?= $data['accbisusut']; ?></td>
                                        <td><?= $susut; ?></td>
                                        <td class="text-center">
                                            <!-- Tombol Ubah -->
                                            <?php if ($_SESSION['hak_akses'] == 'Admin') { ?>
                                                <a href="?page=ubah-kelbrg&kode=<?= $data['kode']; ?>" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Ubah
                                                </a>
                                            <?php } else { ?>
                                                <a href="javascript:void(0);" onclick="showAccessDenied()" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Ubah
                                                </a>
                                            <?php } ?>

                                            <!-- Tombol Hapus -->
                                            <?php if ($_SESSION['hak_akses'] == 'Admin') { ?>
                                                <button class="btn btn-danger btn-sm" onclick="konfirmasiHapus('<?= $data['kode']; ?>')">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            <?php } else { ?>
                                                <a href="javascript:void(0);" onclick="showAccessDeniedHapus()" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
=======
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD

    <!-- JS & SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#kelompokAktivaTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                language: {
                    lengthMenu: "Tampilkan _MENU_ entri per halaman",
                    zeroRecords: "Tidak ada data yang ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada entri tersedia",
                    infoFiltered: "(disaring dari _MAX_ total entri)",
                    search: "Cari:",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });

        function showAccessDenied() {
            Swal.fire({
                icon: 'warning',
                title: 'Akses Ditolak!',
                text: 'Silakan login sebagai admin untuk mengubah data.',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        }

        function showAccessDeniedHapus() {
            Swal.fire({
                icon: 'warning',
                title: 'Akses Ditolak!',
                text: 'Silakan login sebagai admin untuk menghapus data.',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        }

        // ✅ FUNGSI INI DIPINDAH KE LUAR
        function konfirmasiHapus(kode) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?page=hapus-kelbrg&kode=" + kode;
                }
            });
        }
    </script>
=======
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
