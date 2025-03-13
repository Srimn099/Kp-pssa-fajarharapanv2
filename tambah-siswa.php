<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $tmp_lahir = trim($_POST['tmp_lahir']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $pendidikan_terakhir = trim($_POST['pendidikan_terakhir']);
    $nama_ayah = trim($_POST['nama_ayah']);
    $nama_ibu = trim($_POST['nama_ibu']);
    $pk_ortu = trim($_POST['pk_ortu']);
    $tgl_masuk = $_POST['tgl_masuk'];
    $tgl_keluar = $_POST['tgl_keluar'];
    $status = trim($_POST['status']);
    $alamat = trim($_POST['alamat']);

    if ($nama && $tgl_lahir && $jk && $alamat) {
        $query = "INSERT INTO tb_siswa (nama, tmp_lahir, tgl_lahir, jk, pendidikan_terakhir, nama_ayah, nama_ibu, pk_ortu, tgl_masuk, tgl_keluar, status, alamat) 
        VALUES ('$nama', '$tmp_lahir', '$tgl_lahir', '$jk', '$pendidikan_terakhir', '$nama_ayah', '$nama_ibu', '$pk_ortu', '$tgl_masuk', '$tgl_keluar', '$status', '$alamat')";

        $koneksi->query($query);
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='home-member.php?page=data-siswa';</script>";
    } else {
        echo "<script>alert('Harap isi semua field yang wajib!');</script>";
    }
}
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
        }

        .container-form {
            max-width: 700px;
            /* Lebarkan form */
            margin: 50px auto;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            background-color: #f0f8ff;
            /* Warna biru muda */
            border: 1px solid #A9A9A9;
            /* Abu-abu gelap */

            transition: 0.3s;
        }

        .form-control:focus {
            background-color: #e6f7ff;
            /* Warna lebih terang saat fokus */
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>

<body>

    <div class="container container-form">
        <div class="card p-4">
            <h4 class="text-center mb-3"> Tambah Siswa</h4>
            <form method="POST" action="">

                <div class="mb-2">
                    <label class="form-label"> Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama siswa" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tmp_lahir" class="form-control" placeholder="" required>
                </div>
                <div class="mb-2">
                    <label class="form-label"> Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label class="form-label"> Jenis Kelamin</label>
                    <select name="jk" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label"></i> Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan_terakhir" class="form-control" required>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label"> Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"> Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label"> Pekerjaan Orang Tua</label>
                    <input type="text" name="pk_ortu" class="form-control" required>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label"></i> Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"></i> Tanggal Keluar</label>
                        <input type="date" name="tgl_keluar" class="form-control">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label"> Status</label>
                    <input type="text" name="status" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label class="form-label"> Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary w-30"><i class="fas fa-save"></i> Simpan</button>

                    <a href="home-member.php?page=data-siswa" class="btn btn-secondary w-30"> Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>