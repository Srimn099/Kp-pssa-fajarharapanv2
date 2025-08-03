<?php
include 'koneksi.php';

$kode = $_GET['kodekel'];
<<<<<<< HEAD
$sql = $koneksi->query("SELECT * FROM kelanggaran WHERE kodekel='$kode'");
$tampil = $sql->fetch_assoc();
?>

<!-- SweetAlert2 CDN -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Styling tambahan -->
<style>
    .form-control,
    .form-select {
        border: 1px solid #95989c;
        border-radius: 8px;
        transition: border-color 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary,
    .btn-secondary {
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 500;
    }

    .btn-group-custom {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
</style>

<div class="container mt-4">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Ubah Kelompok Anggaran</h5>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="kodekel" class="form-label">Kode</label>
                    <input type="text" name="kodekel" value="<?= $kode ?>" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" value="<?= $tampil['deskripsi'] ?>" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="D" <?= $tampil['jenis'] == 'D' ? 'selected' : '' ?>>Pendapatan</option>
                        <option value="B" <?= $tampil['jenis'] == 'B' ? 'selected' : '' ?>>Biaya</option>
                    </select>
                </div>

                <div class="btn-group-custom">
                    <a href="?page=kelanggaran" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $kodekel = $_POST['kodekel'];
    $deskripsi = $_POST['deskripsi'];
    $jenis = $_POST['jenis'];

    $update = $koneksi->query("UPDATE kelanggaran SET deskripsi='$deskripsi', jenis='$jenis' WHERE kodekel='$kodekel'");

    if ($update) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil diperbarui.',
                showConfirmButton: false,
                timer: 1800
            }).then(() => {
                window.location.href = '?page=kelanggaran';
            });
        </script>";
    }
}
=======
//$sql1=$koneksi->query("select * from kelanggaran order by kodekel");
//$sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
//$sql3=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql4=$koneksi->query("select * from kelanggaran where kodekel='$kode'");
$tampil=$sql4->fetch_assoc();


 

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UBAH DATA KELOMPOK ANGGARAN
                            </h2>
                        </div>
						<div class="body">
						<a href="?page=kelanggaran" class="btn btn-warning btn-sm">Kembali</a>                  
						</div>          
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Kode Kelompok Anggaran</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kodekel" value="<?php echo $kode;?>" class="form-control" readonly />
                            </div>
                        </div>

                        <label for="">Deskripsi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="deskripsi" value="<?php echo $tampil['deskripsi'];?>" class="form-control" />
                            </div>
                        </div>

						<label for="">Jenis</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="jenis" class="form-control show-tick">
									<option value="">--Pilih Jenis--</option>
									
									<option value="D" <?php  if($tampil['jenis']=='D') echo "selected";?>>PENDAPATAN</option>
									<option value="B" <?php  if($tampil['jenis']=='B') echo "selected";?>>BIAYA</option>
									
									
								</select>
								
                            </div>
                        </div>
											
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$deskripsi=$_POST['deskripsi'];
$kodekel=$_POST['kodekel'];
$jenis =$_POST['jenis'];
    $sql=$koneksi->query("update kelanggaran set deskripsi='$deskripsi',jenis='$jenis' where kodekel='$kodekel'");
	
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Perubahan Data Kelompok Anggaran Berhasil di Simpan");
        window.location.href="?page=mataanggaran";
        </script>
        <?php
    }
}

>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
?>