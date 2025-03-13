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
$tgl_awal = date('Y-m-d',strtotime($tgl_awal));
$oke = mysqli_query($koneksi,"select sum(balance.nidrendbal) as saldoawal from balance,tabkira where balance.dtgl='$tgl_awal' and balance.cno_kira=tabkira.cno_kira and tabkira.kodebi in ('401','402') and tabkira.cno_kira not in (select cacctparent from tabkira)");
$asetbersih = $oke->fetch_assoc();
$saldoawalaset = $asetbersih['saldoawal'];
?>
<center>
		<a target="_blank" href="replabarugixls.php?tgl_awal=
												<?php echo $tgl_awal;?>">EXPORT KE EXCEL</a>
</center>

<!DOCTYPE HTML>
<html>
<head>
	<title>Laporan Aktivitas</title>
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
	<caption><h2>LAPORAN AKTIVITAS</h2>
	<h4>Posisi Tanggal :<b><?php echo date('d-F-Y',strtotime($tgl_awal))?></b></h4></caption>
	<thead>
		<tr>
			<th>No. Perkiraan</th>
			<th>Nama Perkiraan</th>
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3"><b>PENDAPATAN DAN SUMBANGAN</b></td>
		</tr>
		<?php
			$no=1;
			$sql=$koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='D' and balance.NIDRENDBAL<>0 order by tabkira.CNO_KIRA");
			$pendapatan =0 ;
			while($data=$sql->fetch_assoc()){
				if($data['NLEVEL']==1){
						$pendapatan = $pendapatan+$data['NIDRENDBAL'];
				}
		?>	
			<tr>
				<td><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}	
					echo $data['CNO_KIRA'];
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				</td>
				<td><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}
					echo $data['CNAMA_KIRA'];
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				
				
				
				</td>
					
				<td align="right"><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}
				
					echo number_format($data['NIDRENDBAL'],0,',','.');
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="2"><b>TOTAL PENDAPATAN DAN SUMBANGAN</b></td>
				<td align="right"><b><?php echo number_format($pendapatan,0,',','.');?></b></td>
			</tr>
	</tbody>
	
<br><br>
	<thead>
		<tr>
			<th>No. Perkiraan</th>
			<th>Nama Perkiraan</th>
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3"><b>BEBAN DAN PROGRAM</b></td>
		</tr>
		<?php
			$no=1;
			
			$sql=$koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='B' and balance.NIDRENDBAL<>0 order by tabkira.CNO_KIRA");
			$biaya =0 ;
			while($data=$sql->fetch_assoc()){
				if($data['NLEVEL']==1){
						$biaya = $biaya+$data['NIDRENDBAL'];
				}
		?>	
			<tr>
				<td><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}	
					echo $data['CNO_KIRA'];
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				</td>
				<td><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}
					echo $data['CNAMA_KIRA'];
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				
				
				
				</td>
					
				<td align="right"><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}
				
					echo number_format($data['NIDRENDBAL'],0,',','.');
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="2"><b>TOTAL BEBAN DAN PROGRAM</b></td>
				<td align="right"><b><?php echo number_format($biaya,0,',','.');?></b></td>
			</tr>
			<tr>
				<td colspan="2"><b>KENAIKAN/PENURUNAN ASET BERSIH</b></td>
				<td align="right"><b><?php echo number_format($pendapatan-$biaya,0,',','.');?></b></td>
			</tr>
			<tr>
				<td colspan="2"><b>ASET BERSIH - AWAL</b></td>
				<td align="right"><b><?php echo number_format($saldoawalaset,0,',','.');?></b></td>
			</tr>
			<tr>
				<td colspan="2"><b>ASET BERSIH - AKHIR</b></td>
				<td align="right"><b><?php echo number_format($saldoawalaset+$pendapatan-$biaya,0,',','.');?></b></td>
			</tr>
			
	</tbody>

	


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