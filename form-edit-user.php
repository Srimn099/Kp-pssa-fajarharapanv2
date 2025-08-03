<<<<<<< HEAD
<?php
include "koneksi.php";
if (isset($_GET['username'])) {
	$username = $_GET['username'];
} else {
	die("Error. No USERNAME Selected!");
}

$query = "SELECT * FROM login WHERE username='$username'";
$sql = mysqli_query($koneksi, $query);
$hasil = mysqli_fetch_array($sql);
$username = $hasil['username'];
$nama = $hasil['nama'];
$hak_akses = $hasil['hak_akses'];
?>

<!-- Link Bootstrap jika belum ada -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
	input.form-control,
	select.form-select {
		border: 1px solid #ced4da !important;
	}
</style>

<div class="container mt-5">
	<div class="card shadow border rounded-4 mx-auto" style="max-width: 720px;">
		<div class="card-header bg-primary text-white rounded-top-4 py-3">
			<h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Data User <u><i><?= htmlspecialchars($username) ?></i></u></h4>
		</div>

		<div class="card-body px-4 py-4">
			<form action="home-admin.php?page=edit-user" method="POST" name="form-edit-user" enctype="multipart/form-data">
				<input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">

				<div class="mb-3">
					<label class="form-label">Username</label>
					<input type="text" class="form-control" value="<?= htmlspecialchars($username) ?>" disabled>
				</div>

				<div class="mb-3">
					<label class="form-label">Nama Lengkap</label>
					<input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>" required>
				</div>

				<div class="mb-4">
					<label class="form-label">Hak Akses</label>
					<select name="hak_akses" class="form-select" required>
						<option value="Admin" <?= $hak_akses == 'Admin' ? 'selected' : '' ?>>Administrator</option>
						<option value="Member" <?= $hak_akses == 'Member' ? 'selected' : '' ?>>Operator</option>
					</select>
				</div>

				<!-- Tombol Simpan dan Batal -->
				<div class="text-end">
					<a href="home-admin.php?page=form-view-user" class="btn btn-secondary">
						<i class="bi bi-x-circle"></i> Batal
					</a>
					<button type="submit" name="Submit" class="btn btn-success me-2">
						<i class="bi bi-save"></i> Simpan
					</button>

				</div>
			</form>
		</div>
	</div>
</div>

<?php mysqli_close($koneksi); ?>
=======
<div style="border:0; padding:10px; width:924px; height:auto;">
	<?php
	include "koneksi.php";
	if (isset($_GET['username'])) {
		$username = $_GET['username'];
	}
	else {
	die ("Error. No USERNAME Selected! ");	
	}
//Tampilkan data dari tabel member
	$query = "SELECT * FROM login WHERE username='$username'";
	$sql = mysqli_query($koneksi,$query);
	$hasil = mysqli_fetch_array ($sql);
	$username	= $hasil['username'];
	$nama	= $hasil['nama'];
	$hak_akses	= $hasil['hak_akses'];
	
?>
<form action="home-admin.php?page=edit-user" method="POST" name="form-edit-user" enctype="multipart/form-data">
	<input type="button" value="Kembali" onclick=location.href="home-admin.php?page=form-view-user" title="Kembali">
	<table width="860" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr bgcolor="#DFE6EF" height="30">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><b>Edit Data User <u><i><?=$username?></i></u></b></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Username</td>
			<td>:&nbsp;<?=$username?><input type="hidden" name="username" value="<?=$username?>"></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nama User</td>
			<td>:&nbsp;<input type="text" name="nama" size="50" value="<?=$nama?>"></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Hak Akses</td>
			<td>:&nbsp;
				<select name="hak_akses" >		
					<option value="Admin" <?php if($hak_akses=='Admin') echo "selected";?>>Administrator</option>
					<option value="Member" <?php if($hak_akses=='Member') echo "selected";?>>Operator</option>
				</select>

			
			</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Input">&nbsp;&nbsp;&nbsp;
				<input type="reset" name="reset" value="Reset"></td>
		</tr>
		
	</table>
</form>
<?php
//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
</div>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
