<?php
date_default_timezone_set('Asia/Jakarta');
//$koneksi = mysqli_connect("localhost","root",

include 'koneksi.php';
include 'functions.php';
$cno_bukti=$_GET['cno_bukti'];
//$tanggal=$_GET['tgl'];
$nama = $_GET['nama'];
$alamat = $_GET['alamat'];
$nominal = $_GET['nominal'];
$jenis = $_GET['jenis'];
$tanggal = $_GET['tanggal'];
$terbilang = konversiangka(strval($nominal)).' Rupiah';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Cetak Kwitansi</title>
	<link rel="icon" type="image/x-icon" href="../../images/favicon.ico">
	<style>
		@media print{
			input.noPrint{
				display: none;
			}
		}
	</style>
</head>
<body>
<img src="image/kopsurat.png" width="50%" height="17.5%"/>
</div>
<table width="50%">
	<td width="40%"><h4>SUDAH TERIMA</h4></td>
	<td width="40%"></td>
	<td width="20%"><h4>No.&nbsp&nbsp:<?php echo $cno_bukti?></h4></td>
	
</table>
<table width="50%">
	<td width="30%">Dari Yth.&nbsp&nbsp:</td>
	<td width="70%"><?php echo $nama?></td>
</table>
<table width="50%">
	<td width="30%">Alamat&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
	<td width="70%"><?php echo $alamat?></td>
	
</table>
<table width="50%">
	<td width="30%">Rp.&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
	<td width="70%" ><?php echo number_format($nominal,0,',','.')?>&nbsp(<?php echo $terbilang?>)</td>
</table>

<table width="50%">
	<td width="100%">Sebagai&nbsp<?php echo $jenis?></td>
</table>

<table width="50%">
	<td width="100%">Semoga Allah membalas segala kebajikan Ibu, Bapak, Saudara dengan yang lebih baik dan lebih banyak. Aamien.</td>
</table>
<table width="50%">
	<td width="100%">Nasrun Minallah Wa Fathun Qarieb</td>
</table>
<table width="50%">
	<td width="100%">Wasalamu'alaikum warahmatullahi wabarakatuh</td>
</table>
<table width="50%">
	<td width="30%"></td>
	<td width="30%"></td>
	<td width="40%" align="center">Bandung,&nbsp<?php echo date('d-F-Y',strtotime($tanggal))?></td>
</table>
<table width="50%">
	<td width="30%"></td>
	<td width="30%"></td>
	<td width="40%" align="center">Yang Menerima</td>
</table>
<br><br><br><br><br>
<table width="50%">
	<td width="30%"></td>
	<td width="30%"></td>
	<td width="40%" align="center">(..................................)</td>
</table>
<br><br><br><br><br>
<input type="button" class="noPrint" value="Cetak" onclick="window.print()">




</body>
</html>