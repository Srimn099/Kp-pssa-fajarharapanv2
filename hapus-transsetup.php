<?php
	include 'koneksi.php';
	$id = $_GET['id'];
	
		$sql = $koneksi->query("delete from transsetup where id='$id'");
	if($sql){
?>

<script type="text/javascript">
		alert ("Data Berhasil di Hapus");
		window.location.href="home-admin.php?page=transsetup";
</script>
<?php
	}
	mysqli_close($koneksi);
?>