<?php
<<<<<<< HEAD
function hitung_umur($tanggal_lahir)
{
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		exit("0 tahun 0 bulan 0 hari");
	}
	return $today->diff($birthDate)->y;
}
include 'koneksi.php';
$cc = mysqli_query($koneksi, "SELECT * FROM company");
$data = $cc->fetch_assoc();
$tahun = $_GET['tahun'];
$status = $_GET['status'];
$lstatus = $status === 'awal' ? 'Awal' : 'Perubahan';
?>

<style>
	body {
		font-family: Arial, sans-serif;
		background: #f9f9f9;
		padding: 20px;
	}

	.container {
		max-width: 1000px;
		margin: auto;
		background: #fff;
		padding: 30px;
	}

	.company-header {
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 20px;
		font-family: 'Times New Roman', Times, serif;
		border-bottom: 3px double black;
		/* <- garis kop surat ganda */
		padding-bottom: 8px;
		/* tambahkan ini untuk geser garis ke bawah */


	}

	.company-logo {
		width: 70px;
		height: 70px;
		object-fit: contain;
	}

	.company-text h1 {
		font-size: 20px;
		font-weight: bold;
		line-height: 1.2;
		margin: 0;
		text-align: center;
		font-family: 'Times New Roman', Times, serif;

	}

	/* judul alamat */
	.company-text p {
		font-size: 10px;
		text-align: center;
		margin: 2px 0 0 0;
		/* lebih dekat ke atas */
		font-family: 'Times New Roman', Times, serif;

	}

	.tahun-anggaran {
		text-align: center;
		margin-top: -10px;
		/* geser ke atas */
		margin-bottom: 20px;
		font-size: 13px;
	}

	/* teks judul RAPB */
	.text-center {
		text-align: center;
		font-size: 14px;
	}

	h1,
	h2,
	h4 {
		text-align: center;
	}

	table {
		width: 100%;
		border-collapse: collapse;
		margin-top: 20px;
	}

	table,
	th,
	td {
		font-size: 12px;
	}

	th,
	td {
		border: 0.5px solid black;
		padding: 6px 12px;
	}

	.text-kode {
		text-align: right;
	}

	.text-right {
		text-align: right;
	}

	.text-left {
		text-align: left;
	}


	.export-button,
	.print-button {
		margin: 10px 0;
		display: inline-block;
		background-color: #007bff;
		color: white;
		padding: 10px 20px;
		text-decoration: none;
		border-radius: 5px;
	}

	.export-button:hover,
	.print-button:hover {
		background-color: #0056b3;
	}

	@media print {
		.noPrint {
			display: none;
		}
	}
</style>

<div class="container">

	<a class="export-button noPrint" target="_blank" href="rapbxls.php?tahun=<?= $tahun; ?>&status=<?= $status; ?>">EXPORT KE EXCEL</a>
	<button class="print-button noPrint" onclick="window.print()">CETAK</button>

	<div class="company-header">
		<img src="image/logomuhammadiyah.png" alt="Logo Kiri" class="company-logo">

		<div class="company-text">
			<h1>
				<?= str_replace('Panti', '<br>Panti', $data['NAMA']); ?>
			</h1>
			<p><?= $data['ALAMAT'] . ', ' . $data['KOTA'] . ', ' . $data['PHONE']; ?></p>
		</div>

		<img src="image/logo_panti_new.png" alt="Logo Kanan" class="company-logo">
	</div>

	<h3 class="text-center">RENCANA ANGGARAN PENDAPATAN DAN BIAYA</h3>
	<h5 class="tahun-anggaran">Tahun Anggaran: <b><?= $tahun . ' (' . $lstatus . ')' ?></b></h5>

	<table>
		<thead>
			<tr>
				<th class="text-kode">Kode</th>
				<th>Deskripsi</th>
				<th>Per Bulan</th>
				<th>Per Tahun</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql1 = $koneksi->query("SELECT kodekel, deskripsi, jenis FROM kelanggaran ORDER BY kodekel");
			$pendapatan = $biaya = 0;

			while ($duta = $sql1->fetch_assoc()) {
				$kodekel = $duta['kodekel'];
				$kelompok = $duta['deskripsi'];
				$subtotal = 0;
				// Judul Kelompok
				echo "<tr style='font-weight:bold;'>
	<td colspan='4'>{$kelompok}</td>
</tr>";
				$sql = $koneksi->query("SELECT mstanggaran.kode, mstanggaran.deskripsi, anggaran.perbulanawal, anggaran.pertahunawal, anggaran.perbulanubah, anggaran.pertahunubah FROM mstanggaran, anggaran WHERE mstanggaran.kode = anggaran.kode AND anggaran.tahun = '$tahun' AND mstanggaran.kodekel = '$kodekel' ORDER BY mstanggaran.kode");
				while ($data = $sql->fetch_assoc()) {
					if ($status == 'awal') {
						$perbulan = $data['perbulanawal'];
						$pertahun = $data['pertahunawal'];
					} else {
						$perbulan = $data['perbulanubah'];
						$pertahun = $data['pertahunubah'];
					}

					$subtotal += $pertahun;

					if ($duta['jenis'] == 'D') {
						$pendapatan = $pendapatan + $pertahun;
					} else {
						$biaya = $biaya + $pertahun;
					}
					echo "<tr>
                            <td class='text-kode'>{$data['kode']}</td>
                            <td>{$data['deskripsi']}</td>
                            <td class='text-right'>" . number_format($perbulan, 2, ',', '.') . "</td>
                            <td class='text-right'>" . number_format($pertahun, 2, ',', '.') . "</td>
                        </tr>";
				}
				echo "<tr style='background-color:#f9f9f9;'>
                     <td colspan='3' style='text-align:right;'><b>Sub Total {$kelompok}</b></td>

                        <td class='text-right'><b>" . number_format($subtotal, 2, ',', '.') . "</b></td>
                    </tr>";
			}
			?>
			<tr style="background:#e0f7fa;">
				<td colspan="3" class="text-right"><b>TOTAL PENDAPATAN</b></td>
				<td class="text-right"><b><?= number_format($pendapatan, 2, ',', '.'); ?></b></td>
			</tr>
			<tr style="background:#fce4ec;">
				<td colspan="3" class="text-right"><b>TOTAL BIAYA</b></td>
				<td class="text-right"><b><?= number_format($biaya, 2, ',', '.'); ?></b></td>
			</tr>
			<tr style="background:#dcedc8;">
				<td colspan="3" class="text-right"><b>SELISIH</b></td>
				<td class="text-right"><b><?= number_format($pendapatan - $biaya, 2, ',', '.'); ?></b></td>
			</tr>
		</tbody>
	</table>
