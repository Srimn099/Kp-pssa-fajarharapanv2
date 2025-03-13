            <!-- Basic Examples -->
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
</head>												
<?php
include 'koneksi.php';
	date_default_timezone_set('Asia/Jakarta');
//$koneksi = mysqli_connect("localhost","root",
$date=date('Y-m-d');
$tgl_awal=$date;
$tgl_akhir = $date;
?>	
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Buku Besar Mata Anggaran</label></center></h1><br>
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
				<form method="POST">
								<label for="">Tanggal</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="date" name="tgl_awal" value="<?php echo $date;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="date" name="tgl_akhir" value="<?php echo $date;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" value="Tentukan Tanggal" name="tanggal" class="btn btn-primary">
								<br><br><br>
				</form>
				<?php
					if(isset($_POST['tanggal'])){
							$tgl_awal = $_POST['tgl_awal'];
							$tgl_akhir = $_POST['tgl_akhir'];
					}
				?>	
                        <div class="body">
                            <div class="table-responsive">
                                <!--<table  class="datatable table table-hover table-bordered">-->
								<table  id="tabel-data" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>KODE ANGGARAN</th>
                                            <th>MATA ANGGARAN</th>
                                            <th>TGL AWAL</th>
                                            <th>TGL AKHIR</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											$no=1;
											$sql=$koneksi->query("select mstanggaran.kode,mstanggaran.deskripsi,'$tgl_awal' as tgl_awal,'$tgl_akhir' as tgl_akhir from mstanggaran order by kode");
											while($data=$sql->fetch_assoc()){
										?>
										<tr>
											<td><?php echo $data['kode'];?></td>
											<td><?php echo $data['deskripsi'];?></td>
											<td><?php echo date('d-m-Y',strtotime($data['tgl_awal']));?></td>
											<td><?php echo date('d-m-Y',strtotime($data['tgl_akhir']));?></td>
											<td>
												<a href="repbbanggaran.php?kode=<?php echo $data['kode'];?>&tgl_awal=
												<?php echo $data['tgl_awal'];?>&tgl_akhir=<?php echo $data['tgl_akhir'];?>" class="
												btn btn-danger btn-sm" target="_blank"><i class="fa fa-print"></i></a>

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
			
