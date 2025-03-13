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
$cno_kira = $_GET['cno_kira'];
$bal = mysqli_query($koneksi,"select balance.NIDRBEGBAL,tabkira.CNAMA_KIRA,tabkira.CGROUP from balance,tabkira where balance.CNO_KIRA=tabkira.CNO_KIRA and balance.DTGL='$tgl_awal' and balance.CNO_KIRA='$cno_kira'");
$balance = $bal->fetch_assoc();
$nsaldo = $balance['NIDRBEGBAL'];
$cnama_kira = $balance['CNAMA_KIRA'];
$cgroup = $balance['CGROUP'];
if($cgroup=='A' || $cgroup=='B'){
	$ndebet = $nsaldo;
	$nkredit = 0;
}else{
	$nkredit= $nsaldo;
	$ndebet = 0;
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Laporan Buku Besar</title>
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
	<caption><h2>BUKU BESAR</h2>
	<h4><?php echo $cnama_kira;?></h4>
	<h4>Periode :<b><?php echo date('d-F-Y',strtotime($tgl_awal))?>&nbsp;s.d.&nbsp;<?php echo date('d-F-Y',strtotime($tgl_akhir))?></b></h4></caption>
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>No. Trx</th>
			<th>Keterangan</th>
			<th>Debet</th>
			<th>Kredit</th>
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
		<tr>
				<td style="font-size:12px"><?php echo date('d-m-Y',strtotime($tgl_awal));?></td>
				<td style="font-size:12px" align="right">0</td>
				<td style="font-size:12px">SALDO AWAL</td>	
				<td style="font-size:12px" align="right"><?php echo number_format($ndebet,2,',','.');?></td>
				<td style="font-size:12px" align="right"><?php echo number_format($nkredit,2,',','.');?></td>
				<td style="font-size:12px" align="right"><?php echo number_format($nsaldo,2,',','.');?></td>
		</tr>
		<?php
			$ntotdebet=0;
			$ntotkredit=0;
			$sql=$koneksi->query("select * from jurnal where CNO_KIRA='$cno_kira' and DTGL_TRANS>='$tgl_awal' and DTGL_TRANS<='$tgl_akhir' order by DTGL_TRANS,NNO_TRANS");
			while($data=$sql->fetch_assoc()){
				if($data['CDEBKRED']=='D'){
					if($cgroup=='A' || $cgroup=='B'){
						$nsaldo = $nsaldo+$data['IDRAMOUNT'];
					}else{
						$nsaldo = $nsaldo-$data['IDRAMOUNT'];
					}
					$ndebet=$data['IDRAMOUNT'];
					$nkredit=0;
				}else{
					if($cgroup=='S' || $cgroup=='D'){
						$nsaldo = $nsaldo+$data['IDRAMOUNT'];
					}else{
						$nsaldo = $nsaldo-$data['IDRAMOUNT'];
					}
					$nkredit=$data['IDRAMOUNT'];
					$ndebet = 0;
				}
				$ntotdebet = $ntotdebet+$ndebet;
				$ntotkredit = $ntotkredit+$nkredit;
			?>	
			<tr>
				<td style="font-size:12px"><?php echo date('d-m-Y',strtotime($data['DTGL_TRANS']));?></td>
				<td style="font-size:12px" align="right"><?php echo $data['NNO_TRANS'];?></td>
				<td style="font-size:12px"><?php echo $data['CKET'];?></td>	
				<td style="font-size:12px" align="right"><?php echo number_format($ndebet,2,',','.');?></td>
				<td style="font-size:12px" align="right"><?php echo number_format($nkredit,2,',','.');?></td>
				<td style="font-size:12px" align="right"><?php echo number_format($nsaldo,2,',','.');?></td>
					
			</tr>
			<?php
			}
			?>
			<tr>
				<td style="font-size:12px"></td>
				<td style="font-size:12px" align="right"></td>
				<td style="font-size:12px">TOTAL</td>	
				<td style="font-size:12px" align="right"><?php echo number_format($ntotdebet,2,',','.');?></td>
				<td style="font-size:12px" align="right"><?php echo number_format($ntotkredit,2,',','.');?></td>
				<td style="font-size:12px" align="right"><?php echo number_format($nsaldo,2,',','.');?></td>
					
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