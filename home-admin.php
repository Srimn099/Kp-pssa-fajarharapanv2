<<<<<<< HEAD
<?php

session_start();
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d');
include 'koneksi.php';
include 'functions.php';
$user = $_SESSION['username'];
$hak_akses = $_SESSION['hak_akses'];
if (!isset($_SESSION['username']) && $hak_akses != "Admin") {
?>
	<script language="JavaScript">
		alert('Anda Bukan Admin. Silahkan Login kembali!');
		document.location = 'index.php';
	</script>
<?php
}
$cek = mysqli_query($koneksi, "select max(dtgl) as maxtgl from balance");
$suk = $cek->fetch_assoc();
$maxtgl = $suk['maxtgl'];
if ($maxtgl < $date) {

	awalhari($koneksi);
	repairneraca($koneksi, $maxtgl);
}
if (isset($_GET['page']) && $_GET['page'] == 'input-user') {
	if (isset($_POST['Submit'])) {
		// Ambil data dari form
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password']; // langsung dari form, tanpa hashing
		$hak_akses = $_POST['hak_akses'];

		// Simpan ke database
		$query = "INSERT INTO login (nama, username, password, hak_akses) 
                  VALUES ('$nama', '$username', '$password', '$hak_akses')";

		$result = mysqli_query($koneksi, $query);

		if ($result) {
			echo "<script>alert('Data berhasil disimpan'); 
                  window.location='home-admin.php?page=form-view-user';</script>";
		} else {
			echo "<script>alert('Gagal menyimpan data');</script>";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

	<!-- Custom CSS -->
	<style>
		:root {
			--primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			--secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
			--success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
			--warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);

			--primary-color: #667eea;
			--secondary-color: #764ba2;
			--accent-color: #f5576c;
			--success-color: #10b981;
			--warning-color: #f59e0b;
			--danger-color: #ef4444;

			--text-primary: #1f2937;
			--text-secondary: #6b7280;
			--text-light: #9ca3af;

			--bg-primary: #ffffff;
			--bg-secondary: #f9fafb;
			--bg-tertiary: #f3f4f6;

			--border-color: #e5e7eb;
			--border-light: #f3f4f6;

			--shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
			--shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
			--shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
			--shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

			--sidebar-width: 280px;
			--topbar-height: 80px;

			--radius-sm: 6px;
			--radius-md: 8px;
			--radius-lg: 12px;
			--radius-xl: 16px;
			--radius-2xl: 20px;
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
			background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
			color: var(--text-primary);
			line-height: 1.6;
			overflow-x: hidden;
			min-height: 100vh;
		}

		.bg-purple-gradient {
			background: var(--primary-gradient);
			color: #fff;
		}

		/* Sidebar Styles */
		.sidebar {
			position: fixed !important;
			left: 0;
			top: 0;
			width: var(--sidebar-width);
			height: 100vh;
			background: var(--bg-primary);
			border-right: 1px solid var(--border-light);
			z-index: 2;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			backdrop-filter: blur(20px);
			box-shadow: var(--shadow-xl);
		}

		.sidebar-header {
			padding: 2rem 1.5rem;
			border-bottom: 1px solid var(--border-light);
			background: var(--primary-gradient);
			color: white;
			text-align: center;
			position: relative;
			overflow: hidden;
		}

		.sidebar-header::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
			pointer-events: none;
		}

		.logo-container {
			position: relative;
			z-index: 2;
		}

		.logo {
			font-size: 1.75rem;
			font-weight: 800;
			margin-bottom: 0.5rem;
			letter-spacing: -0.025em;
		}

		.logo-subtitle {
			font-size: 0.875rem;
			opacity: 0.9;
			font-weight: 500;
		}

		.sidebar-menu {
			padding: 1.5rem 0;
			height: calc(100vh - 200px);
			overflow-y: auto;
		}

		.sidebar-menu::-webkit-scrollbar {
			width: 4px;
		}

		.sidebar-menu::-webkit-scrollbar-track {
			background: transparent;
		}

		.sidebar-menu::-webkit-scrollbar-thumb {
			background: var(--border-color);
			border-radius: 2px;
		}

		.menu-item {
			display: block;
			padding: 1rem 1.5rem;
			color: var(--text-secondary);
			text-decoration: none;
			transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
			border-left: 3px solid transparent;
			position: relative;
			font-weight: 500;
			margin: 0.25rem 0;
		}

		.menu-item:hover {
			background: linear-gradient(90deg, rgba(102, 126, 234, 0.1) 0%, transparent 100%);
			color: var(--primary-color);
			border-left-color: var(--primary-color);
			transform: translateX(4px);
		}

		.menu-item.active {
			background: linear-gradient(90deg, rgba(102, 126, 234, 0.15) 0%, rgba(102, 126, 234, 0.05) 100%);
			color: var(--primary-color);
			border-left-color: var(--primary-color);
			font-weight: 600;
		}

		.menu-item i {
			width: 20px;
			margin-right: 0.75rem;
			font-size: 1.1rem;
		}

		.logout-item {
			border-top: 1px solid var(--border-light);
			margin-top: auto;
			padding-top: 1rem;
		}

		.logout-item .menu-item:hover {
			background: linear-gradient(90deg, rgba(239, 68, 68, 0.1) 0%, transparent 100%);
			color: var(--danger-color);
			border-left-color: var(--danger-color);
		}

		/* Main Content */
		.main-content {
			margin-left: var(--sidebar-width);
			min-height: 100vh;
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
			display: flex;
			flex-direction: column;
			z-index: 1;
		}

		/* Footer */
		.footer {
			background: var(--bg-primary);
			border-top: 1px solid var(--border-light);
			padding: 0.7rem;
			text-align: center;
			margin-top: auto;
		}

		.footer-content {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 0.5rem;
			color: var(--text-secondary);
			font-size: 0.875rem;

		}

		.quick-actions h3 {
			font-size: 1.25rem;
			font-weight: 700;
			margin-bottom: 1.5rem;
			color: var(--text-primary);
		}

		.actions-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
			gap: 1rem;
		}

		.action-btn {
			display: flex;
			align-items: center;
			gap: 0.75rem;
			padding: 1rem 1.5rem;
			background: var(--bg-secondary);
			border: 1px solid var(--border-color);
			border-radius: var(--radius-lg);
			text-decoration: none;
			color: var(--text-primary);
			font-weight: 500;
			transition: all 0.2s;
		}

		.action-btn:hover {
			background: var(--primary-color);
			color: white;
			transform: translateY(-2px);
			box-shadow: var(--shadow-lg);
			border-color: var(--primary-color);
		}

		.action-btn i {
			font-size: 1.25rem;
		}


		@keyframes heartbeat {

			0%,
			100% {
				transform: scale(1);
			}

			50% {
				transform: scale(1.1);
			}
		}

		/* Mobile Responsive */
		.mobile-toggle {
			display: none;
			background: none;
			border: none;
			font-size: 1.25rem;
			color: var(--text-secondary);
			cursor: pointer;
			padding: 0.5rem;
			border-radius: var(--radius-md);
			transition: all 0.2s;
		}

		.mobile-toggle:hover {
			background: var(--bg-tertiary);
			color: var(--text-primary);
		}

		@media (max-width: 1024px) {
			.search-container {
				display: none;
			}
		}

		@media (max-width: 768px) {
			.sidebar {
				transform: translateX(-100%);
			}

			.sidebar.active {
				transform: translateX(0);
			}

			.main-content {
				margin-left: 0;
				z-index: 1;
			}

			.mobile-toggle {
				display: block;
			}

			.page-content {
				padding: 1rem;
			}

			.actions-grid {
				grid-template-columns: 1fr;
			}


		}

		/* Overlay for mobile */
		.sidebar-overlay {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: rgba(0, 0, 0, 0.5);
			z-index: 999;
			opacity: 0;
			visibility: hidden;
			transition: all 0.3s;
		}

		.sidebar-overlay.active {
			opacity: 1;
			visibility: visible;
		}

		/* Loading Animation */
		.loading {
			display: inline-block;
			width: 20px;
			height: 20px;
			border: 3px solid rgba(255, 255, 255, 0.3);
			border-radius: 50%;
			border-top-color: white;
			animation: spin 1s ease-in-out infinite;
		}


		@keyframes spin {
			to {
				transform: rotate(360deg);
			}
		}

		/* Smooth transitions for all interactive elements */
		* {
			transition: color 0.2s, background-color 0.2s, border-color 0.2s, transform 0.2s, box-shadow 0.2s;
		}
	</style>
