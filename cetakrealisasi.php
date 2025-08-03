<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
$bulan_arr = [
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
	'11' => 'NOPEMBER',
	'12' => 'DESEMBER'
];
$bln = $bulan_arr[$bulan];
$status = $_GET['status'];
$lstatus = ($status == 'awal') ? 'Awal' : 'Perubahan';
?>

<title>Realisasi Anggaran Pendapatan dan Biaya</title>
<div class="mt-4 d-flex justify-content-center gap-2 noPrint">
	<button onclick="window.print()" class="btn btn-primary">Cetak PDF</button>
	<a target="_blank" href="realanggaranxls.php?tahun=<?php echo $tahun; ?>&bulan=<?php echo $bulan; ?>&status=<?php echo $status; ?>" class="btn btn-success ">Export ke Excel</a>
</div>
<div class="container">
	<div class="kop d-flex align-items-center justify-content-between mb-3">
		<!-- Logo Kiri -->
		<img src="image/logomuhammadiyah.png" alt="Logo Kiri" class="kop-logo">

		<!-- Teks Tengah -->
		<div class="text-center flex-grow-1 kop-text">
			<h4 class="mb-0 text-uppercase">
				<b>
					<?php
					// Boleh tambahkan <br> secara dinamis kalau mau 2 baris
					echo str_replace(' Panti', '<br>Panti', $data['NAMA']);
					?>
				</b>
			</h4>
			<small>
				<?php echo $data['ALAMAT'] . ', ' . $data['KOTA'] . ', Telp: ' . $data['PHONE']; ?>
			</small>
		</div>

		<!-- Logo Kanan -->
		<img src="image/logo_panti_new.png" alt="Logo Kanan" class="kop-logo">
	</div>
</div>

<div class="text-center mb-4">
	<h6 class="fw-bold text-decoration-underline">REALISASI ANGGARAN PENDAPATAN DAN BIAYA</h6>
	<p class="mb-1">Tahun Anggaran: <b><?php echo $tahun . ' (' . $lstatus . ')' ?></b></p>
	<p>Posisi Bulan: <b><?php echo $bln; ?></b></p>
</div>


