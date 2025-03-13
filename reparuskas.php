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
$tahun = date('Y',strtotime($tgl_awal));
$buat = mysqli_query($koneksi,"create view vw_uki as select dtgl_trans,nno_trans from jurnal where extract(year from dtgl_trans)='$tahun' and dtgl_trans<='$tgl_awal' and ctransflag='tr' and cno_kira in (select cno_kira from tabkira where KODEBI='100')");
$ops = mysqli_query($koneksi,"select jurnal.cno_kira,tabkira.cnama_kira,sum(if(jurnal.cdebkred='D',jurnal.idramount,0)) as debet,sum(if(jurnal.cdebkred='K',jurnal.idramount,0)) as kredit from jurnal,tabkira,vw_uki where jurnal.dtgl_trans=vw_uki.dtgl_trans and jurnal.nno_trans=vw_uki.nno_trans and jurnal.cno_kira=tabkira.cno_kira and jurnal.ctransflag='tr' and tabkira.kodebi in ('301','302','501','502','601','602') group by jurnal.cno_kira");
$aktops = $ops->fetch_assoc();
$invest = mysqli_query($koneksi,"select jurnal.cno_kira,tabkira.cnama_kira,sum(if(jurnal.cdebkred='D',jurnal.idramount,0)) as debet,sum(if(jurnal.cdebkred='K',jurnal.idramount,0)) as kredit from jurnal,tabkira,vw_uki where jurnal.dtgl_trans=vw_uki.dtgl_trans and jurnal.nno_trans=vw_uki.nno_trans and jurnal.cno_kira=tabkira.cno_kira and jurnal.ctransflag='tr' and tabkira.kodebi in ('200') group by jurnal.cno_kira");
$aktinvest = $invest->fetch_assoc();
$hapus =mysqli_query($koneksi,"drop view vw_uki");
$ss=mysqli_query($koneksi,"select sum(nidrendbal) as nidrendbal from balance,tabkira where balance.dtgl='$tgl_awal' and balance.cno_kira=tabkira.cno_kira and tabkira.kodebi='100' and tabkira.cno_kira not in (select cacctparent from tabkira)");
$ss_akhir = $ss->fetch_assoc();
$saldoakhir=$ss_akhir['nidrendbal'];
?>
<center>
		<a target="_blank" href="reparuskasxls.php?tgl_awal=
												<?php echo $tgl_awal;?>">EXPORT KE EXCEL</a>
</center>

<!DOCTYPE HTML>
<html>
<head>
	<title>Laporan ARUS KAS</title>
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
	<caption><h2>LAPORAN ARUS KAS</h2>
	<h4>Posisi Tanggal :<b><?php echo date('d-F-Y',strtotime($tgl_awal))?></b></h4></caption>
	<thead>
		<tr>
			<th>DESKRIPSI</th>
			<th>Debet</th>
			<th>Kredit</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3"><b>AKTIVITAS OPERASIONAL</b></td>
		</tr>
		<?php
			$no=1;
			$selisih =0 ;
			while($data=$ops->fetch_assoc()){
						$selisih = $selisih+$data['kredit']-$data['debet'];
		?>	
			<tr>
				<td><?php 
						
					echo $data['cnama_kira'];
					
					?>
				</td>
				<td align="right"><?php 
					
					echo number_format($data['kredit'],0,',','.');
					
					?>
				
				
				
				</td>
					
				<td align="right"><?php 
					
				
					echo number_format($data['debet'],0,',','.');
					
					?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td ><b>KENAIKAN/PENURUNAN KAS DARI AKTIVITAS OPERASIONAL</b></td>
				<td align="right"><b><?php if($selisih>=0) echo number_format($selisih,0,',','.');?></b></td>
				<td align="right"><b><?php if($selisih<0) echo number_format(abs($selisih),0,',','.');?></b></td>
			</tr>

		<tr>
			<td colspan="3"><b>AKTIVITAS INVESTASI</b></td>
		</tr>
		<?php
			$no=1;
			$selisih1 =0 ;

			while($data=$invest->fetch_assoc()){
						$selisih = $selisih+$data['kredit']-$data['debet'];
						$selisih1 = $selisih1+$data['kredit']-$data['debet'];
		?>	
			<tr>
				<td><?php 
						
					echo $data['cnama_kira'];
					
					?>
				</td>
				<td align="right"><?php 
					
					echo number_format($data['kredit'],0,',','.');
					
					?>
				
				
				
				</td>
					
				<td align="right"><?php 
					
				
					echo number_format($data['debet'],0,',','.');
					
					?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td ><b>KENAIKAN/PENURUNAN KAS DARI AKTIVITAS INVESTASI</b></td>
				<td align="right"><b><?php if($selisih1>=0) echo number_format($selisih1,0,',','.');?></b></td>
				<td align="right"><b><?php if($selisih1<0) echo number_format(abs($selisih1),0,',','.');?></b></td>
			</tr>
			<tr>
				<td ><b>KENAIKAN/PENURUNAN KAS DARI AKTIVITAS BERSIH</b></td>
				<td align="right"><b><?php if($selisih>=0) echo number_format($selisih,0,',','.');?></b></td>
				<td align="right"><b><?php if($selisih<0) echo number_format(abs($selisih),0,',','.');?></b></td>
			</tr>
			<tr>
				<td ><b>KAS DAN BANK - SALDO AWAL</b></td>
				<td align="right"><b><?php if($saldoakhir-$selisih>=0) echo number_format($saldoakhir-$selisih,0,',','.');?></b></td>
				<td align="right"><b><?php if($saldoakhir-$selisih<0) echo number_format(abs($saldoakhir-$selisih),0,',','.');?></b></td>
			</tr>
			<tr>
				<td ><b>KAS DAN BANK - SALDO AKHIR</b></td>
				<td align="right"><b><?php if($saldoakhir>=0) echo number_format($saldoakhir,0,',','.');?></b></td>
				<td align="right"><b><?php if($saldoakhir<0) echo number_format(abs($saldoakhir),0,',','.');?></b></td>
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