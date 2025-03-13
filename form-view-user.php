<head>
  <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<!--<div style="border:0; padding:10px; width:924spx; height:auto;"><br />-->
<center><font color="orange" size="2"><b>View Data User</b></font></center><br />
<input type="button" value="Tambah User" onclick=location.href="home-admin.php?page=form-input-user" title="Add User"><br /><br />
<div class="body">
<div class="table-responsive">
<table id="tabel-data1" class="table table-bordered table-striped table-hover js-basic-example dataTable" >
<thead>
<tr bgcolor="#FF6600">
	<th width="5%">No</td>&nbsp;
	<th width="25%" height="42">username</td>&nbsp;
	<th width="45%">NAMA</td>&nbsp;
	<th width="10%">Hak Akses</td>&nbsp;
	<th width="15%">Action</td>&nbsp;     
</tr>
</thead>
<tbody>
<?php
	include "koneksi.php";
	$Cari="SELECT * FROM login";
	$Tampil = mysqli_query($koneksi,$Cari);
	$nomer=0;
    while (	$hasil = mysqli_fetch_array ($Tampil)) {
			$username= stripslashes ($hasil['username']);
			$nama 	= stripslashes ($hasil['nama']);
			$hak_akses 	= stripslashes ($hasil['hak_akses']);
			
		{
	$nomer++;
?>
	<tr align="center">
		<td height="32"><?=$nomer?><div align="center"></div></td>
		<td><?=$username?><div align="center"></div></td>
		<td><?=$nama?><div align="center"></div></td>
		<td><?=$hak_akses?><div align="center"></div></td>
		<td bgcolor="#EEF2F7"><div align="center"><a href="home-admin.php?page=form-edit-user&username=<?=$username?>">Edit</a> | <a href="home-admin.php?page=hapus-user&username=<?=$username?>">Hapus</a></div></td>
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