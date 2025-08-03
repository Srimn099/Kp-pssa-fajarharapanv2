            <!-- Basic Examples -->
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
</head>												
<?php


?>	
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Chart of Account (Tabel Perkiraan)</label></center></h1><br>
                            <a href="home-admin.php?page=tambah-perkiraan"" class="btn btn-primary btn-sm"><i class="fa fa-user-plus"></i>  Tambah Data</a>
							<a href="home-admin.php?page=form-master" class="btn btn-warning btn-sm">Kembali</a>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
						</div>
                        <div class="body">
                            <div class="table-responsive">
                                <!--<table  class="datatable table table-hover table-bordered">-->
								<table  id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>NO. </th>
                                            <th>No. PERKIRAAN</th>
                                            <th>NAMA PERKIRAAN</th>
                                            <th>TIPE</th>
                                            <th>KELOMPOK</th>
                                            <th>PERK INDUK</th>
											<th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$no=1;
											$sql=$koneksi->query("select * from tabkira order by CNO_KIRA");
											while($data=$sql->fetch_assoc()){
												if($data['CHEAD_DET']=="H"){
													$tipe="General";
												}else{
													$tipe="Detail";
												}
												if($data['CGROUP']=="A"){
													$cgroup="AKTIVA";
												}elseif($data['CGROUP']=="B"){
													$cgroup="BIAYA";
												}elseif($data['CGROUP']=="S"){
													$cgroup="PASIVA";
												}elseif($data['CGROUP']=="D"){
													$cgroup="PENDAPATAN";
												}else{
													$cgroup="ADMINISTRATIF";
												}
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo $data['CNO_KIRA'];?></td>
											<td><?php echo $data['CNAMA_KIRA'];?></td>
											<td><?php echo $tipe;?></td>
											<td><?php echo $cgroup;?></td>
											<td><?php echo $data['CACCTPARENT'];?></td>
											
											<td>
												<a href="home-admin.php?page=ubah-perkiraan&cno_kira=
												<?php echo $data['CNO_KIRA'];?>" class="
												btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick ="return confirm('Anda Yakin akan menghapus Data ini?')" href="home-admin.php?page=hapus-perkiraan&cno_kira=
												<?php echo $data['CNO_KIRA'];?>" class="
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
			
