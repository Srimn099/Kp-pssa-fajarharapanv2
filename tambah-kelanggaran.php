<?php
include 'koneksi.php';
$sql1 = $koneksi->query("SELECT * FROM kelanggaran ORDER BY kodekel");
?>

<head>
    <style>
        .form-control,
        .form-select {
            border: 1px solid gray;
            border-radius: 5px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
        }
    </style>
</head>


<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4>Tambah Data Kelompok Anggaran</h4>
        </div>
        <div class="card-body">
            <a href="?page=kelanggaran" class="btn btn-warning mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="kodekel" class="form-label">Kode Kelompok Anggaran</label>
                    <input type="text" name="kodekel" class="form-control" required />
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" required />
                </div>

                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="D">PENDAPATAN</option>
                        <option value="B">BIAYA</option>
                    </select>
                </div>

                <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $kode = $_POST['kodekel'];
    $deskripsi = $_POST['deskripsi'];
    $jenis = $_POST['jenis'];
    $cekanggaran = mysqli_query($koneksi, "SELECT * FROM kelanggaran WHERE kodekel='$kode'");
    $jumrow = $cekanggaran->num_rows;

    if ($jumrow > 0) {
        echo "<script>alert('Kode Kelompok Anggaran Sudah Ada Dalam Database'); window.location.href='';</script>";
    } else {
        $sql = $koneksi->query("INSERT INTO kelanggaran (kodekel, deskripsi, jenis) VALUES ('$kode', '$deskripsi', '$jenis')");

        if ($sql) {
            echo "<script>alert('Data Berhasil Disimpan'); window.location.href='?page=mataanggaran';</script>";
        }
    }
}
?>