<body bgcolor="#EEF2F7">
<?php
		date_default_timezone_set('Asia/Jakarta');
	include 'koneksi.php';

$date=date('Y-m-d');
$username	= $_POST['username'];
	$nama		= $_POST['nama'];
	$tgl_tabungan	= $_POST['tgl_tabungan']; //$_POST['thn_tabungan']."-".$_POST['bln_tabungan']."-".$_POST['tgl_tabungan'];
	$jml_tabungan	= $_POST['jml_tabungan'];
	$jenis = $_POST['jenis'];
	//validasi data jika data kosong
	if (empty($_POST['jml_tabungan'])) {
	?>
		<script language="JavaScript">
			alert('Masukan Nilai Transaksi!');
			document.location='home-admin.php?page=list-tabungan';
		</script>
	<?php
	}
	else {
	//Masukan data ke Table tabungan
	//echo "<script type='text/javascript'>alert('$tgl_tabungan');</script>";
if($tgl_tabungan==$date){
			$cnt=mysqli_query($koneksi,"insert into counter (cnick) values ('$user')");
			$cnt1=mysqli_query($koneksi,"select max(id) as maxtr from counter where cnick='$user'");
			$ii=$cnt1->fetch_assoc();
			$vnnotrans=$ii['maxtr'];
		}else{
			$cnt1=mysqli_query($koneksi,"select max(NNO_TRANS) as maxtr from jurnal where DTGL_TRANS='$tgl_tabungan'");
			$ii=$cnt1->fetch_assoc();
			$numrow=$ii->num_rows;
			if($numrow==0){
				$vnnotrans=1;
			}else{
				$maxtr=$ii['maxtr'];
				$vnnotrans=$maxtr+1;
			}
	
		}
		
		$aturan = mysqli_query($koneksi,"select * from aturan");
		$atur = mysqli_fetch_array($aturan);
		$acckas = $atur['acckas'];
		if($jenis=='P'){
			$accsimpanan = $atur['accsimpok'];
			$jj = 'Simp. Pokok';
		}else if($jenis=='S'){
			$accsimpanan = $atur['accsimsuka'];
			$jj = 'Simp. Manasuka';
		}else{
			$accsimpanan = $atur['accsimjib'];
			$jj = 'Simpanan Wajib';
		}
		$vcket = 'Setor Simpanan '.$jj.' '.$username.' '.$nama;
		jurnal($koneksi,$tgl_tabungan,$vcket,$accsimpanan,'K',$jml_tabungan,$user,$vnnotrans);
		jurnal($koneksi,$tgl_tabungan,$vcket,$acckas,'D',$jml_tabungan,$user,$vnnotrans);
	
	$input	="INSERT INTO simpanan (username, nama, tgl_tabungan, jml_tabungan,dk,jen,nno_trans) VALUES ('$username','$nama','$tgl_tabungan','$jml_tabungan','K','$jenis','$vnnotrans')";
	//echo "<script type='text/javascript'>alert('$input');</script>";
	
	$query_input =mysqli_query($koneksi,$input);
	//Update tabungan di tabel member
	if($jenis=='P'){
	$update="UPDATE member SET simpok=ifnull(simpok,0) + $jml_tabungan WHERE username='$username'";	
	}elseif($jenis=='W'){
	$update="UPDATE member SET simjib=ifnull(simjib,0) + $jml_tabungan WHERE username='$username'";	
		
	}else{
	$update="UPDATE member SET simsuka=ifnull(simsuka,0) + $jml_tabungan WHERE username='$username'";	
		
	}
	
	$query_update =mysqli_query($koneksi,$update);
		if ($query_update) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Data Setoran Simpanan Berhasil Disimpan!');
		document.location='home-admin.php?page=list-tabungan';
		</script>
	<?php
	}
	else {
	//Jika Gagal
	echo "Setoran Simpanan Gagal Diinput, Silahkan diulangi!";
	}
	}
	//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
</body>