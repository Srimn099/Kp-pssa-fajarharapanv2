<head>
  <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<!--<div style="border:0; padding:10px; width:924spx; height:auto;"><br />-->
<center><font color="orange" size="2"><b>View Data Anggota</b></font></center><br />
<input type="button" value="Tambah Anggota" onclick=location.href="home-admin.php?page=form-input-member" title="Add Member"><br /><br />
<div class="body">
<div class="table-responsive">
<table id="tabel-data1" class="table table-bordered table-striped table-hover js-basic-example dataTable" >
<thead>
<tr bgcolor="#FF6600">
	<th width="5%">No</td>&nbsp;
	<th width="15%" height="42">NO. ANGGOTA</td>&nbsp;
	<th width="28%">NAMA</td>&nbsp;
	<th width="15%">NIK</td>&nbsp;
	<th width="20%">NO HP</td>&nbsp;
	<th width="17%">Action</td>&nbsp;     
</tr>
</thead>
<tbody>
<?php
	include "koneksi.php";
	$Cari="SELECT * FROM member";
	$Tampil = mysqli_query($koneksi,$Cari);
	$nomer=0;
    while (	$hasil = mysqli_fetch_array ($Tampil)) {
			$username= stripslashes ($hasil['username']);
			$nama 	= stripslashes ($hasil['nama']);
			$nik 	= stripslashes ($hasil['nik']);
			$no_hp	= stripslashes ($hasil['no_hp']);
		{
	$nomer++;
?>
	<tr align="center">
		<td height="32"><?=$nomer?><div align="center"></div></td>
		<td><?=$username?><div align="center"></div></td>
		<td><?=$nama?><div align="center"></div></td>
		<td><?=$nik?><div align="center"></div></td>
		<td><?=$no_hp?><div align="center"></div></td>
		<td bgcolor="#EEF2F7"><div align="center"><a href="home-admin.php?page=view-detail-member&username=<?=$username?>">Detail</a> | <a href="home-admin.php?page=form-edit-member&username=<?=$username?>">Edit</a> | <a href="home-admin.php?page=hapus-member&username=<?=$username?>">Hapus</a></div></td>
	</tr>
	<?php  
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
								 <script>
    $(document).ready(function(){
        $('#tabel-data1').DataTable();
    });
</script>
</tbody>
</table>
</div>
</div>
<!--</div>-->