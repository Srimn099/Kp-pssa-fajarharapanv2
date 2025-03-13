<?php
function hitung_umur($tanggal_lahir)
{
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y;
}
include 'koneksi.php';
$cc = mysqli_query($koneksi, "select * from company");
$data = $cc->fetch_assoc();
$tahun = $_GET['tahun'];
$bulan = $_GET['bulan'];
$ymproc = $tahun . $bulan;
if ($bulan == '01') {
	$bln = 'JANUARI';
} elseif ($bulan == '02') {
	$bln = 'FEBRUARI';
} elseif ($bulan == '03') {
	$bln = 'MARET';
} elseif ($bulan == '04') {
	$bln = 'APRIL';
} elseif ($bulan == '05') {
	$bln = 'MEI';
} elseif ($bulan == '06') {
	$bln = 'JUNI';
} elseif ($bulan == '07') {
	$bln = 'JULI';
} elseif ($bulan == '08') {
	$bln = 'AGUSTUS';
} elseif ($bulan == '09') {
	$bln = 'SEPTEMBER';
} elseif ($bulan == '10') {
	$bln = 'OKTOBER';
} elseif ($bulan == '11') {
	$bln = 'NOPEMBER';
} else {
	$bln = 'DESEMBER';
}
$status = $_GET['status'];
if ($status == 'awal') {
	$lstatus = "Awal";
} else {
	$lstatus = "Perubahan";
}
?>
<center>
	<a target="_blank" href="realanggaranxls.php?tahun=<?php echo $tahun; ?>&bulan=<?php echo $bulan; ?>&status=<?php echo $status; ?>">EXPORT KE EXCEL</a>
</center>

<!DOCTYPE HTML>
<html>

<head>
	<title>Realisasi Anggaran Pendapatan dan Biaya</title>
	<style>
		@media print {
			input.noPrint {
				display: none;
			}
		}
	</style>
</head>



