<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
include 'koneksi.php';
include 'functions.php';
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d');
$sss = $koneksi->query("select * from mstanggaran order by kode");

// Pastikan user sudah login
$user = $_SESSION['user'] ?? 'guest'; // Jika user tidak ada di session, gunakan 'guest'
?>

<head>
	<!-- SweetAlert2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css" rel="stylesheet">

	<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="plugins\jquery/jquery.js"></script>
	<!-- SweetAlert2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.all.min.js"></script>


</head>

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<div>
					<h1>
						<center><label class="label label-success">TRANSAKSI RUTIN HARIAN</label></center>
					</h1>
					<br><br>
				</div>
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
							<div class="body">
								<div class="row clearfix">
									<form method="POST">
										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">Tanggal</label>
											</div>
											<div class="col-md-3">
												<input type="date" name="dtgl" value="<?php echo $date; ?>" class="form-control">
											</div>
										</div>

										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">Kode Transaksi</label>
											</div>
											<div class="col-md-2">
												<input type="number" id="id" name="id" class="form-control" data-toggle="modal" data-target="#myModal">
											</div>
										</div>

										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">Akun Debet</label>
											</div>
											<div class="col-md-2">
												<input type="text" id="accdebet" name="accdebet" class="form-control" readonly />
											</div>
											<div class="col-md-6">
												<input type="text" id="cdebet" name="cdebet" class="form-control" readonly />
											</div>
										</div>

										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">Akun Kredit</label>
											</div>
											<div class="col-md-2">
												<input type="text" id="acckredit" name="acckredit" class="form-control" readonly />
											</div>
											<div class="col-md-6">
												<input type="text" id="ckredit" name="ckredit" class="form-control" readonly />
											</div>
										</div>

										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">No. Kwitansi</label>
											</div>
											<div class="col-md-6">
												<input type="text" id="cno_bukti" name="cno_bukti" class="form-control">
											</div>
										</div>

										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">Keterangan</label>
											</div>
											<div class="col-md-6">
												<input type="text" id="cket" name="cket" class="form-control">
											</div>
										</div>

										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">Nilai</label>
											</div>
											<div class="col-md-6">
												<input type="number" name="nilai" class="form-control">
											</div>
										</div>

										<label for="">Jenis</label>
										<div class="form-group mb-3">
											<div class="form-line">
												<select name="jenis" class="form-control show-tick">
													<option value="NON">NON PENERIMAAN ZISWAF</option>
													<option value="shadaqah">Shadaqah</option>
													<option value="zakat fitrah">Zakat Fitrah</option>
													<option value="zakat maal">Zakat Maal</option>
													<option value="zakat tijarah">Zakat Tijarah</option>
													<option value="zakat emas">Zakat Emas</option>
													<option value="wakaf">Wakaf</option>
													<option value="infaq">Infaq</option>
													<option value="sumbangan">Sumbangan</option>
												</select>
											</div>
										</div>

										<label for="">Mata Anggaran</label>
										<div class="form-group mb-3">
											<div class="form-line">
												<select name="cproject" class="form-control show-tick">
													<option value="000">000 - Non APB</option>
													<?php
													while ($anggaran = $sss->fetch_assoc()) {
													?>
														<option value="<?php echo $anggaran['kode']; ?>"><?php echo $anggaran['kode'] . ' - ' . $anggaran['deskripsi']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>

										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">Atas Nama</label>
											</div>
											<div class="col-md-6">
												<input type="text" name="atasnama" class="form-control">
											</div>
										</div>

										<div class="row clearfix mb-3">
											<div class="col-md-2">
												<label for="">Alamat</label>
											</div>
											<div class="col-md-6">
												<input type="text" name="alamat" class="form-control">
											</div>
										</div>

										<!-- Centered Submit Button -->
										<div class="row clearfix mb-3">
											<div class="col-md-12 text-center"> <!-- Center the button -->
												<input type="submit" value="Simpan Transaksi" name="simpan" class="btn btn-primary">
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>


				<?php
				if (isset($_POST['simpan'])) {
					$accdebet = $_POST['accdebet'];
					$acckredit = $_POST['acckredit'];
					$cket = $_POST['cket'];
					$nilai = $_POST['nilai'];
					$cno_bukti = $_POST['cno_bukti'];
					$cproject = $_POST['cproject'];
					$atasnama = $_POST['atasnama'];
					$alamat = $_POST['alamat'];
					$jenis = $_POST['jenis'];
					$dtgl = date('Y-m-d', strtotime($_POST['dtgl']));

					// Validasi jika nilai atau input penting kosong
					if (empty($accdebet) || empty($acckredit) || empty($cket) || empty($nilai) || empty($cno_bukti) || empty($cproject)) {
						echo "<script>
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: 'Semua kolom wajib diisi!',
									customClass: {
										popup: 'popup-large-text'
									},
									confirmButtonText: 'Tutup',
									confirmButtonColor: '#FF0000',
									// Set font size directly in SweetAlert2
									didOpen: () => {
										const swalTitle = document.querySelector('.swal2-title');
										const swalText = document.querySelector('.swal2-html-container');
										const swalConfirmButton = document.querySelector('.swal2-confirm');
										
										if (swalTitle) swalTitle.style.fontSize = '28px';
										if (swalText) swalText.style.fontSize = '18px';
										if (swalConfirmButton) swalConfirmButton.style.fontSize = '15px';
										
									}
								}).then(function() {
									window.location.href = '?page=transrutin';
								});
							  </script>";
						exit;
					}

					// Lanjutkan proses penyimpanan jika data lengkap
					if ($dtgl == $date) {
						$cnt = mysqli_query($koneksi, "insert into counter (cnick) values ('$user')");
						$cnt1 = mysqli_query($koneksi, "select max(id) as maxtr from counter where cnick='$user'");
						$ii = $cnt1->fetch_assoc();
						$vnnotrans = $ii['maxtr'];
					} else {
						$cnt1 = mysqli_query($koneksi, "select max(nno_trans) as maxtr from jurnal where dtgl_trans='$dtgl'");
						$ii = $cnt1->fetch_assoc();
						$vnnotrans = $ii['maxtr'] + 1;
					}

					// Panggil fungsi jurnal untuk mencatat transaksi
					jurnal($koneksi, $dtgl, $cket, $accdebet, 'D', $nilai, $user, $vnnotrans, $cno_bukti, $cproject);
					jurnal($koneksi, $dtgl, $cket, $acckredit, 'K', $nilai, $user, $vnnotrans, $cno_bukti, $cproject);

				?>
					<script type="text/javascript">
						<?php
						if ($jenis <> 'NON') {
						?>
							window.open("cetak.php?cno_bukti=<?php echo $cno_bukti; ?>&nama=<?php echo $atasnama; ?>&alamat=<?php echo $alamat ?>&nominal=<?php echo $nilai ?>&jenis=<?php echo $jenis ?>&tanggal=<?php echo $dtgl ?>", "_blank");
						<?php
						}
						?>
						Swal.fire({
							icon: 'success',
							title: 'Transaksi Sudah Dibukukan!',
							text: 'Transaksi berhasil disimpan.',
							customClass: {
								popup: 'popup-large-text'
							},
							confirmButtonText: 'OK'
						}).then(function() {
							window.location.href = "?page=transrutin";
						});
					</script>
				<?php
				}
				?>




			</div>
		</div>
	</div>
