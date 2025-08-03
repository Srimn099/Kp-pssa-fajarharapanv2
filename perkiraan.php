<<<<<<< HEAD
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Google Font: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<!-- DataTables with Bootstrap 5 -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">


<!-- Script JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom Styles -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }

    /* === Kartu (Card) === */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    }

    /* === Judul Halaman === */
    .page-title {
        font-size: 2rem;
        font-weight: 600;
        color: #2b2d42;
        text-align: center;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #4361ee, #3f37c9);
        border-radius: 2px;
    }

    .btn-aksi {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 0.78rem;
        letter-spacing: 0.3px;
        padding: 0.30rem 0.5rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .btn-aksi i {
        margin-right: 1px;
        font-size: 0.8rem;
    }

    /* Tombol Edit */
    .btn-edit {
        background-color: #E4A11B;
        border-color: #E4A11B;
        color: #211e1e;
    }

    .btn-edit:hover {
        background-color: #E4A11B;
        transform: translateY(-3px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);

    }

    /* Tombol Hapus */
    .btn-hapus {
        background-color: #f44336;
        border-color: #f44336;
        color: white;
    }

    .btn-hapus:hover {
        background-color: #e53935;
        transform: translateY(-3px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        color: white;
    }

    /* === Tabel === */
    .table thead th {
        background-color: #f44336;
        color: white;
        text-align: center !important;
        vertical-align: middle;
    }

    .col-nmr {
        width: 12px;
    }

    .col-noperk {
        width: 100px;
    }

    .col-nama {
        width: 180px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: left;
    }

    .col-induk {
        width: 140px;
        white-space: nowrap;
    }

    .col-aksi {
        width: 140px;
    }


    .table td,
    .table th {
        font-size: 0.85rem;
        vertical-align: middle;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    /* Styling untuk kotak input "Cari" */
    .dataTables_filter input {
        border: 1px solid #999999;
        border-radius: 6px;
        padding: 6px 10px;
        background-color: #fff;
        outline: none;
        transition: border-color 0.2s;
    }

    /* Fokus: saat diklik */
    .dataTables_filter input:focus {
        border-color: #3f37c9;
        box-shadow: 0 0 4px rgba(63, 55, 201, 0.25);
    }

    /* Styling untuk dropdown "Tampilkan 10 data" */
    .dataTables_length select {
        border: 1px solid #999999;
        background-color: #fff;
        outline: none;
        transition: border-color 0.2s;
    }

    /* Fokus: saat diklik */
    .dataTables_length select:focus {
        border-color: #3f37c9;
        box-shadow: 0 0 4px rgba(63, 55, 201, 0.25);
    }

    .swal-tight-dialog {
        border-radius: 10px !important;
    }

    .swal2-title {
        padding-bottom: 0.5rem !important;
    }

    .swal2-html-container {
        padding: 0 !important;
    }

    .swal2-actions {
        margin: 1rem 0 0 0 !important;
        padding: 0.5rem 0 0 0 !important;
    }

    /* Untuk tampilan yang lebih rapi pada layar kecil */
    @media (max-width: 576px) {
        .swal-wide-dialog {
            max-width: 90% !important;
            width: 90% !important;
        }
    }
</style>


<div class="container mt-4">
    <!-- Baris gabungan: Tombol Kembali & Judul -->
    <div class="row mb-3 align-items-center">
        <!-- Tombol Kembali di kiri -->
        <div class="col-md-3 d-flex align-items-center">
            <a href="home-admin.php?page=form-master" class="btn btn-warning">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <!-- Judul di tengah -->
        <div class="col-md-6 text-center d-flex justify-content-center align-items-center">
            <h4 class="page-title m-0">Chart of Account (Tabel Perkiraan)</h4>
        </div>

        <!-- Spacer kanan -->
        <div class="col-md-3"></div>
    </div>

    <!-- Tombol Tambah Data di Tengah -->
    <div class="row mb-4">
        <div class="col text-center">
            <a href="home-admin.php?page=tambah-perkiraan" class="btn btn-primary">
                <i class="fa fa-user-plus me-1"></i> Tambah Data
            </a>
        </div>
    </div>
</div>

<!-- Tabel -->
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table id="tabel-data" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="col-nmr">NO</th>
                        <th class="col-noperk">No. PERKIRAAN</th>
                        <th class="col-nama">NAMA PERKIRAAN</th>
                        <th>TIPE</th>
                        <th>KELOMPOK</th>
                        <th class="col-induk">PERKIRAAN INDUK</th>
                        <th class="col-aksi">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "koneksi.php";
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM tabkira ORDER BY CNO_KIRA");
                    while ($data = $sql->fetch_assoc()) {
                        $tipe = ($data['CHEAD_DET'] == "H") ? "General" : "Detail";
                        $cgroup = match ($data['CGROUP']) {
                            "A" => "AKTIVA",
                            "B" => "BIAYA",
                            "S" => "PASIVA",
                            "D" => "PENDAPATAN",
                            default => "ADMINISTRATIF",
                        };
                    ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td class="col-noperk"><?= htmlspecialchars($data['CNO_KIRA']) ?></td>
                            <td class="col-nama"><?= htmlspecialchars($data['CNAMA_KIRA']) ?></td>
                            <td><?= $tipe ?></td>
                            <td><?= $cgroup ?></td>
                            <td class="col-induk"><?= htmlspecialchars($data['CACCTPARENT']) ?></td>
                            <td class="text-center">
                                <!-- Tombol Edit -->
                                <a href="home-admin.php?page=ubah-perkiraan&cno_kira=<?= $data['CNO_KIRA'] ?>"
                                    class="btn btn-aksi btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <button onclick="confirmDelete('<?= $data['CNO_KIRA'] ?>', '<?= htmlspecialchars($data['CNAMA_KIRA']) ?>')"
                                    class="btn btn-aksi btn-hapus">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    <?php mysqli_close($koneksi); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Inisialisasi DataTable -->
<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    previous: "<i class='fa fa-angle-left'></i>",
                    next: "<i class='fa fa-angle-right'></i>"
                }
            }
        });
    });


    function confirmDelete(cno_kira, accountName) {
        Swal.fire({
            title: '<span style="font-size:1.1rem; font-weight:600;">Hapus Akun Perkiraan?</span>',
            html: `<div style="text-align:left; margin-top:0.5rem; font-size:0.95rem;">
                <div style="margin-bottom:1rem;">Anda akan menghapus:</div>
                <div style="display:grid; grid-template-columns:auto 1fr; gap:0.5rem; align-items:center;">
                    <span style="font-weight:500;">No:</span>
                    <span>${cno_kira}</span>
                    <span style="font-weight:500;">Nama:</span>
                    <span>${accountName}</span>
                </div>
              </div>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<span style="padding:0 1rem;">Hapus</span>',
            cancelButtonText: '<span style="padding:0 1rem;">Batal</span>',
            reverseButtons: true,
            focusCancel: true,
            width: 450,
            padding: '1.25rem 1.5rem 1.5rem',
            customClass: {
                popup: 'swal-tight-dialog',
                title: 'pb-1',
                htmlContainer: 'my-0',
                actions: 'mt-3 pt-2'

            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `home-admin.php?page=hapus-perkiraan&cno_kira=${cno_kira}`;
            }
        });
    }
</script>
=======
            <!-- Basic Examples -->
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
</head>												
<?php


?>	
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Chart of Account (Tabel Perkiraan)</label></center></h1><br>
                            <a href="home-admin.php?page=tambah-perkiraan"" class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i>  Tambah Data</a>
							<a href="home-admin.php?page=form-master" class="btn btn-warning btn-sm">Kembali</a>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
						</div>
                        <div class="body">
                            <div class="table-responsive">
                                <!--<table  class="datatable table table-hover table-bordered">-->
								<table  id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>NO. </th>
                                            <th>No. PERKIRAAN</th>
                                            <th>NAMA PERKIRAAN</th>
                                            <th>TIPE</th>
                                            <th>KELOMPOK</th>
                                            <th>PERK INDUK</th>
											<th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$no=1;
											$sql=$koneksi->query("select * from tabkira order by CNO_KIRA");
											while($data=$sql->fetch_assoc()){
												if($data['CHEAD_DET']=="H"){
													$tipe="General";
												}else{
													$tipe="Detail";
												}
												if($data['CGROUP']=="A"){
													$cgroup="AKTIVA";
												}elseif($data['CGROUP']=="B"){
													$cgroup="BIAYA";
												}elseif($data['CGROUP']=="S"){
													$cgroup="PASIVA";
												}elseif($data['CGROUP']=="D"){
													$cgroup="PENDAPATAN";
												}else{
													$cgroup="ADMINISTRATIF";
												}
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $data['CNO_KIRA'];?></td>
											<td><?php echo $data['CNAMA_KIRA'];?></td>
											<td><?php echo $tipe;?></td>
											<td><?php echo $cgroup;?></td>
											<td><?php echo $data['CACCTPARENT'];?></td>
											
											<td>
												<a href="home-admin.php?page=ubah-perkiraan&cno_kira=
												<?php echo $data['CNO_KIRA'];?>" class="
												btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick ="return confirm('Anda Yakin akan menghapus Data ini?')" href="home-admin.php?page=hapus-perkiraan&cno_kira=
												<?php echo $data['CNO_KIRA'];?>" class="
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
