<?php
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
