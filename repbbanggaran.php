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
$cc = mysqli_query($koneksi, "select * from company");
$data = $cc->fetch_assoc();

$tgl_awal = date('Y-m-d', strtotime($_GET['tgl_awal']));
$tgl_akhir = date('Y-m-d', strtotime($_GET['tgl_akhir']));
$kode = $_GET['kode'];
$bal = mysqli_query($koneksi, "select * from mstanggaran where kode='$kode'");
$balance = $bal->fetch_assoc();
$deskripsi = $balance['deskripsi'];

$cgroup = (substr($kode, 1, 1) == '1') ? 'D' : 'B';
?>

<title>Laporan Buku Besar Mata Anggaran</title>
<style>
	@media print {
		.noPrint {
			display: none !important;
		}
	}

	.kop-surat {
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin-bottom: 10px;
		padding: 0 15px;
		/* Tambahkan padding kiri-kanan */
	}

	.kop-surat img {
		width: 70px;
		height: 70px;
		object-fit: contain;
	}

	.kop-surat .info {
		flex: 1;
		text-align: center;
	}

	.kop-surat .info h1 {
		margin: 0;
		font-size: 24px;
		color: black;
		font-weight: bold;
		line-height: 1.2;
	}

	.kop-surat .info p {
		margin: 0;
		font-size: 14px;
		line-height: 1.2;
	}

	hr.garis-kop {
		border-bottom: 3px double black;
		margin: 10px 0 20px 0;
	}

	.table-laporan {
		border-collapse: collapse;
		width: 100%;
		font-size: 13px;
		font-family: sans-serif;

	}

	.table-laporan th,
	.table-laporan td {
		border: 1px solid #000;
		padding: 6px;
		text-align: center;
		vertical-align: middle;
	}

	.center-text {
		text-align: center;
		margin-top: 10px;
		margin-bottom: 20px;
	}

	.action-buttons {
		text-align: center;
		margin-bottom: 20px;
	}

	.action-buttons a,
	.action-buttons input {
		margin: 5px;
		padding: 6px 12px;
		font-size: 14px;
		border: 1px solid #ccc;
		background-color: #f8f9fa;
		cursor: pointer;
		text-decoration: none;
		color: #000;
	}

	.center-text {
		text-align: center;
		margin-bottom: 20px;
		font-family: sans-serif;
		font-size: 14px;

	}

	.center-text h3 {
		line-height: 1;
		font-family: sans-serif;
		font-size: 18px;
		border-bottom: 2px solid black;
		display: inline-block;
		padding-bottom: 1px;
		margin-bottom: 2px;

	}

	.center-text h4 {
		margin: 13px 0;
		line-height: 1.2;
		font-weight: normal;
		/* Hapus bold */
	}

	.text-ket {
		/* teks keterangan kolom */
		text-align: left !important;
	}
</style>


<div class="action-buttons noPrint">
	<a href="repbbanggaranxls.php?kode=<?php echo $kode; ?>&tgl_awal=<?php echo $tgl_awal; ?>&tgl_akhir=<?php echo $tgl_akhir; ?>" target="_blank">EXPORT KE EXCEL</a>
	<input type="button" class="noPrint" value="Cetak" onclick="window.print()">
</div>

