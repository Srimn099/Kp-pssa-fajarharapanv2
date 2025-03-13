            <!-- Basic Examples -->
<head>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="datatables-1.11.3/css/jquery.dataTables.min.css">
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="datatables-1.11.3/js/jquery.dataTables.min.js"></script>
<link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

</head>												
<?php


?>	
                        <div >
                            <h1><center><label class="label label-success">Transaksi Jurnal</label></center></h1>
							<br><br><br>
                            <center><a href="home-admin.php?page=jentry" class="">Entry Jurnal</a></center><br>
							<center><a href="home-admin.php?page=transrutin" class="">Transaksi Rutin</a></center><br> 
							<center><a href="home-admin.php?page=list-jurnal-admin" class="">List Transaksi Jurnal</a></center><br> 
							<center><a href="home-admin.php?page=bukubesar-admin" class="">Buku Besar</a></center><br> 
							<center><a data-toggle="modal" data-target="#smallModal12" class="">Repair Neraca</a></center><br>
							
                        </div>
            <!-- #END# Basic Examples -->
			
<div class="modal fade" id="smallModal12" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
 <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="datatables-1.11.3/js/jquery.dataTables.js"></script>
        <script src="datatables-1.11.3/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript"></script>	

		<div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="smallModalLabel">Repair Neraca</h4>
            </div>
            <div class="modal-body">
            <form method="POST" action="home-admin.php?page=repairneraca" >
            <label for="">Tanggal Valid</label>
            <div class="form-group">
                <div class="form-line">
                    <input type="date" name="tgl_valid"class="form-control" />
                </div>
            </div>

            
            </div>
            <div class="modal-footer">
                <button type="submit" name="proses" class="btn btn-primary">Proses</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
		</div>
    </div>
</div>
