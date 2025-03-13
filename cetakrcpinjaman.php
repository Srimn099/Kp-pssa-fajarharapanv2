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
$username = $_POST['username'];
$member = mysqli_query($koneksi,"select * from member where username='$username'");
$mombor = $member->fetch_assoc();
$saldoawal=0;
							
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Salinan Rekening Pinjaman</title>
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
	<caption><h2>SALINAN REKENING PINJAMAN</h2></caption>
	<caption>
	No. Anggota&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp<?=$username?>&nbsp&nbsp&nbsp
	Nama&nbsp&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp<?=$mombor['nama']?>
	</caption>
	<thead>
	
			<tr>
			<th>Tanggal</th>
			<th>Keterangan</th>
			<th>Debet</th>
			<th>Kredit</th>
			<th>Saldo </th>
			
		</tr>
	</thead>
	<tbody>
		<?php
				$oke = mysqli_query($koneksi,"select * from pinjaman where username='$username'  order by tgl_transaksi");
				while($oo=$oke->fetch_assoc()){
					if($oo['dk']=='D'){
						$saldoawal = $saldoawal+$oo['pokok'];
						$cket = "PENCAIRAN";
						$debet = $oo['pokok'];
						$kredit = 0;
					}else{
						$saldoawal = $saldoawal-$oo['pokok'];
						$cket = "ANGSURAN";
						$debet = 0;
						$kredit = $oo['pokok'];
					}
			?>
		<tr>
			<td><?php echo $oo['tgl_transaksi'];?></td>
			<td><?php echo $cket;?></td>
			<td><?php echo number_format($debet,0,',','.');?></td>
			<td><?php echo number_format($kredit,0,',','.');?></td>
			<td><?php echo number_format($saldoawal,0,',','.');?></td>
		</tr>
		<?php
			}
		  mysqli_close($koneksi);
		?>
								
	</tbody>
</table>	
<br><br>

<br>
<br>


<br><br><br><br><br>
<input type="button" class="noPrint" value="Cetak" onclick="window.print()">



</div>
</body>
</html>