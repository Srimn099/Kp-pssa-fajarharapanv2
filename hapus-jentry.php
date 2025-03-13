<?php
include 'koneksi.php'; 
	$id = $_GET['id'];
	$cno_kira = $_GET['cno_kira'];
		$sql = $koneksi->query("delete from tempjur where id='$id' and cno_kira='$cno_kira'");
	?>

		<script type="text/javascript">
			alert ("Data Sudah Dihapus!");
			window.location.href="?page=jentry";
		</script>
	
