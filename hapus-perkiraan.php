<?php
include 'koneksi.php'; 
	$cno_kira = $_GET['cno_kira'];
	$sql = $koneksi->query("select CNO_KIRA from jurnal where CNO_KIRA='$cno_kira'");
	$numrow=$sql->num_rows;
	if($numrow==0){

		$sql = $koneksi->query("delete from tabkira where CNO_KIRA='$cno_kira'");

?>

<script type="text/javascript">
		alert ("Data Berhasil di Hapus");
		window.location.href="?page=perkiraan";
</script>
<?php
	}else{
?>
<script type="text/javascript">
		alert ("Perkiraan Yang Sudah Bertransaksi Tidak Bisa Dihapus!");
		window.location.href="?page=perkiraan";
</script>

	<?php
	}
?>