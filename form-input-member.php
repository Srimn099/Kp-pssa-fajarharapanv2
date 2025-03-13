<?php
date_default_timezone_set('Asia/Jakarta');
$date=date('Y-m-d');
?>
<div style="border:0; padding:10px; width:924px; height:auto;">
<form action="home-admin.php?page=input-member" method="POST" name="form-input-member">
	<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr height="46">
				<td width="10%">&nbsp;</td>
				<td width="25%">&nbsp;</td>
				<td width="65%"><font color="orange" size="2"><b>Form Input Anggota</b></font></td>
			</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="25%"><input type="button" value="Cancel" onclick=location.href="home-admin.php?page=form-view-member" title="Cancel"><br /><br /></td>
			<td width="65%">&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nama</td>
			<td><input type="text" name="nama" size="50" maxlength="45" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>NIK</td>
			<td><input type="text" name="nik" size="25" maxlength="20" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Tanggal Lahir</td>
			<td><input type="date" name="tgl_lahir" size="25" value="<?=$date?>" maxlength="20" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jenis Kelamin</td>
			<td><input type="radio" name="jenis_kelamin" value="L" checked> Laki-laki
				<input type="radio" name="jenis_kelamin" value="P"> Perempuan</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Alamat</td>
			<td><input type="text" name="alamat" size="50" maxlength="80" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nomor HP</td>
			<td><input type="text" name="no_hp" size="25" maxlength="12" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Input">&nbsp;&nbsp;&nbsp;
				<input type="reset" name="reset" value="Reset"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
</div>