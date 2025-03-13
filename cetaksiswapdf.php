<?php
include('koneksi.php');

// Query untuk mengambil data siswa dari database
$sql = "SELECT * FROM tb_siswa ORDER BY id ASC";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Siswa</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<style>
		body {
			font-family: Arial, sans-serif;
			text-align: center;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 10px;
			margin-top: 20px;
		}

		th,
		td {
			border: 1px solid black;
			padding: 5px;
			text-align: center;
		}

		.print-button {
			margin: 10px;
			padding: 10px 20px;
			font-size: 16px;
			cursor: pointer;
			background: blue;
			color: white;
			border: none;
		}

		.checkbox-container {
			margin: 20px;
			text-align: left;
			display: inline-block;
		}

		.hidden {
			display: none !important;
			/* Pastikan elemen benar-benar disembunyikan */
		}

		/* Saat mode cetak, hanya kolom yang tidak tersembunyi yang dicetak */
		@media print {

			.print-button,
			.checkbox-container {
				display: none;
			}

			.hidden {
				display: none !important;
			}
		}
	</style>
</head>

<body>
	<h2>Data Siswa</h2>

	<div class="checkbox-container">

		<strong>Pilih data yang ingin dicetak:</strong>
		(<i class="fa-solid fa-check-square" style="color: dodgerblue;"></i> Centang untuk menampilkan,
		<i class="fa-regular fa-square"></i> Hapus centang untuk menyembunyikan)
		</p>

		<label><input type="checkbox" class="column-toggle" data-col="nama" checked> Nama</label>
		<label><input type="checkbox" class="column-toggle" data-col="ttl" checked> Tempat, Tanggal Lahir</label>
		<label><input type="checkbox" class="column-toggle" data-col="jk" checked> JK</label>
		<label><input type="checkbox" class="column-toggle" data-col="pendidikan" checked> Pendidikan</label>
		<label><input type="checkbox" class="column-toggle" data-col="ortu " checked> Nama Ayah & Ibu</label>
		<label><input type="checkbox" class="column-toggle" data-col="pkortu" checked> Pekerjaan Ortu</label>
		<label><input type="checkbox" class="column-toggle" data-col="tglmasuk" checked> Tgl Masuk</label>
		<label><input type="checkbox" class="column-toggle" data-col="tglkeluar" checked> Tgl Keluar</label>
		<label><input type="checkbox" class="column-toggle" data-col="status" checked> Status</label>
		<label><input type="checkbox" class="column-toggle" data-col="alamat" checked> Alamat</label>
	</div>

	<button class="print-button" onclick="window.print()">Cetak</button>

	<table>
		<tr>
			<th>No</th>
			<th class="col-nama">Nama</th>
			<th class="col-ttl">Tempat, Tanggal Lahir</th>
			<th class="col-jk">JK</th>
			<th class="col-pendidikan">Pendidikan</th>
			<th class="col-ortu">Nama Ayah</th>
			<th class="col-ortu">Nama Ibu</th>
			<th class="col-pkortu">Pekerjaan Ortu</th>
			<th class="col-tglmasuk">Tgl Masuk</th>
			<th class="col-tglkeluar">Tgl Keluar</th>
			<th class="col-status">Status</th>
			<th class="col-alamat">Alamat</th>
		</tr>

		<?php
		$no = 1;
		while ($row = $result->fetch_assoc()) {
			echo "<tr>
                    <td>{$no}</td>
                    <td class='col-nama'>{$row['nama']}</td>
                    <td class='col-ttl'>{$row['tmp_lahir']}, {$row['tgl_lahir']}</td>
                    <td class='col-jk'>{$row['jk']}</td>
                    <td class='col-pendidikan'>{$row['pendidikan_terakhir']}</td>
                    <td class='col-ortu'>{$row['nama_ayah']}</td>
                    <td class='col-ortu'>{$row['nama_ibu']}</td>
                    <td class='col-pkortu'>{$row['pk_ortu']}</td>
                    <td class='col-tglmasuk'>{$row['tgl_masuk']}</td>
                    <td class='col-tglkeluar'>{$row['tgl_keluar']}</td>
                    <td class='col-status'>{$row['status']}</td>
                    <td class='col-alamat'>{$row['alamat']}</td>
                  </tr>";
			$no++;
		}
		?>
	</table>

	<script>
		document.querySelectorAll('.column-toggle').forEach(function(checkbox) {
			checkbox.addEventListener('change', function() {
				let colClass = 'col-' + this.dataset.col;
				let elements = document.querySelectorAll('.' + colClass + ', th.' + colClass);

				elements.forEach(el => {
					if (this.checked) {
						el.classList.remove('hidden');
					} else {
						el.classList.add('hidden');
					}
				});
			});
		});
	</script>
</body>

</html>