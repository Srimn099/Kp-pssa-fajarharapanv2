<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktiva Tetap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            text-align: center;
        }

        h1 {
            color: black;
            margin-bottom: 30px;
        }

        .btn-group-custom {
            display: flex;
            flex-direction: column;
            /* Align buttons vertically */
            gap: 10px;
            justify-content: center;
            align-items: center;
            /* Center buttons horizontally */
            max-width: 300px;
            margin: 0 auto;
            /* Center the group within the parent container */
        }

        .btn-custom {
            width: 100%;
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
        <h1><i class="fa fa-boxes icon"></i> Aktiva Tetap</h1>
        <div class="btn-group-custom">
            <a href="?page=kelbrg" class="btn-custom btn-anggaran"><i class="fa fa-layer-group icon"></i> Kelompok Barang</a>
            <a href="?page=inventory" class="btn-custom btn-anggaran"><i class="fa fa-clipboard-list icon"></i> Data Aktiva Tetap</a>
        </div>
    </div>
</body>

</html>