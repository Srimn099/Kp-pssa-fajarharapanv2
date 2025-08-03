<?php
<<<<<<< HEAD
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['kodekel'])) {
	$kodekel = $_POST['kodekel'];

	// Cek apakah kodekel digunakan di mstanggaran
	$tanya = $koneksi->query("SELECT * FROM mstanggaran WHERE kodekel='$kodekel'");
	$numrow = $tanya->num_rows;

	if ($numrow == 0) {
		$sql = $koneksi->query("DELETE FROM kelanggaran WHERE kodekel='$kodekel'");
		echo 'success';
	} else {
		echo 'used';
	}
}
=======
	include 'koneksi.php';

	$kode = $_GET['kodekel'];
	$tanya	=	$koneksi->query("select * from mstanggaran where kodekel='$kode'");
	$numrow = $tanya->num_rows;
	if($numrow==0){
		$sql = $koneksi->query("delete from kelanggaran where kodekel='$kode'");
	?>

		<script type="text/javascript">
			alert ("Data Kelompok Anggaran Sudah Dihapus!");
			window.location.href="?page=mataanggaran";
		</script>
	<?php
	}else{
	?>
		<script type="text/javascript">
			alert ("Data Kelompok Anggaran Sudah Digunakan tidak bisa dihapus!");
			window.location.href="?page=mataanggaran";
		</script>
	<?php
	}
?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
