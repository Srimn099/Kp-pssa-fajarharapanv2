<?php
date_default_timezone_set('Asia/Jakarta');
$date=date('Y-m-d');
?>
<div style="border:0; padding:10px; width:924px; height:auto;">
<form action="home-admin.php?page=input-user" method="POST" name="form-input-user">
	<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr height="46">
				<td width="10%">&nbsp;</td>
				<td width="25%">&nbsp;</td>
				<td width="65%"><font color="orange" size="2"><b>Form Input user</b></font></td>
			</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="25%"><input type="button" value="Cancel" onclick=location.href="home-admin.php?page=form-view-user" title="Cancel"><br /><br /></td>
			<td width="65%">&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Username</td>
			<td><input type="text" name="username" size="25" maxlength="25" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nama</td>
			<td><input type="text" name="nama" size="50" maxlength="50" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Hak Akses</td>
			<td>
				<select name="hak_akses" >		
					<option value="Admin">Administrator</option>
					<option value="Member">Operator</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Simpan">&nbsp;&nbsp;&nbsp;
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