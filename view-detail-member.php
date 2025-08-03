<div style="border:0; padding:10px; width:924px; height:auto;">
	<?php
	include "koneksi.php";
	if (isset($_GET['username'])) {
		$username = $_GET['username'];
	}
	else {
	die ("Error. No ID Selected! ");	
	}
//Tampilkan data dari tabel member
	$query = "SELECT * FROM member WHERE username='$username'";
	$sql = mysqli_query ($koneksi,$query);
	$hasil = mysqli_fetch_array ($sql);
	$username	= $hasil['username'];
	$password	= $hasil['password'];
	$nama	= $hasil['nama'];
	$nik	= $hasil['nik'];
	$dreal 	= $hasil['dreal'];
	$dduedate = $hasil['dduedate'];
	list($thn_lahir,$bln_lahir,$tgl_lahir) = explode ("-",$hasil['tgl_lahir']);
	//list($thn_realisasi,$bln_realisasi,$tgl_realisasi) = explode ("-",$hasil['dreal']);
	//list($thn_jttp,$bln_jttp,$tgl_jttp) = explode ("-",$hasil['dduedate']);
	
	$jenis_kelamin	= $hasil['jenis_kelamin'];
	$pekerjaan	= $hasil['pekerjaan'];
	$alamat		= $hasil['alamat'];
	$email		= $hasil['email'];
	$no_hp		= $hasil['no_hp'];
	$jangka		=$hasil['jangka'];
	if(!empty($hasil['simpok'])){
		$simpok = $hasil['simpok'];
	}else{
		$simpok = 0.0;
	}
	if(!empty($hasil['pinjaman'])){
		$pinjaman = $hasil['pinjaman'];
	}else{
		$pinjaman = 0.0;
	}
	if(!empty($hasil['simjib'])){
		$simjib = $hasil['simjib'];
	}else{
		$simjib = 0.0;
	}
	if(!empty($hasil['simsuka'])){
		$simsuka = $hasil['simsuka'];
	}else{
		$simsuka = 0.0;
	}
	
?>
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
			<td><b>Detail Data Anggota <u><i><?=$username?></i></u></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>No.Anggota</td>
			<td>:&nbsp;<?=$username?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nama Anggota</td>
			<td>:&nbsp;<?=$nama?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>NIK</td>
			<td>:&nbsp;<?=$nik?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Tanggal Lahir</td>
			<td>:&nbsp;<?=$tgl_lahir?>-<?=$bln_lahir?>-<?=$thn_lahir?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jenis Kelamin</td>
			<td>:&nbsp;<?=$jenis_kelamin?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Alamat</td>
			<td>:&nbsp;<?=$alamat?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nomor HP</td>
			<td>:&nbsp;<?=$no_hp?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Simpanan Pokok</td>
			<td>:&nbsp;<?=number_format($simpok,0,',','.')?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Simpanan Wajib</td>
			<td>:&nbsp;<?=number_format($simjib,0,',','.')?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Simpanan Suka Rela</td>
			<td>:&nbsp;<?=number_format($simsuka,0,',','.')?></td>
		</tr>
		
		<tr height="46">
			<td>&nbsp;</td>
			<td>Pinjaman</td>
			<td>:&nbsp;<?=number_format($pinjaman,0,',','.')?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Tanggal Realisasi</td>
			<td>:&nbsp;<?=$dreal?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Jangka Waktu (Bulan)</td>
			<td>:&nbsp;<?=number_format($jangka,0,',','.')?></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Tanggal Jatuh Tempo</td>
			<td>:&nbsp;<?=$dduedate?></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td height="32">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
<?php
//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
</div>