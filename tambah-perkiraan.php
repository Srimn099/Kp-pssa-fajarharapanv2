<?php


 
// menghubungkan dengan koneksi database
include 'koneksi.php';
 
// mengambil data pasien dengan kode paling besar

?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Tambah Akun Perkiraan</label></center></h1>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Nomor Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cno_kira"  class="form-control"  />
                            </div>
                        </div>

                        <label for="">Nama Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cnama_kira"class="form-control" />
                            </div>
                        </div>

                        <label for="">Tipe Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="chead_det" class="form-control show-tick">
									<option value="">--Pilih Tipe--</option>
									<option value="H">General</option>
									<option value="D">Detail</option>
									
									
								</select>
                            </div>
                        </div>

                        <label for="">Perkiraan Induk</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cacctparent" class="form-control" />
                            </div>
                        </div>

                        <label for="">Kelompok Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="cgroup" class="form-control show-tick">
									<option value="">--Pilih Kelompok--</option>
									<option value="A">Aset</option>
									<option value="S">Liabilitas dan Aset Bersih</option>
									<option value="D">Pendapatan</option>
									<option value="B">Biaya</option>
									<option value="M">Administratif</option>
									
									
								</select>
							</div>
                        </div>
						<label for="">Sub Kelompok Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="ckodebi" class="form-control show-tick">
									<option value="">--Pilih Sub Kelompok--</option>
									<option value="100">Aset Lancar</option>
									<option value="200">Aset Tidak Lancar</option>
									<option value="301">Hutang Jangka Pendek</option>
									<option value="302">Hutang Jangka Panjang</option>
									<option value="401">Aset Tidak Terikat</option>
                                    <option value="402">Aset Terikat</option>
                                    <option value="501">Pendapatan Aset Tidak Terikat</option>
                                    <option value="502">Pendapatan Aset Terikat</option>
                                    <option value="601">Beban Aset Tidak Terikat</option>
                                    <option value="602">Beban Aset Terikat</option>

									
									
								</select>
							</div>
                        </div>
 						
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
date_default_timezone_set('Asia/Jakarta');
$date=date("Y-m-d H:i:s");
$cno_kira=$_POST['cno_kira'];
$cnama_kira=$_POST['cnama_kira'];
$chead_det=$_POST['chead_det'];
$cgroup=$_POST['cgroup'];
if ($cgroup=='A' or $cgroup=='B'){
	$cdk = 'D';
}else{
	$cdk = 'K';
}
$ckodebi=$_POST['ckodebi'];
$cacctparent=$_POST['cacctparent'];

    $sql=$koneksi->query("insert into tabkira (CNO_KIRA,CNAMA_KIRA,CHEAD_DET,CGROUP,CACCTPARENT,KODEBI) values ('$cno_kira','$cnama_kira','$chead_det','$cgroup','$cacctparent','$ckodebi')");
	$soso = $koneksi->query("insert into balance select distinct dtgl,'$cno_kira',0,0,'$cdk',0,0,'$cdk' from balance"); 
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="home-admin.php?page=perkiraan";
        </script>
        <?php
    }
}

?>