</div>
<?php mysqli_close($koneksi); ?>
=======
function hitung_umur($tanggal_lahir){
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
$cc=mysqli_query($koneksi,"select * from company");
$data=$cc->fetch_assoc();
$tahun = $_GET['tahun'];
$status = $_GET['status'];
if($status=='awal'){
	$lstatus = "Awal";
}else{
	$lstatus = "Perubahan";
}
?>
<center>
		<a target="_blank" href="rapbxls.php?tahun=<?php echo $tahun;?>&status=<?php echo $status;?>">EXPORT KE EXCEL</a>
</center>

<!DOCTYPE HTML>
<html>
<head>
	<title>Rencana Anggaran Pendapatan dan Biaya</title>
	<style>
		@media print{
			input.noPrint{
				display: none;
			}
		}
	</style>
</head>



<body>
<div style="border:0; padding:10px; width:924px; height:auto;">
<table border="1" width="100%" style="border-collapse: collapse;">
	<div align="left">
		<font size="6" color="red"><b><?php echo $data['NAMA'];?></b></font><br>
		<?php echo $data['ALAMAT'];?>&nbsp<?php echo $data['KOTA'];?>&nbsp<?php echo $data['PHONE'];?>
	</div>
	<caption><h2>RENCANA ANGGARAN PENDAPATAN DAN BIAYA</h2>
	<h4>Tahun Anggaran: <b><?php echo $tahun.' ('.$lstatus.')'?></b></h4></caption>
	<thead>
		<tr>
			<th>Kode</th>
			<th>Deskripsi</th>
			<th>Per Bulan</th>
			<th>Per Tahun</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			$sql1 = $koneksi->query("select * from kelanggaran order by kodekel");
			$pendapatan = 0;
			$biaya = 0;
			while($duta=$sql1->fetch_assoc()){
			$kodekel = $duta['kodekel'];
			$kelompok = $duta['deskripsi'];
			$subtotal=0;
			$sql=$koneksi->query("select mstanggaran.kode,mstanggaran.deskripsi,anggaran.perbulanawal,anggaran.pertahunawal,anggaran.perbulanubah,anggaran.pertahunubah from mstanggaran,anggaran where mstanggaran.kode=anggaran.kode and anggaran.tahun='$tahun' and mstanggaran.kodekel='$kodekel' order by mstanggaran.kode");
			while($data=$sql->fetch_assoc()){
				if($status=='awal'){
					$subtotal = $subtotal+$data['pertahunawal'];
					$perbulan = $data['perbulanawal'];
					$pertahun = $data['pertahunawal'];
					if($duta['jenis']=='D'){
						$pendapatan = $pendapatan+$pertahun;
					}else{
						$biaya = $biaya+$pertahun;
					}
				}else{
					$subtotal = $subtotal+$data['pertahunubah'];
					$perbulan = $data['perbulanubah'];
					$pertahun = $data['pertahunubah'];
				}
				
			?>
			<tr>
				<td><?php echo $data['kode'];?></td>
				<td><?php echo $data['deskripsi'];?></td>
					
				<td align="right"><?php echo number_format($perbulan,2,',','.');?></td>
				<td align="right"><?php echo number_format($pertahun,2,',','.');?></td>
				
			</tr>
			<?php } ?>
			<td colspan="2"><b><?php echo 'Sub Total '.$kelompok;?></b></td>
			<td></td>
			<td align="right"><b><?php echo number_format($subtotal,2,',','.');?></b></td>
			<?php } ?>
			
			<tr>
			<td colspan="2" align="right"><b>TOTAL PENDAPATAN</b></td>
			<td></td>
			<td align="right"><b><?php echo number_format($pendapatan,2,',','.');?></b></td>
			</tr>
			<tr>
			<td colspan="2" align="right"><b>TOTAL BIAYA</b></td>
			<td></td>
			<td align="right"><b><?php echo number_format($biaya,2,',','.');?></b></td>
			</tr>
			<tr>
			<td colspan="2" align="right"><b>SELISIH</b></td>
			<td></td>
			<td align="right"><b><?php echo number_format($pendapatan-$biaya,2,',','.');?></b></td>
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
