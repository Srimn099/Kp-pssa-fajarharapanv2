<?php
// Set default value for $tgl_awal if not set from form submission
$tgl_awal = isset($_POST['tgl_awal']) ? $_POST['tgl_awal'] : date('Y-m-d');
$tgl_akhir = isset($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : date('Y-m-d'); // Add default value for $tgl_akhir

// Your other PHP code here

?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Transaksi</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<style>
		body {
			background-color: #f8f9fa;
			font-family: 'Arial', sans-serif;
			text-align: center;
		}

		.container {
			width: 100%;
			padding: 0;
			/* Remove padding */
		}

		.card {
			width: 100%;
			/* Make the card full width */
		}

		.card-header {
			font-size: 24px;
			/* Increase font size for better visibility */
		}
	</style>
</head>

<div class="container-fluid mt-5"> <!-- Change to container-fluid -->
	<div class="row">
		<div class="col-lg-12"> <!-- Change to full width column -->
			<div class="card shadow-sm">
				<div class="card-header bg-success text-white text-center">
					<h4><strong>Cetak Laporan</strong></h4>
				</div>
				<div class="card-body">
					<form method="POST" class="form-inline mb-4">
						<label for="tgl_awal" class="mr-2">Periode</label>
						<input type="date" name="tgl_awal" value="<?php echo $tgl_awal; ?>" class="form-control mr-3">
						<input type="date" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>" class="form-control mr-3">
						<button type="submit" name="tanggal" class="btn btn-primary">Tentukan Tanggal</button>
					</form>

					<table class="table table-bordered table-striped table-hover">
						<thead class="thead-dark">
							<tr>
								<th>No.</th>
								<th>Laporan</th>
								<th>Periode</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1.</td>
								<td>
									<a href="repneraca.php?tgl_awal=<?php echo $tgl_awal; ?>" target="_blank">Laporan Posisi Keuangan</a>
								</td>
								<td><?php echo date('d-m-Y', strtotime($tgl_awal)); ?></td>
							</tr>
							<tr>
								<td>2.</td>
								<td>
									<a href="replabarugi.php?tgl_awal=<?php echo $tgl_awal; ?>" target="_blank">Laporan Aktivitas</a>
								</td>
								<td><?php echo date('d-m-Y', strtotime($tgl_awal)); ?></td>
							</tr>

							<tr>
								<td>3.</td>
								<td>
									<a href="repjurnal.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank">Laporan Transaksi Jurnal</a>
								</td>
								<td><?php echo date('d-m-Y', strtotime($tgl_awal)); ?>&nbsp;s.d.&nbsp;<?php echo date('d-m-Y', strtotime($tgl_akhir)); ?></td>
							</tr>
							<tr>
								<td>4.</td>
								<td>
									<a href="reparuskas.php?tgl_awal=<?php echo $tgl_awal; ?>" target="_blank">Laporan Arus Kas</a>
								</td>
								<td><?php echo date('d-m-Y', strtotime($tgl_awal)); ?></td>
							</tr>
							<tr>
								<td>5.</td>
								<td>
									<a href="repinvent.php?tgl_awal=<?php echo $tgl_awal; ?>" target="_blank">Daftar Aset Tetap</a>
								</td>
								<td><?php echo date('d-m-Y', strtotime($tgl_awal)); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>