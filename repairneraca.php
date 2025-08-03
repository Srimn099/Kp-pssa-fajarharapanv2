<?php
	include 'koneksi.php';
	$tgl_valid = $_POST['tgl_valid'];
	repairneraca($koneksi,$tgl_valid);
	mysqli_close($koneksi);
	?>

		<script type="text/javascript">
			alert ("Repair Neraca Sudah Dilakukan!");
			window.location.href="?page=form-jurnal";
		</script>
	
