<<<<<<< HEAD
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="datatables-1.11.3/css/jquery.dataTables.min.css">

<script src="plugins/jquery/jquery.min.js"></script>
<script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="container mt-4">
	<div class="row mb-2 align-items-center">
		<!-- Tombol Kembali -->
		<div class="col-md-2 d-flex align-items-center">
			<a href="home-admin.php?page=form-master" class="btn btn-warning text-dark custom-btn-small">
				<i class="fas fa-arrow-left me-1"></i> Kembali
			</a>
		</div>

		<!-- Judul di tengah -->
		<div class="col-md-8 text-center">
			<h4 class="section-title mb-0">Daftar Pengguna</h4>
		</div>

		<!-- Ruang kosong kanan -->
		<div class="col-md-2"></div>
	</div>

	<!-- Baris 2: Tombol Tambah User di Tengah -->
	<div class="row mb-3">
		<div class="col text-center">
			<a href="home-admin.php?page=form-input-user" class="btn btn-success">
				<i class="fas fa-user-plus me-1"></i> Tambah User
			</a>
		</div>
	</div>
</div>

<div class="card shadow">
	<div class="card-body">
		<div class="table-responsive">
			<table id="tabel-data1" class="table table-bordered table-hover">
				<thead class="text-center">
					<tr>
						<th width="5%">No</th>
						<th width="25%">Username</th>
						<th width="45%">Nama</th>
						<th width="10%">Hak Akses</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include "koneksi.php";
					$query = "SELECT * FROM login";
					$result = mysqli_query($koneksi, $query);
					$no = 0;

					while ($row = mysqli_fetch_assoc($result)) {
						$no++;
						$username = htmlspecialchars($row['username']);
						$nama = htmlspecialchars($row['nama']);
						$hak_akses = htmlspecialchars($row['hak_akses']);
						echo "
								<tr class='text-center'>
									<td>$no</td>
									<td>$username</td>
									<td>$nama</td>
									<td>$hak_akses</td>
									<td>
										<a href='home-admin.php?page=form-edit-user&username=$username' class='btn btn-sm btn-primary'>
											<i class='fas fa-edit'></i> Edit
										</a>
										<a href='home-admin.php?page=hapus-user&username=$username' class='btn btn-sm btn-danger' onclick='return confirm(\"Yakin ingin menghapus user ini?\")'>
											<i class='fas fa-trash'></i> Hapus
										</a>
									</td>
								</tr>
							";
					}
					mysqli_close($koneksi);
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>

<script>
	$(document).ready(function() {
		$('#tabel-data1').DataTable();
	});
</script>


<style>
	body {
		font-family: 'Poppins', sans-serif;
		background-color: #f8fafc;
	}

	/* Judul seksi halaman */
	.section-title {
		position: relative;
		display: inline-block;
		font-size: 1.6rem;
		font-weight: 700;
		color: #3b5bdb;
		padding-bottom: 6px;
		margin-bottom: 10px;
	}

	.section-title::after {
		content: "";
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		width: 50%;
		height: 3px;
		background: linear-gradient(90deg, #4361ee, #7209b7);
		bottom: 0;
		border-radius: 5px;
		transition: 0.3s ease-in-out;
	}

	/* Animasi saat hover pada judul */
	.section-title:hover::after {
		width: 80%;
	}

	/* Responsive judul di layar kecil */
	@media (max-width: 576px) {
		.section-title {
			font-size: 1.2rem;
			text-align: center;
		}
	}

	/* Tabel header */
	.table thead tr th {
		background-color: #bcbcbc !important;
		color: black !important;
		text-align: center;
		vertical-align: middle;
	}

	/* DataTables - jarak filter pencarian */
	.dataTables_wrapper .dataTables_filter {
		margin-bottom: 1rem;
	}

	/* Gaya umum tombol */
	.btn {
		border-radius: 8px;
		font-weight: 500;
		transition: all 0.2s ease-in-out;
	}

	.btn:hover {
		opacity: 0.9;
	}

	/* Gaya tombol khusus */
	.btn-outline-secondary {
		color: #6c757d;
		border-color: #6c757d;
	}

	.btn-outline-secondary:hover {
		background-color: #6c757d;
		color: white;
	}

	/* Jika ingin mengatur ukuran ikon */
	.btn i {
		margin-right: 4px;
	}


	/* Tambah jarak bawah tabel */
	.table {
		margin-bottom: 1rem;
	}

	/* Responsive container jika diperlukan */
	.container {
		max-width: 100%;
	}

	/* Tambah jarak tombol dari judul */
	.btn-success {
		margin-top: 6px;
	}

	.custom-btn-small {
		padding: 8px 11px;
		line-height: 1.2;
		border-radius: 6px;
	}
</style>
=======
<head>
  <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<!--<div style="border:0; padding:10px; width:924spx; height:auto;"><br />-->
<center><font color="orange" size="2"><b>View Data User</b></font></center><br />
<input type="button" value="Tambah User" onclick=location.href="home-admin.php?page=form-input-user" title="Add User"><br /><br />
<div class="body">
<div class="table-responsive">
<table id="tabel-data1" class="table table-bordered table-striped table-hover js-basic-example dataTable" >
<thead>
<tr bgcolor="#FF6600">
	<th width="5%">No</td>&nbsp;
	<th width="25%" height="42">username</td>&nbsp;
	<th width="45%">NAMA</td>&nbsp;
	<th width="10%">Hak Akses</td>&nbsp;
	<th width="15%">Action</td>&nbsp;     
</tr>
</thead>
<tbody>
<?php
	include "koneksi.php";
	$Cari="SELECT * FROM login";
	$Tampil = mysqli_query($koneksi,$Cari);
	$nomer=0;
    while (	$hasil = mysqli_fetch_array ($Tampil)) {
			$username= stripslashes ($hasil['username']);
			$nama 	= stripslashes ($hasil['nama']);
			$hak_akses 	= stripslashes ($hasil['hak_akses']);
			
		{
	$nomer++;
?>
	<tr align="center">
		<td height="32"><?=$nomer?><div align="center"></div></td>
		<td><?=$username?><div align="center"></div></td>
		<td><?=$nama?><div align="center"></div></td>
		<td><?=$hak_akses?><div align="center"></div></td>
		<td bgcolor="#EEF2F7"><div align="center"><a href="home-admin.php?page=form-edit-user&username=<?=$username?>">Edit</a> | <a href="home-admin.php?page=hapus-user&username=<?=$username?>">Hapus</a></div></td>
	</tr>
	<?php  
		}
	}
//Tutup koneksi engine MySQL
	mysqli_close($koneksi);
?>
								 <script>
    $(document).ready(function(){
        $('#tabel-data1').DataTable();
    });
</script>
</tbody>
</table>
</div>
</div>
<!--</div>-->
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
