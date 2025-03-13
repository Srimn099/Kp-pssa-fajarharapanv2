<head>
  <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<!--<div style="border:0; padding:10px; width:924px; height:auto;"><br />-->
<center><font color="orange" size="2"><b>List Pinjaman Anggota</b></font></center><br /><br />
<div class="body">
<div class="table-responsive">
<table id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable" >
<thead>
<tr bgcolor="#FF6600">
	<th width="5%">No</td>&nbsp;
	<th width="15%" height="42">NO. ANGGOTA</td>&nbsp;
	<th width="40%">NAMA</td>&nbsp;
	<th width="20%">SALDO PINJAMAN</td>&nbsp;
	<th width="20%">Action</td>&nbsp;     
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
			if(!empty($hasil['pinjaman'])){
			$pinjaman 	= stripslashes ($hasil['pinjaman']);
			}else{
				$pinjaman = 0.0;
			}
	
	$nomer++;
?>
	<tr align="center">
		<td height="32"><?=$nomer?><div align="center"></div></td>
		<td><?=$username?><div align="center"></div></td>
		<td><?=$nama?><div align="right"></div></td>
		<td align="right"><?=number_format($pinjaman,0,',','.')?><div align="center"></div></td>
		<td bgcolor="#EEF2F7"><div align="center"><a href="home-admin.php?page=form-input-pinjaman&username=<?=$username?>">Pinjam</a> | <a href="home-admin.php?page=form-input-bayar&username=<?=$username?>">Bayar</a> | <a href="home-admin.php?page=form-rc-pinjaman&username=<?=$username?>">RC</a></div></td>
	</tr>
<?php  
		}
	
//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>
</tbody>

</table>
</div>
</div>