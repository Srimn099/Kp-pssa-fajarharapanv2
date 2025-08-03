<<<<<<< HEAD
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Jurnal Transaksi</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #007bff, #00d4ff);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 1.5rem;
        }

        .card-title {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #e9ecef;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }

        .btn-action {
            padding: 0.3rem 0.6rem;
            margin: 0 0.2rem;
        }

        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .dropdown-item:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="card-title">List Jurnal Transaksi</h1>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);">Tambah Transaksi</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Ekspor ke Excel</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Refresh Data</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabel-data" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">No. Transaksi</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col" class="text-end">Nilai</th>
                                        <th scope="col">Anggaran</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'koneksi.php';
                                    $sql = "SELECT DTGL_TRANS, NNO_TRANS, CKET, CPROJECT, SUM(IDRAMOUNT) as nilai 
                                            FROM jurnal 
                                            GROUP BY DTGL_TRANS, NNO_TRANS, CKET, CPROJECT";
                                    $result = $koneksi->query($sql);
                                    while ($data = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo date('d-m-Y', strtotime($data['DTGL_TRANS'])); ?></td>
                                            <td><?php echo htmlspecialchars($data['NNO_TRANS']); ?></td>
                                            <td><?php echo htmlspecialchars($data['CKET']); ?></td>
                                            <td class="text-end"><?php echo number_format($data['nilai'], 2, ',', '.'); ?></td>
                                            <td><?php echo htmlspecialchars($data['CPROJECT'] ?? ''); ?></td>
                                            <td>
                                                <a href="?page=ubah-jurnal-admin&tanggal=<?php echo urlencode($data['DTGL_TRANS']); ?>&nno_trans=<?php echo urlencode($data['NNO_TRANS']); ?>"
                                                    class="btn btn-warning btn-sm btn-action" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="home-member.php?page=hapus-jurnal-admin&tanggal=<?php echo urlencode($data['DTGL_TRANS']); ?>&notrans=<?php echo urlencode($data['NNO_TRANS']); ?>"
                                                    class="btn btn-danger btn-sm btn-action" title="Hapus"
                                                    onclick="return confirm('Anda yakin akan menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    mysqli_close($koneksi);
                                    ?>
                                </tbody>
                            </table>
=======
            <!-- Basic Examples -->
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
</head>												
<?php
include 'koneksi.php';

?>	
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">List Jurnal Transaksi</label></center></h1><br>
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
                                            <th>TANGGAL</th>
                                            <th>No. TRANSAKSI</th>
                                            <th>KETERANGAN</th>
                                            <th>NILAI</th>
											<th>ANGGARAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$no=1;
											$sql=$koneksi->query("select DTGL_TRANS,NNO_TRANS,CKET,SUM(IDRAMOUNT) as nilai,CPROJECT from jurnal where CTRANSFLAG='TR' and CDEBKRED='D' group by DTGL_TRANS,NNO_TRANS");
											while($data=$sql->fetch_assoc()){
										?>
										<tr>
											<td><?php echo date('d-m-Y',strtotime($data['DTGL_TRANS']));?></td>
											<td><?php echo $data['NNO_TRANS'];?></td>
											<td><?php echo $data['CKET'];?></td>
											<td align="right"><?php echo number_format($data['nilai'],2,',','.');?></td>
											<td><?php echo $data['CPROJECT'];?></td>
											
											<td>
											<a href="?page=ubah-jurnal-admin&tanggal=
												<?php echo $data['DTGL_TRANS'];?>&nno_trans=<?php echo $data['NNO_TRANS'];?>" class="
												btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick ="return confirm('Anda Yakin akan menghapus Data ini?')" href="home-member.php?page=hapus-jurnal-admin&tanggal=
												<?php echo $data['DTGL_TRANS'];?>&notrans=<?php echo $data['NNO_TRANS'];?>" class="
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable({
                pageLength: 10,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: "Tidak ada data yang tersedia",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri"
                },
                order: [
                    [0, 'desc']
                ], // Sort by Tanggal descending
                columnDefs: [{
                        targets: 5,
                        orderable: false
                    } // Disable sorting on Aksi column
                ]
            });
        });
    </script>
</body>

</html>
=======
            <!-- #END# Basic Examples -->
			
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
