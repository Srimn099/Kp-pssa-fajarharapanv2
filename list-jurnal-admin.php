            <!-- Basic Examples -->
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
</head>												
<?php
include 'koneksi.php';

?>	
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">List Jurnal Transaksi</label></center></h1><br>
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
                                            <th>TANGGAL</th>
                                            <th>No. TRANSAKSI</th>
                                            <th>KETERANGAN</th>
                                            <th>NILAI</th>
											<th>ANGGARAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$no=1;
											$sql=$koneksi->query("select DTGL_TRANS,NNO_TRANS,CKET,SUM(IDRAMOUNT) as nilai,CPROJECT from jurnal where CTRANSFLAG='TR' and CDEBKRED='D' group by DTGL_TRANS,NNO_TRANS");
											while($data=$sql->fetch_assoc()){
										?>
										<tr>
											<td><?php echo date('d-m-Y',strtotime($data['DTGL_TRANS']));?></td>
											<td><?php echo $data['NNO_TRANS'];?></td>
											<td><?php echo $data['CKET'];?></td>
											<td align="right"><?php echo number_format($data['nilai'],2,',','.');?></td>
											<td><?php echo $data['CPROJECT'];?></td>
											
											<td>
											<a href="?page=ubah-jurnal-admin&tanggal=
												<?php echo $data['DTGL_TRANS'];?>&nno_trans=<?php echo $data['NNO_TRANS'];?>" class="
												btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick ="return confirm('Anda Yakin akan menghapus Data ini?')" href="home-member.php?page=hapus-jurnal-admin&tanggal=
												<?php echo $data['DTGL_TRANS'];?>&notrans=<?php echo $data['NNO_TRANS'];?>" class="
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
			
