<?php
function difmonth($dtgl1, $dtgl2)
{
	$tanggal1 = new Datetime($dtgl1);
	$tanggal2 = new Datetime($dtgl2);
	$y = $tanggal2->diff($tanggal1)->y;
	$m = $tanggal2->diff($tanggal1)->m;

	$selisih = ($y * 12) + $m;
	return $selisih;
}

function awalhari($kon)
{
	//	echo "<script type='text/javascript'>alert('awal hari');</script>";
	date_default_timezone_set('Asia/Jakarta');
	$date = date('Y-m-d');
	$sql = mysqli_query($kon, "select max(dtgl) as maxtgl from balance");
	$oke = $sql->fetch_assoc();
	$tgl = $oke['maxtgl'];
	if ($tgl < $date) {

		$today = date('Y-m-d', strtotime($tgl));
		$nextday = date("Y-m-d", strtotime($today . "+1 day"));
		$tgl1 = $nextday; //date_add($tgl,date_interval_create_from_date_string("1 days"));
		while ($tgl1 <= $date) {
			$suir = mysqli_query($kon, "insert into balance select '$tgl1',cno_kira,0,nidrendbal,cdkbegbal,0,nidrendbal,cdkbegbal from balance where dtgl='$tgl'");
			$today = date('Y-m-d', strtotime($tgl1));
			$nextday = date("Y-m-d", strtotime($today . "+1 day"));
			$tgl1 = $nextday; //date_add($tgl1,date_interval_create_from_date_string("1 days"));

		}
		$co = mysqli_query($kon, "delete from counter");
		$ci = mysqli_query($kon, "alter table counter auto_increment=0");
	}
}