<div class="table-responsive">
	<table class="table table-bordered table-sm">
		<thead class="table-light text-center align-middle">
			<tr>
				<th class="text-kode">Kode</th>
				<th>Deskripsi</th>
				<th>Anggaran</th>
				<th>Realisasi</th>
				<th>Selisih</th>
				<th>%</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql1 = $koneksi->query("SELECT * FROM kelanggaran ORDER BY kodekel");
			$angpendapatan = $angbiaya = $realpendapatan = $realbiaya = 0;

			while ($duta = $sql1->fetch_assoc()) {
				$kodekel = $duta['kodekel'];
				$kelompok = $duta['deskripsi'];
				$subtotalanggaran = $subtotalrealisasi = 0;
				// Judul Kelompok
				echo "<tr style='font-weight:bold;'>
	<td colspan='6'>{$kelompok}</td>
</tr>";

				$sql = $koneksi->query("
							SELECT mstanggaran.kode, mstanggaran.deskripsi,
								anggaran.pertahunawal, anggaran.pertahunubah,
								SUM(jurnal.idramount) AS realisasi
							FROM mstanggaran
							LEFT JOIN jurnal
								ON mstanggaran.kode = jurnal.cproject
								AND YEAR(jurnal.dtgl_trans) = '$tahun'
								AND DATE_FORMAT(jurnal.dtgl_trans, '%Y%m') <= '$ymproc'
								AND jurnal.ctransflag = 'TR'
								AND jurnal.cdebkred = 'D'
							JOIN anggaran ON mstanggaran.kode = anggaran.kode AND anggaran.tahun = '$tahun'
							WHERE mstanggaran.kodekel = '$kodekel'
							GROUP BY mstanggaran.kode, mstanggaran.deskripsi, anggaran.pertahunawal, anggaran.pertahunubah
						");

				while ($data = $sql->fetch_assoc()) {
					$anggaran = ($status == 'awal') ? $data['pertahunawal'] : $data['pertahunubah'];
					$realisasi = $data['realisasi'] ?? 0;
					$selisih = $anggaran - $realisasi;
					$prosentase = ($anggaran != 0) ? ($realisasi / $anggaran) * 100 : 0;

					$subtotalanggaran += $anggaran;
					$subtotalrealisasi += $realisasi;

					if ($duta['jenis'] == 'D') {
						$angpendapatan += $anggaran;
						$realpendapatan += $realisasi;
					} else {
						$angbiaya += $anggaran;
						$realbiaya += $realisasi;
					}
			?>
					<tr>
						<td class="text-kode"><?php echo $data['kode']; ?></td>
						<td><?php echo $data['deskripsi']; ?></td>
						<td class="text-end"><?php echo number_format($anggaran, 2, ',', '.'); ?></td>
						<td class="text-end"><?php echo number_format($realisasi, 2, ',', '.'); ?></td>
						<td class="text-end"><?php echo number_format($selisih, 2, ',', '.'); ?></td>
						<td class="text-end"><?php echo number_format($prosentase, 2, ',', '.'); ?></td>
					</tr>
				<?php } ?>

				<tr class="table-secondary">
					<td colspan="2" class="text-end fw-bold">Sub Total <?php echo $kelompok; ?></td>
					<td class="text-end fw-bold"><?php echo number_format($subtotalanggaran, 2, ',', '.'); ?></td>
					<td class="text-end fw-bold"><?php echo number_format($subtotalrealisasi, 2, ',', '.'); ?></td>
					<td class="text-end fw-bold"><?php echo number_format($subtotalanggaran - $subtotalrealisasi, 2, ',', '.'); ?></td>
					<td class="text-end fw-bold">
						<?php echo ($subtotalanggaran != 0) ? number_format(($subtotalrealisasi / $subtotalanggaran) * 100, 2, ',', '.') : '0,00'; ?>
					</td>
				</tr>
			<?php } ?>

			<tr class="table-warning fw-bold">
				<td colspan="2" class="text-end">TOTAL PENDAPATAN</td>
				<td class="text-end"><?php echo number_format($angpendapatan, 2, ',', '.'); ?></td>
				<td class="text-end"><?php echo number_format($realpendapatan, 2, ',', '.'); ?></td>
				<td class="text-end"><?php echo number_format($angpendapatan - $realpendapatan, 2, ',', '.'); ?></td>
				<td class="text-end">
					<?php echo ($angpendapatan != 0) ? number_format(($realpendapatan / $angpendapatan) * 100, 2, ',', '.') : '0,00'; ?>
				</td>
			</tr>

			<tr class="table-danger fw-bold">
				<td colspan="2" class="text-end">TOTAL BIAYA</td>
				<td class="text-end"><?php echo number_format($angbiaya, 2, ',', '.'); ?></td>
				<td class="text-end"><?php echo number_format($realbiaya, 2, ',', '.'); ?></td>
				<td class="text-end"><?php echo number_format($angbiaya - $realbiaya, 2, ',', '.'); ?></td>
				<td class="text-end">
					<?php echo ($angbiaya != 0) ? number_format(($realbiaya / $angbiaya) * 100, 2, ',', '.') : '0,00'; ?>
				</td>
			</tr>

			<tr class="table-success fw-bold">
				<td colspan="2" class="text-end">SELISIH</td>
				<td class="text-end"><?php echo number_format($angpendapatan - $angbiaya, 2, ',', '.'); ?></td>
				<td class="text-end"><?php echo number_format($realpendapatan - $realbiaya, 2, ',', '.'); ?></td>
				<td colspan="2"></td>
			</tr>
		</tbody>
	</table>
</div>

<?php mysqli_close($koneksi); ?>
</div>
<style>
	body {
		font-size: 13px;
		font-family: Arial, sans-serif;
		padding: 30px;
	}

	@media print {
		.noPrint {
			display: none !important;
		}
	}

	.kop {
		border-bottom: 3px double black;
		padding-bottom: 10px;
		margin-bottom: 15px;
		padding-bottom: 10px;
		font-family: 'Times New Roman', Times, serif;
		margin-top: 20px;

	}

	.kop-logo {
		width: 70px;
		height: 70px;
		object-fit: contain;
	}

	/* teks kolom kode */
	.text-kode {
		text-align: center;
	}

	/* teks alamat */
	.kop-text {
		font-size: 13px;
		line-height: 1.3;
	}

	/* teks judul lembaga */
	.kop-text h4 {
		font-size: 20px;
	}

	table.table-bordered td,
	table.table-bordered th {
		border: 1px solid #000 !important;
	}

	table.table th,
	table.table td {
		vertical-align: middle;
		font-size: 11px;
	}

	.fw-bold {
		font-weight: bold;
	}
</style>