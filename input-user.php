<div style="border:0; padding:10px; width:860px; height:400;">
<?php
	if ($_POST['Submit'] == "Simpan") {
	$nama		= $_POST['nama'];
	$username		= $_POST['username'];
	$hak_akses		= $_POST['hak_akses'];
	
	//validasi data data kosong
	if (empty($_POST['username']) ||empty($_POST['nama'])||empty($_POST['hak_akses'])) {
		?>
			<script language="JavaScript">
				alert('Data Harap Dilengkapi!');
				document.location='home-admin.php?page=form-input-user';
			</script>
		<?php
	}
	else {
	include "koneksi.php";
	//cek username di database
	
//Masukan data ke Table data member

$input1	="INSERT INTO login (username, nama, hak_akses)
		VALUES ('$username','$nama','$hak_akses')";
$query_input1 =mysqli_query($koneksi,$input1);
//Masukan data ke Table login
	if ($query_input1) {
	//Jika Sukses
?>
		<script language="JavaScript">
		alert('Input Data User Berhasil!');
		document.location='home-admin.php';
		</script>
<?php
	}
	else {
	//Jika Gagal
	echo "Input Gagal!";
	}
//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
	}
}
?>
</div>