<body>
	<div style="border:0; padding:10px; width:924px; height:auto;">
		<table border="1" width="100%" style="border-collapse: collapse;">
			<div align="left">
				<font size="6" color="red"><b><?php echo $data['NAMA']; ?></b></font><br>
				<?php echo $data['ALAMAT']; ?>&nbsp<?php echo $data['KOTA']; ?>&nbsp<?php echo $data['PHONE']; ?>
			</div>
			<caption>
				<h2>REALISASI ANGGARAN PENDAPATAN DAN BIAYA</h2>
				<h4>Tahun Anggaran: <b><?php echo $tahun . ' (' . $lstatus . ')' ?></b></h4>
				<h4>Posisi Bulan : <b><?php echo $bln; ?></b></h4>
			</caption>
			<thead>
				<tr>
					<th>Kode</th>
					<th>Deskripsi</th>
					<th>Anggaran</th>
					<th>Realisasi</th>
					<th>Selisih</th>
					<th>%</th>

				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$sql1 = $koneksi->query("select * from kelanggaran order by kodekel");
				$angpendapatan = 0;
				$angbiaya = 0;
				$realpendapatan = 0;
				$realbiaya = 0;
				while ($duta = $sql1->fetch_assoc()) {
					$kodekel = $duta['kodekel'];
					$kelompok = $duta['deskripsi'];
					$subtotalanggaran = 0;
					$subtotalrealisasi = 0;
					$sql = $koneksi->query("
					SELECT mstanggaran.kode, 
						   mstanggaran.deskripsi, 
						   anggaran.pertahunawal, 
						   anggaran.pertahunubah, 
						   SUM(jurnal.idramount) AS realisasi 
					FROM mstanggaran 
					LEFT JOIN jurnal 
						ON mstanggaran.kode = jurnal.cproject 
						AND YEAR(jurnal.dtgl_trans) = '$tahun' 
						AND DATE_FORMAT(jurnal.dtgl_trans, '%Y%m') <= '$ymproc' 
						AND jurnal.ctransflag = 'TR' 
						AND jurnal.cdebkred = 'D'
					JOIN anggaran 
						ON mstanggaran.kode = anggaran.kode 
						AND anggaran.tahun = '$tahun' 
					WHERE mstanggaran.kodekel = '$kodekel'
					GROUP BY mstanggaran.kode, mstanggaran.deskripsi, anggaran.pertahunawal, anggaran.pertahunubah
				");
					while ($data = $sql->fetch_assoc()) {
						if ($status == 'awal') {
							$subtotalanggaran = $subtotalanggaran + $data['pertahunawal'];

							$anggaran = $data['pertahunawal'];
							if (is_null($data['realisasi'])) {
								$realisasi = 0;
							} else {
								$realisasi = $data['realisasi'];
							}
							$subtotalrealisasi = $subtotalrealisasi + $realisasi;
							if (is_null($anggaran)) {
								$anggaran = 0;
							}
							if ($anggaran == 0) {
								$prosentase = 0;
								$selisih = $anggaran - $realisasi;
							} else {
								$prosentase = $realisasi / $anggaran * 100;
								$selisih = $anggaran - $realisasi;
							}
							if ($duta['jenis'] == 'D') {
								$angpendapatan = $angpendapatan + $anggaran;
								$realpendapatan = $realpendapatan + $realisasi;
							} else {
								$angbiaya = $angbiaya + $anggaran;
								$realbiaya = $realbiaya + $realisasi;
							}
						} else {
							$subtotalanggaran = $subtotalanggaran + $data['pertahunubah'];

							$anggaran = $data['pertahunubah'];
							if (is_null($data['realisasi'])) {
								$realisasi = 0;
							} else {
								$realisasi = $data['realisasi'];
							}

							$subtotalrealisasi = $subtotalrealisasi + $realisasi;

							if (is_null($anggaran)) {
								$anggaran = 0;
							}
							if ($anggaran == 0) {
								$prosentase = 0;
								$selisih = $anggaran - $realisasi;
							} else {
								$prosentase = $realisasi / $anggaran * 100;
								$selisih = $anggaran - $realisasi;
							}
							if ($duta['jenis'] == 'D') {
								$angpendapatan = $angpendapatan + $anggaran;
								$realpendapatan = $realpendapatan + $realisasi;
							} else {
								$angbiaya = $angbiaya + $anggaran;
								$realbiaya = $realbiaya + $realisasi;
							}
						}

				?>
						<tr>
							<td><?php echo $data['kode']; ?></td>
							<td><?php echo $data['deskripsi']; ?></td>

							<td align="right"><?php echo number_format($anggaran, 2, ',', '.'); ?></td>
							<td align="right"><?php echo number_format($realisasi, 2, ',', '.'); ?></td>
							<td align="right"><?php echo number_format($anggaran - $realisasi, 2, ',', '.'); ?></td>
							<td align="right"><?php echo number_format($prosentase, 2, ',', '.'); ?></td>
						</tr>
					<?php } ?>
					<td colspan="2"><b><?php echo 'Sub Total ' . $kelompok; ?></b></td>
					<td align="right"><b><?php echo number_format($subtotalanggaran, 2, ',', '.'); ?></b></td>
					<td align="right"><b><?php echo number_format($subtotalrealisasi, 2, ',', '.'); ?></b></td>
					<td align="right"><b><?php echo number_format($subtotalanggaran - $subtotalrealisasi, 2, ',', '.'); ?></b></td>
					<td align="right">
						<b>
							<?php
							echo ($subtotalanggaran != 0)
								? number_format($subtotalrealisasi / $subtotalanggaran * 100, 2, ',', '.')
								: '0,00';
							?>
						</b>
					</td> <?php } ?>

				<tr>
					<td colspan="2" align="right"><b>TOTAL PENDAPATAN</b></td>
					<td align="right"><b><?php echo number_format($angpendapatan, 2, ',', '.'); ?></b></td>
					<td align="right"><b><?php echo number_format($realpendapatan, 2, ',', '.'); ?></b></td>
					<td align="right">
						<b>
							<?php
							echo ($angpendapatan != 0)
								? number_format($realpendapatan / $angpendapatan * 100, 2, ',', '.')
								: '0,00';
							?>
						</b>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="right"><b>TOTAL BIAYA</b></td>
					<td align="right"><b><?php echo number_format($angbiaya, 2, ',', '.'); ?></b></td>
					<td align="right"><b><?php echo number_format($realbiaya, 2, ',', '.'); ?></b></td>
					<td align="right"><b>
							<?php
							if ($angbiaya != 0) {
								echo number_format(($realbiaya / $angbiaya) * 100, 2, ',', '.');
							} else {
								echo '0,00'; // Jika anggaran biaya nol, tampilkan 0,00
							}
							?>
						</b></td>
				</tr>
				<tr>
					<td colspan="2" align="right"><b>SELISIH</b></td>
					<td align="right"><b><?php echo number_format($angpendapatan - $angbiaya, 2, ',', '.'); ?></b></td>
					<td align="right"><b><?php echo number_format($realpendapatan - $realbiaya, 2, ',', '.'); ?></b></td>
					<td></td>
				</tr>
			</tbody>

			<br><br>




		</table>
		<?php
		mysqli_close($koneksi);
		?>
		<br>
		<br>


		<br><br><br><br><br>
		<input type="button" class="noPrint" value="Cetak" onclick="window.print()">


	</div>
</body>

</html>