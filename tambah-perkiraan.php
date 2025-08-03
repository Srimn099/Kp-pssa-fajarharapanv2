<<<<<<< HEAD
<?php include 'koneksi.php'; ?>

<!-- Bootstrap CSS & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<!-- SweetAlert2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-5">
    <div class="card shadow border-0 rounded-4 mx-auto" style="max-width: 750px;">
        <div class="card-header bg-success text-white rounded-top-4 py-3">
            <h4 class="mb-0 text-center"><i class="bi bi-journal-plus me-2"></i>Tambah Akun Perkiraan</h4>
        </div>

        <div class="card-body px-4 py-4">
            <form method="POST">
                <div class="mb-3">
                    <label for="cno_kira" class="form-label">Nomor Perkiraan</label>
                    <input type="text" name="cno_kira" id="cno_kira" class="form-control border-secondary" required>
                </div>

                <div class="mb-3">
                    <label for="cnama_kira" class="form-label">Nama Perkiraan</label>
                    <input type="text" name="cnama_kira" id="cnama_kira" class="form-control border-secondary" required>
                </div>

                <div class="mb-3">
                    <label for="chead_det" class="form-label">Tipe Perkiraan</label>
                    <select name="chead_det" id="chead_det" class="form-select border-secondary" required>
                        <option value="">-- Pilih Tipe --</option>
                        <option value="H">General</option>
                        <option value="D">Detail</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cacctparent" class="form-label">Perkiraan Induk</label>
                    <input type="text" name="cacctparent" id="cacctparent" class="form-control border-secondary">
                </div>

                <div class="mb-3">
                    <label for="cgroup" class="form-label">Kelompok Perkiraan</label>
                    <select name="cgroup" id="cgroup" class="form-select border-secondary" required>
                        <option value="">-- Pilih Kelompok --</option>
                        <option value="A">Aset</option>
                        <option value="S">Liabilitas dan Aset Bersih</option>
                        <option value="D">Pendapatan</option>
                        <option value="B">Biaya</option>
                        <option value="M">Administratif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="ckodebi" class="form-label">Sub Kelompok Perkiraan</label>
                    <select name="ckodebi" id="ckodebi" class="form-select border-secondary" required>
                        <option value="">-- Pilih Sub Kelompok --</option>
                        <option value="100">Aset Lancar</option>
                        <option value="200">Aset Tidak Lancar</option>
                        <option value="301">Hutang Jangka Pendek</option>
                        <option value="302">Hutang Jangka Panjang</option>
                        <option value="401">Aset Tidak Terikat</option>
                        <option value="402">Aset Terikat</option>
                        <option value="501">Pendapatan Aset Tidak Terikat</option>
                        <option value="502">Pendapatan Aset Terikat</option>
                        <option value="601">Beban Aset Tidak Terikat</option>
                        <option value="602">Beban Aset Terikat</option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="home-admin.php?page=perkiraan" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </a>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    date_default_timezone_set('Asia/Jakarta');
    $cno_kira     = $_POST['cno_kira'];
    $cnama_kira   = $_POST['cnama_kira'];
    $chead_det    = $_POST['chead_det'];
    $cgroup       = $_POST['cgroup'];
    $ckodebi      = $_POST['ckodebi'];
    $cacctparent  = $_POST['cacctparent'];

    // Otomatisasi Debit/Kredit
    $cdk = ($cgroup == 'A' || $cgroup == 'B') ? 'D' : 'K';

    $sql = $koneksi->query("INSERT INTO tabkira (CNO_KIRA, CNAMA_KIRA, CHEAD_DET, CGROUP, CACCTPARENT, KODEBI)
                            VALUES ('$cno_kira','$cnama_kira','$chead_det','$cgroup','$cacctparent','$ckodebi')");

    $soso = $koneksi->query("INSERT INTO balance 
        SELECT DISTINCT dtgl, '$cno_kira', 0, 0, '$cdk', 0, 0, '$cdk' 
        FROM balance");
    if ($sql) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: 'Data akun perkiraan berhasil ditambahkan',
                showConfirmButton: true,
                timer: 3000
            }).then((result) => {
                window.location.href = 'home-admin.php?page=perkiraan';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menyimpan data'
            });
        </script>";
    }
}
?>


<style>
    .form-control,
    .form-select {
        border-width: 1.5px !important;
    }

    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .btn-outline-secondary {
        border-width: 1.5px;
    }

    .btn {
        padding: 8px 16px;
        font-weight: 500;
    }
</style>
=======
<?php


 
// menghubungkan dengan koneksi database
include 'koneksi.php';
 
// mengambil data pasien dengan kode paling besar

?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Tambah Akun Perkiraan</label></center></h1>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Nomor Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cno_kira"  class="form-control"  />
                            </div>
                        </div>

                        <label for="">Nama Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cnama_kira"class="form-control" />
                            </div>
                        </div>

                        <label for="">Tipe Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="chead_det" class="form-control show-tick">
									<option value="">--Pilih Tipe--</option>
									<option value="H">General</option>
									<option value="D">Detail</option>
									
									
								</select>
                            </div>
                        </div>

                        <label for="">Perkiraan Induk</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cacctparent" class="form-control" />
                            </div>
                        </div>

                        <label for="">Kelompok Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="cgroup" class="form-control show-tick">
									<option value="">--Pilih Kelompok--</option>
									<option value="A">Aset</option>
									<option value="S">Liabilitas dan Aset Bersih</option>
									<option value="D">Pendapatan</option>
									<option value="B">Biaya</option>
									<option value="M">Administratif</option>
									
									
								</select>
							</div>
                        </div>
						<label for="">Sub Kelompok Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="ckodebi" class="form-control show-tick">
									<option value="">--Pilih Sub Kelompok--</option>
									<option value="100">Aset Lancar</option>
									<option value="200">Aset Tidak Lancar</option>
									<option value="301">Hutang Jangka Pendek</option>
									<option value="302">Hutang Jangka Panjang</option>
									<option value="401">Aset Tidak Terikat</option>
                                    <option value="402">Aset Terikat</option>
                                    <option value="501">Pendapatan Aset Tidak Terikat</option>
                                    <option value="502">Pendapatan Aset Terikat</option>
                                    <option value="601">Beban Aset Tidak Terikat</option>
                                    <option value="602">Beban Aset Terikat</option>

									
									
								</select>
							</div>
                        </div>
 						
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
date_default_timezone_set('Asia/Jakarta');
$date=date("Y-m-d H:i:s");
$cno_kira=$_POST['cno_kira'];
$cnama_kira=$_POST['cnama_kira'];
$chead_det=$_POST['chead_det'];
$cgroup=$_POST['cgroup'];
if ($cgroup=='A' or $cgroup=='B'){
	$cdk = 'D';
}else{
	$cdk = 'K';
}
$ckodebi=$_POST['ckodebi'];
$cacctparent=$_POST['cacctparent'];

    $sql=$koneksi->query("insert into tabkira (CNO_KIRA,CNAMA_KIRA,CHEAD_DET,CGROUP,CACCTPARENT,KODEBI) values ('$cno_kira','$cnama_kira','$chead_det','$cgroup','$cacctparent','$ckodebi')");
	$soso = $koneksi->query("insert into balance select distinct dtgl,'$cno_kira',0,0,'$cdk',0,0,'$cdk' from balance"); 
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="home-admin.php?page=perkiraan";
        </script>
        <?php
    }
}

?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
