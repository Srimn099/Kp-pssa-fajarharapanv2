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