</head>

<body>
	<!-- Sidebar Overlay for Mobile -->
	<div class="sidebar-overlay" id="sidebarOverlay"></div>

	<!-- Sidebar -->
	<div class="sidebar" id="sidebar">
		<div class="sidebar-header">
			<div class="logo-container">
				<div class="logo">LKSA Fajar Harapan</div>
			</div>
		</div>
		<?php
		$page = $_GET['page'] ?? 'main'; // Letakkan di atas sidebar
		?>
		<nav class="sidebar-menu">
			<a href="home-admin.php?page=main" class="menu-item <?php echo ($page == 'main') ? 'active' : ''; ?>">
				<i class="fas fa-home"></i>
				<span>Dashboard</span>
			</a>
			<a href="home-admin.php?page=form-master" class="menu-item <?php if (in_array($page, ['form-master', 'company', 'form-view-user', 'perkiraan', 'ubah-perkkiraan', 'hapus-perkiraan', 'transsetup', 'tambah-transsetup'])) echo 'active'; ?>">
				<i class="fas fa-cog"></i>
				<span>Pengaturan</span>
			</a>
			<a href="home-admin.php?page=form-fixedasset" class="menu-item  <?php if (in_array($page, ['form-fixedasset', 'kelbrg', 'inventory', 'tambah-inventory', 'ubah-inventory', 'hapus-inventory'])) echo 'active'; ?>">
				<i class="fas fa-building"></i>
				<span>Aset Tetap</span>
			</a>
			<a href="home-admin.php?page=form-anggaran" class="menu-item  <?php if (in_array($page, ['form-anggaran', 'mataanggaran', 'tambah-anggaran', 'hapus-anggaran', 'ubah-anggaran', 'rapb', 'ubah-rapb', 'bukubesaranggaran', 'kelanggaran', 'tambah-kelanggaran', 'hapus-kelanggaran', 'ubah-kelanggaran'])) echo 'active'; ?>">
				<i class="fas fa-chart-pie"></i>
				<span>Anggaran</span>
			</a>
			<a href="home-admin.php?page=form-jurnal" class="menu-item  <?php if (in_array($page, ['form-jurnal', 'jentry', 'hapus-jentry', 'transrutin', 'list-jurnal-admin', 'hapus-jurnal-admin'])) echo 'active'; ?>">
				<i class="fas fa-exchange-alt"></i>
				<span>Transaksi</span>
			</a>
			<a href="#reports" class="menu-item">
				<i class="fas fa-file-alt"></i>
				<span>Laporan</span>
			</a>
			<div class="logout-item">
				<a href="/index.php" class="menu-item">
					<i class="fas fa-sign-out-alt"></i>
					<span>Logout</span>
				</a>
			</div>
		</nav>
	</div>


	<div class="main-content">
		<!-- Top Navbar -->
		<nav class="top-navbar">
			<nav class="navbar navbar-expand-lg bg-purple-gradient">
				<div class="container-fluid">
					<?php
					$_SESSION['nama'] = $_SESSION['nama'] ?? 'Admin LKSA';
					$_SESSION['foto'] = $_SESSION['foto'] ?? 'https://ui-avatars.com/api/?name=Admin+LKSA&background=4361ee&color=fff';
					?>

					<a class="navbar-brand"></a>

					<div class="dropdown ms-auto">
						<a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="<?php echo $_SESSION['foto']; ?>" alt="Foto Profil" width="36" height="36" class="rounded-circle me-2" style="object-fit:cover;">
							<span class="fw-semibold"><?php echo $_SESSION['nama']; ?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
							<li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
							<li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Pengaturan</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item text-danger" href="index.php"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</nav>

		<!-- Konten dinamis -->
		<div class="page-content flex-fill">
			<?php
			$page = $_GET['page'] ?? "main";

			switch ($page) {
				case 'form-fixedasset':
					include "form-fixedasset.php";
					break;
				case 'form-master':
					include "form-master.php";
					break;
				case 'company':
					include "company.php";
					break;
				case 'form-view-user';
					include "form-view-user.php";
					break;
				case 'form-input-user';
					include "form-input-user.php";
					break;
				case 'form-edit-user';
					include "form-edit-user.php";
					break;
				case 'input-user';
					include "form-input-user.php";
					break;
				case 'hapus-user';
					include "hapus-user.php";
				case 'perkiraan':
					include "perkiraan.php";
					break;
				case 'tambah-perkiraan':
					include "tambah-perkiraan.php";
					break;
				case 'hapus-perkiraan':
					include "hapus-perkiraan.php";
					break;
				case 'ubah-perkiraan':
					include "ubah-perkiraan.php";
					break;
				case 'transsetup':
					include "transsetup.php";
					break;
				case 'tambah-transsetup':
					include "tambah-transsetup.php";
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
				case 'inventory':
					include "inventory.php";
					break;
				case 'tambah-inventory':
					include "tambah-inventory.php";
					break;
				case 'ubah-inventory':
					include "ubah-inventory.php";
					break;
				case 'hapus-inventory':
					include "hapus-inventory.php";
					break;
				case 'form-anggaran':
					include "form-anggaran.php";
					break;
				case 'mataanggaran':
					include "mataanggaran.php";
					break;
				case 'kelanggaran':
					include "kelanggaran.php";
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
				case 'tambah-anggaran':
					include "tambah-anggaran.php";
					break;
				case 'ubah-anggaran':
					include "ubah-anggaran.php";
					break;
				case 'hapus-anggaran':
					include "hapus-anggaran.php";
					break;
				case 'rapb':
					include "rapb.php";
					break;
				case 'bukubesaranggaran':
					include "bukubesaranggaran.php";
					break;
				case 'ubah-rapb':
					include "ubah-rapb.php";
					break;
				case 'form-jurnal':
					include "form-jurnal.php";
					break;
				case 'jentry':
					include "jentry.php";
					break;
				case 'hapus-jentry':
					include "hapus-jentry.php";
					break;
				case 'transrutin':
					include "transrutin.php";
					break;
				case 'list-jurnal-admin';
					include "list-jurnal-admin.php";
					break;
				case 'hapus-jurnal-admin':
					include "hapus-jurnal-admin.php";
					break;
				case 'main':
				default:
					include 'admin-dashboard.php';
					break;
			}
			?>
		</div>

		<!-- Footer -->
		<footer class="footer">
			<div class="footer-content">
				<span>&copy; 2025 LKSA Fajar Harapan.</span>
			</div>
		</footer>
	</div>

	<!-- JavaScript -->
	<script>
		// Set current date
		function setCurrentDate() {
			const now = new Date();
			const options = {
				weekday: 'long',
				year: 'numeric',
				month: 'long',
				day: 'numeric'
			};
			document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', options);
		}

		// Sidebar toggle functionality
		const sidebarToggle = document.getElementById('sidebarToggle');
		const sidebar = document.getElementById('sidebar');
		const sidebarOverlay = document.getElementById('sidebarOverlay');

		function toggleSidebar() {
			sidebar.classList.toggle('active');
			sidebarOverlay.classList.toggle('active');
			document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
		}

		function closeSidebar() {
			sidebar.classList.remove('active');
			sidebarOverlay.classList.remove('active');
			document.body.style.overflow = '';
		}



		// Close sidebar when clicking on menu items (mobile)
		document.querySelectorAll('.menu-item').forEach(item => {
			item.addEventListener('click', () => {
				if (window.innerWidth <= 768) {
					closeSidebar();
				}
			});
		});

		// Add loading states to buttons
		document.querySelectorAll('.action-btn').forEach(btn => {
			btn.addEventListener('click', function(e) {
				e.preventDefault();
				const icon = this.querySelector('i');
				const originalClass = icon.className;
				icon.className = 'loading';

				setTimeout(() => {
					icon.className = originalClass;
				}, 1000);
			});
		});



		// Auto-close sidebar on window resize
		window.addEventListener('resize', function() {
			if (window.innerWidth > 768) {
				closeSidebar();
			}
		});
	</script>