function repairneraca($koneksi, $tglvalid)
{
	$dd = $koneksi->query("select distinct DTGL from balance where dtgl>'$tglvalid'  order by dtgl");
	if ($dd) {
		$tgl = $tglvalid;
		$numrow = $dd->num_rows;
		//echo "<script type='text/javascript'>alert('$numrow');</script>";	
		while ($dodo = $dd->fetch_assoc()) {
			$vdtgl = $dodo['DTGL'];
			$uu = mysqli_query($koneksi, "update balance a,balance b set a.NIDRBEGBAL=b.NIDRENDBAL where a.cno_kira=b.cno_kira and a.dtgl='$vdtgl' and b.dtgl='$tgl'");
			$hari = date('d', strtotime($vdtgl));
			$bulan = date('m', strtotime($vdtgl));
			if ($bulan . $hari == '0101') {
				$sql1 = $koneksi->query("select sum(balance.nidrendbal) as dapat from balance,tabkira where balance.dtgl='$tgl' and balance.cno_kira=tabkira.cno_kira and tabkira.cgroup='D' and tabkira.kodebi='501' and tabkira.cno_kira not in (select cacctparent from tabkira)");
				$dapat1 = $sql1->fetch_assoc();
				$sql2 = $koneksi->query("select sum(balance.nidrendbal) as biaya from balance,tabkira where balance.dtgl='$tgl' and balance.cno_kira=tabkira.cno_kira and tabkira.cgroup='B' and tabkira.kodebi='601' and tabkira.cno_kira not in (select cacctparent from tabkira)");
				$biaya1 = $sql2->fetch_assoc();
				$laba1 = $dapat1['dapat'] - $biaya1['biaya'];
				$sql3 = $koneksi->query("update balance set nidrbegbal=nidrbegbal+'$laba1' where dtgl='$vdtgl' and cno_kira in (select cno_kira from tabkira where kodebi='401')");
				$sql31 = $koneksi->query("update tabkira set slakha=slakha+'$laba1' where kodebi='401'");

				$sql4 = $koneksi->query("select sum(balance.nidrendbal) as dapat from balance,tabkira where balance.dtgl='$tgl' and balance.cno_kira=tabkira.cno_kira and tabkira.cgroup='D' and tabkira.kodebi='502' and tabkira.cno_kira not in (select cacctparent from tabkira)");
				$dapat2 = $sql4->fetch_assoc();
				$sql5 = $koneksi->query("select sum(balance.nidrendbal) as biaya from balance,tabkira where balance.dtgl='$tgl' and balance.cno_kira=tabkira.cno_kira and tabkira.cgroup='B' and tabkira.kodebi='602' and tabkira.cno_kira not in (select cacctparent from tabkira)");
				$biaya2 = $sql5->fetch_assoc();
				$laba2 = $dapat2['dapat'] - $biaya2['biaya'];
				$sql6 = $koneksi->query("update balance set nidrbegbal=nidrbegbal+'$laba1' where dtgl='$vdtgl' and cno_kira in (select cno_kira from tabkira where kodebi='402'')");
				$sql61 = $koneksi->query("update tabkira set slakha=slakha+'$laba1' where kodebi='402'");



				$sql4 = $koneksi->query("update balance,tabkira set balance.nidrbegbal=0,balance.nidrendbal=0 where balance.dtgl='$vdtgl' and balance.cno_kira=tabkira.cno_kira and tabkira.cgroup in ('D','B')");
				$nres1 = mysqli_query($koneksi, "select * from tabkira where NPROFFLOSS=1");
				$mytabkir = $nres1->fetch_assoc();
				$vcgroup = $mytabkir['CGROUP'];
				$vcacctparent = $mytabkir['CACCTPARENT'];
				$vnlevel	=	$mytabkir['NLEVEL'];
				$i = 1;
				while ($i <= $vnlevel - 1) {
					$sql3 = $koneksi->query("update balance set nidrbegbal=nidrbegbal+'$laba' where dtgl='$vdtgl' and cno_kira='$vcacctparent'");
					$sql31 = $koneksi->query("update tabkira set slakha=slakha+'$laba' where cno_kira='$vcacctparent'");

					$nres1 = mysqli_query($koneksi, "select * from tabkira where CNO_KIRA='$vcacctparent'");
					$mytabkir = $nres1->fetch_assoc();
					$vcgroup = $mytabkir['CGROUP'];
					$vcAcctParent = $mytabkir['CACCTPARENT'];
					$i++;
				}
			}



			$ee = mysqli_query($koneksi, "create view debjur as select cno_kira,sum(idramount) as debet from jurnal where dtgl_trans='$vdtgl' and cdebkred='D' group by cno_kira");
			$kk = mysqli_query($koneksi, "create view kredjur as select cno_kira,sum(idramount) as kredit from jurnal where dtgl_trans='$vdtgl' and cdebkred='K' group by cno_kira");
			$gabung = mysqli_query($koneksi, "create view gabung as select balance.cno_kira,balance.nidrbegbal,ifnull(debjur.debet,0) as debet,ifnull(kredjur.kredit,0) as kredit from balance left join debjur on balance.cno_kira=debjur.cno_kira and balance.dtgl='$vdtgl' left join kredjur on balance.cno_kira=kredjur.cno_kira and balance.dtgl='$vdtgl' where balance.dtgl='$vdtgl'");
			$updab = mysqli_query($koneksi, "update balance,gabung set balance.nidrendbal=balance.nidrbegbal+gabung.debet-gabung.kredit where balance.cno_kira=gabung.cno_kira and balance.dtgl='$vdtgl' and balance.cno_kira in (select cno_kira from tabkira where cgroup='A' or cgroup='B')");
			$updsd = mysqli_query($koneksi, "update balance,gabung set balance.nidrendbal=balance.nidrbegbal+gabung.kredit-gabung.debet where balance.cno_kira=gabung.cno_kira and balance.dtgl='$vdtgl' and balance.cno_kira in (select cno_kira from tabkira where cgroup='S' or cgroup='D')");
			$hps1 = mysqli_query($koneksi, "drop view debjur");
			$hps1 = mysqli_query($koneksi, "drop view kredjur");
			$hps1 = mysqli_query($koneksi, "drop view gabung");
			$tgl = $vdtgl;
		}
		$updtabkira = mysqli_query($koneksi, "update tabkira,balance set tabkira.slakha=balance.nidrendbal where tabkira.cno_kira=balance.cno_kira and balance.dtgl='$tgl'");
	} else {
		echo "<script type='text/javascript'>alert('gagal repair');</script>";
	}
}




