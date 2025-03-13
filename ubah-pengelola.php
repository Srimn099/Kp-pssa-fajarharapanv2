<?php
// Memasukkan file koneksi.php
include('koneksi.php');

// Pastikan ada parameter id di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID pengelola tidak ditemukan!'); window.location.href='home-member.php?page=data-pengelola';</script>";
    exit;
}

$id = intval($_GET['id']);

// Ambil data pengelola berdasarkan ID
$query = "SELECT * FROM tb_pengelola WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='home-member.php?page=data-pengelola';</script>";
    exit;
}

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $no_ktp = $_POST['no_ktp'];
    $jk = $_POST['jk'];
    $usia = $_POST['usia'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $foto_lama = $_POST['foto_lama'];

    // Cek apakah ada file gambar yang diunggah
    if (!empty($_FILES['foto']['name'])) {
        $foto = basename($_FILES['foto']['name']);
        $target_dir = "image/pengelola/";
        $target_file = $target_dir . $foto;

        // Pindahkan file yang diunggah ke folder tujuan
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            // Hapus foto lama jika ada
            if (!empty($foto_lama) && file_exists($target_dir . $foto_lama)) {
                unlink($target_dir . $foto_lama);
            }
        } else {
            echo "<script>alert('Gagal mengunggah foto!');</script>";
        }
    } else {
        $foto = $foto_lama;
    }

    // Update data pengelola di database
    $updateQuery = "UPDATE tb_pengelola SET nama=?, no_ktp=?, jk=?, usia=?, alamat=?, jabatan=?, foto=? WHERE id=?";
    $stmt = $koneksi->prepare($updateQuery);
    $stmt->bind_param("sssssssi", $nama, $no_ktp, $jk, $usia, $alamat, $jabatan, $foto, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='home-member.php?page=data-pengelola';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Pengelola</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container container-form ">
        <div class="card p-4">
            <h2 class="mb-4 text-center">Ubah Data Pengelola</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($data['foto']) ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="no_ktp" class="form-label">No KTP</label>
                    <input type="text" name="no_ktp" class="form-control" value="<?= htmlspecialchars($data['no_ktp']) ?>" required>
                </div>
                <div class="mb-2">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" class=" form-select" required>
                        <option value="Laki-laki" <?= $data['jk'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= $data['jk'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="usia" class="form-label">Usia</label>
                    <input type="number" name="usia" class="form-control" value="<?= htmlspecialchars($data['usia']) ?>" required>
                </div>
                <div class="mb-2">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data['alamat']) ?></textarea>
                </div>
                <div class="mb-2">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="<?= htmlspecialchars($data['jabatan']) ?>" required>
                </div>
                <div class="mb-2">
                    <label for="foto" class="form-label">Foto</label><br>
                    <img src="image/pengelola/<?= htmlspecialchars($data['foto']) ?>" alt="Foto" width="100" height="100" class="mb-2"><br>
                    <input type="file" name="foto" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="home-member.php?page=data-pengelola" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<style>
    /* Ubah warna border input */
    .form-control,
    .form-select {
        border: 1px solid #808080;
        /* Warna biru */
        border-radius: 5px;
        padding: 8px;
        font-size: 14px;
    }

    /* Tombol agar lebih menonjol */
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .container-form {
        max-width: 700px;
        margin: 50px auto;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>


</html>