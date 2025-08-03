<?php
include 'koneksi.php';

$kode = $_GET['kode'];
<<<<<<< HEAD
$sql1 = $koneksi->query("SELECT * FROM kelanggaran ORDER BY kodekel");
$sql4 = $koneksi->query("SELECT * FROM mstanggaran WHERE kode='$kode'");
$tampil = $sql4->fetch_assoc();
?>

<div class="container mt-4">
    <!-- Tombol kembali -->
    <div class="mb-3">
        <a href="?page=mataanggaran" class="btn btn-warning shadow-sm">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center rounded-top-4">
                    <h4 class="mb-0">Ubah Mata Anggaran</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Mata Anggaran</label>
                            <input type="text" name="kode" id="kode" value="<?= $kode ?>" class="form-control custom-input" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" value="<?= $tampil['deskripsi'] ?>" class="form-control custom-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="kodekel" class="form-label">Kelompok Anggaran</label>
                            <select name="kodekel" id="kodekel" class="form-select custom-input" required>
                                <option value="">-- Pilih Kelompok --</option>
                                <?php while ($aset = $sql1->fetch_assoc()) { ?>
                                    <option value="<?= $aset['kodekel'] ?>" <?= ($aset['kodekel'] == $tampil['kodekel']) ? 'selected' : '' ?>>
                                        <?= $aset['kodekel'] . ' - ' . $aset['deskripsi'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="text-center">
                            <a href="?page=mataanggaran" class="btn btn-outline-secondary shadow rounded-3 ">
                                <i class="fa fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" name="simpan" class="btn btn-success shadow-sm rounded-3">
                                <i class="fa fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'koneksi.php';

$kode = $_GET['kode'];
$sql1 = $koneksi->query("SELECT * FROM kelanggaran ORDER BY kodekel");
$sql4 = $koneksi->query("SELECT * FROM mstanggaran WHERE kode='$kode'");
$tampil = $sql4->fetch_assoc();

$showSuccess = false; // variabel status
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $deskripsi = $_POST['deskripsi'];
    $kodekel = $_POST['kodekel'];

    $sql = $koneksi->query("UPDATE mstanggaran SET deskripsi='$deskripsi', kodekel='$kodekel' WHERE kode='$kode'");
    if ($sql) {
        $showSuccess = true; // set status sukses
    }
}
?>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($showSuccess): ?>
    <script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data Mata Anggaran berhasil diperbarui',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '?page=mataanggaran';
        });
    </script>
<?php endif; ?>


<style>
    .custom-input {
        border: 1.5px solid #99a6b2;
        border-radius: 0.5rem;
        padding: 10px 14px;
        transition: all 0.3s ease;
    }

    .custom-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .card-header {
        padding: 1rem 1.25rem;
        font-size: 1.25rem;
        font-weight: bold;
        background: #214DD1;


    }
</style>
=======
$sql1=$koneksi->query("select * from kelanggaran order by kodekel");
//$sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
//$sql3=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql4=$koneksi->query("select * from mstanggaran where kode='$kode'");
$tampil=$sql4->fetch_assoc();


 

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UBAH DATA MATA ANGGARAN
                            </h2>
                        </div>
                         <div class="body">
						<a href="?page=mataanggaran" class="btn btn-warning btn-sm">Kembali</a>                  
						</div>   
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Kode Mata Anggaran</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kode" value="<?php echo $kode;?>" class="form-control" readonly />
                            </div>
                        </div>

                        <label for="">Deskripsi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="deskripsi" value="<?php echo $tampil['deskripsi'];?>" class="form-control" />
                            </div>
                        </div>

						<label for="">Kelompok Anggaran</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="kodekel" class="form-control show-tick">
									<option value="">--Pilih Kelompok--</option>
									<?php
									while($aset=$sql1->fetch_assoc()){
									?>
									<option value="<?php echo $aset['kodekel'];?>" <?php  if($aset['kodekel']==$tampil['kodekel']) echo "selected";?>><?php echo $aset['kodekel'].' - '.$aset['deskripsi'];?></option>
									<?php
									}
									?>
									
								</select>
								
                            </div>
                        </div>
											
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$kode=$_POST['kode'];
$deskripsi=$_POST['deskripsi'];
$kodekel=$_POST['kodekel'];
    $sql=$koneksi->query("update mstanggaran set deskripsi='$deskripsi',kodekel='$kodekel' where kode='$kode'");
	
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Perubahan Data Mata Anggaran Berhasil di Simpan");
        window.location.href="?page=mataanggaran";
        </script>
        <?php
    }
}

?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
