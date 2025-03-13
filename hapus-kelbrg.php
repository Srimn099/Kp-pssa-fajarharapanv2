<?php
	include 'koneksi.php';

	$kode = $_GET['kode'];
	$tanya	=	$koneksi->query("select * from inventory where kelompok='$kode'");
	$numrow = $tanya->num_rows;
	if($numrow==0){
		$sql = $koneksi->query("delete from kelbrg where kode='$kode'");
	?>

		<script type="text/javascript">
			alert ("Data Kelompok Aktiva Tetap Sudah Dihapus!");
			window.location.href="?page=kelbrg";
		</script>
	<?php
	}else{
	?>
		<script type="text/javascript">
			alert ("Data Kelompok Aktiva Tetap Sudah Digunakan tidak bisa dihapus!");
			window.location.href="?page=kelbrg";
		</script>
	<?php
	}
?>
