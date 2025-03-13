<?php
include 'koneksi.php'; 

	$tanggal = $_GET['tanggal'];
	$notrans = $_GET['notrans'];
	$dtgl = date('Y-m-d',strtotime($tanggal));
		$sql = $koneksi->query("delete from jurnal where DTGL_TRANS='$dtgl' and NNO_TRANS='$notrans'");
	$prevday = date("Y-m-d", strtotime($dtgl. "-1 day"));
	repairneraca($koneksi,$prevday)
?>

<script type="text/javascript">
		alert ("Data Jurnal Berhasil di Hapus");
		window.location.href="?page=list-jurnal-admin";
</script>
