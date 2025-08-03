<?php
include 'koneksi.php';
$sql1 = $koneksi->query("SELECT * FROM kelanggaran ORDER BY kodekel");
?>

<head>
    <style>
<<<<<<< HEAD
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 670px;
            margin: 50px auto;
            /* Tambah jarak ke bawah */
        }

        .form-control,
        .form-select {
            border: 1px solid #ced4da;
            border-radius: 6px;
            padding: 10px;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .card-header h4 {
            margin: 0;
        }


        .btn {
            font-size: 14px;
            border-radius: 8px;
=======
        .form-control,
        .form-select {
            border: 1px solid gray;
            border-radius: 5px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
        }
    </style>
</head>

<<<<<<< HEAD
<div class="container form-container">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h4>Tambah Kelompok Anggaran</h4>
        </div>
        <div class="card-body">
=======

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4>Tambah Data Kelompok Anggaran</h4>
        </div>
        <div class="card-body">
            <a href="?page=kelanggaran" class="btn btn-warning mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="kodekel" class="form-label">Kode Kelompok Anggaran</label>
                    <input type="text" name="kodekel" class="form-control" required />
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" required />
                </div>

<<<<<<< HEAD
                <div class="mb-4">
=======
                <div class="mb-3">
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    <label for="jenis" class="form-label">Jenis</label>
                    <select name="jenis" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="D">PENDAPATAN</option>
                        <option value="B">BIAYA</option>
                    </select>
                </div>

<<<<<<< HEAD
                <div class="d-flex justify-content-center gap-2">
                    <a href="?page=kelanggaran" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Batal
                    </a>
                    <button type="submit" name="simpan" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
=======
                <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            </form>
        </div>
    </div>
</div>
<<<<<<< HEAD
<!-- Tambahkan ini di bagian <head> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
=======
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f

<?php
if (isset($_POST['simpan'])) {
    $kode = $_POST['kodekel'];
    $deskripsi = $_POST['deskripsi'];
    $jenis = $_POST['jenis'];
    $cekanggaran = mysqli_query($koneksi, "SELECT * FROM kelanggaran WHERE kodekel='$kode'");
    $jumrow = $cekanggaran->num_rows;

    if ($jumrow > 0) {
<<<<<<< HEAD
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Duplikat!',
            text: 'Kode Kelompok Anggaran sudah ada dalam database.',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.location.href = '';
        });
        </script>";
=======
        echo "<script>alert('Kode Kelompok Anggaran Sudah Ada Dalam Database'); window.location.href='';</script>";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    } else {
        $sql = $koneksi->query("INSERT INTO kelanggaran (kodekel, deskripsi, jenis) VALUES ('$kode', '$deskripsi', '$jenis')");

        if ($sql) {
<<<<<<< HEAD
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil disimpan.',
                confirmButtonColor: '#28a745'
            }).then(() => {
                window.location.href = '?page=kelanggaran';
            });
            </script>";
=======
            echo "<script>alert('Data Berhasil Disimpan'); window.location.href='?page=mataanggaran';</script>";
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
        }
    }
}
?>