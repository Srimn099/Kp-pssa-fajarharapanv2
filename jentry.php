<?php
date_default_timezone_set('Asia/Jakarta');
include 'koneksi.php';

$date=date('Y-m-d');
?>  
<head>
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="plugins\jquery/jquery.js"></script>
	
</head>

<div style="border:0; padding:10px; width:924px; height:auto;">
				<div >
                    <h1><center><label class="label label-success">Jurnal Entry</label></center></h1><br><br>
					<a href="home-admin.php?page=form-jurnal" class="btn btn-warning btn-sm">Kembali</a>
					
                        
				
				
										
										<form method="POST">
										<br>
										&nbsp;&nbsp;No. Perkiraan&nbsp;&nbsp;<input type="text" size="20" maxlength="45" id="cno_kira" name="cno_kira" data-toggle="modal" data-target="#myModal"/>&nbsp;&nbsp;<input type="text" id="cnama_kira" name="cnama_kira" size="50" maxlength="45" readonly />
										<table width="924px" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
										<td width="2%">&nbspDebet/Kredit</td>
										<td width="3%"><select class="form-control" name="cdebkred">
															<option value="D">Debet</option>
															<option value="K">Kredit</option>
										</select>
										</td>
										<td width="1%">&nbsp&nbsp&nbsp&nbspNilai</td>
										<td width="3%" ><input type="number" onchange="setTwoNumberDecimal" min="0" max="99000000000" step="0.01" value="0.00"id="idramount" size="100" maxlength="45" name="idramount" /></td>
										<!--<table width="964" border="0" align="center" cellpadding="0" cellspacing="0">-->
												<!--<tr height="46">
													<td>&nbsp;</td>
													<td>No. Perkiraan</td>
													<td><input type="text" name="cno_kira" size="50" maxlength="45" /></td>
													<td><input type="text" name="cnama_kira" size="50" maxlength="45" /></td>
												</tr>
												<tr height="46">
													<td>&nbsp;</td>
													<td><select name="cdebkred" >
															<option value="D">Debet</option>
															<option value="K">Kredit</option>
														</select>
													</td>
													<td>Nilai</td>
													<td><input type="number" id="idramount" size="100" maxlength="45" name="idramount" /></td>
												</tr>
												<tr height="46">
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td><input type="submit" value="Tambahkan" name="simpan" class="btn btn-primary"></td>
												</tr>-->
										<!--</table>	-->
												<td width="10%">&nbsp;&nbsp;<input type="submit" value="Tambahkan" name="simpan" class="btn btn-primary"></td><br><br>
											</tr>
										</table>
										</FORM>
										
									
				
				<?php
				
					if(isset($_POST['simpan'])){
						$cno_kira = $_POST['cno_kira'];
						$cnama_kira=$_POST['cnama_kira'];
						$cdebkred=$_POST['cdebkred'];
						$nilai=$_POST['idramount'];
						if($cdebkred=='D'){
							$debet=$nilai;
							$kredit=0;
						}else{
							$kredit=$nilai;
							$debet=0;
						}
						if($cno_kira==''){
							echo "<script type='text/javascript'>alert('Nomor Perkiraan Kosong');</script>";
						}else{
						$dodo=mysqli_query($koneksi,"insert into tempjur (id,cno_kira,cnama_kira,debet,kredit) values ('$user','$cno_kira','$cnama_kira','$debet','$kredit')");
						}
					}
					
				?>
				<form method="POST">
									
					<div class="body">
						<table class="table table-striped ">
							<thead>
								<tr>
									<th>No. Perkiraan</th>
									<th>Nama Perkiraan</th>
									<th>Debet</th>
									<th>Kredit</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									
									$no=1;
									$sql=mysqli_query($koneksi,"select * from tempjur where id='$user'");
									$totdebet=0;
									$totkredit=0;
									while($data=$sql->fetch_assoc()){
										$deb=$data['debet'];
										$kred=$data['kredit'];
									
										$totdebet=$totdebet+$deb; //$totdebet+data['debet'];
										$totkredit=$totkredit+$kred //$totkredit+data['kredit'];
									
								?>
								<tr>
									<td><?php echo $data['cno_kira'];?></td>
									<td><?php echo $data['cnama_kira'];?></td>
									<td align="right"><?php echo number_format($data['debet'],2,',','.');?></td>
									<td align="right"><?php echo number_format($data['kredit'],2,',','.');?></td>
									<td>
										<a onclick ="return confirm('Anda Yakin akan menghapus Data ini?')" href="home-admin.php?page=hapus-jentry&id=
												<?php echo $data['id'];?>&cno_kira=<?php echo $data['cno_kira'];?>">Hapus</a>

									</td>
									</tr>
								<?php }
								
								?>
							</tbody>
						</table>
						<br>
						<br>
							<label for="">Tanggal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="date" name="dtgl" value="<?php echo $date;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="">Keterangan</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="text" name="cket" size="60" ><br><br>
							<label for="">Total Debet</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="number" align="right" name="totdebet" value="<?php echo $totdebet;?>" >&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="">Total Kredit</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="number" align="right" name="totkredit"  value="<?php $totkredit;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" value="Book" name="buku" class="btn btn-primary">
						
					</div>
				</form>
				<?php
				
					if(isset($_POST['buku'])){
						$totdebet1 = $_POST['totdebet'];
						$totkredit1 = $_POST['totkredit'];
						$date=date("Y-m-d");
						$vdtgl=$_POST['dtgl'];
						$vcket=$_POST['cket'];
						
						if($vcket==''){
					
							echo "<script type='text/javascript'>alert('Keterangan Transaksi Harus Diisi!');</script>";
						}else{
							
							if($vdtgl==$date){
								$cnt=mysqli_query($koneksi,"insert into counter (cnick) values ('$user')");
								$cnt1=mysqli_query($koneksi,"select max(id) as maxtr from counter where cnick='$user'");
								$ii=$cnt1->fetch_assoc();
								$vnnotrans=$ii['maxtr'];
							}else{
								$cnt1=mysqli_query($koneksi,"select max(NNO_TRANS) as maxtr from jurnal where DTGL_TRANS='$vdtgl'");
								$ii=$cnt1->fetch_assoc();
								$numrow=$ii->num_rows;
								if($numrow==0){
									$vnnotrans=1;
								}else{
									$maxtr=$ii['maxtr'];
									$vnnotrans=$maxtr+1;
								}
	
							}
							
							if($totdebet1==$totkredit1){
								$sql1=mysqli_query($koneksi,"select * from tempjur where id='$user'");
								while($duta=$sql1->fetch_assoc()){
								//jurnal($koneksi,$vdtgl,$vcket,$vcnokira,$vcdebkred,$vnidramount,$vcuser,$vnnotrans)
									$vcnokira=$duta['cno_kira'];
									if($duta['debet']>0){
										$vcdebkred='D';
										$vnidramount=$duta['debet'];
									}else{
										$vcdebkred='K';
										$vnidramount=$duta['kredit'];
										
									}
									jurnal($koneksi,$vdtgl,$vcket,$vcnokira,$vcdebkred,$vnidramount,$user,$vnnotrans);
							
								}
								$hapus=mysqli_query($koneksi,"delete from tempjur where id='$user'");
								?>
								<script type="text/javascript">
									alert("Transaksi Jurnal Sudah Dibukukan!");
									window.location.href="?page=jentry";
								</script>
								<?php
							}else{
								echo "<script type='text/javascript'>alert('Total Debet<>Total Kredit. Transaksi Tidak Bisa Dijalankan');</script>";
							}
							
						}
						
					}
					mysqli_close($koneksi);
				?>
				
				
