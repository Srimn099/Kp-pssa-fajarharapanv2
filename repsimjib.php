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
$tgl_awal = $_GET['tgl_awal'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Laporan Nominatif Simpanan Wajib</title>
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
	<caption><h2>NOMINATIF SIMPANAN WAJIB</h2></caption>
	<caption>Posisi Tanggal :<b><?php echo date('d-F-Y',strtotime($tgl_awal))?></b></caption>
	<thead>
		<tr>
			<th>No.</th>
			<th>No. Anggota</th>
			<th>Nama Anggota</th>
			<th>Saldo Simpanan</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			$sql=$koneksi->query("select * from member where simjib>0 order by username");
			$total = 0;
			while($data=$sql->fetch_assoc()){
				$total = $total+$data['simjib'];
			?>	
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo $data['username'];?></td>
				<td><?php echo $data['nama'];?></td>	
				<td align="right"><?php echo number_format($data['simjib'],0,',','.');?></td>
					
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="3" align="right"><b>TOTAL SALDO</b></td>
				<td align="right"><b><?php echo number_format($total,0,',','.');?></b></td>
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