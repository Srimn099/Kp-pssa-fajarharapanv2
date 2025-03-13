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
                    <h1><center><label class="label label-success">Salinan Rekening Simpanan</label></center></h1><br><br><br><br>
				</div>	
					
				<form method="POST">
								<label for="">Mulai Tanggal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="date" name="tgl_awal" value="<?php echo $date;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" value="Tampilkan" name="tampil" class="btn btn-primary">
								<br><br><br>
				</form>
				<?php
					if(isset($_POST['tampil'])){
							$tgl_awal = $_POST['tgl_awal'];
							
							$rrr = mysqli_query($koneksi,"select sum(if(dk='K',jml_tabungan,0))-sum(if(dk='D',jml_tabungan,0)) as salawal from simpanan where username='$username' and tgl_tabungan<'$tgl_awal'");
							$rrs=$rrr->fetch_assoc();
							$saldoawal=$rrs['salawal'];
							
					}
				?>	
					<div class="body">
					<form method="POST" action="cetakrc.php" target="_blank">
								<label for ="">No. Anggota</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="text" name="username" value="<?=$username?>" readonly />&nbsp;&nbsp;&nbsp;
								<label for ="">Nama</label>&nbsp;&nbsp;&nbsp;
								<input type="text" name="nama" value="<?=$su['nama']?>" readonly />&nbsp;&nbsp;&nbsp;
								<label for="">Mulai Tanggal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="date" name="tgl_awal" value="<?php echo $tgl_awal;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								
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
									<tr>
										<td><?php echo $tgl_awal;?></td>
										<td>Saldo Awal</td>
										<td></td>
										<td><?php echo number_format($saldoawal,0,',','.');?></td>
										<td><?php echo number_format($saldoawal,0,',','.');?></td>
									</tr>	
									<?php
										$oke = mysqli_query($koneksi,"select * from simpanan where username='$username' and tgl_tabungan>='$tgl_awal' order by tgl_tabungan");
										while($oo=$oke->fetch_assoc()){
											if($oo['dk']=='K'){
												$saldoawal = $saldoawal+$oo['jml_tabungan'];
												$cket = "SETORAN";
												$debet = 0;
												$kredit = $oo['jml_tabungan'];
											}else{
												$saldoawal = $saldoawal-$oo['jml_tabungan'];
												$cket = "PENARIKAN";
												$debet = $oo['jml_tabungan'];
												$kredit = 0;
											}
									?>
									<tr>
										<td><?php echo $oo['tgl_tabungan'];?></td>
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




