<<<<<<< HEAD
<title>Buku Besar Mata Anggaran</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<style>
    body {
        background-color: #f9f9f9;
    }

    .page-header {
        color: #2c3e50;
        padding: 10px 0;
        margin-bottom: 30px;


    }

    .page-header h4 {
        font-size: 2.2rem;
        font-weight: 800;
        display: inline-block;
        position: relative;
        letter-spacing: 1px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-header h4::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        /* garis dibawah judul */
        height: 4px;
        background: linear-gradient(90deg, #3498db, #2ecc71);
    }

    .btn-primary:hover {
        background-color: #157347;
        border-color: #157347;
    }

    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em;
    }

    /* CARD UMUM */
    .filter-card {
        max-width: 650px;
        margin: 0 auto;
        border-radius: 0.5rem;
    }

    /* HEADER CARD */
    .filter-card-header {
        background-color: #198754;
        color: white;
        padding: 8px 16px;
        font-weight: 500;
        font-size: 15px;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    /* LABEL */
    .label-small {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 4px;
    }

    /* INPUT DATE STYLE */
    input[type="date"].form-control {
        border: 1px solid #737373;
        border-radius: 0.25rem;
        box-shadow: none;
        transition: border-color 0.2s ease-in-out;
        font-size: 14px;
        padding: 4px 8px;
    }

    /* FOCUS STYLE */
    input[type="date"].form-control:focus {
        border-color: #198754;
        outline: none;
        box-shadow: 0 0 0 0.1rem rgba(25, 135, 84, 0.25);
    }

    /* TOMBOL PILIH TANGGAL */
    .btn-tanggal {
        font-size: 14px;
        padding: 8px 14px;
        min-width: 120px;
        white-space: nowrap;
        /* cegah teks pindah baris */
    }

    /* INPUT DATE BORDER */
    input[type="date"].form-control {
        border: 1px solid #737373;
        /* Warna abu-abu Bootstrap */
        border-radius: 0.25rem;
        box-shadow: none;
        transition: border-color 0.2s ease-in-out;
    }

    /* Saat focus */
    input[type="date"].form-control:focus {
        border-color: #198754;
        /* Hijau: sama dengan header */
        outline: none;
        box-shadow: 0 0 0 0.1rem rgba(25, 135, 84, 0.25);
    }

    /* TABEL BORDER */
    .table {
        border: 1px solid #dee2e6;
    }

    .table th,
    .table td {
        border: 1px solid #a8b3bd;
        text-align: center;
        /* horizontal center */
        vertical-align: middle;
        /* vertical center */
    }

    /* WARNA HEADER TABEL BIRU TUA */
    .table thead.table-header-darkblue th {
        background-color: #1d3557;
        /* Biru tua */
        color: white;
        text-align: center;
    }

    .table td.kode-kolom,
    .table th.kode-kolom {
        width: 100px;
        text-align: right;
        text-align: center;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #000;
        /* hitam */
        border-radius: 0.25rem;
        padding: 4px 8px;
    }

    /* BORDER HITAM: Dropdown "Tampilkan 10 entri" */
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #000;
        /* hitam */
        border-radius: 0.25rem;
        padding: 4px 25px;
        font-size: 14px;
    }

    .btn-kembali {
        background-color: #007bff;
        color: white;
        padding: 8px 18px;
        font-size: 16px;
        font-weight: 500;
        border: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        text-decoration: none;
    }

    .btn-kembali:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
    }
</style>


