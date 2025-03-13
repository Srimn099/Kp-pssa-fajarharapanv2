<head>
  <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<!--<script type="text/javascript" src="plugins\jquery/jquery.js"></script>-->

</head>


<div style="border:0; padding:10px; width:924px; height:auto;"><br />
<center><font color="orange" size="2"><b>List Simpanan Anggota</b></font></center><br /><br />

<table id="tabel-data" width="924" border="0" align="center" cellpadding="0" cellspacing="0">
<thead>
<tr bgcolor="#FF6600">
	<th width="5%">No</td>&nbsp;
	<th width="7.5%" height="42">NO.ANGGOTA</td>&nbsp;
	<th width="22.5%">NAMA</td>&nbsp;
	<th width="10%">Simp. Pokok</td>&nbsp;
	<th width="15%">Simp. Wajib</td>&nbsp;
	<th width="15%">Simp. Suka</td>&nbsp;
	<th width="25%">Action</td>&nbsp;     
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
			if(!empty($hasil['simpok'])){
			$simpok 	= stripslashes ($hasil['simpok']);
			}else{
			$simpok = 0.0;	
			}
			if(!empty($hasil['simjib'])){
			$simjib 	= stripslashes ($hasil['simjib']);
			}else{
			$simjib = 0.0;	
			}
			if(!empty($hasil['simsuka'])){
			$simsuka 	= stripslashes ($hasil['simsuka']);
			}else{
			$simsuka = 0.0;	
			}
		{
	$nomer++;
?>
	<tr align="center">
		<td height="32"><?=$nomer?><div align="center"></div></td>
		<td ><?=$username?><div align="center"></div></td>
		<td><?=$nama?><div align="center"></div></td>
		<td align="right"><?=number_format($simpok,0,',','.')?><div align="center"></div></td>
		<td align="right"><?=number_format($simjib,0,',','.')?><div align="center"></div></td>
		<td align="right"><?=number_format($simsuka,0,',','.')?><div align="center"></div></td>
		<td bgcolor="#EEF2F7"><div align="center"><a href="home-admin.php?page=form-input-tabungan&username=<?=$username?>">Setor</a> | <a href="home-admin.php?page=form-ambil-tabungan&username=<?=$username?>">Tarik</a> | <a  href="home-admin.php?page=form-rc-tabungan&username=<?=$username?>" >RC</a></div></td>
	</tr>
	<?php  
		}
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





<div id="myModal1" class="modal fade" role="dialog">

   <div class="modal-dialog">
	<!-- konten modal-->
	<div class="modal-content">
		<!-- heading modal -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Bagian heading modal</h4>
		</div>
		<!-- body modal -->
		<div class="modal-body">
			<p>bagian body modal.</p>
			<input type="text" id="username" readonly />
		</div>
		<!-- footer modal -->
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
		</div>
	</div>
   </div>
</div>