<div style="padding: 10px; width: 924px; margin: 0 auto;">

	<div class="kop-surat">
		<img src="image/logomuhammadiyah.png" alt="Logo">
		<div class="info">
			<h1>
				<?= str_replace('Panti', '<br>Panti', $data['NAMA']); ?>
			</h1>
			<p><?php echo $data['ALAMAT']; ?>, <?php echo $data['KOTA']; ?> - Telp: <?php echo $data['PHONE']; ?></p>
		</div>
		<img src="image/logo_panti_new.png" alt="Logo Kanan" class="company-logo">
	</div>



	<hr class="garis-kop">
	<div class="center-text">
		<h3>BUKU BESAR MATA ANGGARAN</h3>
		<h4><?php echo '[' . $kode . '] - ' . $deskripsi; ?></h4>
		<h4>Periode: <b><?php echo date('d F Y', strtotime($tgl_awal)) . " s.d. " . date('d F Y', strtotime($tgl_akhir)); ?></b></h4>
	</div>

	<table class="table-laporan">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>No. Trx</th>
				<th class="text-ket">Keterangan</th>
				<th>Nilai</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$ntotal = 0;
			$query = "SELECT * FROM jurnal WHERE cproject='$kode' AND DTGL_TRANS >= '$tgl_awal' AND DTGL_TRANS <= '$tgl_akhir' AND ctransflag='TR' AND cdebkred='" . ($cgroup == 'D' ? 'K' : 'D') . "' ORDER BY DTGL_TRANS, NNO_TRANS";
			$sql = $koneksi->query($query);
			while ($data = $sql->fetch_assoc()) {
				$ntotal += $data['IDRAMOUNT'];
			?>
				<tr>
					<td><?php echo date('d-m-Y', strtotime($data['DTGL_TRANS'])); ?></td>
					<td align="right"><?php echo $data['NNO_TRANS']; ?></td>
					<td class="text-ket"><?php echo $data['CKET']; ?></td>
					<td align="right"><?php echo number_format($data['IDRAMOUNT'], 2, ',', '.'); ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td colspan="2"></td>
				<td><strong>TOTAL</strong></td>
				<td align="right"><strong><?php echo number_format($ntotal, 2, ',', '.'); ?></strong></td>
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
$tgl_awal = date('Y-m-d',strtotime($_GET['tgl_awal']));
$tgl_akhir = date('Y-m-d',strtotime($_GET['tgl_akhir']));
$kode = $_GET['kode'];
$bal = mysqli_query($koneksi,"select * from mstanggaran where kode='$kode'");
$balance = $bal->fetch_assoc();
$deskripsi = $balance['deskripsi'];
if(substr($kode,1,1)=='1'){
	$cgroup = 'D';
}else{
	$cgroup = 'B';
}
?>
<center>
		<a target="_blank" href="repbbanggaranxls.php?kode=<?php echo $kode;?>&tgl_awal=
												<?php echo $tgl_awal;?>&tgl_akhir=<?php echo $tgl_akhir;?>">EXPORT KE EXCEL</a>
</center>

<!DOCTYPE HTML>
<html>
<head>
	<title>Laporan Buku Besar Mata Anggaran</title>
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
	<caption><h2>BUKU BESAR MATA ANGGARAN</h2>
	<h4><?php echo '['.$kode.'] - '.$deskripsi;?></h4>
	<h4>Periode :<b><?php echo date('d-F-Y',strtotime($tgl_awal))?>&nbsp;s.d.&nbsp;<?php echo date('d-F-Y',strtotime($tgl_akhir))?></b></h4></caption>
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>No. Trx</th>
			<th>Keterangan</th>
			<th>Nilai</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
			$ntotal=0;
			if($cgroup=='D'){
				$sql=$koneksi->query("select * from jurnal where cproject='$kode' and DTGL_TRANS>='$tgl_awal' and DTGL_TRANS<='$tgl_akhir' and ctransflag='TR' and cdebkred='K' order by DTGL_TRANS,NNO_TRANS");
			}else{
				$sql=$koneksi->query("select * from jurnal where cproject='$kode' and DTGL_TRANS>='$tgl_awal' and DTGL_TRANS<='$tgl_akhir' and ctransflag='TR' and cdebkred='D' order by DTGL_TRANS,NNO_TRANS");
			}
			while($data=$sql->fetch_assoc()){
				
				$ntotal = $ntotal+$data['IDRAMOUNT'];
				
			?>	
			<tr>
				<td style="font-size:12px"><?php echo date('d-m-Y',strtotime($data['DTGL_TRANS']));?></td>
				<td style="font-size:12px" align="right"><?php echo $data['NNO_TRANS'];?></td>
				<td style="font-size:12px"><?php echo $data['CKET'];?></td>	
				<td style="font-size:12px" align="right"><?php echo number_format($data['IDRAMOUNT'],2,',','.');?></td>
					
			</tr>
			<?php
			}
			?>
			<tr>
				<td style="font-size:12px"></td>
				<td style="font-size:12px" align="right"></td>
				<td style="font-size:12px">TOTAL</td>	
				<td style="font-size:12px" align="right"><?php echo number_format($ntotal,2,',','.');?></td>
					
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
</html>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
