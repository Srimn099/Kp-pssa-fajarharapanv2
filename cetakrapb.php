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