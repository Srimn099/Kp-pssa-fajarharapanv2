<?php
include 'koneksi.php';
include 'functions.php';
<<<<<<< HEAD

$cc = mysqli_query($koneksi, "SELECT * FROM company");
=======
$cc = mysqli_query($koneksi, "select * from company");
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
$data = $cc->fetch_assoc();
$tgl_awal = $_GET['tgl_awal'];
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Daftar Aset Tetap</title>
	<style>
<<<<<<< HEAD
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
		}

		.header {
			text-align: center;
			margin-bottom: 10px;
		}

		.header h2 {
			margin: 0;
			color: red;
		}

		.header p {
			margin: 2px;
			font-size: 12px;
		}


		.caption {
			text-align: center;
			margin-top: 10px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 10px;
		}

		th,
		td {
			border: 1px solid #000;
			padding: 5px;
			font-size: 12px;
		}

		thead th {
			background-color: #f2f2f2;
			text-align: center;
		}

		@media print {
			.noPrint {
				display: none !important;
=======
		@media print {
			input.noPrint {
				display: none;
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
			}
		}
	</style>
</head>

<body>
<<<<<<< HEAD
	<!-- Tombol Cetak -->
	<div class="noPrint" style="text-align: left; margin-bottom: 10px;">
		<button onclick="window.print()" style="
		background-color: #007bff;
		color: white;
		border: none;
		padding: 8px 16px;
		font-size: 14px;
		border-radius: 4px;
		cursor: pointer;
		display: inline-flex;
		align-items: center;
		gap: 6px;
	">
			Cetak
		</button>
	</div>
	<!-- Header Perusahaan -->
	<div class="header">
		<h2><b><?php echo $data['NAMA']; ?></b></h2>
		<p><?php echo $data['ALAMAT'] . ', ' . $data['KOTA'] . ' - ' . $data['PHONE']; ?></p>
	</div>

	<!-- Judul Laporan -->
	<div class="caption">
		<h3>DAFTAR ASET TETAP</h3>
		<p>Posisi Tanggal: <b><?php echo date('d-F-Y', strtotime($tgl_awal)); ?></b></p>
	</div>

	<!-- Tabel Data -->
	<table>
=======

	<table border="1" width="100%" style="border-collapse: collapse;">
		<div align="left">
			<font size="6" color="red"><b><?php echo $data['NAMA']; ?></b></font><br>
			<?php echo $data['ALAMAT']; ?>&nbsp<?php echo $data['KOTA']; ?>&nbsp<?php echo $data['PHONE']; ?>
		</div>
		<caption>
			<h2>DAFTAR ASET TETAP</h2>
		</caption>
		<caption>Posisi Tanggal :<b><?php echo date('d-F-Y', strtotime($tgl_awal)) ?></b></caption>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
		<thead>
			<tr>
				<th>No.</th>
				<th>No. Register</th>
				<th>Deskripsi Barang</th>
				<th>Kelompok</th>
				<th>Tgl Beli</th>
				<th>Nilai Beli</th>
				<th>Masa</th>
				<th>Umur</th>
				<th>Susut</th>
				<th>Akumulasi</th>
				<th>Nilai Buku</th>
<<<<<<< HEAD
=======


>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
<<<<<<< HEAD
			$sql = $koneksi->query("SELECT inventory.*, kelbrg.nama AS namakelompok, kelbrg.lflag 
									FROM inventory 
									JOIN kelbrg ON inventory.kelompok = kelbrg.kode 
									WHERE inventory.dbeli <= '$tgl_awal' 
									ORDER BY inventory.dbeli, inventory.inventno");

			while ($data = $sql->fetch_assoc()) {
				$usedmth = difmonth($data['dbeli'], $tgl_awal) + 1;
				if ($usedmth > $data['masa']) $usedmth = $data['masa'];

=======
			$sql = $koneksi->query("select inventory.*,kelbrg.nama as namakelompok,kelbrg.lflag from inventory,kelbrg where inventory.kelompok=kelbrg.kode and inventory.dbeli<='$tgl_awal' order by inventory.dbeli,inventory.inventno");
			$total = 0;
			while ($data = $sql->fetch_assoc()) {
				$usedmth = difmonth($data['dbeli'], $tgl_awal) + 1;
				if ($usedmth > $data['masa']) {
					$usedmth = $data['masa'];
				}
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
				if ($data['lflag'] == 'Y') {
					$depresiasi = round($data['harga'] / $data['masa'], 0);
					if ($usedmth >= $data['masa']) {
						$nilaibuku = 1;
						$akumsusut = $data['harga'];
					} else {
						$akumsusut = $depresiasi * $usedmth;
						$nilaibuku = $data['harga'] - $akumsusut;
					}
				} else {
					$depresiasi = 0;
					$akumsusut = 0;
					$nilaibuku = $data['harga'];
				}
			?>
				<tr>
<<<<<<< HEAD
					<td align="center"><?php echo $no++; ?></td>
					<td><?php echo $data['inventno']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['namakelompok']; ?></td>
					<td align="center"><?php echo date('d-m-Y', strtotime($data['dbeli'])); ?></td>
					<td align="right"><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
					<td align="center"><?php echo $data['masa']; ?></td>
					<td align="center"><?php echo $usedmth; ?></td>
					<td align="right"><?php echo number_format($depresiasi, 0, ',', '.'); ?></td>
					<td align="right"><?php echo number_format($akumsusut, 0, ',', '.'); ?></td>
					<td align="right"><?php echo number_format($nilaibuku, 0, ',', '.'); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<?php mysqli_close($koneksi); ?>
=======
					<td width="2.5%" style="font-size:12px"><?php echo $no++; ?></td>
					<td width="10%" style="font-size:12px"><?php echo $data['inventno']; ?></td>
					<td width="30%" style="font-size:12px"><?php echo $data['nama']; ?></td>
					<td width="25%" style="font-size:12px"><?php echo $data['namakelompok']; ?></td>
					<td width="5%" style="font-size:12px"><?php echo date('d-m-Y', strtotime($data['dbeli'])); ?></td>
					<td width="10%" style="font-size:12px" align="right"><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
					<td width="2.5%" style="font-size:12px"><?php echo $data['masa']; ?></td>
					<td width="2.5%" style="font-size:12px"><?php echo $usedmth; ?></td>
					<td width="5%" align="right" style="font-size:12px"><?php echo number_format($depresiasi, 0, ',', '.'); ?></td>
					<td width="5%" align="right" style="font-size:12px"><?php echo number_format($akumsusut, 0, ',', '.'); ?></td>
					<td width="7.5%" align="right" style="font-size:12px"><?php echo number_format($nilaibuku, 0, ',', '.'); ?></td>

				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<br><br>

	<?php
	mysqli_close($koneksi);
	?>
	<br>
	<br>


	<br><br><br><br><br>
	<input type="button" class="noPrint" value="Cetak" onclick="window.print()">



>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
</body>

</html>