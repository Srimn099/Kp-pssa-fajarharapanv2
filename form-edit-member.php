<div style="border:0; padding:10px; width:924px; height:auto;">
	<?php
	include "koneksi.php";
	if (isset($_GET['username'])) {
		$username = $_GET['username'];
	}
	else {
	die ("Error. No USERNAME Selected! ");	
	}
//Tampilkan data dari tabel member
	$query = "SELECT * FROM member WHERE username='$username'";
	$sql = mysqli_query($koneksi,$query);
	$hasil = mysqli_fetch_array ($sql);
	$username	= $hasil['username'];
	$nama	= $hasil['nama'];
	$nik	= $hasil['nik'];
	list($thn_lahir,$bln_lahir,$tgl_lahir) = explode ("-",$hasil['tgl_lahir']);
	$jenis_kelamin	= $hasil['jenis_kelamin'];
	$pekerjaan	= $hasil['pekerjaan'];
	$alamat		= $hasil['alamat'];
	$email		= $hasil['email'];
	$no_hp		= $hasil['no_hp'];
	$simpok		= $hasil['simpok'];
	$simjib		= $hasil['simjib'];
	$simsuka		= $hasil['simsuka'];
	$pinjaman		= $hasil['pinjaman'];
?>
<form action="#" method="POST" name="form-edit-member" enctype="multipart/form-data">
	<input type="button" value="Kembali" onclick=location.href="home-admin.php?page=form-view-member" title="Kembali">
	<table width="860" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr bgcolor="#DFE6EF" height="30">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><b>Edit Data Anggota <u><i><?=$username?></i></u></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>No. Anggota</td>
			<td>:&nbsp;<?=$username?><input type="hidden" name="husername" value="<?=$username?>"></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nama Anggota</td>
			<td>:&nbsp;<input type="text" name="nama" size="50" value="<?=$nama?>"></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>NIK</td>
			<td>:&nbsp;<input type="text" name="nik" size="40" value="<?=$nik?>"></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Tanggal Lahir</td>
			<td>:&nbsp;<select name="tgl_lahir">
			<?php
				for ($i=1; $i<=31; $i++) {
					$tg = ($i<10) ? "0$i" : $i;
					$sele = ($tg==$tgl_lahir)? "selected" : "";
					echo "<option value='$tg' $sele>$tg</option>";	
				}
			?>
				</select> - 
				<select name="bln_lahir">
			<?php
				for ($i=1; $i<=12; $i++) {
					$bl = ($i<10) ? "0$i" : $i;
					$sele = ($bl==$bln_lahir)?"selected" : "";
					echo "<option value='$bl' $sele>$bl</option>";	
				}
			?>
				</select> -
				<select name="thn_lahir">
			<?php
				for ($i=1920; $i<=2020; $i++) {
					$th = ($i<1945) ? "0000" : $i;
					$sele = ($i==$thn_lahir)?"selected" : "";
					echo "<option value='$th' $sele>$th</option>";	
				}
			?>
				</select></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jenis Kelamin</td>
			<td>:&nbsp;<input type="radio" name="jenis_kelamin" value="L" <?php echo ($jenis_kelamin=='L')?"checked":""; ?>> Laki-laki &nbsp;&nbsp;
				<input type="radio" name="jenis_kelamin" value="P" <?php echo ($jenis_kelamin=='P')?"checked":""; ?>> Perempuan</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Alamat</td>
			<td>:&nbsp;<input type="text" name="alamat" size="70" value="<?=$alamat?>" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nomor HP</td>
			<td>:&nbsp;<input type="text" name="no_hp" size="25" value="<?=$no_hp?>" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Simpanan Pokok</td>
			<td>:&nbsp;<input type="text" name="simpok" size="25" maxlength="20" value="<?=$simpok?>" readonly /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Simpanan Wajib</td>
			<td>:&nbsp;<input type="text" name="simjib" size="25" maxlength="20" value="<?=$simjib?>" readonly /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Simpanan Suka Rela</td>
			<td>:&nbsp;<input type="text" name="simsuka" size="25" maxlength="20" value="<?=$simsuka?>" readonly /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Pinjaman</td>
			<td>:&nbsp;<input type="text" name="pinjaman" size="40" maxlength="35" value="<?=$pinjaman?>"  readonly/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td height="20">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
<?php
//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
</div>