</body>

</html>
=======
<style>
#menu-toggle {
  display: none;
}
#menu {
  width: 180px;
  overflow: hidden;
  max-height: 0;
  padding: 0;
  margin: 0 auto;
  -webkit-transition: all 0.3s ease;
}
#menu-toggle:checked + #menu {
  max-height: 100px;
}
</style>

<?php 

    session_start();
	date_default_timezone_set('Asia/Jakarta');
	$date = date('Y-m-d');
	include 'koneksi.php';
	include 'functions.php';
	$user = $_SESSION['username'];
    $hak_akses = $_SESSION['hak_akses'];
    if(!isset($_SESSION['username']) && $hak_akses!="Admin"){
		?>
			<script language="JavaScript">
				alert('Anda Bukan Admin. Silahkan Login kembali!');
				document.location='index.php';
			</script>
		<?php
    }
	$cek = mysqli_query($koneksi,"select max(dtgl) as maxtgl from balance");
	$suk = $cek->fetch_assoc();
	$maxtgl = $suk['maxtgl'];
	if($maxtgl<$date){
		
		awalhari($koneksi);
        repairneraca($koneksi,$maxtgl);
		
	}

?>
<html>
<head>
	<title>Lembaga Kesejahteraan Sosial Anak Fajar Harapan | Admin</title>
	<link href="style.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	
    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
	
