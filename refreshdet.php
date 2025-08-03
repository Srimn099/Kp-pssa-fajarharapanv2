<?php
include 'koneksi.php';

	$aturan = mysqli_query($koneksi,"select * from aturan");
	$aa=$aturan->fetch_assoc();
	$rate = $aa['rate'];
	$pinjaman = mysqli_query($koneksi,"select username,dreal,jangka from  member where pinjaman>0 order by username");
	while($pipin = $pinjaman->fetch_assoc()){
		$username = $pipin['username'];
		$tglreal = $pipin['dreal'];
		$jangka = $pipin['jangka'];
		$plaf = mysqli_query($koneksi,"select username,if(dk='D',sum(pokok),0)-if(dk='K',sum(pokok),0) as plafond from pinjaman where username='$username' and tgl_transaksi<='$tglreal' group by username");
		$plof = $plaf->fetch_assoc();
		if($plof){
			$plafon = $plof['plafond'];
			$jasa = round($plafon*$rate/1200,-2);
			
			$angpokok = round($plafon/$jangka,-2);
			$tanggal = $tglreal;
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
			$trx = mysqli_query($koneksi,"select username,sum(pokok) as angsurpokok from pinjaman where username='$username' and tgl_transaksi>'$tglreal'");
		
			$angsurpokok = $trx->fetch_assoc();
			$totangsurpokok = $angsurpokok['angsurpokok'];
			
			if($totangsurpokok>0){
				
				$qjadwal = mysqli_query($koneksi,"select * from detangsur where username='$username' order by nourtr");
				while($qdet = $qjadwal->fetch_assoc()){
					$wjbpokok = $qdet['pokok'];
					$nourtr = $qdet['nourtr'];
					
				if($totangsurpokok>$wjbpokok){
						$angpokok=$wjbpokok;
					}else{
						$angpokok = $totangsurpokok;
					}
					//echo "<script type='text/javascript'>alert('$angpokok');</script>";	
					$totangsurpokok=$totangsurpokok-$angpokok;
					$qupd = mysqli_query($koneksi,"update detangsur set angpokok='$angpokok' where username='$username' and nourtr='$nourtr'");
				
				}
			}
		
			$trx1 = mysqli_query($koneksi,"select username,sum(jasa) as angsurjasa from pinjaman where username='$username' and tgl_transaksi>'$tglreal'");
		
			$angsurjasa = $trx1->fetch_assoc();
			$totangsurjasa = $angsurjasa['angsurjasa'];
			if($totangsurjasa>0){
				$qjadwal1 = mysqli_query($koneksi,"select * from detangsur where username='$username' order by nourtr");
				while($qdet1 = $qjadwal1->fetch_assoc()){
					$wjbjasa = $qdet1['jasa'];
					$nourtr = $qdet1['nourtr'];
					if($totangsurjasa>$wjbjasa){
						$angjasa=$wjbjasa;
					}else{
						$angjasa = $totangsurjasa;
					}
					$totangsurjasa=$totangsurjasa-$angjasa;
					$qupd = mysqli_query($koneksi,"update detangsur set angjasa='$angjasa' where username='$username' and nourtr='$nourtr'");
				
				}
			}
		
		}
	}
	mysqli_close($koneksi);
?>
<script type="text/javascript">
			alert ("Refresh Jadwal Angsuran Sudah Dilakukan!");
			window.location.href="?page=form-jurnal";
		</script>