<?php
include 'koneksi.php';

<<<<<<< HEAD
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['periode'])) {
	$tahun = $_POST['tahun'];
	$bulan = $_POST['bulan'];

	// Output JavaScript redirect
	echo "<script>
		window.location.href = '?page=rapb&tahun=$tahun&bulan=$bulan';
	</script>";
	exit;
}

$tahun = $_GET['tahun'] ?? date('Y');
$bulan = $_GET['bulan'] ?? date('m');
?>


<title>RAPB - Budget Planning</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- Custom CSS -->
<style>
	body {
		font-family: 'Poppins', sans-serif;
	}

	.card-header {
		background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
		border-radius: 0.375rem 0.375rem 0 0 !important;
	}

	.custom-title {
		font-family: 'Poppins', sans-serif;
		font-weight: 600;
		position: relative;
		color: #343a40;
		display: inline-block;
	}

	.custom-title::after {
		content: '';
		position: absolute;
		bottom: -6px;
		left: 37%;
		width: 20%;
		height: 3px;
		background-color: #0047b3;
		border-radius: 2px;
	}

	@media (max-width: 768px) {
		.header-bar {
			flex-direction: column;
			align-items: flex-start !important;
		}

		.custom-title {
			margin-top: 1rem;
		}
	}

	.form-select,
	.form-control {
		border-radius: 0.375rem;
		border: 1px solid #6e8091;
	}

	.btn {
		border-radius: 0.375rem;
		font-weight: 500;
		transition: all 0.3s ease;
		padding: 0.5rem 1rem;
	}

	.btn:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	}

	.btn-warning {
		background-color: #f39c12;
		border-color: #f39c12;
	}

	.btn-danger {
		background-color: var(--accent-color);
		border-color: var(--accent-color);
	}

	.input-tahun {
		max-width: 120px;
	}


	#budget-table th:nth-child(3),
	#budget-table td:nth-child(3) {
		text-align: left;
	}

	/* Tabel dengan border tegas dan rapi */
	#budget-table {
		border-collapse: collapse;
		width: 100%;
		font-size: 14px;
	}

	#budget-table th,
	#budget-table td {
		border: 1px solid #c5ccd3;
		padding: 10px 12px;
		text-align: center;
		vertical-align: middle;
	}

	/* Hover baris */
	#budget-table tbody tr:hover {
		background-color: #d9d9d9;
	}

	/* Responsif jika konten panjang */
	.table-responsive {
		overflow-x: auto;
	}

	table.dataTable thead th {
		background-color: #003366;
		color: white;
	}

	table.dataTable tbody tr:hover {
		background-color: rgba(52, 152, 219, 0.1);
	}


	.action-buttons .btn {
		margin: 0 3px;
		min-width: 80px;
	}

	.print-section {
		background-color: #f8f9fa;
		border-radius: 0.375rem;
		padding: 15px;
		margin-bottom: 10px;
	}

	.print-btn {
		margin: 5px;
		min-width: 250px;
	}
</style>

