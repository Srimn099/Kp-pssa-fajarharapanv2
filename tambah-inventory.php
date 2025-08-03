<<<<<<< HEAD
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include 'koneksi.php';
$sql = mysqli_query($koneksi, "SELECT * FROM kelbrg ORDER BY kode"); ?>

<div class="container py-4">
    <div class="form-container">
        <div class="card shadow">
            <div class="card-header py-3">
                <h4><i class="fas fa-cube me-2"></i>Tambah Aset Tetap</h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="inventno" class="form-label">Nomor Register</label>
                        <input type="text" name="inventno" class="form-control" id="inventno" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="kelompok" class="form-label">Kelompok Barang</label>
                        <select name="kelompok" class="form-select" id="kelompok" required>
                            <option value="" disabled selected>-- Pilih Kelompok --</option>
                            <?php while ($klp = $sql->fetch_assoc()) { ?>
                                <option value="<?= $klp['kode']; ?>"><?= $klp['kode'] . ' - ' . $klp['nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dbeli" class="form-label">Tanggal Perolehan</label>
                        <input type="date" name="dbeli" class="form-control" id="dbeli" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Nilai Perolehan</label>
                        <input type="text" name="harga" class="form-control" id="harga" required>
                    </div>

                    <div class="mb-3">
                        <label for="masa" class="form-label">Masa Manfaat (bulan)</label>
                        <input type="number" name="masa" class="form-control" id="masa" required>
                    </div>

                    <div class="mb-3">
                        <label for="kondisi" class="form-label">Kondisi Barang</label>
                        <select name="kondisi" class="form-select" id="kondisi" required>
                            <option value="" disabled selected>-- Pilih Kondisi --</option>
                            <option value="B">Baik</option>
                            <option value="S">Sedang</option>
                            <option value="K">Kurang Baik</option>
                            <option value="R">Rusak</option>
                        </select>
                    </div>

                    <div class="text-end mt-4">
                        <a href="home-admin.php?page=inventory" class="btn btn-secondary btn-custom">
                            <i class="fa-solid fa-xmark"></i>Batal
                        </a>
                        <button type="submit" name="simpan" class="btn btn-success btn-custom">
                            <i class="fas fa-save"></i>Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<?php
if (isset($_POST['simpan'])) {
    date_default_timezone_set('Asia/Jakarta');
    $inventno = $_POST['inventno'];
    $nama = $_POST['nama'];
    $kelompok = $_POST['kelompok'];
    $dbeli = $_POST['dbeli'];
    $harga = $_POST['harga'];
    $masa = $_POST['masa'];
    $kondisi = $_POST['kondisi'];

    $cekinvent = mysqli_query($koneksi, "SELECT * FROM inventory WHERE inventno='$inventno'");
    if ($cekinvent->num_rows > 0) {
        echo "<script>alert('No. Register Barang sudah terdaftar!');</script>";
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO inventory (inventno, nama, kelompok, dbeli, harga, masa, latitude) VALUES ('$inventno','$nama','$kelompok','$dbeli','$harga','$masa','$kondisi')");
        if ($simpan) {
            echo "
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Data aset berhasil ditambahkan.',
        showConfirmButton: false,
        timer: 1800
    }).then(() => {
        window.location.href='?page=inventory';
    });
</script>";
        }
    }
}
?>
<script>
    const hargaInput = document.getElementById("harga");

    hargaInput.addEventListener("input", function(e) {
        let value = e.target.value.replace(/[^,\d]/g, "").toString();
        let split = value.split(",");
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        e.target.value = "Rp " + rupiah;
    });

    // Saat submit form, hilangkan 'Rp' dan titik agar data bisa disimpan sebagai angka
    const form = document.querySelector("form");
    form.addEventListener("submit", function() {
        hargaInput.value = hargaInput.value.replace(/[^0-9]/g, ""); // hilangkan semua selain angka
    });
</script>

<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        background: linear-gradient(to right, #007bff, #0056b3);
        color: white;
    }

    .card-header h4 {
        font-weight: 600;
        margin: 0;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 4px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #acacac;
        /* border biru tua */
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-custom {
        border-radius: 8px;
        padding: 6px 10px;
        /* vertikal 6px, horizontal 16px */
        width: auto;
        min-width: unset;
    }

    .btn-custom i {
        margin-right: 6px;
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 0 15px;
        }
    }
</style>
=======
<?php


 
// menghubungkan dengan koneksi database
include 'koneksi.php'; 
$sql=mysqli_query($koneksi,"select * from kelbrg order by kode");
?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Tambah Aset Tetap</label></center></h1>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Nomor Register</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="inventno"  class="form-control"  />
                            </div>
                        </div>

                        <label for="">Nama Barang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama"class="form-control" />
                            </div>
                        </div>

                        <label for="">Kelompok Barang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="kelompok" class="form-control show-tick">
									<option value="">--Pilih Kelompok--</option>
									<?php
									while($klp=$sql->fetch_assoc()){
									?>
									<option value="<?php echo $klp['kode'];?>"><?php echo $klp['kode'].' - '.$klp['nama'];?></option>
									<?php
									}
									?>
									
								</select>
                            </div>
                        </div>
                        <label for="">Tanggal Perolehan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="dbeli"class="form-control" />
                            </div>
                        </div>
                        <label for="">Nilai Perolehan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="harga"class="form-control" />
                            </div>
                        </div>
                        <label for="">Masa Manfaat (Dalam Bulan)</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="masa"class="form-control" />
                            </div>
                        </div>
                         <label for="">Kondisi Barang</label>
                         <div class="form-group">
                            <div class="form-line">
                                <select name="kondisi" class="form-control show-tick">
									<option value="">--Pilih Kondisi--</option>
									<option value="B">Baik</option>
									<option value="S">Sedang</option>
									<option value="K">Kurang Baik</option>
									<option value="R">Rusak</option>
									
								</select>
                            </div>
                        </div>

                        
 						
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
date_default_timezone_set('Asia/Jakarta');
$date=date("Y-m-d H:i:s");
$inventno = $_POST['inventno'];
$nama = $_POST['nama'];
$kelompok = $_POST['kelompok'];
$dbeli = $_POST['dbeli'];
$harga = $_POST['harga'];
$masa = $_POST['masa'];
$kondisi = $_POST['kondisi'];
$cekinvent = mysqli_query($koneksi,"select * from inventory where inventno='$inventno'");
$jumrow=$cekinvent->num_rows;
if ($jumrow>0){
    ?>
    <script type="text/javascript">
    alert ("No. Register Barang Sudah Terdaftar!");
    window.location.href="";
    </script>
    <?php

}else{




    $sql=$koneksi->query("insert into inventory (inventno,nama,kelompok,dbeli,harga,masa,latitude) values ('$inventno','$nama','$kelompok','$dbeli','$harga','$masa','$kondisi')");
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="?page=inventory";
        </script>
        <?php
    }
}
}

?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
