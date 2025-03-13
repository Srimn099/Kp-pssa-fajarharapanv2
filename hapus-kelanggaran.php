<?php
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
