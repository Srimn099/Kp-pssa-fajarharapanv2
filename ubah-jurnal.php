<?php
include 'koneksi.php';

$dtgl = $_GET['tanggal'];
$nno_trans = $_GET['nno_trans'];
$sql1 = $koneksi->query("select * from mstanggaran order by kode");
//$sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
//$sql3=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql4=$koneksi->query("select * from jurnal where DTGL_TRANS='$dtgl' and NNO_TRANS='$nno_trans' and ctransflag='tr' and cdebkred='D'");
$tampil=$sql4->fetch_assoc();


 

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                KOREKSI MATA ANGGARAN
                            </h2>
                        </div>
                         <div class="body">
						<a href="?page=list-jurnal" class="btn btn-warning btn-sm">Kembali</a>                  
						</div>   
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Tanggal Transaksi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="tanggal" value="<?php echo $dtgl;?>" class="form-control" readonly />
                            </div>
                        </div>

						<label for="">Nomor Transaksi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="nno_trans" value="<?php echo $nno_trans;?>" class="form-control" readonly />
                            </div>
                        </div>

                        <label for="">Deskripsi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cket" value="<?php echo $tampil['CKET'];?>" class="form-control" readonly />
                            </div>
                        </div>
						<label for="">Nilai Transaksi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="idramount" value="<?php echo $tampil['IDRAMOUNT'];?>" class="form-control" readonly />
                            </div>
                        </div>
						<label for="">Mata Anggaran</label>
													<div class="form-group">
														<div class="form-line">
                        
													<select name="cproject" class="form-control show-tick">
													<option value="000" <?php  if('000'==$tampil['CPROJECT']) echo "selected";?>  >000 - Non APB</option>
													<?php
														while($anggaran=$sql1->fetch_assoc()){
														?>
														<option value="<?php echo $anggaran['kode'];?>" <?php  if($anggaran['kode']==$tampil['CPROJECT']) echo "selected";?>><?php echo $anggaran['kode'].' - '.$anggaran['deskripsi'];?></option>
														<?php } ?>
													</select>	
														</div>
													</div>	

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$cproject=$_POST['cproject'];
$dtgl=$_POST['tanggal'];
$nno_trans=$_POST['nno_trans'];
    $sql=$koneksi->query("update jurnal set CPROJECT='$cproject' where dtgl_trans='$dtgl' and nno_trans='$nno_trans'");
	
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Mata Anggaran Untuk Transaksi Sudah Dikoreksi");
        window.location.href="?page=list-jurnal";
        </script>
        <?php
    }
}

?>