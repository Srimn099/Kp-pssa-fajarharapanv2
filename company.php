<?php
	include 'koneksi.php';
    $sql = $koneksi->query("select * from company");
    $tampil=$sql->fetch_assoc();
		$nama=$tampil['NAMA'];
		$alamat=$tampil['ALAMAT'];
		$kota=$tampil['KOTA'];
		$telpon=$tampil['PHONE'];
		$zipcode=$tampil['ZIPCODE'];
	

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Data Panti Asuhan</label></center></h1>
							<a href="home-admin.php?page=form-master" class="btn btn-warning btn-sm">Kembali</a><br><br>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="Multipart/form-control">
                        <label for="">Nama Panti Asuhan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama" value="<?php echo $nama;?>" class="form-control"  />
                            </div>
                        </div>

                        <label for="">Alamat</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="alamat" value="<?php echo $alamat;?>" class="form-control" />
                            </div>
                        </div>

                        
                        <label for="">Kota</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kota" value="<?php echo $kota;?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Kode Pos</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="zipcode" value="<?php echo $zipcode;?>" class="form-control" />
                            </div>
                        </div>

						<label for="">No Telpon</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number"  name="phone" value="<?php echo $telpon;?>" class="form-control" />
                            </div>
                        </div>
						
						
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$alamat=$_POST['alamat'];
$nama=$_POST['nama'];
$telpon=$_POST['phone'];
$kota=$_POST['kota'];
$zipcode=$_POST['zipcode'];


	$tanya=$koneksi->query("select * from company");
	$numrow=$tanya->num_rows;
	if($numrow==0){
		$sql=$koneksi->query("insert into company (nama,alamat,kota,phone,zipcode) values ('$nama','$alamat','$kota','$telpon','$zipcode')");
	}else{	
		$sql=$koneksi->query("update company set NAMA='$nama',ALAMAT='$alamat',KOTA='$kota',PHONE='$telpon',ZIPCODE='$zipcode'");
	}
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Panti Asuhan Tersimpan!");
        window.location.href="home-admin.php?page=form-master";
        </script>
        <?php
    }
}
mysqli_close($koneksi);
?>