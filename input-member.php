<div style="border:0; padding:10px; width:860px; height:400;">
<?php
	if ($_POST['Submit'] == "Input") {
	$nama		= $_POST['nama'];
	$nik		= $_POST['nik'];
	$tgl_lahir	= $_POST['tgln_lahir']; //."-".$_POST['bln_lahir']."-".$_POST['tgl_lahir'];
	$jenis_kelamin	= $_POST['jenis_kelamin'];
	$alamat		= $_POST['alamat'];
	$no_hp		= $_POST['no_hp'];
	
	//validasi data data kosong
	if (empty($_POST['username']) ||empty($_POST['nama'])||empty($_POST['nik'])) {
		?>
			<script language="JavaScript">
				alert('Data Harap Dilengkapi!');
				document.location='home-admin.php?page=form-input-member';
			</script>
		<?php
	}
	else {
	include "koneksi.php";
	//cek username di database
	$cif = mysqli_query($koneksi,"select max(username) as maxcif from member");
	$cc=$cif->fetch_assoc();
	if($cc->num_rows>0){
	$urutan = (int) $cc['maxcif'];
 
// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;
 
$username = sprintf("%06s", $urutan);
	
	}else{
$username='000001';		
	}
	
//Masukan data ke Table data member

$input1	="INSERT INTO member (username, nama, nik, tgl_lahir, jenis_kelamin, alamat,  no_hp)
		VALUES ('$username','$nama','$nik','$tgl_lahir','$jenis_kelamin','$alamat','$no_hp')";
$query_input1 =mysqli_query($koneksi,$input1);
//Masukan data ke Table login
	if ($query_input1) {
	//Jika Sukses
?>
		<script language="JavaScript">
		alert('Input Data Member Berhasil!');
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