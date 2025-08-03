<body bgcolor="#EEF2F7">
<?php
			date_default_timezone_set('Asia/Jakarta');
	include 'koneksi.php';

$date=date('Y-m-d');
$username	= $_POST['username'];
	$nama		= $_POST['nama'];
	$tgl_bayar	= $_POST['tgl_bayar'] ;//."-".$_POST['bln_bayar']."-".$_POST['tgl_bayar'];
	$jml_bayar	= $_POST['jml_bayar'];
	$sql=mysqli_query($koneksi,"select pinjaman from member where username='$username'");
	$sequel=$sql->fetch_assoc();
	$saldo=$sequel['pinjaman'];
//	echo "<script type='text/javascript'>alert('$jml_bayar');</script>";
	$byrpokok = $_POST['byrpokok'];
	//echo "<script type='text/javascript'>alert('$byrpokok');</script>";
	$byrjasa = $jml_bayar-$byrpokok;
	//validasi data jika data kosong
	if (empty($jml_bayar) || $byrpokok>$saldo) {
	?>
		<script language="JavaScript">
			alert('Jumlah Pembayaran Kosong atau Pembayaran Melebihi Saldo! Mohon Diinput ulang!');
			document.location='home-admin.php?page=list-pinjaman';
		</script>
	<?php
	}
	else {
	//Masukan data ke Table bayar
		if($tgl_bayar==$date){
			$cnt=mysqli_query($koneksi,"insert into counter (cnick) values ('$user')");
			$cnt1=mysqli_query($koneksi,"select max(id) as maxtr from counter where cnick='$user'");
			$ii=$cnt1->fetch_assoc();
			$vnnotrans=$ii['maxtr'];
		}else{
			$cnt1=mysqli_query($koneksi,"select max(NNO_TRANS) as maxtr from jurnal where DTGL_TRANS='$tgl_bayar'");
			
			$numrow=$cnt1->num_rows;
			if($numrow==0){
				$vnnotrans=1;
			}else{
				$maxtr=$ii['maxtr'];
				$vnnotrans=$maxtr+1;
			}
	
		}
		$input = "insert into pinjaman (username,nama,tgl_transaksi,pokok,jasa,dk,nno_trans) values ('$username','$nama','$tgl_bayar','$byrpokok','$byrjasa','K','$vnnotrans')";
		$query_input =mysqli_query($koneksi,$input);
		
		$aturan = mysqli_query($koneksi,"select * from aturan");
		$atur = mysqli_fetch_array($aturan);
		$accpiutang = $atur['accpiutang'];
		$acckas = $atur['acckas'];
		$accpendapatan = $atur['accpendapatan'];
		$vcket = 'Angsuran Pinjaman '.$username.' '.$nama;
		$vcket1 = 'Jasa Pinjaman '.$username.' '.$nama;
		jurnal($koneksi,$tgl_bayar,$vcket,$accpiutang,'K',$byrpokok,$user,$vnnotrans);
		jurnal($koneksi,$tgl_bayar,$vcket,$acckas,'D',$jml_bayar,$user,$vnnotrans);
		if($byrjasa>0){
			jurnal($koneksi,$tgl_bayar,$vcket,$accpendapatan,'K',$byrjasa,$user,$vnnotrans);
		}



	$input	="INSERT INTO pinjaman (username, nama, tgl_transaksi, pokok,jasa,dk,nno_trans) VALUES ('$username','$nama','$tgl_bayar','$byrpokok','$byrjasa','K','$vnnotrans)";
	$query_input =mysqli_query($koneksi,$input);
	//Update pinjaman di tabel member
	$update="UPDATE member SET pinjaman=pinjaman - $byrpokok WHERE username='$username'";
	$query_update =mysqli_query($koneksi,$update);
	$vnbyrpokok = $byrpokok;
	$vnbyrjasa = $byrjasa;
	$dedet = mysqli_query($koneksi,"select * from detangsur where username='$username' and pokok-angpokok>0 order by nourtr");
	while($dodet=$dedet->fetch_assoc()){
		$nourtr = $dodet['nourtr'];
		if($vnbyrpokok>=$dodet['pokok']-$dodet['angpokok']){
			$vnbyrpokok = $vnbyrpokok-($dodet['pokok']-$dodet['angpokok']);
			
			$hihi = mysqli_query($koneksi,"update detangsur set angpokok=pokok where username='$username' and nourtr='$nourtr'");
			
		}else{
			if($vnbyrpokok>0){
				$hihi = mysqli_query($koneksi,"update detangsur set angpokok='$vnbyrpokok' where username='$username' and nourtr='$nourtr'");
			}
		}
	}

	$dedet = mysqli_query($koneksi,"select * from detangsur where username='$username' and jasa-angjasa>0 order by nourtr");
	while($dodet=$dedet->fetch_assoc()){
		$nourtr = $dodet['nourtr'];
		if($vnbyrjasa>=$dodet['jasa']-$dodet['angjasa']){
			$vnbyrjasa = $vnbyrjasa-($dodet['jasa']-$dodet['angjasa']);
			
			$hihi = mysqli_query($koneksi,"update detangsur set angjasa=jasa where username='$username' and nourtr='$nourtr'");
			
		}else{
			if($vnbyrjasa>0){
				$hihi = mysqli_query($koneksi,"update detangsur set angjasa='$vnbyrjasa' where username='$username' and nourtr='$nourtr'");
			}
		}
	}

		
	if ($query_update) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Data Pembayaran Pinjaman Berhasil Diinput!');
		document.location='home-admin.php?page=list-pinjaman';
		</script>
	<?php
	}
	else {
	//Jika Gagal
	echo "Pembayaran Gagal Diinput, Silahkan diulangi!";
	}
	}
	//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
</body>