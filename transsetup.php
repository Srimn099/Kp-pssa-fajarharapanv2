<<<<<<< HEAD
<?php
// Pastikan koneksi $koneksi sudah dibuat sebelum bagian ini
?>


<title>Daftar Transaksi Rutin</title>

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />

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

    /* Border untuk dropdown “Tampilkan x data per halaman” */
    .dataTables_length select {
        border: 1px solid #bcbcbc;
        border-radius: 4px;
    }

    /* Border untuk input pencarian */
    .dataTables_filter input {
        border: 1px solid #bcbcbc;
        border-radius: 4px;
        padding: 4px 8px;
    }

    .card {
        border-radius: 6px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .page-title {
        font-size: 1.90rem;
        font-weight: 600;
        text-align: center;
        position: relative;
        display: inline-block;
        background: linear-gradient(90deg, #2f80ed, #9b51e0);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .page-title::after {
        content: "";
        display: block;
        margin: 6px auto 0;
        width: 80px;
        height: 4px;
        border-radius: 4px;
        background: linear-gradient(90deg, #2f80ed, #9b51e0);
    }

    .btn-action {
        padding: 4px 8px;
    }

    .table thead th {
        vertical-align: middle;
        text-align: center;
        background-color: #bcbcbc !important;
    }

    .table tbody td {
        vertical-align: middle;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif !important
    }


    .btn-group-custom a {
        margin-right: 0.4rem;
    }

    .custom-btn-small {
        padding: 4px 10px;
        /* font-size: 0.85rem; */
        line-height: 1.6;
        border-radius: 5px;
    }
</style>


<div class="container mt-0 mb-5">
    <div class="card p-4">

        <!-- Tombol Kembali di Atas -->
        <div class="mb-3">
            <a href="home-admin.php?page=form-master" class="btn btn-warning btn-sm custom-btn-small">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <!-- Judul Halaman -->
        <div class="text-center mb-4">
            <h2 class="page-title">Daftar Transaksi Rutin</h2>
        </div>

        <!-- Tombol Tambah Data di Tengah -->
        <div class="text-center mb-3" style="margin-top: -10px;">
            <a href="home-admin.php?page=tambah-transsetup" class="btn btn-primary btn-sm">
                <i class="fa fa-plus me-1"></i> Tambah Data
            </a>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table id="tabel-data" class="table table-bordered table-striped table-hover align-middle">
                <thead class="text-center">
                    <tr>
                        <th style="width:5%;">No</th>
                        <th>Perkiraan Debet</th>
                        <th>Perkiraan Kredit</th>
                        <th>Keterangan</th>
                        <th style="width:110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM transsetup ORDER BY id DESC");
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= htmlspecialchars($data['accdebet'] . ' - ' . $data['cdebet']); ?></td>
                            <td><?= htmlspecialchars($data['acckredit'] . ' - ' . $data['ckredit']); ?></td>
                            <td><?= htmlspecialchars($data['cket']); ?></td>
                            <td class="text-center btn-group-custom">
                                <a href="home-admin.php?page=ubah-transsetup&id=<?= $data['id']; ?>" class="btn btn-warning btn-sm btn-action" data-bs-toggle="tooltip" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="home-admin.php?page=hapus-transsetup&id=<?= $data['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?');" class="btn btn-danger btn-sm btn-action" data-bs-toggle="tooltip" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(disaring dari _MAX_ total data)"
            },
            columnDefs: [{
                orderable: false,
                targets: 4
            }]
        });

        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el);
        });
    });
</script>
=======
            <!-- Basic Examples -->
<?php


?>	
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
</head>		
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Daftar Transaksi Rutin</label></center></h1>
                            <a href="home-admin.php?page=tambah-transsetup" class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i>  Tambah Data</a>
							<a href="home-admin.php?page=form-master" class="btn btn-warning btn-sm">Kembali</a><br><br>
							</div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>NO. </th>
                                            <th>Perkiran Debet</th>
                                            <th>Perkiraan Kredit</th>
                                            <th>Keterangan Transaksi</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$no=1;
											$sql=$koneksi->query("select * from transsetup");
											while($data=$sql->fetch_assoc()){
											?>	
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $data['accdebet'].' - '.$data['cdebet'];?></td>
											<td><?php echo $data['acckredit'].' - '.$data['ckredit'];?></td>
											<td><?php echo $data['cket'];?></td>
											
											<td>
												<a href="home-admin.php?page=ubah-transsetup&id=
												<?php echo $data['id'];?>" class="
												btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick ="return confirm('Anda Yakin akan menghapus Data ini?')" href="home-admin.php?page=hapus-transsetup&id=
												<?php echo $data['id'];?>" class="
												btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

											</td>
										</tr>
											<?php } ?>
                                    </tbody>
									<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>
                                </table>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
