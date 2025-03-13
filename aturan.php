<?php
	include 'koneksi.php';
	$sql1	=	$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
	$sql2	=	$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
	$sql3	=	$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
	$sql4	=	$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
	$sql5	=	$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
	$sql6	=	$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
	$sql7	=	$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
	
	
    $sql = $koneksi->query("select * from aturan");
    $tampil=$sql->fetch_assoc();
		

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">PENGATURAN AKUN TRANSAKSI</label></center></h1>
							<a href="home-admin.php?page=form-master" class="btn btn-warning btn-sm">Kembali</a><br><br>
                        </div>
                        
						
                        <div class="body">
                        <form method="POST" enctype="Multipart/form-control">
						<label for="">Akun Kas</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="acckas" class="form-control show-tick">
									<?php
									while($tabkira=mysqli_fetch_array($sql1)){
									?>
									<option value="<?php echo $tabkira['CNO_KIRA'];?>" <?php if($tampil['acckas']==$tabkira['CNO_KIRA']) echo "selected";?>><?php echo $tabkira['CNO_KIRA'].' - '.$tabkira['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						
						<label for="">Akun Pinjaman</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="accpiutang" class="form-control show-tick">
									<?php
									while($tabkira1=mysqli_fetch_array($sql2)){
									?>
									<option value="<?php echo $tabkira1['CNO_KIRA'];?>" <?php if($tampil['accpiutang']==$tabkira1['CNO_KIRA']) echo "selected";?>><?php echo $tabkira1['CNO_KIRA'].' - '.$tabkira1['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						<label for="">Akun Simpanan Pokok</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="accsimpok" class="form-control show-tick">
									<?php
									while($tabkira2=mysqli_fetch_array($sql3)){
									?>
									<option value="<?php echo $tabkira2['CNO_KIRA'];?>" <?php if($tampil['accsimpok']==$tabkira2['CNO_KIRA']) echo "selected";?>><?php echo $tabkira2['CNO_KIRA'].' - '.$tabkira2['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						<label for="">Akun Simpanan Wajib</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="accsimjib" class="form-control show-tick">
									<?php
									while($tabkira3=mysqli_fetch_array($sql4)){
									?>
									<option value="<?php echo $tabkira3['CNO_KIRA'];?>" <?php if($tampil['accsimjib']==$tabkira3['CNO_KIRA']) echo "selected";?>><?php echo $tabkira3['CNO_KIRA'].' - '.$tabkira3['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						<label for="">Akun Simpanan Sukarela</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="accsimsuka" class="form-control show-tick">
									<?php
									while($tabkira4=mysqli_fetch_array($sql5)){
									?>
									<option value="<?php echo $tabkira4['CNO_KIRA'];?>" <?php if($tampil['accsimsuka']==$tabkira4['CNO_KIRA']) echo "selected";?>><?php echo $tabkira4['CNO_KIRA'].' - '.$tabkira4['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						<label for="">Akun Pendapatan Jasa Pinjaman</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="accpendapatan" class="form-control show-tick">
									<?php
									while($tabkira5=mysqli_fetch_array($sql6)){
									?>
									<option value="<?php echo $tabkira5['CNO_KIRA'];?>" <?php if($tampil['accpendapatan']==$tabkira5['CNO_KIRA']) echo "selected";?>><?php echo $tabkira5['CNO_KIRA'].' - '.$tabkira5['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						
						<label for="">Rate Pinjaman (% per tahun)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number"  name="rate" value="<?php echo $tampil['rate'];?>" class="form-control" />
                            </div>
                        </div>
						
						
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 

if (isset($_POST['simpan'])){
$acckas=$_POST['acckas'];
$accpiutang=$_POST['accpiutang'];
$accsimpok=$_POST['accsimpok'];
$accsimjib=$_POST['accsimjib'];
$accsimsuka=$_POST['accsimsuka'];
$accpendapatan=$_POST['accpendapatan'];

$rate=$_POST['rate'];


	$tanya=$koneksi->query("select * from aturan");
	$numrow=$tanya->num_rows;
	if($numrow==0){
		$sql=$koneksi->query("insert into aturan (acckas,accpiutang,accsimpok,accsimjib,rate,accsimsuka,accpendapatan) values ('$acckas','$accpiutang','$accsimpok','$accsimjib','$rate','$accsimsuka','$accpendapatan')");
	}else{	
		$sql=$koneksi->query("update aturan set acckas='$acckas',accpiutang='$accpiutang',accsimpok='$accsimpok',accsimjib='$accsimjib',rate='$rate',accsimsuka='$accsimsuka',accpendapatan='$accpendapatan'");
	}
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Pengaturan Akun Transaksi Tersimpan!");
        window.location.href="home-admin.php?page=form-master";
        </script>
        <?php
    }
}
mysqli_close($koneksi);
?>