</div>




<!-- Awal Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
	<script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="js/jquery-1.11.2.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="datatables-1.11.3/js/jquery.dataTables.js"></script>
        <script src="datatables-1.11.3/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript"></script>	

	


                <div class="modal-dialog">
                    <div class="modal-content">
                       
                         <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title" id="myModalLabel">
                                TABLE PERKIRAAN
                            </h2>
                            
                        </div>
                        <div class="modal-body">
                            
                                <table id="lookup" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nomor Perkiraan</th>
                                            <th>Nama Perkiraan</th>
                                             
                                        </tr>
                                    </thead>

                                    <tbody>
                                    
                                    <?php
									include 'koneksi.php';
									
                                    $sql= $koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira)");
                                    while($data= $sql->fetch_assoc()){


                                    ?>
                                    
                                    <tr class="pilih" data-cnokira="<?php echo $data['CNO_KIRA']; ?>" data-cnamakira="<?php echo $data['CNAMA_KIRA'];?>">
                                        
                                        <td><?php echo $data['CNO_KIRA']?></td>
                                        <td><?php echo $data['CNAMA_KIRA']?></td>
                                        
                                    </tr>
                                    <?php } 
									mysqli_close($koneksi);
									?>        
	                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                       
            </div>
        	<script>
        // jika dipilih, no_pasien akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("cno_kira").value = $(this).attr('data-cnokira');
				document.getElementById("cnama_kira").value = $(this).attr('data-cnamakira');
                $('#myModal').modal('hide');
            });
            

// tabel lookup pasien
            $(function () {
                $("#lookup").dataTable();
            });
        
        </script>

<!--Akhir Modal-->



<div id="myModal1" class="modal fade" role="dialog">
   <div class="modal-dialog">
	<!-- konten modal-->
	<div class="modal-content">
		<!-- heading modal -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Bagian heading modal</h4>
		</div>
		<!-- body modal -->
		<div class="modal-body">
			<p>bagian body modal.</p>
		</div>
		<!-- footer modal -->
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
		</div>
	</div>
   </div>
</div>