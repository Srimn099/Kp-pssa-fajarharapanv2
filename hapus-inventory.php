<?php
include 'koneksi.php'; 
	$inventno = $_GET['inventno'];
	
		$sql = $koneksi->query("delete from inventory where inventno='$inventno'");

?>

<script type="text/javascript">
		alert ("Data Berhasil di Hapus");
		window.location.href="?page=inventory";
</script>
