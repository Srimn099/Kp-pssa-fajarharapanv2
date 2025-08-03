<<<<<<< HEAD
<!-- Styles & Scripts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-color: #3a57e8;
        --secondary-color: #2c3e50;
        --danger-color: #dc3545;
        --light-gray: #f8f9fa;
        --medium-gray: #e9ecef;
        --dark-gray: #495057;
        --border-color: #dee2e6;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--light-gray);
        color: #212529;
    }

    .card-jurnal {
        max-width: 700px;
        margin: 2rem auto;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .card-header {
        background-color: var(--primary-color);
        color: white;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .card-header h4 {
        font-weight: 600;
        margin: 0;
        font-size: 1.25rem;
    }

    .card-body {
        padding: 1.5rem;
        background-color: white;
    }

    .action-btn {
        display: flex;
        align-items: center;
        padding: 0.875rem 1.25rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
        margin-bottom: 0.75rem;
        background-color: var(--light-gray);
        color: var(--secondary-color);
        border: 1px solid var(--border-color);
        text-decoration: none;
    }

    .action-btn i {
        margin-right: 12px;
        font-size: 1.1rem;
        color: var(--primary-color);
    }

    .action-btn:hover {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-1px);
    }

    .action-btn:hover i {
        color: white;
    }

    /* Special style for Balance Repair button */
    .btn-repair {
        background-color: rgba(220, 53, 69, 0.05);
        border-color: rgba(220, 53, 69, 0.3);
    }

    .btn-repair i {
        color: var(--danger-color);
    }

    .btn-repair:hover {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background-color: var(--primary-color);
        color: white;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1rem 1.5rem;
    }

    /* Red header for repair modal */
    .modal-repair .modal-header {
        background-color: var(--danger-color);
    }

    .modal-title {
        font-weight: 500;
        font-size: 1.1rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .form-control {
        border-radius: 6px;
        padding: 0.625rem 1rem;
        border: 1px solid var(--border-color);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(58, 87, 232, 0.15);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border: none;
        padding: 0.5rem 1.25rem;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-danger {
        background-color: var(--danger-color);
    }

    .btn-secondary {
        background-color: var(--medium-gray);
        color: var(--dark-gray);
        border: none;
        padding: 0.5rem 1.25rem;
        border-radius: 6px;
        font-weight: 500;
    }

    @media (max-width: 576px) {
        .card-jurnal {
            margin: 1rem;
        }

        .action-btn {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
    }
</style>

<div class="container py-4">
    <div class="card card-jurnal">
        <div class="card-header text-center">
            <h4><i class="fas fa-book me-2"></i>Journal Transactions</h4>
        </div>
        <div class="card-body">
            <!-- Modified Journal Entry Link -->
            <a href="home-admin.php?page=jentry" class="action-btn" onclick="event.stopPropagation()">
                <i class="fas fa-plus"></i> Journal Entry
            </a>

            <!-- Other links with same modification -->
            <a href="home-admin.php?page=transrutin" class="action-btn" onclick="event.stopPropagation()">
                <i class="fas fa-repeat"></i> Routine Transactions
            </a>

            <a href="home-admin.php?page=list-jurnal-admin" class="action-btn" onclick="event.stopPropagation()">
                <i class="fas fa-list"></i> Transaction List
            </a>

            <a href="home-admin.php?page=bukubesar-admin" class="action-btn" onclick="event.stopPropagation()">
                <i class="fas fa-book-open"></i> General Ledger
            </a>

            <!-- Keep button for modal trigger -->
            <button class="action-btn btn-repair" data-bs-toggle="modal" data-bs-target="#repairModal">
                <i class="fas fa-tools"></i> Balance Repair
            </button>
        </div>
    </div>
</div>
<!-- Repair Balance Modal -->
<div class="modal fade modal-repair" id="repairModal" tabindex="-1" aria-labelledby="repairModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="home-admin.php?page=repairneraca">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-tools me-2"></i>Balance Repair</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tgl_valid" class="form-label">Validation Date</label>
                        <input type="date" name="tgl_valid" id="tgl_valid" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="proses" class="btn btn-danger">Process Repair</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Set today's date as default for the date input
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('tgl_valid').valueAsDate = new Date();
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a.action-btn').forEach(link => {
            link.addEventListener('click', function(e) {
                window.location.href = this.href;
            });
        });
    });
</script>
=======
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
