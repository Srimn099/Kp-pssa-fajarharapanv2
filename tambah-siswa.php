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
<<<<<<< HEAD
    $status_sekolah = trim($_POST['status_sekolah']);
    $alamat = trim($_POST['alamat']);
    $keterangan = trim($_POST['keterangan']);

    if ($nama && $tgl_lahir && $jk && $alamat) {
        $query = "INSERT INTO tb_siswa (nama, tmp_lahir, tgl_lahir, jk, pendidikan_terakhir, nama_ayah, nama_ibu, pk_ortu, tgl_masuk, tgl_keluar, status, status_sekolah, alamat, keterangan) 
        VALUES ('$nama', '$tmp_lahir', '$tgl_lahir', '$jk', '$pendidikan_terakhir', '$nama_ayah', '$nama_ibu', '$pk_ortu', '$tgl_masuk', '$tgl_keluar','$status', '$status_sekolah', '$alamat','$keterangan')";

        $koneksi->query($query);
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: 'Data berhasil ditambahkan!',
                confirmButtonColor: '#198754',
                customClass: { popup: 'swal2-small' }
            }).then(() => {
                window.location.href = 'home-member.php?page=data-siswa';
            });
        </script>";
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Harap isi semua field yang wajib!',
                confirmButtonColor: '#d33',
                customClass: { popup: 'swal2-small' }
            });
        </script>";
    }
    $koneksi->close();
}
=======
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<<<<<<< HEAD
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
=======
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
        }

        .container-form {
            max-width: 700px;
<<<<<<< HEAD
=======
            /* Lebarkan form */
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            margin: 50px auto;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control {
<<<<<<< HEAD
            background-color: rgba(216, 216, 216, 0.9);
            border: 1px solid #A9A9A9;
=======
            background-color: #f0f8ff;
            /* Warna biru muda */
            border: 1px solid #A9A9A9;
            /* Abu-abu gelap */

>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            transition: 0.3s;
        }

        .form-control:focus {
            background-color: #e6f7ff;
<<<<<<< HEAD
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .swal2-small {
            font-size: 13px !important;
            padding: 1.2em 1em !important;
            width: 400px !important;
        }
=======
            /* Warna lebih terang saat fokus */
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    </style>
</head>

<body>
<<<<<<< HEAD
    <div class="container container-form">
        <div class="card p-4">
            <h4 class="text-center mb-3">Tambah Siswa</h4>
            <form method="POST" action="" id="formTambahSiswa" novalidate>
                <?php
                $fields = [
                    ['nama', 'Nama'],
                    ['tmp_lahir', 'Tempat Lahir'],
                    ['tgl_lahir', 'Tanggal Lahir', 'date'],
                    ['jk', 'Jenis Kelamin', 'select', ['Laki-laki', 'Perempuan']],
                    ['pendidikan_terakhir', 'Pendidikan Terakhir'],
                    ['nama_ayah', 'Nama Ayah'],
                    ['nama_ibu', 'Nama Ibu'],
                    ['pk_ortu', 'Pekerjaan Orang Tua'],
                    ['tgl_masuk', 'Tanggal Masuk', 'date'],
                    ['tgl_keluar', 'Tanggal Keluar', 'date'],
                    ['status', 'Status Siswa'],
                    ['status_sekolah', 'Status Sekolah', 'select', ['Aktif', 'Nonaktif', 'Lulus']],
                    ['alamat', 'Alamat', 'textarea'],
                    ['keterangan', 'Keterangan', 'textarea']
                ];

                foreach ($fields as $f) {
                    $name = $f[0];
                    $label = $f[1];
                    $type = $f[2] ?? 'text';
                    $options = $f[3] ?? [];
                    echo "<div class='mb-2'>
                            <label class='form-label'>$label</label>";

                    if ($type === 'select') {
                        echo "<select name='$name' class='form-control' required><option value=''>-- Pilih --</option>";
                        foreach ($options as $opt) echo "<option value='$opt'>$opt</option>";
                        echo "</select>";
                    } elseif ($type === 'textarea') {
                        echo "<textarea name='$name' class='form-control' rows='2'></textarea>";
                    } else {
                        echo "<input type='$type' name='$name' class='form-control' required>";
                    }

                    echo "<div class='invalid-feedback'>$label wajib diisi</div></div>";
                }
                ?>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary w-30"><i class="fas fa-save"></i> Simpan</button>
                    <a href="home-member.php?page=data-siswa" class="btn btn-secondary w-30">Batal</a>
=======

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
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="" disabled selected>--Pilih Status--</option>
                        <option value="Yatim">Yatim</option>
                        <option value="Piatu">Piatu</option>
                        <option value="Yatim Piatu">Yatim Piatu</option>
                        <option value="Dhuafa">Dhuafa</option>
                    </select>
                </div>


                <div class="mb-2">
                    <label class="form-label"> Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary w-30"><i class="fas fa-save"></i> Simpan</button>

                    <a href="home-member.php?page=data-siswa" class="btn btn-secondary w-30"> Batal</a>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                </div>
            </form>
        </div>
    </div>

<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("formTambahSiswa").addEventListener("submit", function(e) {
            e.preventDefault();
            const form = this;
            let isValid = true;
            form.querySelectorAll("[required]").forEach(function(input) {
                if (!input.value.trim()) {
                    input.classList.add("is-invalid");
                    isValid = false;
                } else {
                    input.classList.remove("is-invalid");
                }
            });
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap isi semua field yang wajib!',
                    confirmButtonColor: '#d33',
                    customClass: {
                        popup: 'swal2-small'
                    }
                });
                return;
            }
            Swal.fire({
                title: 'Konfirmasi',
                text: "Apakah Anda yakin ingin menyimpan data siswa ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
=======
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
</body>

</html>