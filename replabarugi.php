<?php
<<<<<<< HEAD
function hitung_umur($tanggal_lahir)
{
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		exit("0 tahun 0 bulan 0 hari");
=======
function hitung_umur($tanggal_lahir){
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) { 
	    exit("0 tahun 0 bulan 0 hari");
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y;
}
include 'koneksi.php';
<<<<<<< HEAD
$cc = mysqli_query($koneksi, "select * from company");
$data = $cc->fetch_assoc();
$tgl_awal = $_GET['tgl_awal'];
$tgl_awal = date('Y-m-d', strtotime($tgl_awal));
$oke = mysqli_query($koneksi, "select sum(balance.nidrendbal) as saldoawal from balance,tabkira where balance.dtgl='$tgl_awal' and balance.cno_kira=tabkira.cno_kira and tabkira.kodebi in ('401','402') and tabkira.cno_kira not in (select cacctparent from tabkira)");
$asetbersih = $oke->fetch_assoc();
$saldoawalaset = $asetbersih['saldoawal'];
?>
<div class="tombol-wrapper noPrint">
	<a target="_blank" href="replabarugixls.php?tgl_awal=<?php echo $tgl_awal; ?>">EXPORT KE EXCEL</a>
	<input type="button" value="Cetak" onclick="window.print()">
</div>


<!DOCTYPE HTML>
<html>

<head>
	<title>Laporan Aktivitas</title>
	<style>
		@media print {
			input.noPrint {
=======
$cc=mysqli_query($koneksi,"select * from company");
$data=$cc->fetch_assoc();
$tgl_awal = $_GET['tgl_awal'];
$tgl_awal = date('Y-m-d',strtotime($tgl_awal));
$oke = mysqli_query($koneksi,"select sum(balance.nidrendbal) as saldoawal from balance,tabkira where balance.dtgl='$tgl_awal' and balance.cno_kira=tabkira.cno_kira and tabkira.kodebi in ('401','402') and tabkira.cno_kira not in (select cacctparent from tabkira)");
$asetbersih = $oke->fetch_assoc();
$saldoawalaset = $asetbersih['saldoawal'];
?>
<center>
		<a target="_blank" href="replabarugixls.php?tgl_awal=
												<?php echo $tgl_awal;?>">EXPORT KE EXCEL</a>
</center>

<!DOCTYPE HTML>
<html>
<head>
	<title>Laporan Aktivitas</title>
	<style>
		@media print{
			input.noPrint{
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
				display: none;
			}
		}
	</style>
</head>
<<<<<<< HEAD

<body>
	<div style="border:0; padding:10px; width:924px; height:auto;">

		<table border="1" width="100%" style="border-collapse: collapse;">
			<div class="company-info">
				<h2 style="color: red;"><?php echo $data['NAMA']; ?></h2>
				<p style="font-size:13px; text-align: center; margin-top:4px;"><?php echo $data['ALAMAT'] . ', ' . $data['KOTA'] . ' - ' . $data['PHONE']; ?></p>
			</div>
			<caption>
				<h2>LAPORAN AKTIVITAS</h2>
				<h4 style="font-size:14px; margin-top:5px;">Posisi Tanggal :<b><?php echo date('d-F-Y', strtotime($tgl_awal)) ?></b></h4>
			</caption>
			<thead>
				<tr>
					<th>No. Perkiraan</th>
					<th>Nama Perkiraan</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="3"><b>PENDAPATAN DAN SUMBANGAN</b></td>
				</tr>
				<?php
				$no = 1;
				$sql = $koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='D' and balance.NIDRENDBAL<>0 order by tabkira.CNO_KIRA");
				$pendapatan = 0;
				while ($data = $sql->fetch_assoc()) {
					if ($data['NLEVEL'] == 1) {
						$pendapatan = $pendapatan + $data['NIDRENDBAL'];
					}
				?>
					<tr>
						<td><?php
							if ($data['NLEVEL'] == 1) {
							?>
								<b>
								<?php
							}
							echo $data['CNO_KIRA'];
							if ($data['NLEVEL'] == 1) {
								?>
								</b>
							<?php
							}
							?>
						</td>
						<td><?php
							if ($data['NLEVEL'] == 1) {
							?>
								<b>
								<?php
							}
							echo $data['CNAMA_KIRA'];
							if ($data['NLEVEL'] == 1) {
								?>
								</b>
							<?php
							}
							?>



						</td>

						<td align="right"><?php
											if ($data['NLEVEL'] == 1) {
											?>
								<b>
								<?php
											}

											echo number_format($data['NIDRENDBAL'], 0, ',', '.');
											if ($data['NLEVEL'] == 1) {
								?>
								</b>
							<?php
											}
							?>
						</td>
					</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="2"><b>TOTAL PENDAPATAN DAN SUMBANGAN</b></td>
					<td align="right"><b><?php echo number_format($pendapatan, 0, ',', '.'); ?></b></td>
				</tr>
			</tbody>

			<br><br>
			<thead>
				<tr>
					<th>No. Perkiraan</th>
					<th>Nama Perkiraan</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="3"><b>BEBAN DAN PROGRAM</b></td>
				</tr>
				<?php
				$no = 1;

				$sql = $koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='B' and balance.NIDRENDBAL<>0 order by tabkira.CNO_KIRA");
				$biaya = 0;
				while ($data = $sql->fetch_assoc()) {
					if ($data['NLEVEL'] == 1) {
						$biaya = $biaya + $data['NIDRENDBAL'];
					}
				?>
					<tr>
						<td><?php
							if ($data['NLEVEL'] == 1) {
							?>
								<b>
								<?php
							}
							echo $data['CNO_KIRA'];
							if ($data['NLEVEL'] == 1) {
								?>
								</b>
							<?php
							}
							?>
						</td>
						<td><?php
							if ($data['NLEVEL'] == 1) {
							?>
								<b>
								<?php
							}
							echo $data['CNAMA_KIRA'];
							if ($data['NLEVEL'] == 1) {
								?>
								</b>
							<?php
							}
							?>



						</td>

						<td align="right"><?php
											if ($data['NLEVEL'] == 1) {
											?>
								<b>
								<?php
											}

											echo number_format($data['NIDRENDBAL'], 0, ',', '.');
											if ($data['NLEVEL'] == 1) {
								?>
								</b>
							<?php
											}
							?>
						</td>
					</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="2"><b>TOTAL BEBAN DAN PROGRAM</b></td>
					<td align="right"><b><?php echo number_format($biaya, 0, ',', '.'); ?></b></td>
				</tr>
				<tr>
					<td colspan="2"><b>KENAIKAN/PENURUNAN ASET BERSIH</b></td>
					<td align="right"><b><?php echo number_format($pendapatan - $biaya, 0, ',', '.'); ?></b></td>
				</tr>
				<tr>
					<td colspan="2"><b>ASET BERSIH - AWAL</b></td>
					<td align="right"><b><?php echo number_format($saldoawalaset, 0, ',', '.'); ?></b></td>
				</tr>
				<tr>
					<td colspan="2"><b>ASET BERSIH - AKHIR</b></td>
					<td align="right"><b><?php echo number_format($saldoawalaset + $pendapatan - $biaya, 0, ',', '.'); ?></b></td>
				</tr>

			</tbody>




		</table>
		<?php
		mysqli_close($koneksi);
		?>
		<br>
		<br>



	</div>
</body>

</html>
<style>
	.tombol-wrapper {
		display: flex;
		justify-content: flex-start;
		/* Sejajar ke kiri */
		gap: 15px;
		/* Jarak antar tombol */
		margin-bottom: 20px;
	}

	.tombol-wrapper a,
	.tombol-wrapper input {
		text-decoration: none;
		padding: 8px 16px;
		background-color: #007bff;
		color: white;
		border: none;
		border-radius: 5px;
		cursor: pointer;
		font-size: 14px;
	}

	.tombol-wrapper a:hover,
	.tombol-wrapper input:hover {
		background-color: #0056b3;
	}

	@media print {
		.noPrint {
			display: none;
		}
	}

	body {
		font-family: Arial, sans-serif;
		margin: 0;
		padding: 0;
		color: #000;
		background: #fff;
	}

	h2,
	h4 {
		text-align: center;
		margin: 0;
	}

	.table-title {
		text-align: center;
		margin-top: 10px;
	}

	.company-info {
		text-align: left;

	}

	table {
		width: 100%;
		border-collapse: collapse;
		margin-top: -5px;
		font-size: 14px;
	}

	th,
	td {
		border: 1px solid #000;
		padding: 8px;
		text-align: left;
		vertical-align: top;
	}

	th {
		background-color: #e0e0e0;
		text-align: center;
	}

	tr:nth-child(even) {
		background-color: #f9f9f9;
	}

	tr td:last-child {
		text-align: right;
	}


	caption {
		caption-side: top;
		margin-bottom: 20px;
		margin-top: -10px;
	}
</style>
=======
<body>
<div style="border:0; padding:10px; width:924px; height:auto;">

<table border="1" width="100%" style="border-collapse: collapse;">
	<div align="left">
		<font size="6" color="red"><b><?php echo $data['NAMA'];?></b></font><br>
		<?php echo $data['ALAMAT'];?>&nbsp<?php echo $data['KOTA'];?>&nbsp<?php echo $data['PHONE'];?>
	</div>
	<caption><h2>LAPORAN AKTIVITAS</h2>
	<h4>Posisi Tanggal :<b><?php echo date('d-F-Y',strtotime($tgl_awal))?></b></h4></caption>
	<thead>
		<tr>
			<th>No. Perkiraan</th>
			<th>Nama Perkiraan</th>
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3"><b>PENDAPATAN DAN SUMBANGAN</b></td>
		</tr>
		<?php
			$no=1;
			$sql=$koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='D' and balance.NIDRENDBAL<>0 order by tabkira.CNO_KIRA");
			$pendapatan =0 ;
			while($data=$sql->fetch_assoc()){
				if($data['NLEVEL']==1){
						$pendapatan = $pendapatan+$data['NIDRENDBAL'];
				}
		?>	
			<tr>
				<td><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}	
					echo $data['CNO_KIRA'];
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				</td>
				<td><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}
					echo $data['CNAMA_KIRA'];
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				
				
				
				</td>
					
				<td align="right"><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}
				
					echo number_format($data['NIDRENDBAL'],0,',','.');
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="2"><b>TOTAL PENDAPATAN DAN SUMBANGAN</b></td>
				<td align="right"><b><?php echo number_format($pendapatan,0,',','.');?></b></td>
			</tr>
	</tbody>
	
<br><br>
	<thead>
		<tr>
			<th>No. Perkiraan</th>
			<th>Nama Perkiraan</th>
			<th>Saldo</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="3"><b>BEBAN DAN PROGRAM</b></td>
		</tr>
		<?php
			$no=1;
			
			$sql=$koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='B' and balance.NIDRENDBAL<>0 order by tabkira.CNO_KIRA");
			$biaya =0 ;
			while($data=$sql->fetch_assoc()){
				if($data['NLEVEL']==1){
						$biaya = $biaya+$data['NIDRENDBAL'];
				}
		?>	
			<tr>
				<td><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}	
					echo $data['CNO_KIRA'];
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				</td>
				<td><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}
					echo $data['CNAMA_KIRA'];
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				
				
				
				</td>
					
				<td align="right"><?php 
					if($data['NLEVEL']==1){
						?>
						<b>
						<?php
					}
				
					echo number_format($data['NIDRENDBAL'],0,',','.');
					if($data['NLEVEL']==1){
						?>
						</b>
						<?php
					}
					?>
				</td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td colspan="2"><b>TOTAL BEBAN DAN PROGRAM</b></td>
				<td align="right"><b><?php echo number_format($biaya,0,',','.');?></b></td>
			</tr>
			<tr>
				<td colspan="2"><b>KENAIKAN/PENURUNAN ASET BERSIH</b></td>
				<td align="right"><b><?php echo number_format($pendapatan-$biaya,0,',','.');?></b></td>
			</tr>
			<tr>
				<td colspan="2"><b>ASET BERSIH - AWAL</b></td>
				<td align="right"><b><?php echo number_format($saldoawalaset,0,',','.');?></b></td>
			</tr>
			<tr>
				<td colspan="2"><b>ASET BERSIH - AKHIR</b></td>
				<td align="right"><b><?php echo number_format($saldoawalaset+$pendapatan-$biaya,0,',','.');?></b></td>
			</tr>
			
	</tbody>

	


</table>
<?php
mysqli_close($koneksi);
?>
<br>
<br>


<br><br><br><br><br>
<input type="button" class="noPrint" value="Cetak" onclick="window.print()">



</div>
</body>
</html>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
