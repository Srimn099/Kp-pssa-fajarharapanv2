<script>
function Jumlah1(){
    
var kwjbpokok = document.getElementById('kwjbpokok').value;
var kwjbjasa = document.getElementById('kwjbjasa').value;
var jmlbayar = document.getElementById('jml_bayar').value;

var totkwjb = parseInt(kwjbpokok) + parseInt(kwjbjasa);
var byrpokok = parseInt(kwjbpokok)/totkwjb*parseInt(jmlbayar);
var byrjasa = totkwjb - byrpokok;
if(byrjasa<0){
	var byrjasa = parseInt(jmlbayar)-byrpokok;
}
if(!isNaN(byrpokok)){
    document.getElementById('byrpokok').value = byrpokok;
	document.getElementById('byrjasa').value = byrjasa;
}	

}
</script>

<script>
function Jumlah2(){
    
var jml_bayar = document.getElementById('jml_bayar').value;
var byrpokok = document.getElementById('byrpokok').value;

var byrjasa = parseInt(jml_bayar) - parseInt(byrpokok);

if(!isNaN(byrjasa)){
    document.getElementById('byrjasa').value = byrjasa;
}	

}
</script>


<div style="border:0; padding:10px; width:924px; height:auto;">
	<?php
	date_default_timezone_set('Asia/Jakarta');
//$koneksi = mysqli_connect("localhost","root",
$date=date('Y-m-d');
$tahun = date('Y',strtotime($date));
$bulan = date('m',strtotime($date));
$periode = $tahun.$bulan;
//echo "<script type='text/javascript'>alert('$periode');</script>";
	
		include "koneksi.php";
		if (isset($_GET['username'])) {
			$username = $_GET['username'];
			$query   = "SELECT * FROM member WHERE username='$username'";
			$hasil   = mysqli_query($koneksi,$query);
			$data    = mysqli_fetch_array($hasil);
			$username	= $data['username'];
			$nama	= $data['nama'];
			$saldo = $data['pinjaman'];
			$tanya1 = mysqli_query($koneksi,"select sum(pokok-angpokok) as wajibpokok from detangsur where username='$username' and extract(year_month from dtgl)<='$periode'");
			
			$tonya1 = $tanya1->fetch_assoc();
			
			$wajibpokok = $tonya1['wajibpokok'];
			
			$tanya2 = mysqli_query($koneksi,"select sum(jasa-angjasa) as wajibjasa from detangsur where username='$username' and extract(year_month from dtgl)<='$periode'");
			
			$tonya2 = $tanya2->fetch_assoc();
			
			$wajibjasa = $tonya2['wajibjasa'];
			
		}
		else {
			die ("Error. Tidak ada USERNAME yang dipilih Silakan cek kembali! ");	
		}
	?>
<form action="home-admin.php?page=input-bayar" method="POST" name="form-input-bayar">
	<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr height="46">
				<td width="10%">&nbsp;</td>
				<td width="25%">&nbsp;</td>
				<td width="65%"><font color="orange" size="2"><b>Form Input Angsuran Pinjaman</b></font></td>
			</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="25%"><input type="button" value="Cancel" onclick=location.href="home-admin.php?page=list-pinjaman" title="Cancel"><br /><br /></td>
			<td width="65%">&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nomor Anggota</td>
			<td><input name="username" type="text" size="25" value="<?=$username?>" disabled="disabled" />
				<input name="username" type="hidden" size="25" value="<?=$username?>" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nama</td>
			<td><input name="nama" type="text" size="25" value="<?=$nama?>" disabled="disabled" />
				<input name="nama" type="hidden" value="<?=$nama?>" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Saldo Pinjaman</td>
			<td><input type="number" value="<?=$saldo?>" name="saldo" size="25" maxlength="10" disabled="disabled" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Kewajiban Bayar Sampai Bulan Ini (Pokok)</td>
			<td><input type="number" id="kwjbpokok" name="kwjbpokok" value="<?=$wajibpokok?>" size="25" maxlength="10" disabled="disabled" /></td>
			</tr
		<tr height="46">
			<td>&nbsp;</td>
			<td>Kewajiban Bayar Sampai Bulan Ini (Jasa)</td>
			<td><input type="number" id="kwjbjasa" name="kwjbjasa" value="<?=$wajibjasa?>" size="25" maxlength="10" disabled="disabled" /></td>
		</tr
		</tr>
		
		<tr height="46">
			<td>&nbsp;</td>
			<td>Tanggal Transaksi</td>
			<td><input type="date" value="<?=$date?>" name="tgl_bayar" size="25" maxlength="10" /></td>
		</tr>
		
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jumlah Bayar</td>
			<td><input type="number" id="jml_bayar"   name="jml_bayar" size="25" maxlength="10" onkeyup="Jumlah1();" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jumlah Bayar Pokok</td>
			<td><input type="number" id="byrpokok"  name="byrpokok" size="25" maxlength="10" onkeyup="Jumlah2();" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jumlah Bayar Jasa</td>
			<td><input type="number" id="byrjasa"  name="byrjasa" size="25" maxlength="10" disabled="disabled" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Bayar">&nbsp;&nbsp;&nbsp;
				<input type="reset" name="reset" value="Reset"></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
</div>