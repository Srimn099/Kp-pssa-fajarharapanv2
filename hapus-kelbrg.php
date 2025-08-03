<?php
<<<<<<< HEAD

include 'koneksi.php';

$kode = $_GET['kode'];
$tanya = $koneksi->query("SELECT * FROM inventory WHERE kelompok='$kode'");
$numrow = $tanya->num_rows;

if ($numrow == 0) {
	$sql = $koneksi->query("DELETE FROM kelbrg WHERE kode='$kode'");
?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		Swal.fire({
			icon: 'success',
			title: 'Berhasil!',
			text: 'Data Kelompok Aktiva Tetap telah dihapus.',
			confirmButtonColor: '#3085d6',
			confirmButtonText: 'OK'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = "?page=kelbrg";
			}
		});
	</script>
<?php
} else {
?>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		Swal.fire({
			icon: 'error',
			title: 'Gagal Menghapus!',
			text: 'Data Kelompok Aktiva Tetap sedang digunakan dan tidak bisa dihapus.',
			confirmButtonColor: '#d33',
			confirmButtonText: 'OK',
			customClass: {
				confirmButton: 'btn-mini'
			}
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = "home-admin.php?page=kelbrg";
			}
		});
	</script>
<?php
}
?>
<style>
	.btn-mini {
		padding: 7px 15px !important;
		font-size: 12px !important;
	}
</style>
=======
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