<div class="container-fluid py-4">
	<!-- Header bar satu baris -->
	<div class="d-flex justify-content-between align-items-center mb-4 header-bar">
		<a href="?page=form-anggaran" class="btn btn-warning">
			<i class="fas fa-arrow-left me-2"></i>Kembali
		</a>
		<h2 class="custom-title text-center m-0">
			RENCANA ANGGARAN PENDAPATAN DAN BIAYA (RAPB)
		</h2>
		<div style="width: 120px;"></div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card shadow-sm">
				<div class="card-body">
					<!-- Period Selection Form -->
					<div class="period-selector mb-3 d-flex justify-content-center">
						<form method="POST" class="row gx-2 gy-2 align-items-end justify-content-center">
							<div class="col-md-auto">
								<label for="bulan" class="form-label mb-1">Bulan</label>
								<select name="bulan" id="bulan" class="form-select form-select-sm">
									<?php
									$months = [
										'01' => 'JANUARI',
										'02' => 'FEBRUARI',
										'03' => 'MARET',
										'04' => 'APRIL',
										'05' => 'MEI',
										'06' => 'JUNI',
										'07' => 'JULI',
										'08' => 'AGUSTUS',
										'09' => 'SEPTEMBER',
										'10' => 'OKTOBER',
										'11' => 'NOVEMBER',
										'12' => 'DESEMBER'
									];
									foreach ($months as $key => $month) {
										$selected = ($key == $bulan) ? 'selected' : '';
										echo "<option value='$key' $selected>$month</option>";
									}
									?>
								</select>
							</div>
							<div class="col-md-auto">
								<label for="tahun" class="form-label mb-1">Tahun</label>
								<input type="text" name="tahun" id="tahun" class="form-control form-control-sm input-tahun" value="<?= $tahun ?>">
							</div>
							<div class="col-md-auto">
								<button type="submit" name="periode" class="btn btn-sm btn-primary">
									<i class="fas fa-calendar-alt me-1"></i> Pilih Periode
								</button>
							</div>
						</form>
					</div>

					<!-- Print Options -->
					<div class="print-section text-center">
						<div class="row">
							<div class="col-md-6">
								<a href="cetakrapb.php?tahun=<?php echo $tahun; ?>&status=awal" target="_blank" class="btn btn-outline-primary print-btn">
									<i class="fas fa-print me-2"></i>Cetak RAPB (Awal)
								</a>
								<a href="cetakrapb.php?tahun=<?php echo $tahun; ?>&status=ubah" target="_blank" class="btn btn-outline-primary print-btn">
									<i class="fas fa-print me-2"></i>Cetak RAPB (Perubahan)
								</a>
							</div>
							<div class="col-md-6">
								<a href="cetakrealisasi.php?tahun=<?php echo $tahun; ?>&bulan=<?php echo $bulan; ?>&status=awal" target="_blank" class="btn btn-outline-success print-btn">
									<i class="fas fa-print me-2"></i>Cetak Realisasi (Awal)
								</a>
								<a href="cetakrealisasi.php?tahun=<?php echo $tahun; ?>&bulan=<?php echo $bulan; ?>&status=ubah" target="_blank" class="btn btn-outline-success print-btn">
									<i class="fas fa-print me-2"></i>Cetak Realisasi (Perubahan)
								</a>
							</div>
						</div>
					</div>

					<!-- Budget Data Table -->
					<div class="table-responsive">
						<table id="budget-table">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="7%">Kode</th>
									<th width="20%">Deskripsi</th>
									<th width="10%">Per Bulan (Awal)</th>
									<th width="10%">Per Tahun (Awal)</th>
									<th width="10%">Per Bulan (Ubah)</th>
									<th width="10%">Per Tahun (Ubah)</th>
									<th width="8%">Periode</th>
									<th width="5%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$sql = $koneksi->query("SELECT perbulanawal, perbulanubah, pertahunawal, pertahunubah, mstanggaran.kode, mstanggaran.deskripsi 
                                                          FROM mstanggaran 
                                                          LEFT JOIN anggaran ON mstanggaran.kode = anggaran.kode AND anggaran.tahun = '$tahun' 
                                                          ORDER BY mstanggaran.kode");

								$njumrow = $sql->num_rows;
								if ($njumrow == 0) {
									$sss = $koneksi->query("INSERT INTO anggaran SELECT '$tahun', kode, 0, 0, 0, 0 FROM mstanggaran ORDER BY kode");
									$sql = $koneksi->query("SELECT perbulanawal, perbulanubah, pertahunawal, pertahunubah, mstanggaran.kode, mstanggaran.deskripsi 
                                                              FROM mstanggaran 
                                                              LEFT JOIN anggaran ON mstanggaran.kode = anggaran.kode AND anggaran.tahun = '$tahun' 
                                                              ORDER BY mstanggaran.kode");
								}

								while ($data = $sql->fetch_assoc()) {
									if (is_null($data['perbulanawal'])) {
										$ququ = $koneksi->query("INSERT INTO anggaran VALUES ('$tahun', '$data[kode]', 0, 0, 0, 0)");
										$perbulanawal = 0;
										$pertahunawal = 0;
										$perbulanubah = 0;
										$pertahunubah = 0;
									} else {
										$perbulanawal = $data['perbulanawal'];
										$pertahunawal = $data['pertahunawal'];
										$perbulanubah = $data['perbulanubah'];
										$pertahunubah = $data['pertahunubah'];
									}
								?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo htmlspecialchars($data['kode']); ?></td>
										<td><?php echo htmlspecialchars($data['deskripsi']); ?></td>
										<td class="numeric-cell"><?php echo number_format($perbulanawal, 2, ',', '.'); ?></td>
										<td class="numeric-cell"><?php echo number_format($pertahunawal, 2, ',', '.'); ?></td>
										<td class="numeric-cell"><?php echo number_format($perbulanubah, 2, ',', '.'); ?></td>
										<td class="numeric-cell"><?php echo number_format($pertahunubah, 2, ',', '.'); ?></td>
										<td><?php echo $tahun; ?></td>
										<td class="action-buttons">
											<a href="?page=ubah-rapb&kode=<?php echo urlencode($data['kode']); ?>&tahun=<?php echo $tahun; ?>"
												class="btn btn-sm btn-warning" title="Edit">
												<i class="fas fa-edit"></i> Edit
											</a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
=======
?>

<head>
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
	<script src="plugins/jquery/jquery.min.js"></script>
	<script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<?php
$tahun = $_GET['tahun'];

?>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div>
				<h1>
					<center><label class="label label-success">Rencana Anggaran Pendapatan dan Biaya (RAPB)</label></center>
				</h1><br>
				<div class="body">
					<form method="POST">
						<label for="">Periode</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="bulan" title="Pilih Bulan" width="200px">
							<option value="01">JANUARI</option>
							<option value="02">FEBRUARI</option>
							<option value="03">MARET</option>
							<option value="04">APRIL</option>
							<option value="05">MEI</option>
							<option value="06">JUNI</option>
							<option value="07">JULI</option>
							<option value="08">AGUSTUS</option>
							<option value="09">SEPTEMBER</option>
							<option value="10">OKTOBER</option>
							<option value="11">NOPEMBER</option>
							<option value="12">DESEMBER</option>
						</select>&nbsp;&nbsp;&nbsp;
						<input type="text" name="tahun" value="<?php echo $tahun; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" value="Pilih Periode" name="periode" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="?page=form-anggaran" class="btn btn-warning btn-sm">Kembali</a>
						<br><br><br>
					</form>
				</div>
				<?php
				if (isset($_POST['periode'])) {
					$tahun = $_POST['tahun'];
					$bulan = $_POST['bulan'];
				}
				?>
				<div class="body">
					<a href="cetakrapb.php?tahun=<?php echo $tahun; ?>&status=awal" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak RAPB (Awal).......................</a>
					<a href="cetakrapb.php?tahun=<?php echo $tahun; ?>&status=ubah" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak RAPB (Perubahan)..................</a><br><br>
					<a href="cetakrealisasi.php?tahun=<?php echo $tahun; ?>&bulan=<?php echo $bulan; ?>&status=awal" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Cetak Realisasi Anggaran (Awal)....</a>
					<a href="cetakrealisasi.php?tahun=<?php echo $tahun; ?>&bulan=<?php echo $bulan; ?>&status=ubah" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Cetak Realisasi Anggaran (Perubahan)</a>
				</div>
				<ul class="header-dropdown m-r--5">


					<ul class="dropdown-menu pull-right">
						<li><a href="javascript:void(0);">Action</a></li>
						<li><a href="javascript:void(0);">Another action</a></li>
						<li><a href="javascript:void(0);">Something else here</a></li>
					</ul>

				</ul>
			</div>
			<div class="body">
				<div class="table-responsive">
					<!--<table  class="datatable table table-hover table-bordered">-->
					<table id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable">
						<thead>
							<tr>
								<th>NO. </th>
								<th>KODE</th>
								<th>DESKRIPSI</th>
								<th>PER BULAN (AWAL)</th>
								<th>PER TAHUN (AWAL)</th>
								<th>PER BULAN (UBAH)</th>
								<th>PER TAHUN (UBAH)</th>
								<th>PERIODE</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							$sql = $koneksi->query("select perbulanawal,perbulanubah,pertahunawal,pertahunubah,mstanggaran.kode,mstanggaran.deskripsi from mstanggaran left join anggaran on mstanggaran.kode=anggaran.kode and anggaran.tahun='$tahun' order by mstanggaran.kode");

							$njumrow = $sql->num_rows;
							if ($njumrow == 0) {
								$sss = $koneksi->query("insert into anggaran select '$tahun',kode,0,0,0,0 from mstanggaran order by kode");
								$sql = $koneksi->query("select perbulanawal,perbulanubah,pertahunawal,pertahunubah,mstanggaran.kode,mstanggaran.deskripsi from mstanggaran left join anggaran on mstanggaran.kode=anggaran.kode and anggaran.tahun='$tahun' order by mstanggaran.kode");
							}
							while ($data = $sql->fetch_assoc()) {
								if (is_null($data['perbulanawal'])) {
									$ququ = $koneksi->query("insert into anggaran select '$tahun','$data[kode]',0,0,0,0");
									$perbulanawal = 0;
									$pertahunawal = 0;
									$perbulanubah = 0;
									$pertahunubah = 0;
								} else {
									$perbulanawal = $data['perbulanawal'];
									$pertahunawal = $data['pertahunawal'];
									$perbulanubah = $data['perbulanubah'];
									$pertahunubah = $data['pertahunubah'];
								}
							?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data['kode']; ?></td>
									<td><?php echo $data['deskripsi']; ?></td>
									<td align="right"><?php echo number_format($perbulanawal, 2, ',', '.'); ?></td>
									<td align="right"><?php echo number_format($pertahunawal, 2, ',', '.'); ?></td>
									<td align="right"><?php echo number_format($perbulanubah, 2, ',', '.'); ?></td>
									<td align="right"><?php echo number_format($pertahunubah, 2, ',', '.'); ?></td>
									<td><?php echo $tahun; ?></td>
									<td>
										<a href="?page=ubah-rapb&kode=
												<?php echo $data['kode']; ?>&tahun=<?php echo $tahun; ?>" class="
												btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>

									</td>
								</tr>
							<?php } ?>
						</tbody>
						<script>
							$(document).ready(function() {
								$('#tabel-data').DataTable();
							});
						</script>


					</table>

>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
				</div>
			</div>
		</div>
	</div>
</div>
<<<<<<< HEAD

<!-- Loading Overlay (initially hidden) -->
<div id="loading-overlay" class="loading-overlay" style="display: none;">
	<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
		<span class="visually-hidden">Loading...</span>
	</div>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Custom JavaScript -->
<script>
	$(document).ready(function() {
		// Show loading overlay
		$('#loading-overlay').show();

		// Initialize DataTable with more options
		var table = $('#budget-table').DataTable({
			"language": {
				"url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/Indonesian.json"
			},
			"responsive": true,
			"autoWidth": false,
			"initComplete": function() {
				// Hide loading overlay when table is ready
				$('#loading-overlay').hide();
			},

			"columnDefs": [{
					"orderable": false,
					"targets": [0, 8]
				}, // Disable sorting for No and Aksi columns
				{
					"className": "dt-center",
					"targets": [0, 7, 8]
				}, // Center align these columns
				{
					"type": "num-fmt",
					"targets": [3, 4, 5, 6]
				} // Proper numeric sorting for currency columns
			]
		});



	});
</script>
=======
<!-- #END# Basic Examples -->
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
