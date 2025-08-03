<?php
function hitung_umur($tanggal_lahir)
{
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) {
		exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y;
}

include 'koneksi.php';
$cc = mysqli_query($koneksi, "select * from company");
$data = $cc->fetch_assoc();
$tgl_awal = $_GET['tgl_awal'];
?>
<left>
	<a href="repneracaxls.php?tgl_awal=<?php echo $tgl_awal; ?>" target="_blank" class="noPrint btn-export">
		<button class="btn">Export Excel</button>
	</a>
	<input type="button" class="noPrint btn-print" value="Cetak" onclick="window.print()">
</left>


<!DOCTYPE HTML>
<html>

<head>
	<title>Laporan Posisi Keuangan</title>
	<style>
		@media print {
			.noPrint {
				display: none;
			}
		}

<<<<<<< HEAD
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

		.section-header {
			background-color: #d0d0d0;
			text-align: left;
		}

		caption {
			caption-side: top;
		}

=======
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
		.btn {
			background-color: #4CAF50;
			/* Green */
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			font-size: 16px;
			cursor: pointer;
			border-radius: 5px;
			transition: background-color 0.3s;
		}

		.btn:hover {
			background-color: #45a049;
			/* Darker green on hover */
		}

		.btn-export {
			text-decoration: none;
			/* Remove underline */
		}

		.btn-print {
			background-color: #008CBA;
			/* Blue */
			border: none;
			color: white;
			padding: 10px 20px;
			font-size: 16px;
			cursor: pointer;
			border-radius: 5px;
			transition: background-color 0.3s;
		}

		.btn-print:hover {
			background-color: #007bb5;
			/* Darker blue on hover */
		}
<<<<<<< HEAD
=======

		/* .noPrint {
			display: inline-block;
			margin: 10px;
		} */
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
	</style>

</head>

<body>
	<div style="border:0; padding:10px; width:924px; height:auto;">
		<table border="1" width="100%" style="border-collapse: collapse;">
<<<<<<< HEAD
			<div class="company-info">
				<h2 style="color: red;"><?php echo $data['NAMA']; ?></h2>
				<p style="font-size:13px; text-align: center; margin-top:4px;"><?php echo $data['ALAMAT'] . ', ' . $data['KOTA'] . ' - ' . $data['PHONE']; ?></p>
			</div>

			<div class="table-title">
				<h3>LAPORAN POSISI KEUANGAN</h3>
				<h4 style="font-size:14px; margin-top:-10px;">Posisi Tanggal: <b><?php echo date('d F Y', strtotime($tgl_awal)) ?></b></h4>
			</div>

=======
			<div align="left">
				<font size="6" color="red"><b><?php echo $data['NAMA']; ?></b></font><br>
				<?php echo $data['ALAMAT']; ?>&nbsp<?php echo $data['KOTA']; ?>&nbsp<?php echo $data['PHONE']; ?>
			</div>
			<caption>
				<h2>LAPORAN POSISI KEUANGAN</h2>
				<h4>Posisi Tanggal :<b><?php echo date('d-F-Y', strtotime($tgl_awal)) ?></b></h4>
			</caption>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
			<thead>
				<tr>
					<th>No. Perkiraan</th>
					<th>Nama Perkiraan</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
<<<<<<< HEAD
				<tr class="section-header">
