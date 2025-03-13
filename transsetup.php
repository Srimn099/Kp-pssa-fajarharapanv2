            <!-- Basic Examples -->
<?php


?>	
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
</head>		
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Daftar Transaksi Rutin</label></center></h1>
                            <a href="home-admin.php?page=tambah-transsetup" class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i>  Tambah Data</a>
							<a href="home-admin.php?page=form-master" class="btn btn-warning btn-sm">Kembali</a><br><br>
							</div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>NO. </th>
                                            <th>Perkiran Debet</th>
                                            <th>Perkiraan Kredit</th>
                                            <th>Keterangan Transaksi</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$no=1;
											$sql=$koneksi->query("select * from transsetup");
											while($data=$sql->fetch_assoc()){
											?>	
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $data['accdebet'].' - '.$data['cdebet'];?></td>
											<td><?php echo $data['acckredit'].' - '.$data['ckredit'];?></td>
											<td><?php echo $data['cket'];?></td>
											
											<td>
												<a href="home-admin.php?page=ubah-transsetup&id=
												<?php echo $data['id'];?>" class="
												btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick ="return confirm('Anda Yakin akan menghapus Data ini?')" href="home-admin.php?page=hapus-transsetup&id=
												<?php echo $data['id'];?>" class="
												btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

											</td>
										</tr>
											<?php } ?>
                                    </tbody>
									<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>
                                </table>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