</head>
<body>
<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="964" bgcolor="#B0C4DE"><img src="image/header03_new.png" width="964" height="130" /></td>
	</tr>
</table>
<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td><hr></td>
	</tr>
</table>
<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
	<?php
		$cc = $koneksi->query("select * from company");
		$oo = $cc->fetch_assoc();
	?>	
	<tr>
		<td><h2><center><?php echo $oo['NAMA'];?></center></h2></td>
	</tr>
</table>

<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF" height="32">
		<td width="10">&nbsp;</td>
		<td width="944">
			<div class="nav">
				<ul>
					
					<li><a href="home-admin.php?page=form-master" title="Pengaturan"><u>P</u>engaturan</a></li>
					<li><a href="home-admin.php?page=form-fixedasset" title="Aset Tetap">A<u>s</u>set Tetap</a></li>
					<li><a href="home-admin.php?page=form-anggaran" title="Anggaran"><u>A</u>nggaran</a></li>
					<li><a href="home-admin.php?page=form-jurnal" title="Transaksi"><u>T</u>ransaksi</a></li>
					<li><a href="home-admin.php?page=form-laporan-new" title="Laporan"><u>L</u>aporan</a></li>
					<li><a href="login/logout.php" title="Log out"><u>L</u>og out</a></li>
				</li>
			</div>
		</td>
		<td width="10">&nbsp;</td>
	</tr>