function jurnal($koneksi, $vdtgl, $vcket, $vcnokira, $vcdebkred, $vnidramount, $vcuser, $vnnotrans, $cno_bukti, $cproject)
{
	// Cek jika IDRAMOUNT kosong
	if (empty($vnidramount)) {
		// Set default value jika kosong
		$vnidramount = 0;  // atau berikan nilai lain yang sesuai
		// Bisa tampilkan pesan error jika diperlukan, namun validasi sudah dilakukan di sisi klien
	}

	// Lanjutkan dengan query insert
	$cjurntype = 'JU';
	$ctransflag = 'TR';
	$lautho = 'Y';

	$nres1 = mysqli_query($koneksi, "INSERT INTO jurnal (NNO_TRANS, DTGL_TRANS, CKET, CNO_KIRA, CDEBKRED, IDRAMOUNT, CJURNTYPE, CTRANSFLAG, LAUTHO, CUSER, CNO_BUKTI, CPROJECT) 
    VALUES ('$vnnotrans', '$vdtgl', '$vcket', '$vcnokira', '$vcdebkred', '$vnidramount', 'JU', 'TR', 'Y', '$vcuser', '$cno_bukti', '$cproject')");

	if (!$nres1) {
		echo "<script>alert('Gagal menyimpan data.');</script>";
		return;
	}

	// Lanjutkan kode lainnya seperti biasa
	// ...


	$date = date("Y-m-d");

	$nres1 = mysqli_query($koneksi, "insert into jurnal (NNO_TRANS,DTGL_TRANS,CKET,CNO_KIRA,CDEBKRED,IDRAMOUNT,CJURNTYPE,CTRANSFLAG,LAUTHO,CUSER,CNO_BUKTI,CPROJECT) values ('$vnnotrans','$vdtgl','$vcket','$vcnokira','$vcdebkred','$vnidramount','JU','TR','Y','$vcuser','$cno_bukti','$cproject')");

	$nres1 = mysqli_query($koneksi, "select * from tabkira where CNO_KIRA='$vcnokira'");
	$mytabkir = $nres1->fetch_assoc();
	$vcgroup = $mytabkir['CGROUP'];
	$vcacctparent = $mytabkir['CACCTPARENT'];
	$vnlevel	=	$mytabkir['NLEVEL'];
	if ($vcgroup == 'A' || $vcgroup == 'B') {
		if ($vcdebkred == 'D') {
			$vnnilai = $vnidramount;
		} else {
			$vnnilai = -$vnidramount;
		}
	} else {
		if ($vcdebkred == 'K') {
			$vnnilai = $vnidramount;
		} else {
			$vnnilai = -$vnidramount;
		}
	}
	$nres = mysqli_query($koneksi, "update tabkira set SLAKHA=SLAKHA+'$vnnilai' where CNO_KIRA='$vcnokira'");
	$nres = mysqli_query($koneksi, "update balance set NIDRENDBAL=NIDRENDBAL+'$vnnilai' where CNO_KIRA='$vcnokira' and DTGL>='$vdtgl'");
	$nres = mysqli_query($koneksi, "update balance set NIDRBEGBAL=NIDRBEGBAL+'$vnnilai' where CNO_KIRA='$vcnokira' and DTGL>'$vdtgl'");

	$i = 1;
	while ($i <= $vnlevel - 1) {
		$nres1 = mysqli_query($koneksi, "insert into jurnal (NNO_TRANS,DTGL_TRANS,CKET,CNO_KIRA,CDEBKRED,IDRAMOUNT,CJURNTYPE,CTRANSFLAG,LAUTHO,CUSER,CNO_BUKTI,CPROJECT) Values ('$vnnotrans','$vdtgl','$vcket','$vcacctparent','$vcdebkred','$vnidramount','JU','','Y','$vcuser','$cno_bukti','$cproject')");
		$nres = mysqli_query($koneksi, "update tabkira set SLAKHA=SLAKHA+'$vnnilai' where CNO_KIRA='$vcacctparent'");
		$nres = mysqli_query($koneksi, "update balance set NIDRENDBAL=NIDRENDBAL+'$vnnilai' where CNO_KIRA='$vcacctparent' and DTGL>='$vdtgl'");
		$nres = mysqli_query($koneksi, "update balance set NIDRBEGBAL=NIDRBEGBAL+'$vnnilai' where CNO_KIRA='$vcacctparent' and DTGL>'$vdtgl'");

		$nres1 = mysqli_query($koneksi, "select * from tabkira where CNO_KIRA='$vcacctparent'");
		$mytabkir = $nres1->fetch_assoc();
		$vcgroup = $mytabkir['CGROUP'];
		$vcAcctParent = $mytabkir['CACCTPARENT'];
		$i++;
	}
}


function konversiAngka($a)
{
	$ratus = '';
	$ribu = '';
	$ribu1 = '';
	$juta = '';
	$juta1 = '';
	$milyar = '';

	if (strlen($a) <= 3) {
		if (strlen($a) == 1 and $a == '0') {
			$ratus = 'Nol ';
		} else {
			$ratus = SUBSTR($a, 0, strlen($a));
		}
	}
	if (strlen($a) > 3 and strlen($a) <= 6) {
		$ratus = substr($a, -3);
		$ribu = SUBSTR($a, 0, strlen($a) - 3);
	}
	if (strlen($a) > 6 and strlen($a) <= 9) {
		$ratus = substr($a, -3);
		$ribu1 = SUBSTR($a, 0, strlen($a) - 3);
		$ribu = substr($ribu1, -3);
		$juta = SUBSTR($ribu1, 0, strlen($ribu1) - 3);
	}
	if (strlen($a) == 10) {
		$ratus = substr($a, -3);
		$ribu1 = SUBSTR($a, 0, strlen($a) - 3);
		$ribu = substr($ribu1, -3);
		$juta1 = SUBSTR($ribu1, 0, strlen($ribu1) - 3);
		$juta = substr($juta1, -3);
		$milyar = SUBSTR($juta1, 0, strlen($juta1) - 3);
	}
	if (strlen($a) == 4) {
		$d = '1';
	} else {
		$d = '0';
	}
	$b = '';
	if (!empty(trim($milyar))) {
		$b = $b . _angka($milyar, $d) . 'Milyar ';
	}

	if (!empty(TRIM($juta))) {
		$b = $b . _angka($juta, $d);
		if (!empty(_angka($juta, $d))) {
			$b = $b . ' Juta ';
		}
	}
	if (!empty(TRIM($ribu))) {
		$l = _angka($ribu, $d);
		$b = $b . $l;
		if (!empty($l)) {
			if (strtoupper($l) == 'SE') {
				$b = $b . 'ribu ';
			} else {
				$b = $b . 'Ribu ';
			}
		}
	}
	if (!empty(TRIM($ratus))) {
		if (strtoupper(TRIM($ratus)) <> 'NOL') {
			$b = $b . _angka($ratus, $d);
		} else {
			$b = 'Nol ';
		}
	}
	return $b;
}
function _angka($r, $s)
{
	$c = '';
	if (strlen($r) == 1) {
		$c = _angka1($r);
		if ($r == '1' and $s == '1') {
			$c = 'Se';
		}
	} else {
		if (strlen($r) == 2) {
			if (SUBSTR($r, 0, 1) == '1') {
				if (SUBSTR($r, 1, 1) == '1') {
					$c = 'Sebelas ';
				} else {
					if (SUBSTR($r, 1, 1) == '0') {
						$c = 'Sepuluh ';
					} else {
						$c = _angka1(SUBSTR($r, 1, 1)) . 'Belas ';
					}
				}
			} else {
				if (SUBSTR($r, 1, 1) == '0') {
					$c = _angka1(SUBSTR($r, 0, 1)) . 'Puluh ';
				} else {
					$c = _angka1(SUBSTR($r, 0, 1)) . 'Puluh ' . _angka1(SUBSTR($r, 1, 1));
				}
			}
		} else {
			if (SUBSTR($r, 1, 1) == '1') {
				if (SUBSTR($r, 2, 1) == '1') {
					$c = 'Sebelas ';
				} else {
					if (SUBSTR($r, 2, 1) == '0') {
						$c = 'Sepuluh ';
					} else {
						$c = _angka1(SUBSTR($r, 2, 1)) . 'Belas ';
					}
				}
			} else {
				if (SUBSTR($r, 1, 1) == '0') {
					if (SUBSTR($r, 2, 1) <> '0') {
						$c = _angka1(SUBSTR($r, 2, 1));
					}
				} else {
					if (SUBSTR($r, 2, 1) == '0') {
						$c = _angka1(SUBSTR($r, 1, 1)) . 'Puluh ';
					} else {
						$c = _angka1(SUBSTR($r, 1, 1)) . 'Puluh ' . _angka1(SUBSTR($r, 2, 1));
					}
				}
			}
			if (SUBSTR($r, 0, 1) == '1') {
				$c = 'Seratus ' . $c;
			} else {
				if (SUBSTR($r, 0, 1) <> '0') {
					$c = _angka1(SUBSTR($r, 0, 1)) . 'Ratus ' . $c;
				}
			}
		}
	}
	return $c;
}


function _angka1($a)
{
	$T  = '';
	if ($a == '1') {
		$T = 'Satu ';
	}
	if ($a == '2') {
		$T = 'Dua ';
	}
	if ($a == '3') {

		$T = 'Tiga ';
	}
	if ($a == '4') {
		$T = 'Empat ';
	}
	if ($a == '5') {
		$T = 'Lima ';
	}
	if ($a == '6') {
		$T = 'Enam ';
	}
	if ($a == '7') {
		$T = 'Tujuh ';
	}
	if ($a == '8') {
		$T = 'Delapan ';
	}
	if ($a == '9') {
		$T = 'Sembilan ';
	}
	return $T;
}
