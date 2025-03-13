<?php


 
// menghubungkan dengan koneksi database
include 'koneksi.php'; 
$sql=mysqli_query($koneksi,"select * from kelbrg order by kode");
?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Tambah Aset Tetap</label></center></h1>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Nomor Register</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="inventno"  class="form-control"  />
                            </div>
                        </div>

                        <label for="">Nama Barang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama"class="form-control" />
                            </div>
                        </div>

                        <label for="">Kelompok Barang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="kelompok" class="form-control show-tick">
									<option value="">--Pilih Kelompok--</option>
									<?php
									while($klp=$sql->fetch_assoc()){
									?>
									<option value="<?php echo $klp['kode'];?>"><?php echo $klp['kode'].' - '.$klp['nama'];?></option>
									<?php
									}
									?>
									
								</select>
                            </div>
                        </div>
                        <label for="">Tanggal Perolehan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="dbeli"class="form-control" />
                            </div>
                        </div>
                        <label for="">Nilai Perolehan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="harga"class="form-control" />
                            </div>
                        </div>
                        <label for="">Masa Manfaat (Dalam Bulan)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="masa"class="form-control" />
                            </div>
                        </div>
                         <label for="">Kondisi Barang</label>
                         <div class="form-group">
                            <div class="form-line">
                                <select name="kondisi" class="form-control show-tick">
									<option value="">--Pilih Kondisi--</option>
									<option value="B">Baik</option>
									<option value="S">Sedang</option>
									<option value="K">Kurang Baik</option>
									<option value="R">Rusak</option>
									
								</select>
                            </div>
                        </div>

                        
 						
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
date_default_timezone_set('Asia/Jakarta');
$date=date("Y-m-d H:i:s");
$inventno = $_POST['inventno'];
$nama = $_POST['nama'];
$kelompok = $_POST['kelompok'];
$dbeli = $_POST['dbeli'];
$harga = $_POST['harga'];
$masa = $_POST['masa'];
$kondisi = $_POST['kondisi'];
$cekinvent = mysqli_query($koneksi,"select * from inventory where inventno='$inventno'");
$jumrow=$cekinvent->num_rows;
if ($jumrow>0){
    ?>
    <script type="text/javascript">
    alert ("No. Register Barang Sudah Terdaftar!");
    window.location.href="";
    </script>
    <?php

}else{




    $sql=$koneksi->query("insert into inventory (inventno,nama,kelompok,dbeli,harga,masa,latitude) values ('$inventno','$nama','$kelompok','$dbeli','$harga','$masa','$kondisi')");
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="?page=inventory";
        </script>
        <?php
    }
}
}

?>