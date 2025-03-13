<?php
include 'koneksi.php';

$kode = $_GET['kodekel'];
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

?>