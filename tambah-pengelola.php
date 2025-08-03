<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_ktp = trim($_POST['no_ktp']);
    $nama = trim($_POST['nama']);
    $jk = trim($_POST['jk']);
    $usia = trim($_POST['usia']);
    $alamat = trim($_POST['alamat']);
    $jabatan = trim($_POST['jabatan']);

    // Periksa apakah file diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
<<<<<<< HEAD
        $target_dir = "image/pengelola/";
        $foto = $_FILES['foto']['name'];
        $target_file = $target_dir . basename($foto);
=======
        $target_dir = "image/pengelola/";  // Folder penyimpanan
        $foto = $_FILES['foto']['name']; // Nama file asli
        $target_file = $target_dir . basename($foto); // Path lengkap file

        // Cek apakah file benar-benar gambar
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageFileType, $allowed_types)) {
<<<<<<< HEAD
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                  <script>
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal!',
                          text: 'Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan!',
                          confirmButtonColor: '#d33'
                      });
                  </script>";
        } else {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $query = $koneksi->prepare("INSERT INTO tb_pengelola (foto, no_ktp, nama, jk, usia, alamat, jabatan) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?)");
                $query->bind_param("ssssiss", $foto, $no_ktp, $nama, $jk, $usia, $alamat, $jabatan);

                if ($query->execute()) {
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                          <script>
                              Swal.fire({
                                  title: 'Berhasil!',
                                  text: 'Data pengelola berhasil ditambahkan',
                                  icon: 'success',
                                  confirmButtonColor: '#28a745',
                                  timer: 2000,
                                  timerProgressBar: true,
                                  showConfirmButton: false
                              }).then(() => {
                                  window.location.href = 'home-member.php?page=data-pengelola';
                              });
                          </script>";
                    exit();
                } else {
                    $error_message = addslashes($query->error);
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                          <script>
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Gagal!',
                                  text: 'Terjadi kesalahan: $error_message',
                                  confirmButtonColor: '#d33'
                              });
                          </script>";
                }
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                      <script>
                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal!',
                              text: 'Gagal mengupload foto!',
                              confirmButtonColor: '#d33'
                          });
                      </script>";
            }
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Gagal!',
                      text: 'Foto tidak diunggah! Pastikan memilih file.',
                      confirmButtonColor: '#d33'
                  });
              </script>";
    }
}
?>

=======
            echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan!');</script>";
        } else {
            // Cek dan upload file
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                // Simpan ke database
                $query = $koneksi->prepare("INSERT INTO tb_pengelola (foto, no_ktp, nama, jk, usia, alamat, jabatan) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?)");
                $query->bind_param("ssssiss", $foto, $no_ktp, $nama, $jk, $usia, $alamat, $jabatan);

                if ($query->execute()) {
                    echo "<script>alert('Data berhasil ditambahkan!'); window.location='home-member.php?page=data-pengelola';</script>";
                } else {
                    echo "<script>alert('Terjadi kesalahan saat menyimpan data!');</script>";
                }
            } else {
                echo "<script>alert('Gagal mengupload foto!');</script>";
            }
        }
    } else {
        echo "<script>alert('Foto tidak diunggah! Pastikan memilih file.');</script>";
    }
}

$koneksi->close();
?>



>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Tambah Pengelola</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
=======
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
<<<<<<< HEAD

=======
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
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
<<<<<<< HEAD
            background-color: #f8f9fa;
            /* Warna gray/abu-abu */
        }

        .form-control {
            background-color: rgba(216, 216, 216, 0.9);
            border: 1px solid #A9A9A9;
=======
        }

        .form-control {
            background-color: #f0f8ff;
            /* Warna biru muda */
            border: 1px solid #A9A9A9;
            /* Abu-abu gelap */

>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            transition: 0.3s;
        }

        .form-control:focus {
<<<<<<< HEAD
            background-color: #fff;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
=======
            background-color: #e6f7ff;
            /* Warna lebih terang saat fokus */
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
        }
    </style>
</head>

<body>
<<<<<<< HEAD
    <div class="container container-form">
        <div class="card p-4">
            <h4 class="text-center mb-4">Tambah Pengelola</h4>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Foto <span class="text-danger">*</span></label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No. KTP</label>
                    <input type="text" name="no_ktp" class="form-control" placeholder="Masukkan No. KTP">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
=======

    <div class="container container-form">
        <div class="card p-4">
            <h4 class="text-center mb-3"> Tambah Pengelola</h4>
            <form method="POST" action="" enctype="multipart/form-data">

                <div class="mb-2">
                    <label class="form-label"> Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                </div>


                <div class="mb-2">
                    <label class="form-label"> No. KTP</label>
                    <input type="text" name="no_ktp" class="form-control" placeholder="Masukkan No. KTP">
                </div>

                <div class="mb-2">
                    <label class="form-label"> Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                </div>

                <div class="mb-2">
                    <label class="form-label"> Jenis Kelamin</label>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
                    <select name="jk" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
<<<<<<< HEAD
                <div class="mb-3">
                    <label class="form-label">Usia <span class="text-danger">*</span></label>
                    <input type="number" name="usia" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                    <input type="text" name="jabatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"></textarea>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 me-2">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                    <a href="home-member.php?page=data-pengelola" class="btn btn-secondary px-4">Batal</a>
                </div>
=======

                <div class="mb-2">
                    <label class="form-label"> Usia</label>
                    <input type="number" name="usia" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label"> Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" required>
                </div>

                <div class="mb-2">
                    <label class="form-label"> Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"></textarea>
                </div>



                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary w-30"><i class="fas fa-save"></i> Simpan</button>
                    <a href="home-member.php?page=data-pengelola" class="btn btn-secondary w-30"> Batal</a>
                </div>

>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
=======
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
</body>

</html>