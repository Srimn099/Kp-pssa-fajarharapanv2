<?php
include('koneksi.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tb_siswa WHERE id = '$id'";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location='home-member.php?page=data-siswa';</script>";
        exit;
    }
}

// Proses update data siswa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
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
        $query = "UPDATE tb_siswa SET 
                    nama='$nama', 
                    tgl_lahir='$tgl_lahir', 
                    jk='$jk', 
                    pendidikan_terakhir='$pendidikan_terakhir', 
                    nama_ayah='$nama_ayah', 
                    nama_ibu='$nama_ibu', 
                    pk_ortu='$pk_ortu', 
                    tgl_masuk='$tgl_masuk', 
                    tgl_keluar='$tgl_keluar', 
                    status='$status', 
                    alamat='$alamat' 
                  WHERE id='$id'";

        if ($koneksi->query($query)) {
            echo "<script>alert('Data berhasil diperbarui!'); window.location='home-member.php?page=data-siswa';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan, coba lagi!');</script>";
        }
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
    <title>Ubah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-form {
            max-width: 700px;
            margin: 50px auto;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            background-color: #f0f8ff;
            border: 1px solid #A9A9A9;
            transition: 0.3s;
        }

        .form-control:focus {
            background-color: #e6f7ff;
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>

<body>
    <div class="container container-form">
        <div class="card p-4">
            <h4 class="text-center mb-4">Ubah Data Siswa</h4>
            <form method="POST" action="">

                <div class="mb-2">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $row['tgl_lahir']; ?>" required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jk" class="form-control" required>
                        <option value="Laki-laki" <?= ($row['jk'] == "Laki-laki") ? "selected" : ""; ?>>Laki-laki</option>
                        <option value="Perempuan" <?= ($row['jk'] == "Perempuan") ? "selected" : ""; ?>>Perempuan</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan_terakhir" class="form-control" value="<?= $row['pendidikan_terakhir']; ?>" required>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Nama Ayah</label>
                        <input type="text" name="nama_ayah" class="form-control" value="<?= $row['nama_ayah']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nama Ibu</label>
                        <input type="text" name="nama_ibu" class="form-control" value="<?= $row['nama_ibu']; ?>">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">Pekerjaan Orang Tua</label>
                    <input type="text" name="pk_ortu" class="form-control" value="<?= $row['pk_ortu']; ?>">
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" class="form-control" value="<?= $row['tgl_masuk']; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tgl_keluar" class="form-control" value="<?= $row['tgl_keluar']; ?>">
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Yatim" <?= ($row['status'] == 'Yatim') ? 'selected' : ''; ?>>Yatim</option>
                        <option value="Piatu" <?= ($row['status'] == 'Piatu') ? 'selected' : ''; ?>>Piatu</option>
                        <option value="Yatim Piatu" <?= ($row['status'] == 'Yatim Piatu') ? 'selected' : ''; ?>>Yatim Piatu</option>
                        <option value="Dhuafa" <?= ($row['status'] == 'Dhuafa') ? 'selected' : ''; ?>>Dhuafa</option>
                    </select>
                </div>

                <div class="mb-2">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required><?= $row['alamat']; ?></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type=" submit" class="btn btn-primary w-30"><i class="fas fa-save"></i> Simpan Perubahan</button>
                    <a href="home-member.php?page=data-siswa" class="btn btn-secondary w-30">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>