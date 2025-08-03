<?php
<<<<<<< HEAD
function hitung_umur($tanggal_lahir)
{
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	return $y;
}
include 'koneksi.php';
$cc = mysqli_query($koneksi, "SELECT * FROM company");
$data = $cc->fetch_assoc();
$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));
?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Laporan Transaksi Jurnal</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 12px;
		}

		table {
			border-collapse: collapse;
			width: 100%;
		}

		th,
		td {
			padding: 5px;
			border: 1px solid #000;
		}

		thead {
			background-color: #f2f2f2;
		}

		/* Tombol */
		.button-group {
			display: flex;
			gap: 10px;
			margin-bottom: 15px;
		}

		.btn-custom {
			background-color: #28a745;
			color: white;
			padding: 8px 16px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 14px;
			text-decoration: none;
			transition: background-color 0.3s ease;
		}

		.btn-custom:hover {
			background-color: #218838;
		}

		.btn-print {
			background-color: #007bff;
		}

		.btn-print:hover {
			background-color: #0056b3;
		}

		/* Saat dicetak, sembunyikan elemen-elemen ini */
		@media print {

			.noPrint,
			.hide-on-print,
			.button-group {
				display: none !important;
			}
		}
	</style>

</head>

<body>

	<!-- Tombol -->
	<div class="button-group noPrint">
		<a class="btn-custom" href="repjurnalxls.php?tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank">
			Export ke Excel
		</a>
		<button class="btn-custom btn-print" onclick="window.print()">Cetak</button>
	</div>
	<!-- Informasi Perusahaan -->
	<div style="border:0; padding:10px; width:924px;">
		<div style="text-align: center;">
			<h2 style="color:red; margin-bottom: 5px;"><?php echo $data['NAMA']; ?></h2>
			<p style="margin: 0;"><?php echo $data['ALAMAT'] . ', ' . $data['KOTA'] . ' - ' . $data['PHONE']; ?></p>
		</div>

		<!-- Judul -->
		<div style="text-align: center;">
			<h2 style="margin-bottom: 5px;">LAPORAN TRANSAKSI JURNAL</h2>
			<h4 style="margin-top: 0;">Periode: <b><?php echo date('d F Y', strtotime($tgl_awal)) . ' s.d. ' . date('d F Y', strtotime($tgl_akhir)); ?></b></h4>
		</div>

		<!-- Tabel Data -->
		<table width="100%">
			<thead>
				<tr>
					<th>Tanggal</th>
					<th>No. Trx</th>
					<th>Perkiraan</th>
					<th>Keterangan</th>
					<th>Debet</th>
					<th>Kredit</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql = $koneksi->query("SELECT tabkira.CNO_KIRA, tabkira.CNAMA_KIRA, jurnal.* 
									FROM tabkira, jurnal 
									WHERE tabkira.CNO_KIRA = jurnal.CNO_KIRA 
									AND jurnal.DTGL_TRANS >= '$tgl_awal' 
									AND jurnal.DTGL_TRANS <= '$tgl_akhir' 
									AND jurnal.CTRANSFLAG = 'TR' 
									ORDER BY jurnal.DTGL_TRANS, jurnal.NNO_TRANS, tabkira.CNO_KIRA");
				$debet = 0;
				$kredit = 0;
				while ($data = $sql->fetch_assoc()) {
					if ($data['CDEBKRED'] == 'D') {
						$ndebet = $data['IDRAMOUNT'];
						$nkredit = 0;
						$debet += $ndebet;
					} else {
						$nkredit = $data['IDRAMOUNT'];
						$ndebet = 0;
						$kredit += $nkredit;
					}
				?>
					<tr>
						<td><?php echo date('d-m-Y', strtotime($data['DTGL_TRANS'])); ?></td>
						<td align="right"><?php echo $data['NNO_TRANS']; ?></td>
						<td><?php echo $data['CNO_KIRA'] . ' - ' . $data['CNAMA_KIRA']; ?></td>
						<td><?php echo $data['CKET']; ?></td>
						<td align="right"><?php echo number_format($ndebet, 2, ',', '.'); ?></td>
						<td align="right"><?php echo number_format($nkredit, 2, ',', '.'); ?></td>
					</tr>
				<?php } ?>

				<!-- TOTAL hanya ditampilkan saat layar -->
				<tr>
					<td colspan="4" align="right"><b>TOTAL</b></td>
					<td align="right"><b><?php echo number_format($debet, 2, ',', '.'); ?></b></td>
					<td align="right"><b><?php echo number_format($kredit, 2, ',', '.'); ?></b></td>
				</tr>
			</tbody>
		</table>


		<?php mysqli_close($koneksi); ?>

</body>

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
$tgl_awal = date('Y-m-d',strtotime($_GET['tgl_awal']));
$tgl_akhir = date('Y-m-d',strtotime($_GET['tgl_akhir']));

?>
<center>
		<a target="_blank" href="repjurnalxls.php?tgl_awal=
												<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir;?>">EXPORT KE EXCEL</a>
</center>

<!DOCTYPE HTML>
<html>
<head>
	<title>Laporan Transaksi Jurnal</title>
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
	<caption><h2>LAPORAN TRANSAKSI JURNAL</h2>
	<h4>Periode :<b><?php echo date('d-F-Y',strtotime($tgl_awal))?>&nbsp;s.d.&nbsp;<?php echo date('d-F-Y',strtotime($tgl_akhir))?></b></h4></caption>
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>No. Trx</th>
			<th>Perkiraan</th>
			<th>Keterangan</th>
			<th>Debet</th>
			<th>Kredit</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			$sql=$koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,jurnal.* from tabkira,jurnal where tabkira.CNO_KIRA=jurnal.CNO_KIRA and jurnal.DTGL_TRANS>='$tgl_awal' and jurnal.DTGL_TRANS<='$tgl_akhir' and jurnal.CTRANSFLAG='TR' order by jurnal.DTGL_TRANS,jurnal.NNO_TRANS,tabkira.CNO_KIRA");
			$debet =0 ;
			$kredit = 0;
			while($data=$sql->fetch_assoc()){
				if($data['CDEBKRED']=='D'){
					$debet=$debet+$data['IDRAMOUNT'];
					$ndebet=$data['IDRAMOUNT'];
					$nkredit=0;
				}else{
					$kredit=$kredit+$data['IDRAMOUNT'];
					$nkredit=$data['IDRAMOUNT'];
				$ndebet = 0;
				}
			?>	
			<tr>
				<td style="font-size:12px"><?php echo date('d-m-Y',strtotime($data['DTGL_TRANS']));?></td>
				<td style="font-size:12px" align="right"><?php echo $data['NNO_TRANS'];?></td>
				<td style="font-size:12px"><?php echo $data['CNO_KIRA'].'-'.$data['CNAMA_KIRA'];?></td>
				<td style="font-size:12px"><?php echo $data['CKET'];?></td>	
				<td style="font-size:12px" align="right"><?php echo number_format($ndebet,2,',','.');?></td>
				<td style="font-size:12px" align="right"><?php echo number_format($nkredit,2,',','.');?></td>
					
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="4" align="right"><b>TOTAL </b></td>
				<td align="right"><b><?php echo number_format($debet,2,',','.');?></b></td>
				<td align="right"><b><?php echo number_format($kredit,2,',','.');?></b></td>
			</tr>
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



</div>
</body>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
</html>