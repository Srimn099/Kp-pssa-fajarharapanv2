<?php

    $inventno = $_GET['inventno'];
    $sql = $koneksi->query("select * from inventory where inventno='$inventno'");
    $tampil = $sql->fetch_assoc();
    $sql1=mysqli_query($koneksi,"select * from kelbrg order by kode");

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">UBAH DATA ASET TETAP</label></center></h1>
                            
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="Multipart/form-control">
                        <label for="">No. Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="inventno" value="<?php echo $tampil['inventno'];?>" class="form-control" readonly />
                            </div>
                        </div>

                        <label for="">Nama Barang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama" value="<?php echo $tampil['nama'];?>" class="form-control" />
                            </div>
                        </div>

                         <label for="">Kelompok Barang</label>
                         <div class="form-group">
                            <div class="form-line">
                                <select name="kelompok" class="form-control show-tick">
									<option value="">--Pilih Kelompok--</option>
									<?php
									while($klp=$sql1->fetch_assoc()){
									?>
									<option value="<?php echo $klp['kode'];?>" <?php if($tampil['kelompok']==$klp['kode']) echo "selected";?>><?php echo $klp['kode'].' - '.$klp['nama'];?></option>
									<?php
									}
									?>
									
								</select>
                            </div>
                        </div>

                        
                        
                        <label for="">Tanggal Perolehan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="dbeli" value="<?php echo $tampil['dbeli'];?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Nilai Perolehan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="harga" value="<?php echo $tampil['harga'];?>" class="form-control" />
                            </div>
                        </div>
                        
                        <label for="">Masa Manfaat</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="masa" value="<?php echo $tampil['masa'];?>" class="form-control" />
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
    $inventno = $_POST['inventno'];
    $nama = $_POST['nama'];
    $kelompok = $_POST['kelompok'];
    $dbeli = $_POST['dbeli'];
    $harga = $_POST['harga'];
    $masa = $_POST['masa'];
    $kondisi = $_POST['kondisi'];


    $sql=$koneksi->query("update inventory set nama='$nama',kelompok='$kelompok',dbeli='$dbeli',harga='$harga',masa='$masa',latitude='$kondisi' where inventno='$inventno'");
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Ubah");
        window.location.href="?page=inventory";
        </script>
        <?php
    }
}

?>