<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="javascript:history.back()" class="btn-kembali">&larr; Kembali</a>

        <h4 class="text-center flex-grow-1 mb-0">Buku Besar Mata Anggaran</h4>
    </div>

    <?php
    include 'koneksi.php';
    date_default_timezone_set('Asia/Jakarta');
    $tgl_awal = date('Y-m-d');
    $tgl_akhir = date('Y-m-d');

    if (isset($_POST['tanggal'])) {
        $tgl_awal = $_POST['tgl_awal'];
        $tgl_akhir = $_POST['tgl_akhir'];
    }
    ?>
    <div class="card filter-card shadow-sm mb-3">
        <div class="card-header filter-card-header">
            <i class="fas fa-calendar-alt me-2"></i>Filter Tanggal
        </div>
        <div class="card-body">
            <form method="POST" class="row g-3 justify-content-center align-items-end">
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="tgl_awal" class="form-label label-small">Tanggal Awal</label>
                    <input type="date" name="tgl_awal" class="form-control form-control-sm" value="<?= $tgl_awal ?>" required>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <label for="tgl_akhir" class="form-label label-small">Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control form-control-sm" value="<?= $tgl_akhir ?>" required>
                </div>
                <div class="col-12 col-md-4 col-lg-2 d-grid">
                    <button type="submit" name="tanggal" class="btn btn-sm btn-primary btn-tanggal">
                        <i class="fas fa-calendar-check me-1"></i> Pilih Tanggal
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-data" class="table table-bordered table-hover align-middle">
                    <thead class="table-header-darkblue">
                        <tr>
                            <th class="kode-kolom">Kode Anggaran</th>
                            <th>Mata Anggaran</th>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = $koneksi->query("SELECT kode, deskripsi FROM mstanggaran ORDER BY kode");
                        while ($data = $sql->fetch_assoc()) {
                        ?>
                            <tr>
                                <td class="kode-kolom"><?= $data['kode']; ?></td>
                                <td style="text-align: left;"><?= $data['deskripsi']; ?></td>
                                <td><?= date('d-m-Y', strtotime($tgl_awal)); ?></td>
                                <td><?= date('d-m-Y', strtotime($tgl_akhir)); ?></td>
                                <td class="text-center">
                                    <a href="repbbanggaran.php?kode=<?= $data['kode']; ?>&tgl_awal=<?= $tgl_awal; ?>&tgl_akhir=<?= $tgl_akhir; ?>"
                                        class="btn btn-sm btn-danger" target="_blank">
                                        <i class="fas fa-print me-1"></i>Cetak
                                    </a>
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
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
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
include 'koneksi.php';
	date_default_timezone_set('Asia/Jakarta');
//$koneksi = mysqli_connect("localhost","root",
$date=date('Y-m-d');
$tgl_awal=$date;
$tgl_akhir = $date;
?>	
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Buku Besar Mata Anggaran</label></center></h1><br>
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
				<form method="POST">
								<label for="">Tanggal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="date" name="tgl_awal" value="<?php echo $date;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="date" name="tgl_akhir" value="<?php echo $date;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" value="Tentukan Tanggal" name="tanggal" class="btn btn-primary">
								<br><br><br>
				</form>
				<?php
					if(isset($_POST['tanggal'])){
							$tgl_awal = $_POST['tgl_awal'];
							$tgl_akhir = $_POST['tgl_akhir'];
					}
				?>	
                        <div class="body">
                            <div class="table-responsive">
                                <!--<table  class="datatable table table-hover table-bordered">-->
								<table  id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>KODE ANGGARAN</th>
                                            <th>MATA ANGGARAN</th>
                                            <th>TGL AWAL</th>
                                            <th>TGL AKHIR</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$no=1;
											$sql=$koneksi->query("select mstanggaran.kode,mstanggaran.deskripsi,'$tgl_awal' as tgl_awal,'$tgl_akhir' as tgl_akhir from mstanggaran order by kode");
											while($data=$sql->fetch_assoc()){
										?>
										<tr>
											<td><?php echo $data['kode'];?></td>
											<td><?php echo $data['deskripsi'];?></td>
											<td><?php echo date('d-m-Y',strtotime($data['tgl_awal']));?></td>
											<td><?php echo date('d-m-Y',strtotime($data['tgl_akhir']));?></td>
											<td>
												<a href="repbbanggaran.php?kode=<?php echo $data['kode'];?>&tgl_awal=
												<?php echo $data['tgl_awal'];?>&tgl_akhir=<?php echo $data['tgl_akhir'];?>" class="
												btn btn-danger btn-sm" target="_blank"><i class="fa fa-print"></i></a>

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
