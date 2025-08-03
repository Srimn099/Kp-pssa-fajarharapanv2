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
header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=LAP_JURNAL_".$_GET['tgl_awal'].".xls");

include 'koneksi.php';
$cc=mysqli_query($koneksi,"select * from company");
$data=$cc->fetch_assoc();
$tgl_awal = date('Y-m-d',strtotime($_GET['tgl_awal']));
$tgl_akhir = date('Y-m-d',strtotime($_GET['tgl_akhir']));

?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Laporan Transaksi Jurnal</title>
	
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


</div>
</body>
</html>