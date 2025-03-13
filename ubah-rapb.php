<?php
include 'koneksi.php';

$kode = $_GET['kode'];
$tahun = $_GET['tahun'];
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