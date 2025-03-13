<?php

include 'koneksi.php';
 
// menghubungkan dengan koneksi database
 $sql1=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
 $sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
 
// mengambil data pasien dengan kode paling besar

?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Penambahan Transaksi Rutin</label></center></h1>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Akun Debet</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="accdebet" class="form-control show-tick">
									<?php
									while($tabkira=mysqli_fetch_array($sql1)){
									?>
									<option value="<?php echo $tabkira['CNO_KIRA'];?>"><?php echo $tabkira['CNO_KIRA'].' - '.$tabkira['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						
						<label for="">Akun Kredit</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="acckredit" class="form-control show-tick">
									<?php
									while($tabkira1=mysqli_fetch_array($sql2)){
									?>
									<option value="<?php echo $tabkira1['CNO_KIRA'];?>" ><?php echo $tabkira1['CNO_KIRA'].' - '.$tabkira1['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						
                        <label for="">Keterangan Transaksi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cket" class="form-control" />
                            </div>
                        </div>

                        		
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
date_default_timezone_set('Asia/Jakarta');
$date=date("Y-m-d H:i:s");
$accdebet=$_POST['accdebet'];
$acckredit=$_POST['acckredit'];
$cket=$_POST['cket'];
$ssl=$koneksi->query("select CNAMA_KIRA from tabkira where CNO_KIRA='$accdebet'");
$debet=$ssl->fetch_assoc();
$cdebet=$debet['CNAMA_KIRA'];
$ssl1=$koneksi->query("select CNAMA_KIRA from tabkira where CNO_KIRA='$acckredit'");
$kredit=$ssl1->fetch_assoc();
$ckredit=$kredit['CNAMA_KIRA'];

$nu=$koneksi->query("select * from transsetupp");
$numrow=$nu->num_rows;
if($numrow==0){
    $sql=$koneksi->query("insert into transsetup (accdebet,cdebet,acckredit,ckredit,cket) values ('$accdebet','$cdebet','$acckredit','$ckredit','$cket')");
}else{
	$sql=$koneksi->query("update transsetup set accdebet='$accdebet',acckredit='$acckredit',cdebet='$cdebet',ckredit='$ckredit',cket='$cket'");
}
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="home-admin.php?page=transsetup";
        </script>
        <?php
    }
}
mysqli_close($koneksi);
?>