=======
				<tr>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
					<td colspan="3"><b>ASET LANCAR</b></td>
				</tr>
				<?php
				$no = 1;
				$sql = $koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='A' and KODEBI='100' and balance.NIDRENDBAL<>0 order by tabkira.CNO_KIRA");
				$aktiva = 0;
				$aktlancar = 0;
				while ($data = $sql->fetch_assoc()) {
					if ($data['NLEVEL'] == 1) {
						$aktiva = $aktiva + $data['NIDRENDBAL'];
						$aktlancar = $aktlancar + $data['NIDRENDBAL'];
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

											echo number_format($data['NIDRENDBAL'], 2, ',', '.');
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
					<td colspan="2"><b>TOTAL ASET LANCAR</b></td>
					<td align="right"><b><?php echo number_format($aktlancar, 2, ',', '.'); ?></b></td>
				</tr>
<<<<<<< HEAD
				<tr class="section-header">
=======
				<tr>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
					<td colspan="3"><b>ASET TIDAK LANCAR</b></td>
				</tr>
				<?php
				$no = 1;
				$sql = $koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='A' and KODEBI='200' and balance.NIDRENDBAL<>0 order by tabkira.CNO_KIRA");
				$aktnonlancar = 0;
				while ($data = $sql->fetch_assoc()) {
					if ($data['NLEVEL'] == 1) {
						$aktiva = $aktiva + $data['NIDRENDBAL'];
						$aktnonlancar = $aktnonlancar + $data['NIDRENDBAL'];
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

											echo number_format($data['NIDRENDBAL'], 2, ',', '.');
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
					<td colspan="2"><b>TOTAL ASET TIDAK LANCAR</b></td>
					<td align="right"><b><?php echo number_format($aktnonlancar, 2, ',', '.'); ?></b></td>
				</tr>
				<tr>
					<td colspan="2"><b>TOTAL ASET</b></td>
					<td align="right"><b><?php echo number_format($aktiva, 2, ',', '.'); ?></b></td>
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
<<<<<<< HEAD
				<tr class="section-header">
=======
				<tr>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
					<td colspan="3"><b>HUTANG DAN ASET BERSIH</b></td>
				</tr>
				<?php
				$no = 1;
				$pendapatan1 = mysqli_query($koneksi, "select sum(NIDRENDBAL) as pendapatan from balance,tabkira where balance.CNO_KIRA=tabkira.CNO_KIRA and tabkira.CGROUP='D' and tabkira.kodebi='501' and tabkira.CNO_KIRA not in (select CACCTPARENT from tabkira) and balance.DTGL='$tgl_awal'");
				$dapat1 = $pendapatan1->fetch_assoc();
				$vndapat1 = $dapat1['pendapatan'];
				$pendapatan2 = mysqli_query($koneksi, "select sum(NIDRENDBAL) as pendapatan from balance,tabkira where balance.CNO_KIRA=tabkira.CNO_KIRA and tabkira.CGROUP='D' and tabkira.kodebi='502' and tabkira.CNO_KIRA not in (select CACCTPARENT from tabkira) and balance.DTGL='$tgl_awal'");
				$dapat2 = $pendapatan2->fetch_assoc();
				$vndapat2 = $dapat2['pendapatan'];


				$biaya1 = mysqli_query($koneksi, "select sum(NIDRENDBAL) as biaya from balance,tabkira where balance.CNO_KIRA=tabkira.CNO_KIRA and tabkira.CGROUP='B' and tabkira.KODEBI='601' and tabkira.CNO_KIRA not in (select CACCTPARENT from tabkira) and balance.DTGL='$tgl_awal'");
				$nbiaya1 = $biaya1->fetch_assoc();
				$vnbiaya1 = $nbiaya1['biaya'];

				$biaya2 = mysqli_query($koneksi, "select sum(NIDRENDBAL) as biaya from balance,tabkira where balance.CNO_KIRA=tabkira.CNO_KIRA and tabkira.CGROUP='B' and tabkira.KODEBI='602' and tabkira.CNO_KIRA not in (select CACCTPARENT from tabkira) and balance.DTGL='$tgl_awal'");
				$nbiaya2 = $biaya2->fetch_assoc();
				$vnbiaya2 = $nbiaya2['biaya'];

				$sql = $koneksi->query("select tabkira.CNO_KIRA,tabkira.CNAMA_KIRA,balance.NIDRENDBAL,tabkira.NLEVEL,tabkira.KODEBI  from tabkira,balance where tabkira.CNO_KIRA=balance.CNO_KIRA and balance.DTGL='$tgl_awal' and CGROUP='S' order by tabkira.CNO_KIRA");
				$pasiva = 0;
				while ($data = $sql->fetch_assoc()) {
					if ($data['NLEVEL'] == 1) {
						if ($data['KODEBI'] == '401') {
							$pasiva = $pasiva + $data['NIDRENDBAL'] + $vndapat1 - $vnbiaya1;
							$nilai = $data['NIDRENDBAL'] + $vndapat1 - $vnbiaya1;
						} elseif ($data['KODEBI'] == '402') {
							$pasiva = $pasiva + $data['NIDRENDBAL'] + $vndapat2 - $vnbiaya2;
							$nilai = $data['NIDRENDBAL'] + $vndapat2 - $vnbiaya2;
						} else {
							$pasiva = $pasiva + $data['NIDRENDBAL'];
							$nilai = $data['NIDRENDBAL'];
						}
					} else {
						if ($data['KODEBI'] == '401') {
							$nilai = $data['NIDRENDBAL'] + $vndapat1 - $vnbiaya1;
						} elseif ($data['KODEBI'] == '402') {
							$nilai = $data['NIDRENDBAL'] + $vndapat2 - $vnbiaya2;
						} else {
							$nilai = $data['NIDRENDBAL'];
						}
					}
					if ($nilai <> 0) {
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

												echo number_format($nilai, 2, ',', '.');
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
				}
				?>
				<tr>
					<td colspan="2"><b>TOTAL HUTANG DAN ASET BERSIH</b></td>
					<td align="right"><b><?php echo number_format($pasiva, 2, ',', '.'); ?></b></td>
				</tr>
			</tbody>




		</table>
		<?php
		mysqli_close($koneksi);
		?>




	</div>
</body>

</html>