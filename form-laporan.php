<?php
date_default_timezone_set('Asia/Jakarta');
include 'koneksi.php';

$date=date('Y-m-d');
$sql = mysqli_query($koneksi,"create table tb_laporan (no smallint,nama char(50),tgl_awal date,aksi char(50)) engine=myISAM DEFAULT CHARSET=latin1");
$ssl = mysqli_query($koneksi,"insert into tb_laporan select 1,'Laporan Posisi Keuangan','$date','repneraca.php'");
$ssl = mysqli_query($koneksi,"insert into tb_laporan select 2,'Laporan Aktivitas','$date','replabarugi.php'");
$ssl = mysqli_query($koneksi,"insert into tb_laporan select 3,'Laporan Transaksi Jurnal','$date','repjurnal.php'");
$ssl = mysqli_query($koneksi,"insert into tb_laporan select 4,'Laporan Arus Kas','$date','reparuskas.php'");
$ssl = mysqli_query($koneksi,"insert into tb_laporan select 4,'Daftar Aset Tetap','$date','repinvent.php'");

?>  
<head>
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="plugins\jquery/jquery.js"></script>
	
</head>

<div style="border:0; padding:10px; width:924px; height:auto;">
				<div >
                    <h1><center><label class="label label-success">Cetak Laporan</label></center></h1><br><br><br><br>

					
				<form method="POST">
								<label for="">Tanggal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="date" name="tgl_awal" value="<?php echo $date;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" value="Tentukan Tanggal" name="tanggal" class="btn btn-primary">
								<br><br><br>
				</form>
				<?php
					if(isset($_POST['tanggal'])){
							$tgl_awal = $_POST['tgl_awal'];
							$rrr = mysqli_query($koneksi,"update tb_laporan set tgl_awal='$tgl_awal'");
					}
				?>	
					<div class="body">
						<table class="table table-striped ">
							<thead>
								<tr>
									<th>No. </th>
									<th>Laporan</th>
									<th>Periode
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
									<?php
										$oke = mysqli_query($koneksi,"select * from tb_laporan order by no");
										while($oo=$oke->fetch_assoc()){
									?>
									<tr>
										<td><?php echo $oo['no'];?></td>
										<td><?php echo $oo['nama'];?></td>
										<td><?php echo $oo['tgl_awal'];?></td>
										<td>
											<a  href="<?php echo $oo['aksi'];?>?tgl_awal=<?php echo $oo['tgl_awal'];?>" target="_blank">Cetak</a>

										</td>
									</tr>
									<?php
										}
									  $dodo = mysqli_query($koneksi,"drop table tb_laporan");
									  mysqli_close($koneksi);
									?>
								
								
								
								
							</tbody>
						</table>
				
				</div>
</div>




