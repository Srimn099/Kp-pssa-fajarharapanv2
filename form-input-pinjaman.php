<script>
function Jumlah(){
    
var lama = document.getElementById('lama').value;
var baru = document.getElementById('baru').value;
var rslt = parseInt(lama) + parseInt(baru);
if(!isNaN(rslt)){
    document.getElementById('total').value = rslt;
}

}
</script>


<div style="border:0; padding:10px; width:924px; height:auto;">
	<?php
	date_default_timezone_set('Asia/Jakarta');
//$koneksi = mysqli_connect("localhost","root",
$date=date('Y-m-d');
$jangka = 12;
$nextday = date("Y-m-d", strtotime($date. "+$jangka month"));
	//echo "<script type='text/javascript'>alert('$nextday');</script>";

		include "koneksi.php";
		if (isset($_GET['username'])) {
			$username = $_GET['username'];
			$query   = "SELECT * FROM member WHERE username='$username'";
			$hasil   = mysqli_query($koneksi,$query);
			$data    = mysqli_fetch_array($hasil);
			$username	= $data['username'];
			$nama	= $data['nama'];
			$pinjaman = $data['pinjaman'];
			$query1	=	"select sum(jasa-angjasa) as tjasa from detangsur where username='$username'";
			$husal = mysqli_query($koneksi,$query1);
			$duta = mysqli_fetch_array($husal);
			$tjasa = $duta['tjasa'];
		}
		else {
			die ("Error. Tidak ada Anggota yang dipilih Silakan cek kembali! ");	
		}
	?>
<form action="home-admin.php?page=input-pinjaman" method="POST" name="form-input-pinjaman">
	<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr height="46">
				<td width="10%">&nbsp;</td>
				<td width="25%">&nbsp;</td>
				<td width="65%"><font color="orange" size="2"><b>Form Input Pinjaman (Baru/Topup)</b></font></td>
			</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="25%"><input type="button" value="Cancel" onclick=location.href="home-admin.php?page=list-pinjaman" title="Cancel"><br /><br /></td>
			<td width="65%">&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>No. Anggota</td>
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
			<td>Saldo Pinjaman Lama</td>
			<td><input type="number" id="lama" name="saldo_lama" size="25" maxlength="10" value="<?=$pinjaman?>"/></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Tanggal Transaksi</td>
			<td><input type="date" value="<?=$date?>" name="tgl_pinjaman" size="25" maxlength="10" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jumlah Pinjaman Baru</td>
			<td><input id="baru" type="number" name="jml_transaksi" size="25" maxlength="10" onkeyup="Jumlah();" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Saldo Pinjaman Total</td>
			<td><input id="total" type="number" name="saldo_total" size="25" maxlength="10"  /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jangka Waktu (Bulan)</td>
			<td><input type="number" name="jangka" size="25" maxlength="10" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>tunggakan Jasa Pinjaman Sebelumnya</td>
			<td><input type="number" name="tjasa" value="<?php echo $tjasa;?>" size="25" maxlength="10" readonly  /></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Pinjam">&nbsp;&nbsp;&nbsp;
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