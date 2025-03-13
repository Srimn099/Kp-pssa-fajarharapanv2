<?php
include 'koneksi.php';

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

				</div>
			</div>
		</div>
	</div>
</div>
<!-- #END# Basic Examples -->