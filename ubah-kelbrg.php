<?php
include 'koneksi.php';

$kode = $_GET['kode'];
$sql1 = $koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql2 = $koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql3 = $koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql4 = $koneksi->query("select * from kelbrg where kode='$kode'");
$tampil = $sql4->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Kelompok Aktiva Tetap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f4f7f6;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Ubah warna border input */
        .form-control,
        .form-select {
            border: 1px solid #808080;
            /* Warna biru */
            border-radius: 5px;

        }

        .form-control:focus {
            /* background-color: #e6f7ff;
            border-color: #0056b3; */
            box-shadow: 0 5 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h3><i class="fas fa-edit"></i> Ubah Data Kelompok Aktiva Tetap</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="kode">Kode Kelompok</label>
                                <input type="text" name="kode" value="<?php echo $kode; ?>" class="form-control" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="nama">Deskripsi</label>
                                <input type="text" name="nama" value="<?php echo $tampil['nama']; ?>" class="form-control" />
                            </div>

                            <div class="mb-3">
                                <label for="accinvent">Perkiraan Aset</label>
                                <select name="accinvent" class="form-select">
                                    <option value="">-- Pilih Perkiraan --</option>
                                    <?php while ($aset = $sql1->fetch_assoc()) { ?>
                                        <option value="<?php echo $aset['CNO_KIRA']; ?>" <?php if ($aset['CNO_KIRA'] == $tampil['accbarang']) echo "selected"; ?>>
                                            <?php echo $aset['CNO_KIRA'] . ' - ' . $aset['CNAMA_KIRA']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="accakumsusut">Perkiraan Akumulasi Penyusutan</label>
                                <select name="accakumsusut" class="form-select">
                                    <option value="">-- Pilih Perkiraan --</option>
                                    <?php while ($akum = $sql2->fetch_assoc()) { ?>
                                        <option value="<?php echo $akum['CNO_KIRA']; ?>" <?php if ($akum['CNO_KIRA'] == $tampil['accakumsusut']) echo "selected"; ?>>
                                            <?php echo $akum['CNO_KIRA'] . ' - ' . $akum['CNAMA_KIRA']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="accbiayasusut">Perkiraan Biaya Penyusutan</label>
                                <select name="accbiayasusut" class="form-select">
                                    <option value="">-- Pilih Perkiraan --</option>
                                    <?php while ($bisut = $sql3->fetch_assoc()) { ?>
                                        <option value="<?php echo $bisut['CNO_KIRA']; ?>" <?php if ($bisut['CNO_KIRA'] == $tampil['accbisusut']) echo "selected"; ?>>
                                            <?php echo $bisut['CNO_KIRA'] . ' - ' . $bisut['CNAMA_KIRA']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="lsusut">Status Penyusutan</label>
                                <select name="lsusut" class="form-select">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Y" <?php if ($tampil['lflag'] == 'Y') echo "selected"; ?>>Disusutkan</option>
                                    <option value="N" <?php if ($tampil['lflag'] == 'N') echo "selected"; ?>>Tidak Disusutkan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="home-member.php?page=kelbrg" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>