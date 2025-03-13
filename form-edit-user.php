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
	$query = "SELECT * FROM login WHERE username='$username'";
	$sql = mysqli_query($koneksi,$query);
	$hasil = mysqli_fetch_array ($sql);
	$username	= $hasil['username'];
	$nama	= $hasil['nama'];
	$hak_akses	= $hasil['hak_akses'];
	
?>
<form action="home-admin.php?page=edit-user" method="POST" name="form-edit-user" enctype="multipart/form-data">
	<input type="button" value="Kembali" onclick=location.href="home-admin.php?page=form-view-user" title="Kembali">
	<table width="860" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr bgcolor="#DFE6EF" height="30">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><b>Edit Data User <u><i><?=$username?></i></u></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Username</td>
			<td>:&nbsp;<?=$username?><input type="hidden" name="username" value="<?=$username?>"></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nama User</td>
			<td>:&nbsp;<input type="text" name="nama" size="50" value="<?=$nama?>"></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Hak Akses</td>
			<td>:&nbsp;
				<select name="hak_akses" >		
					<option value="Admin" <?php if($hak_akses=='Admin') echo "selected";?>>Administrator</option>
					<option value="Member" <?php if($hak_akses=='Member') echo "selected";?>>Operator</option>
				</select>

			
			</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Input">&nbsp;&nbsp;&nbsp;
				<input type="reset" name="reset" value="Reset"></td>
		</tr>
		
	</table>
</form>
<?php
//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
</div>