<?php

    $cno_kira = $_GET['cno_kira'];
    $sql = $koneksi->query("select * from tabkira where CNO_KIRA='$cno_kira'");
    $tampil = $sql->fetch_assoc();

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">UBAH DATA TABEL PERKIRAAN</label></center></h1>
                            
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="Multipart/form-control">
                        <label for="">No. Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cno_kira" value="<?php echo $tampil['CNO_KIRA'];?>" class="form-control" readonly />
                            </div>
                        </div>

                        <label for="">Nama Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cnama_kira" value="<?php echo $tampil['CNAMA_KIRA'];?>" class="form-control" />
                            </div>
                        </div>

                         <label for="">Tipe Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="chead_det" class="form-control show-tick">
									<option value="">--Pilih Tipe--</option>
									<option value="H" <?php if($tampil['CHEAD_DET']=='H') echo "selected";?> >General</option>
									<option value="D" <?php if($tampil['CHEAD_DET']=='D') echo "selected";?> >Detail</option>
									
									
								</select>
                            </div>
                        </div>

                        
                        <label for="">Perkiraan Induk</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cacctparent" value="<?php echo $tampil['CACCTPARENT'];?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Kelompok Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="cgroup" class="form-control show-tick">
									<option value="">--Pilih Kelompok Perkiraan--</option>
									<option value="A" <?php if($tampil['CGROUP']=='A') echo "selected";?>>Aktiva</option>
									<option value="S" <?php if($tampil['CGROUP']=='S') echo "selected";?>>Pasiva</option>
									<option value="D" <?php if($tampil['CGROUP']=='D') echo "selected";?>>Pendapatan</option>
									<option value="B" <?php if($tampil['CGROUP']=='B') echo "selected";?>>Biaya</option>
									<option value="M" <?php if($tampil['CGROUP']=='M') echo "selected";?>>Administratif</option>
									
									
								</select>
							</div>
                        </div>
						<label for="">Sub Kelompok Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="ckodebi" class="form-control show-tick">
									<option value="">--Pilih Sub Kelompok--</option>
									<option value="100" <?php if($tampil['KODEBI']=='100') echo "selected";?>>Aset Lancar</option>
									<option value="200" <?php if($tampil['KODEBI']=='200') echo "selected";?>>Aset Tidak Lancar</option>
									<option value="301" <?php if($tampil['KODEBI']=='301') echo "selected";?>>Hutang Jangka Pendek</option>
									<option value="302" <?php if($tampil['KODEBI']=='302') echo "selected";?>>Hutang Jangka Panjang</option>
									<option value="401" <?php if($tampil['KODEBI']=='401') echo "selected";?>>Aset Tidak Terikat</option>
                                    <option value="402" <?php if($tampil['KODEBI']=='402') echo "selected";?>>Aset Terikat</option>
                                    <option value="501" <?php if($tampil['KODEBI']=='501') echo "selected";?>>Pendapatan Aset Tidak Terikat</option>
                                    <option value="502" <?php if($tampil['KODEBI']=='502') echo "selected";?>>Pendapatan Aset Terikat</option>
                                    <option value="601" <?php if($tampil['KODEBI']=='601') echo "selected";?>>Beban Aset Tidak Terikat</option>
                                    <option value="602" <?php if($tampil['KODEBI']=='602') echo "selected";?>>Beban Aset Terikat</option>

									
									
								</select>
							</div>
                        </div>
						
						
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$cno_kira=$_POST['cno_kira'];
$cnama_kira=$_POST['cnama_kira'];
$chead_det=$_POST['chead_det'];
$cgroup=$_POST['cgroup'];
$ckodebi=$_POST['ckodebi'];
$cacctparent=$_POST['cacctparent'];



    $sql=$koneksi->query("update tabkira set CNAMA_KIRA='$cnama_kira',CHEAD_DET='$chead_det',CGROUP='$cgroup',CACCTPARENT='$cacctparent',KODEBI='$ckodebi' where CNO_KIRA='$cno_kira'");
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Ubah");
        window.location.href="?page=perkiraan";
        </script>
        <?php
    }
}

?>