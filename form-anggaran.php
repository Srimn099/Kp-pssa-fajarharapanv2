<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .card-custom {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .btn-group-custom {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            /* Spasi antar tombol */
        }

        .btn-custom {
            width: 250px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-anggaran {
            background: linear-gradient(135deg, #28a745, #218838);
            border: none;
        }

        .btn-anggaran:hover {
            background: #1e7e34;
            transform: scale(1.05);
        }

        .icon {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card-custom">
                    <h1><i class="fa fa-chart-line icon"></i> Anggaran</h1>
                    <hr>

                    <div class="btn-group-custom">
                        <a href="?page=kelanggaran" class="btn btn-anggaran btn-custom">
                            <i class="fa fa-folder-open icon"></i> Kelompok Anggaran
                        </a>
                        <a href="?page=mataanggaran" class="btn btn-anggaran btn-custom">
                            <i class="fa fa-book icon"></i> Data Mata Anggaran
                        </a>
                        <a href="?page=rapb&tahun=<?php echo date('Y'); ?>" class="btn btn-anggaran btn-custom">
                            <i class="fa fa-coins icon"></i> Rencana Anggaran Pendapatan & Biaya
                        </a>
                        <a href="?page=bukubesaranggaran" class="btn btn-anggaran btn-custom">
                            <i class="fa fa-balance-scale icon"></i> Buku Besar Mata Anggaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>