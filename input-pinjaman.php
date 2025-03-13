<body bgcolor="#EEF2F7">
<?php
date_default_timezone_set('Asia/Jakarta');
include 'koneksi.php';

$date=date('Y-m-d');
$username	= $_POST['username'];
	$nama		= $_POST['nama'];
	$sisajasa 		= $_POST['tjasa'];
	$tgl_transaksi	= $_POST['tgl_pinjaman']; //."-".$_POST['bln_transaksi']."-".$_POST['tgl_transaksi'];
	$jml_transaksi	= $_POST['jml_transaksi'];
	$plafon = $_POST['saldo_total'];
	$jangka = $_POST['jangka'];
	//validasi data jika data kosong
	if (empty($_POST['jml_transaksi'])) {
	?>
		<script language="JavaScript">
			alert('Masukan Jumlah transaksi!');
			document.location='home-admin.php?page=list-pinjaman';
		</script>
	<?php
	}
	else {
	//Masukan data ke Table pinjaman
		if($tgl_transaksi==$date){
			$cnt=mysqli_query($koneksi,"insert into counter (cnick) values ('$user')");
			$cnt1=mysqli_query($koneksi,"select max(id) as maxtr from counter where cnick='$user'");
			$ii=$cnt1->fetch_assoc();
			$vnnotrans=$ii['maxtr'];
		}else{
			$cnt1=mysqli_query($koneksi,"select max(NNO_TRANS) as maxtr from jurnal where DTGL_TRANS='$tgl_transaksi'");
			$ii=$cnt1->fetch_assoc();
			$numrow=$ii->num_rows;
			if($numrow==0){
				$vnnotrans=1;
			}else{
				$maxtr=$ii['maxtr'];
				$vnnotrans=$maxtr+1;
			}
	
		}
		$input	="INSERT INTO pinjaman (username, nama, tgl_transaksi, pokok,jasa,dk,nno_trans) VALUES ('$username','$nama','$tgl_transaksi','$jml_transaksi',0,'D','$vnnotrans)";
		$query_input =mysqli_query($koneksi,$input);
		
		$aturan = mysqli_query($koneksi,"select * from aturan");
		$atur = mysqli_fetch_array($aturan);
		$accpiutang = $atur['accpiutang'];
		$acckas = $atur['acckas'];
		$accpendapatan = $atur['accpendapatan'];
		$vcket = 'Cair Pinjaman '.$username.' '.$nama;
		$vcket1 = 'Jasa Pinjaman '.$username.' '.$nama;
		jurnal($koneksi,$tgl_transaksi,$vcket,$accpiutang,'D',$jml_transaksi,$user,$vnnotrans);
		jurnal($koneksi,$tgl_transaksi,$vcket,$acckas,'K',$jml_transaksi-$tjasa,$user,$vnnotrans);
		if($tjasa>0){
			jurnal($koneksi,$tgl_transaksi,$vcket1,$accpendapatan,'K',$tjasa,$user,$vnnotrans);
		}
	
	//Update pinjaman di tabel member
	$update="UPDATE member SET pinjaman=pinjaman + $jml_transaksi WHERE username='$username'";
	$aturan = mysqli_query($koneksi,"select * from aturan");
	$aa=$aturan->fetch_assoc();
	$jasa = round($plafon*$aa['rate']/1200,-2);
	$angpokok = round($plafon/$jangka,-2);
	$tanggal = $tgl_transaksi;
	$vnangpokok = 0;
	$dedel = mysqli_query($koneksi,"delete from detangsur where username='$username'");
	for($i=1;$i<=$jangka;$i++){
		$vdtgl = date("Y-m-d", strtotime($tanggal. "+$i month"));
		if($i<$jangka){
			$ss = mysqli_query($koneksi,"insert into detangsur (username,nourtr,dtgl,pokok,jasa,angpokok,angjasa) values ('$username','$i','$vdtgl','$angpokok','$jasa',0,0)");
		}else{
			$vnang = $plafon-$vnangpokok;
			$ss = mysqli_query($koneksi,"insert into detangsur (username,nourtr,dtgl,pokok,jasa,angpokok,angjasa) values ('$username','$i','$vdtgl','$vnang','$jasa',0,0)");
		}
		$vnangpokok= $vnangpokok+$angpokok;
		
	}
	$query_update =mysqli_query($koneksi,$update);
		if ($query_update) {
		//Jika Sukses
	?>
		<script language="JavaScript">
		alert('Data Pinjaman Berhasil Diinput!');
		document.location='home-admin.php?page=list-pinjaman';
		</script>
	<?php
	}
	else {
	//Jika Gagal
	echo "Pinjaman Gagal Diinput, Silahkan diulangi!";
	}
	}
	/*else {
	//Jika Gagal
	echo "Pinjaman Gagal Diinput, Silahkan diulangi!";
	}
	}*/
	//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
</body>