</div>
<?php
mysqli_close($koneksi);
?>



<!-- Awal Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
	<script src="plugins/jquery/jquery.min.js"></script>
	<script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="js/jquery-1.11.2.min.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.js"></script>
	<script src="datatables-1.11.3/js/jquery.dataTables.js"></script>
	<script src="datatables-1.11.3/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript"></script>

	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h4 class="modal-title" id="myModalLabel">TABLE JENIS TRANSAKSI</h4>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<table id="lookup" class="table table-bordered table-hover table-striped">
					<thead class="table-dark">
						<tr>
							<th>ID</th>
							<th>KETERANGAN</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include 'koneksi.php';
						$sql = $koneksi->query("SELECT * FROM transsetup");
						while ($data = $sql->fetch_assoc()) {
						?>
							<tr class="pilih" data-id="<?php echo $data['id']; ?>"
								data-accdebet="<?php echo $data['accdebet']; ?>"
								data-cdebet="<?php echo $data['cdebet']; ?>"
								data-acckredit="<?php echo $data['acckredit']; ?>"
								data-ckredit="<?php echo $data['ckredit']; ?>"
								data-cket="<?php echo $data['cket']; ?>">
								<td><?php echo $data['id'] ?></td>
								<td><?php echo $data['cket'] ?></td>
							</tr>
						<?php }
						mysqli_close($koneksi);
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {

			// Inisialisasi DataTables
			$('#lookup').DataTable({
				"pagingType": "simple_numbers",
				"language": {
					"paginate": {
						"previous": "&laquo;",
						"next": "&raquo;"
					}
				}
			});

			// Klik pada baris tabel untuk memilih data
			$(document).on('click', '.pilih', function() {
				$('#id').val($(this).data('id'));
				$('#accdebet').val($(this).data('accdebet'));
				$('#cdebet').val($(this).data('cdebet'));
				$('#acckredit').val($(this).data('acckredit'));
				$('#ckredit').val($(this).data('ckredit'));
				$('#cket').val($(this).data('cket'));

				// Tambahkan efek animasi sebelum modal tertutup
				$('.modal').fadeOut(300, function() {
					$(this).modal('hide');

					$('.modal-backdrop').remove();
					$('body').removeClass('modal-open'); // Hapus class modal-open dari body
					$('body').css('overflow', 'auto'); // Pastikan scrolling bisa digunakan kembali
				});
			});

		});
	</script>

	<style>
		/* Hover Effect */
		.table-hover tbody tr:hover {
			background-color: #f8f9fa;
			cursor: pointer;
			transition: background-color 0.3s ease-in-out;
		}

		/* Styling Tombol Close */
		.btn-close {
			background-color: white;
			border: none;
		}

		/* Style Pagination */
		.dataTables_paginate .paginate_button {
			padding: 2px 5px !important;
			font-size: 12px !important;
			border-radius: 4px;

		}

		/* Hover pada baris di dalam modal */
		.modal-body table tbody tr.pilih:hover {
			background-color: #343a40 !important;
			/* Warna gelap */
			color: white !important;
			/* Warna teks putih */
			cursor: pointer;
			/* Tanda kursor menjadi tangan */
			transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
		}
	</style>