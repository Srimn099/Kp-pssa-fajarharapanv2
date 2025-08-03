<div style="border:0; padding:10px; width:924px; height:auto;">
	<?php
date_default_timezone_set('Asia/Jakarta');
//$koneksi = mysqli_connect("localhost","root",
$date=date('Y-m-d');

		include "koneksi.php";
		if (isset($_GET['username'])) {
			$username = $_GET['username'];
			$query   = "SELECT * FROM member WHERE username='$username'";
			$hasil   = mysqli_query($koneksi,$query);
			$data    = mysqli_fetch_array($hasil);
			$username	= $data['username'];
			$nama	= $data['nama'];
		}
		else {
			die ("Error. Tidak ada Anggota yang dipilih Silakan cek kembali! ");	
		}
	?>
<form action="home-admin.php?page=ambil-tabungan" method="POST" name="form-ambil-tabungan">
	<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr height="46">
				<td width="10%">&nbsp;</td>
				<td width="25%">&nbsp;</td>
				<td width="65%"><font color="orange" size="2"><b>Form Penarikan Simpanan</b></font></td>
			</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="25%"><input type="button" value="Cancel" onclick=location.href="home-admin.php?page=list-tabungan" title="Cancel"><br /><br /></td>
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
			<td>Jenis Simpanan</td>
			<td>
			<select  name="jenis">
															<option value="P">Simpanan Pokok</option>
															<option value="W">Simpanan Wajib</option>
															<option value="S">Simpanan Manasuka</option>
			</select>
			</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Tanggal Transaksi</td>
			<td><input type="date" value="<?=$date?>" name="tgl_tabungan" size="25" maxlength="10" /></td>
			<!--<td><select name="tgl_tabungan">-->
				<?php
					/*for ($i=1; $i<=31; $i++) {
						$tg = ($i<10) ? "0$i" : $i;
						echo "<option value='$tg'>$tg</option>";	
					}*/
				?>
				<!--</select> -
				<select name="bln_tabungan">-->
				<?php
					/*for($bln=1;$bln<=12;$bln++){
						$nama_bln = array (1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Des");
						echo "<option value=$bln>$nama_bln[$bln]</option>";
					}*/
				?>
				<!--</select> - 
				<select name="thn_tabungan">-->
				<?php
					/*for ($i=2015; $i<=2100; $i++) {
						echo "<option value='$i'>$i</option>";	
					}*/
				?>
				<!--</select>-->
			<!--</td>-->
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nilai Penarikan</td>
			<td><input type="number" name="jml_tabungan" size="25" maxlength="10" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Tarik">&nbsp;&nbsp;&nbsp;
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