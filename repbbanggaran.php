<?php
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