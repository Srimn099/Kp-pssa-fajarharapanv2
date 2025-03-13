<?php


 
// menghubungkan dengan koneksi database
include 'koneksi.php';
$sql1=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql3=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");

 
// mengambil angka dari nmor pasien terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
 
// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
 
// membentuk nomor pasien baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
 
// mengambil data pasien dengan kode paling besar

?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                TAMBAH DATA KELOMPOK AKTIVA TETAP
                            </h2>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Kode Kelompok</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kode"  class="form-control"  />
                            </div>
                        </div>

                        <label for="">Deskripsi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama" class="form-control" />
                            </div>
                        </div>

						<label for="">Perkiraan Aset</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="accinvent" class="form-control show-tick">
									<option value="">--Pilih Perkiraan--</option>
									<?php
									while($aset=$sql1->fetch_assoc()){
									?>
									<option value="<?php echo $aset['CNO_KIRA'];?>"><?php echo $aset['CNO_KIRA'].' - '.$aset['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
								
                            </div>
                        </div>
						<label for="">Perkiraan Akumulasi Penyusutan</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="accakumsusut" class="form-control show-tick">
									<option value="">--Pilih Perkiraan--</option>
									<?php
									while($akum=$sql2->fetch_assoc()){
									?>
									<option value="<?php echo $akum['CNO_KIRA'];?>"><?php echo $akum['CNO_KIRA'].' - '.$akum['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
								
                            </div>
                        </div>
						<label for="">Perkiraan Biaya Penyusutan</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="accbiayasusut" class="form-control show-tick">
									<option value="">--Pilih Perkiraan--</option>
									<?php
									while($bisut=$sql3->fetch_assoc()){
									?>
									<option value="<?php echo $bisut['CNO_KIRA'];?>"><?php echo $bisut['CNO_KIRA'].' - '.$bisut['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
								
                            </div>
                        </div>
						<label for="">Status Penyusutan</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="lsusut" class="form-control show-tick">
									<option value="">--Pilih Status--</option>
									<option value="Y">Disusutkan</option>
									<option value="N">Tidak Disusutkan</option>
								</select>
								
                            </div>
                        </div>
						
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$kode=$_POST['kode'];
$nama=$_POST['nama'];
$accinvent=$_POST['accinvent'];
$accakumsusut=$_POST['accakumsusut'];
$accbiayasusut=$_POST['accbiayasusut'];
$lsusut=$_POST['lsusut'];
$cekkel = mysqli_query($koneksi,"select * from kelbrg where kode='$kode'");
$jumrow = $cekkel->num_rows;
if($jumrow>0){
    ?>
    <script type="text/javascript">
    alert ("Kode Kelompok Sudah Ada Dalam Database");
    window.location.href="";
    </script>
    <?php

}else{    

$sql=$koneksi->query("insert into kelbrg (kode,nama,accbarang,accakumsusut,accbisusut,lflag) values ('$kode','$nama','$accinvent','$accakumsusut','$accbiayasusut','$lsusut')");
	
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="?page=kelbrg";
        </script>
        <?php
    }
}
}

?>