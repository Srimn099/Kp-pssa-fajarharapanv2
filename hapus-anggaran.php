<?php
<<<<<<< HEAD
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kode'])) {
	$kode = $_POST['kode'];

	// Cek apakah kode sudah digunakan di tabel anggaran
	$cek = $koneksi->query("SELECT * FROM anggaran WHERE kode='$kode'");
	$numrow = $cek->num_rows;

	if ($numrow == 0) {
		// Aman untuk dihapus
		$hapus = $koneksi->query("DELETE FROM mstanggaran WHERE kode='$kode'");
		echo 'success';
	} else {
		// Sudah digunakan, tidak bisa dihapus
		echo 'used';
	}
}
=======
	include 'koneksi.php';

	$kode = $_GET['kode'];
	$tanya	=	$koneksi->query("select * from anggaran where kode='$kode'");
	$numrow = $tanya->num_rows;
	if($numrow==0){
		$sql = $koneksi->query("delete from mstanggaran where kode='$kode'");
	?>

		<script type="text/javascript">
			alert ("Data Mata Anggaran Sudah Dihapus!");
			window.location.href="?page=mataanggaran";
		</script>
	<?php
	}else{
	?>
		<script type="text/javascript">
			alert ("Data Mata Anggaran Sudah Digunakan tidak bisa dihapus!");
			window.location.href="?page=mataanggaran";
		</script>
	<?php
	}
?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
