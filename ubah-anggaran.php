<?php
include 'koneksi.php';

$kode = $_GET['kode'];
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