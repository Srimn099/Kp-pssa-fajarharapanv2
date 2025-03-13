<?php
	include "koneksi.php";
	if (isset($_GET['username'])) {
		$username = $_GET['username'];
		$hak_akses = $_GET['hak_akses'];
		$nama = $_GET['nama'];
			$upd = "update login set nama='$nama',hak_akses='$hak_akses' WHERE username='$username'";
			$sql = mysqli_query ($koneksi,$upd);
			if ($sql) {		
				?>
					<script language="JavaScript">
					alert('Anggota <?=$username?> Berhasil diupdate!');
					document.location='home-admin.php?page=form-view-user';
					</script>
				<?php		
			} else {
				echo "<h2><font color=red><center>Data gagal diupdate!</center></font></h2>";	
			}
		}
	}
	mysqli_close($koneksi);
?>