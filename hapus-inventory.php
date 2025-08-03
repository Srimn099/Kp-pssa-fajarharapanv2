<?php
<<<<<<< HEAD
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inventno'])) {
	$inventno = $_POST['inventno'];
	$sql = $koneksi->query("DELETE FROM inventory WHERE inventno='$inventno'");
	echo 'success';
}
=======
include 'koneksi.php'; 
	$inventno = $_GET['inventno'];
	
		$sql = $koneksi->query("delete from inventory where inventno='$inventno'");

?>

<script type="text/javascript">
		alert ("Data Berhasil di Hapus");
		window.location.href="?page=inventory";
</script>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
