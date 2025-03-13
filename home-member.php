<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard | LKSA Fajar Harapan</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<style>
		body {
			background-color: #f8f9fa;
			font-family: 'Arial', sans-serif;
			text-align: center;
		}

		.sidebar {
			width: 250px;
			height: 100vh;
			background-color: rgb(26, 94, 196);
			color: white;
			padding: 20px;
			position: fixed;
			transition: width 0.3s;
			font-weight: normal;
			/* Pastikan font tidak bold */
		}

		.sidebar h4 {
			text-align: center;
			margin-bottom: 30px;
			font-weight: normal;
			/* Pastikan tulisan tidak bold */
		}

		.sidebar a {
			color: white;
			text-decoration: none;
			display: flex;
			align-items: center;
			padding: 10px;
			margin: 10px 0;
			/* border-radius: 0px; */
			transition: background 0.3s;
			border-bottom: 1px solid rgba(255, 255, 255, 0.3);
			/* Garis bawah setiap tombol */
		}


		.sidebar a:hover {
			background: rgba(255, 255, 255, 0.2);
			border-radius: 5px;
		}

		.sidebar a i {
			margin-right: 10px;
		}

		.sidebar a:last-child {
			border-bottom: none;
			/* Menghilangkan garis pada tombol terakhir */
		}

		.content {
			margin-left: 270px;
			padding: 20px;
			width: calc(100% - 270px);
		}

		.card {
			border: none;
			border-radius: 10px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		.sidebar .active {
			background: rgba(255, 255, 255, 0.3);
			border-radius: 5px;
		}

		.logout-btn {
			color: rgb(185, 152, 152);
			background-color: rgb(202, 16, 16);
			/* Warna merah */
			border-radius: 5px;
			padding: 10px 15px;
			display: block;
			text-align: center;
		}


		.sidebar .logout-btn:hover {
			background-color: rgb(57, 48, 48)
		}
	</style>
</head>

<body>
	<div class="sidebar">
		<h4>LKSA FAJAR HARAPAN</h4>
		<!-- New Links for Siswa, Alumni, and Pengurus -->
		<a href="home-member.php" class="<?= (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'active' : '' ?>">
			<i class="fas fa-home"></i> Home
		</a>
		<a href="home-member.php?page=data-siswa" class="<?= (isset($_GET['page']) && ($_GET['page'] == 'data-siswa' || $_GET['page'] == 'tambah-siswa' || $_GET['page'] == 'ubah-siswa' || $_GET['page'] == 'hapus-siswa')) ? 'active' : '' ?>">
			<i class="fas fa-users"></i> Data Siswa
		</a>
		<a href="home-member.php?page=data-alumni" class="<?= (isset($_GET['page']) && $_GET['page'] == 'data-alumni') ? 'active' : '' ?>">
			<i class="fas fa-user-graduate"></i> Data Alumni
		</a>
		<a href="home-member.php?page=data-pengelola"
			class="<?= (isset($_GET['page']) && ($_GET['page'] == 'data-pengelola' || $_GET['page'] == 'tambah-pengelola')) ? 'active' : '' ?>">
			<i class="fas fa-user-tie"></i> Data Pengelola
		</a>

		<a href="home-member.php?page=form-fixedasset"
			class="<?= (isset($_GET['page']) && in_array($_GET['page'], ['form-fixedasset', 'kelbrg', 'inventory'])) ? 'active' : '' ?>">
			<i class="fas fa-box"></i> Aset Tetap
		</a>

		<a href="home-member.php?page=form-anggaran" class="<?= (isset($_GET['page']) && $_GET['page'] == 'form-anggaran') ? 'active' : '' ?>">
			<i class="fas fa-money-bill"></i> Anggaran
		</a>
		<a href="home-member.php?page=form-jurnal-member" class="<?= (isset($_GET['page']) && $_GET['page'] == 'form-jurnal-member') ? 'active' : '' ?>">
			<i class="fas fa-book"></i> Transaksi
		</a>
		<a href="home-member.php?page=form-laporan-new" class="<?= (isset($_GET['page']) && $_GET['page'] == 'form-laporan-new') ? 'active' : '' ?>">
			<i class="fas fa-chart-line"></i> Laporan
		</a>
		<a href="login/logout.php " class="logout-btn">
			<i class="fas fa-sign-out-alt"></i> Logout
		</a>
	</div>
	<div class="content">
		<div class="container">
			<?php

			$hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
			$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

			$tgl = date("d");
			$bln = date("n") - 1; // Index mulai dari 0
			$thn = date("Y");
			$hariIni = $hari[date("w")];

			// Cek apakah halaman ini adalah home-member.php DAN tidak ada parameter "page"
			if (basename($_SERVER['PHP_SELF']) == "home-member.php" && empty($_GET['page'])) {
			?>
				<div class="text-center my-4">
					<h2 class="fw-bold text-primary">Dashboard Utama
					</h2>
					<p class="fs-5 text-secondary">Selamat datang, <strong class="text-dark"><?= $_SESSION['nama']; ?></strong></p>
					<p class="fs-6 text-muted">
						<i class="fas fa-calendar-alt"></i> <?= "$hariIni, $tgl $bulan[$bln] $thn"; ?>
					</p>

				</div>
			<?php } ?>


			<div class="card p-3">
				<?php
				$page = (isset($_GET['page'])) ? $_GET['page'] : "main";
				switch ($page) {
					case 'data-siswa':
						include 'data-siswa.php';
						break;
					case 'tambah-siswa':
						include 'tambah-siswa.php';
						break;
					case 'ubah-siswa':
						include 'ubah-siswa.php';
						break;
					case 'hapus-siswa':
						include 'hapus-siswa.php';
						break;
					case 'data-alumni':
						include 'data-alumni.php';
						break;
					case 'data-pengelola':
						include 'data-pengelola.php';
						break;
					case 'tambah-pengelola':
						include 'tambah-pengelola.php';
						break;
					case 'ubah-pengelola':
						include 'ubah-pengelola.php';
						break;
					case 'hapus-pengelola':
						include 'hapus-pengelola.php';
						break;
					case 'form-fixedasset':
						include "form-fixedasset.php";
						break;
					case 'form-anggaran':
						include "form-anggaran.php";
						break;
					case 'mataanggaran':
						include "mataanggaran.php";
						break;
					case 'tambah-anggaran':
						include "tambah-anggaran.php";
						break;
					case 'hapus-anggaran':
						include "hapus-anggaran.php";
						break;
					case 'ubah-anggaran':
						include "ubah-anggaran.php";
						break;
					case 'repairneraca':
						include "repairneraca.php";
						break;
					case 'kelanggaran':
						include "kelanggaran.php";
						break;
					case 'bukubesaranggaran':
						include "bukubesaranggaran.php";
						break;
					case 'tambah-kelanggaran':
						include "tambah-kelanggaran.php";
						break;
					case 'hapus-kelanggaran':
						include "hapus-kelanggaran.php";
						break;
					case 'ubah-kelanggaran':
						include "ubah-kelanggaran.php";
						break;
					case 'ubah-jurnal':
						include "ubah-jurnal.php";
						break;
					case 'rapb':
						include "rapb.php";
						break;
					case 'ubah-rapb':
						include "ubah-rapb.php";
						break;
					case 'inventory':
						include "inventory.php";
						break;
					case 'ubah-inventory':
						include "ubah-inventory.php";
						break;
					case 'tambah-inventory':
						include "tambah-inventory.php";
						break;
					case 'hapus-inventory':
						include "hapus-inventory.php";
						break;
					case 'kelbrg':
						include "kelbrg.php";
						break;
					case 'ubah-kelbrg':
						include "ubah-kelbrg.php";
						break;
					case 'tambah-kelbrg':
						include "tambah-kelbrg.php";
						break;
					case 'hapus-kelbrg':
						include "hapus-kelbrg.php";
						break;
					case 'repairneraca':
						include "repairneraca.php";
						break;
					case 'form-jurnal-member':
						include "form-jurnal-member.php";
						break;
					case 'form-laporan':
						include "form-laporan.php";
						break;
					case 'jentry':
						include "jentry.php";
						break;
					case 'form-laporan-new':
						include "form-laporan-new.php";
						break;
					case 'transrutin':
						include "transrutin.php";
						break;
					case 'list-jurnal':
						include "list-jurnal.php";
						break;
					case 'bukubesar':
						include "bukubesar.php";
						break;
					case 'hapus-jurnal':
						include "hapus-jurnal.php";
						break;
					case 'hapus-jentry':
						include "hapus-jentry.php";
						break;
					case 'main':
					default:
						include 'about-login.php';
				}
				?>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>