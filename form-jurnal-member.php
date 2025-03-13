<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center">
                <h2>Transaksi</h2>
            </div>
            <div class="card-body text-center">
                <div class="list-group">
                    <a href="home-member.php?page=transrutin" class="list-group-item list-group-item-action"><i class="fa fa-money-bill-wave"></i> Transaksi Rutin</a>
                    <a href="home-member.php?page=list-jurnal" class="list-group-item list-group-item-action"><i class="fa fa-book"></i> List Jurnal</a>
                    <a href="home-member.php?page=bukubesar" class="list-group-item list-group-item-action"><i class="fa fa-balance-scale"></i> Buku Besar</a>
                    <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#repairModal"><i class="fa fa-tools"></i> Repair Neraca</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Repair Neraca -->
    <div class="modal fade" id="repairModal" tabindex="-1" aria-labelledby="repairModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="repairModalLabel">Repair Neraca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="home-member.php?page=repairneraca">
                        <div class="mb-3">
                            <label for="tgl_valid" class="form-label">Tanggal Valid</label>
                            <input type="date" name="tgl_valid" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="proses" class="btn btn-success">Proses</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>