</table>
<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF">
		<td>&nbsp;</td>
	</tr>
</table>
<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF">
		<td width="10">&nbsp;</td>
		<td rowspan="4" valign="top">
			<table width="938" height="auto" bgcolor="white" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="938" valign="top">
						<?php
						$page = (isset($_GET['page']))? $_GET['page'] : "main";
						switch ($page) {
							case 'form-fixedasset' : include "form-fixedasset.php"; break;
							case 'form-anggaran' : include "form-anggaran.php"; break;
							case 'mataanggaran' : include "mataanggaran.php"; break;
							case 'tambah-anggaran' : include "tambah-anggaran.php"; break;
							case 'hapus-anggaran' : include "hapus-anggaran.php"; break;
							case 'ubah-anggaran' : include "ubah-anggaran.php"; break;
							case 'kelanggaran' : include "kelanggaran.php"; break;
							case 'tambah-kelanggaran' : include "tambah-kelanggaran.php"; break;
							case 'hapus-kelanggaran' : include "hapus-kelanggaran.php"; break;
							case 'ubah-kelanggaran' : include "ubah-kelanggaran.php"; break;
							case 'ubah-jurnal-admin' : include "ubah-jurnal-admin.php"; break;
							case 'rapb' : include "rapb.php"; break;
							case 'ubah-rapb' : include "ubah-rapb.php"; break;
							case 'inventory' : include "inventory.php"; break;
							case 'ubah-inventory' : include "ubah-inventory.php"; break;
							case 'tambah-inventory' : include "tambah-inventory.php"; break;
							case 'hapus-inventory' : include "hapus-inventory.php"; break;
							case 'kelbrg' : include "kelbrg.php"; break;
							case 'ubah-kelbrg' : include "ubah-kelbrg.php"; break;
							case 'tambah-kelbrg' : include "tambah-kelbrg.php"; break;
							case 'hapus-kelbrg' : include "hapus-kelbrg.php"; break;
							case 'repairneraca' : include "repairneraca.php"; break;
							case 'refreshdet' : include "refreshdet.php"; break;
							case 'tambah-transsetup' : include "tambah-transsetup.php"; break;
							case 'form-jurnal' : include "form-jurnal.php"; break;
							case 'form-rc-tabungan' : include "form-rc-tabungan.php"; break;
							case 'form-rc-pinjaman' : include "form-rc-pinjaman.php"; break;
							case 'form-laporan' : include "form-laporan.php"; break;
							case 'form-laporan-new' : include "form-laporan-new.php"; break;
							case 'jentry' : include "jentry.php"; break;
							case 'transrutin' : include "transrutin.php"; break;
							case 'list-jurnal-admin' : include "list-jurnal-admin.php"; break;
							case 'bukubesar-admin' : include "bukubesar-admin.php"; break;
							case 'hapus-jurnal-admin' : include "hapus-jurnal-admin.php"; break;
							case 'hapus-jentry' : include "hapus-jentry.php"; break;
							case 'ubah-transsetup' : include "ubah-transsetup.php"; break;
							case 'hapus-transsetup' : include "hapus-transsetup.php"; break;
							case 'transsetup' : include "transsetup.php"; break;
							case 'form-master' : include "form-master.php"; break;
							case 'aturan' : include "aturan.php"; break;
							case 'tambah-perkiraan' : include "tambah-perkiraan.php"; break;
							case 'ubah-perkiraan' : include "ubah-perkiraan.php"; break;
							case 'hapus-perkiraan' : include "hapus-perkiraan.php"; break;
							case 'perkiraan' : include "perkiraan.php"; break;
							case 'company' : include "company.php"; break;
							case 'form-input-user' : include "form-input-user.php"; break;
							case 'form-view-user' : include "form-view-user.php"; break;
							case 'form-edit-user' : include "form-edit-user.php"; break;
							case 'hapus-user' : include "hapus-user.php"; break;
							case 'edit-user' : include "edit-user.php"; break;
							case 'input-user' : include "input-user.php"; break;
							case 'list-pinjaman' : include "list-pinjaman.php"; break;
							case 'list-tabungan' : include "list-tabungan.php"; break;
							case 'form-input-pinjaman' : include "form-input-pinjaman.php"; break;
							case 'form-input-bayar' : include "form-input-bayar.php"; break;
							case 'form-input-tabungan' : include "form-input-tabungan.php"; break;
							case 'input-bayar' : include "input-bayar.php"; break;
							case 'input-pinjaman' : include "input-pinjaman.php"; break;
							case 'input-tabungan' : include "input-tabungan.php"; break;
							case 'view-detail-member' : include "view-detail-member.php"; break;
							case 'form-ambil-tabungan' : include "form-ambil-tabungan.php"; break;
							case 'ambil-tabungan' : include "ambil-tabungan.php"; break;
							case 'pro-version' : include "pro-version.php"; break;
							case 'bukubesaranggaran' : include "bukubesaranggaran.php"; break;
							case 'main' :
							default : include 'about-login.php';	
						}
						?>
					</td>	
				</tr>
			</table>
		</td>
		<td width="10">&nbsp;</td>
	</tr>
</table>
<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#F8F8FF">
		<td>&nbsp;</td>
	</tr>
</table>
<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr bgcolor="#B0C4DE">
		<td height="36" colspan="5" bgcolor="#B0C4DE"><div align="right" style="margin:0 12px 0 0;"><font color="#000"></font><br></div></td>
	</tr>
</table>
<div align="center"></div>

</body>
</html>




>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
