<?php
date_default_timezone_set('Asia/Jakarta');
include 'koneksi.php';

$date=date('Y-m-d');
$tgl_awal=$date;
$saldoawal=0;
if (isset($_GET['username'])) {
	$username = $_GET['username'];
	$sql=mysqli_query($koneksi,"select * from member where username='$username'");
	$su=$sql->fetch_assoc();
	
}
?>  
<head>
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="plugins\jquery/jquery.js"></script>
	
</head>

<div style="border:0; padding:10px; width:924px; height:auto;">
				<div >
                    <h1><center><label class="label label-success">Salinan Rekening Pinjaman</label></center></h1><br><br><br><br>
				</div>	
					
					<div class="body">
					<form method="POST" action="cetakrcpinjaman.php" target="_blank">
								<label for ="">No. Anggota</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="text" name="username" value="<?=$username?>" readonly />&nbsp;&nbsp;&nbsp;
								<label for ="">Nama</label>&nbsp;&nbsp;&nbsp;
								<input type="text" name="nama" value="<?=$su['nama']?>" readonly />&nbsp;&nbsp;&nbsp;
								
								<br><br>
	

						<table class="table table-striped ">
							<thead>
								<tr>
									<th>Tanggal</th>
									<th>Ket</th>
									<th>Debet
									<th>Kredit</th>
									<th>Saldo</th>
								</tr>
							</thead>
							<tbody>
									<?php
										$oke = mysqli_query($koneksi,"select * from pinjaman where username='$username'  order by tgl_transaksi");
										while($oo=$oke->fetch_assoc()){
											if($oo['dk']=='D'){
												$saldoawal = $saldoawal+$oo['pokok'];
												$cket = "PENCAIRAN";
												$debet = $oo['pokok'];
												$kredit = 0;
											}else{
												$saldoawal = $saldoawal-$oo['pokok'];
												$cket = "ANGSURAN";
												$debet = 0;
												$kredit = $oo['pokok'];
											}
									?>
									<tr>
										<td><?php echo $oo['tgl_transaksi'];?></td>
										<td><?php echo $cket;?></td>
										<td><?php echo number_format($debet,0,',','.');?></td>
										<td><?php echo number_format($kredit,0,',','.');?></td>
										<td><?php echo number_format($saldoawal,0,',','.');?></td>
										</tr>
									<?php
										}
									  mysqli_close($koneksi);
									?>
								
								
								
								
							</tbody>
						</table>
				<input type="submit" value="Cetak" name="cetak" class="btn btn-primary">
				</form>
				</div>
</div>




