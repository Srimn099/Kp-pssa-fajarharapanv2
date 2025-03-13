<?php
include 'koneksi.php';
include 'functions.php';
$cc = mysqli_query($koneksi, "select * from company");
$data = $cc->fetch_assoc();
$tgl_awal = $_GET['tgl_awal'];
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Daftar Aset Tetap</title>
	<style>
		@media print {
			input.noPrint {
				display: none;
			}
		}
	</style>
</head>

<body>

	<table border="1" width="100%" style="border-collapse: collapse;">
		<div align="left">
			<font size="6" color="red"><b><?php echo $data['NAMA']; ?></b></font><br>
			<?php echo $data['ALAMAT']; ?>&nbsp<?php echo $data['KOTA']; ?>&nbsp<?php echo $data['PHONE']; ?>
		</div>
		<caption>
			<h2>DAFTAR ASET TETAP</h2>
		</caption>
		<caption>Posisi Tanggal :<b><?php echo date('d-F-Y', strtotime($tgl_awal)) ?></b></caption>
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


			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$sql = $koneksi->query("select inventory.*,kelbrg.nama as namakelompok,kelbrg.lflag from inventory,kelbrg where inventory.kelompok=kelbrg.kode and inventory.dbeli<='$tgl_awal' order by inventory.dbeli,inventory.inventno");
			$total = 0;
			while ($data = $sql->fetch_assoc()) {
				$usedmth = difmonth($data['dbeli'], $tgl_awal) + 1;
				if ($usedmth > $data['masa']) {
					$usedmth = $data['masa'];
				}
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



</body>

</html>