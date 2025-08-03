<?php
date_default_timezone_set('Asia/Jakarta');
<<<<<<< HEAD
$date = date('Y-m-d');
?>

<!-- Tambahkan ini di bagian <head> jika belum ada -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
	.form-control,
	.form-select {
		border: 1px solid #000 !important;
	}

	.custom-padding {
		padding-top: 1rem;
		padding-bottom: 3rem;
	}
</style>


<div class="container mt-5">
	<div class="card shadow border-0 rounded-4 mx-auto" style="max-width: 720px;">
		<div class="card-header bg-primary text-white py-3 rounded-top-4">
			<h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Form Input User</h4>
		</div>
		<div class="card-body px-4 custom-padding">
			<form action="home-admin.php?page=input-user" method="POST" name="form-input-user">
				<div class="row g-4">
					<!-- Nama Lengkap -->
					<div class="col-md-12">
						<label class="form-label">Nama Lengkap</label>
						<input type="text" name="nama" maxlength="50" class="form-control" required>
					</div>

					<!-- Username -->
					<div class="col-md-12">
						<label class="form-label">Username</label>
						<input type="text" name="username" maxlength="25" class="form-control" required>
					</div>

					<!-- Password -->
					<div class="col-md-12">
						<label class="form-label">Password</label>
						<input type="password" name="password" maxlength="100" class="form-control" required>
					</div>

					<!-- Hak Akses -->
					<div class="col-md-12">
						<label class="form-label">Hak Akses</label>
						<select name="hak_akses" class="form-select" required>
							<option value="">-- Pilih Hak Akses --</option>
							<option value="Admin">Administrator</option>
							<option value="Member">Operator</option>
						</select>
					</div>
				</div>

				<!-- Tombol Aksi -->
				<div class="mt-5 d-flex gap-2 align-items-center justify-content-center">
					<a href="home-admin.php?page=form-view-user" class="btn btn-secondary">
						<i class="bi bi-arrow-left-circle"></i> Batal
					</a>
					<button type="submit" name="Submit" class="btn btn-success">
						<i class="bi bi-save"></i> Simpan
					</button>
				</div>
			</form>
		</div>
	</div>
=======
$date=date('Y-m-d');
?>
<div style="border:0; padding:10px; width:924px; height:auto;">
<form action="home-admin.php?page=input-user" method="POST" name="form-input-user">
	<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr height="46">
				<td width="10%">&nbsp;</td>
				<td width="25%">&nbsp;</td>
				<td width="65%"><font color="orange" size="2"><b>Form Input user</b></font></td>
			</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td width="25%"><input type="button" value="Cancel" onclick=location.href="home-admin.php?page=form-view-user" title="Cancel"><br /><br /></td>
			<td width="65%">&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Username</td>
			<td><input type="text" name="username" size="25" maxlength="25" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Nama</td>
			<td><input type="text" name="nama" size="50" maxlength="50" /></td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>Hak Akses</td>
			<td>
				<select name="hak_akses" >		
					<option value="Admin">Administrator</option>
					<option value="Member">Operator</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr height="46">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="Submit" value="Simpan">&nbsp;&nbsp;&nbsp;
				<input type="reset" name="reset" value="Reset"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
</div>