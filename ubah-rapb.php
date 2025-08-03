<?php
include 'koneksi.php';

$kode = $_GET['kode'];
$tahun = $_GET['tahun'];
<<<<<<< HEAD

// Ambil data anggaran dan deskripsi
$sql4 = $koneksi->query("SELECT anggaran.*, mstanggaran.deskripsi 
	FROM mstanggaran, anggaran 
	WHERE mstanggaran.kode = anggaran.kode 
	AND mstanggaran.kode = '$kode' 
	AND anggaran.tahun = '$tahun'");
$tampil = $sql4->fetch_assoc();
?>

<!-- Tambahkan SweetAlert2 dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Style -->
<style>
    .form-control-custom {
        border: 1px solid black;
    }

    .form-control-readonly {
        background-color: #d9d9d9;
        border: 1px solid black;
    }

    .btn-custom {
        min-width: 100px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Ubah Data RAPB</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Tahun Anggaran</label>
                            <input type="text" name="tahun" value="<?= $tahun ?>" class="form-control form-control-readonly" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Mata Anggaran</label>
                            <input type="text" name="kode" value="<?= $kode ?>" class="form-control form-control-readonly" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" value="<?= $tampil['deskripsi'] ?>" class="form-control form-control-custom">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Per Bulan (Awal)</label>
                            <input type="text" name="perbulanawal" value="<?= number_format($tampil['perbulanawal'], 0, ',', '.') ?>" class="form-control form-control-custom rupiah">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Per Tahun (Awal)</label>
                            <input type="text" name="pertahunawal" value="<?= number_format($tampil['pertahunawal'], 0, ',', '.') ?>" class="form-control form-control-custom rupiah">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Per Bulan (Perubahan)</label>
                            <input type="text" name="perbulanubah" value="<?= number_format($tampil['perbulanubah'], 0, ',', '.') ?>" class="form-control form-control-custom rupiah">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Per Tahun (Perubahan)</label>
                            <input type="text" name="pertahunubah" value="<?= number_format($tampil['pertahunubah'], 0, ',', '.') ?>" class="form-control form-control-custom rupiah">
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="?page=rapb&tahun=<?= $tahun ?>" class="btn btn-secondary me-2 btn-custom">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" name="simpan" class="btn btn-primary btn-custom">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST['simpan'])) {
                function toNumber($val)
                {
                    return (int) str_replace(['.', ','], '', $val);
                }

                $kode = $_POST['kode'];
                $tahun = $_POST['tahun'];
                $deskripsi = $_POST['deskripsi'];
                $perbulanawal = toNumber($_POST['perbulanawal']);
                $pertahunawal = toNumber($_POST['pertahunawal']);
                $perbulanubah = toNumber($_POST['perbulanubah']);
                $pertahunubah = toNumber($_POST['pertahunubah']);

                // Update anggaran
                $sql1 = $koneksi->query("UPDATE anggaran 
        SET perbulanawal='$perbulanawal', 
            pertahunawal='$pertahunawal', 
            perbulanubah='$perbulanubah', 
            pertahunubah='$pertahunubah' 
        WHERE kode='$kode' AND tahun='$tahun'");

                // Update deskripsi di mstanggaran
                $sql2 = $koneksi->query("UPDATE mstanggaran 
        SET deskripsi='$deskripsi' 
        WHERE kode='$kode'");

                if ($sql1 && $sql2) {
                    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data RAPB berhasil diperbarui!',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href='?page=rapb&tahun=$tahun';
            });
        </script>";
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- Format input angka ke Rupiah -->
<script>
    document.querySelectorAll('.rupiah').forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = this.value.replace(/[^0-9]/g, '');
            this.value = new Intl.NumberFormat('id-ID').format(value);
        });
    });
</script>
=======
$sql1=$koneksi->query("select * from kelanggaran order by kodekel");
//$sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
//$sql3=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql4=$koneksi->query("select anggaran.*,mstanggaran.deskripsi from mstanggaran,anggaran where mstanggaran.kode=anggaran.kode and mstanggaran.kode='$kode' and anggaran.tahun='$tahun'");
$tampil=$sql4->fetch_assoc();


 

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                UBAH DATA RAPB
                            </h2>
                        </div>
                         <div class="body">
						<a href="?page=rapb&tahun=<?php echo $tahun;?>" class="btn btn-warning btn-sm">Kembali</a>                  
						</div>   
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Tahun Anggaran</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="tahun" value="<?php echo $tahun;?>" class="form-control" readonly />
                            </div>
                        </div>

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
						<label for="">Per Bulan (Awal)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="perbulanawal" value="<?php echo $tampil['perbulanawal'];?>" class="form-control" />
                            </div>
                        </div>
						<label for="">Per Tahun (Awal)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="pertahunawal" value="<?php echo $tampil['pertahunawal'];?>" class="form-control" />
                            </div>
                        </div>
						<label for="">Per Bulan (Perubahan)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="perbulanubah" value="<?php echo $tampil['perbulanubah'];?>" class="form-control" />
                            </div>
                        </div>					
						<label for="">Per Tahun (Perubahan)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="pertahunubah" value="<?php echo $tampil['pertahunubah'];?>" class="form-control" />
                            </div>
                        </div>
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$kode=$_POST['kode'];
$tahun=$_POST['tahun'];
$perbulanawal=$_POST['perbulanawal'];
$pertahunawal=$_POST['pertahunawal'];
$perbulanubah=$_POST['perbulanubah'];
$pertahunubah=$_POST['pertahunubah'];
    $sql=$koneksi->query("update anggaran set perbulanawal='$perbulanawal',pertahunawal='$pertahunawal',perbulanubah='$perbulanubah',pertahunubah='$pertahunubah' where kode='$kode' and tahun='$tahun'");
	
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Perubahan Data RAPB Berhasil di Simpan");
        window.location.href="?page=rapb&tahun=<?php echo $tahun;?>";
        </script>
        <?php
    }
}

?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
