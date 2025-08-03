<?php
<<<<<<< HEAD
$inventno = $_GET['inventno'];
$sql = $koneksi->query("SELECT * FROM inventory WHERE inventno='$inventno'");
$tampil = $sql->fetch_assoc();
$sql1 = mysqli_query($koneksi, "SELECT * FROM kelbrg ORDER BY kode");
?>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3a0ca3;
        --accent-color: #f72585;
        --light-bg: #f8f9fa;
        --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }

    .form-wrapper {
        max-width: 650px;
        margin: 30px auto;
    }

    .card-custom {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .card-custom .card-header {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .form-label {
        font-weight: 500;
        color: #333;
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #acacac;
        font-size: 15px;
    }

    .btn {
        font-size: 0.85rem;
        padding: 6px 16px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Tombol Simpan */
    .btn-simpan {
        background-color: #198754;
        color: white;
        border: none;
    }

    .btn-simpan:hover {
        background-color: #157347;
        transform: scale(1.05);
    }

    /* Tombol Kembali */
    .btn-kembali {
        background-color: white;
        border: 1px solid #6c757d;
        color: #6c757d;
    }

    .btn-kembali:hover {
        background-color: #6c757d;
        color: white;
        transform: scale(1.05);
    }

    /* Tombol outline sekunder umum */
    .btn-outline-secondary:hover {
        background-color: #e2e6ea;
    }

    /* Jarak antar form */
    .form-section {
        margin-bottom: 20px;
    }
</style>

<div class="form-wrapper">
    <div class="card card-custom">
        <div class="card-header bg-primary text-white py-3 text-center">
            <h4 class="mb-0">✏️ Ubah Data Aset Tetap</h4>
        </div>
        <div class="card-body px-4 py-4">
            <form method="POST" enctype="multipart/form-data">

                <div class="form-section">
                    <label for="inventno" class="form-label">No. Perkiraan</label>
                    <input type="text" class="form-control" name="inventno" value="<?= $tampil['inventno'] ?>" readonly>
                </div>

                <div class="form-section">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama" value="<?= $tampil['nama'] ?>" required>
                </div>

                <div class="form-section">
                    <label for="kelompok" class="form-label">Kelompok Barang</label>
                    <select class="form-select" name="kelompok" required>
                        <option value="">-- Pilih Kelompok --</option>
                        <?php while ($klp = $sql1->fetch_assoc()): ?>
                            <option value="<?= $klp['kode'] ?>" <?= $tampil['kelompok'] == $klp['kode'] ? 'selected' : '' ?>>
                                <?= $klp['kode'] . ' - ' . $klp['nama'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-section">
                    <label for="dbeli" class="form-label">Tanggal Perolehan</label>
                    <input type="date" class="form-control" name="dbeli" value="<?= $tampil['dbeli'] ?>" required>
                </div>

                <div class="form-section">
                    <label for="harga" class="form-label">Nilai Perolehan</label>
                    <input type="text" class="form-control" name="harga" id="harga" value="<?= number_format($tampil['harga'], 0, ',', '.') ?>" required>
                </div>

                <div class="form-section">
                    <label for="masa" class="form-label">Masa Manfaat (Bulan)</label>
                    <input type="number" class="form-control" name="masa" value="<?= $tampil['masa'] ?>" required>
                </div>

                <div class="form-section">
                    <label for="kondisi" class="form-label">Kondisi Barang</label>
                    <select class="form-select" name="kondisi" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="B" <?= $tampil['latitude'] == 'B' ? 'selected' : '' ?>>Baik</option>
                        <option value="S" <?= $tampil['latitude'] == 'S' ? 'selected' : '' ?>>Sedang</option>
                        <option value="K" <?= $tampil['latitude'] == 'K' ? 'selected' : '' ?>>Kurang Baik</option>
                        <option value="R" <?= $tampil['latitude'] == 'R' ? 'selected' : '' ?>>Rusak</option>
                    </select>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="?page=inventory" class="btn btn-kembali">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" name="simpan" class="btn btn-simpan">
                        <i class="bi bi-check-circle me-1"></i> Simpan
                    </button>

                </div>

            </form>
        </div>
    </div>
</div>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_POST['simpan'])) {
=======

    $inventno = $_GET['inventno'];
    $sql = $koneksi->query("select * from inventory where inventno='$inventno'");
    $tampil = $sql->fetch_assoc();
    $sql1=mysqli_query($koneksi,"select * from kelbrg order by kode");

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">UBAH DATA ASET TETAP</label></center></h1>
                            
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="Multipart/form-control">
                        <label for="">No. Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="inventno" value="<?php echo $tampil['inventno'];?>" class="form-control" readonly />
                            </div>
                        </div>

                        <label for="">Nama Barang</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama" value="<?php echo $tampil['nama'];?>" class="form-control" />
                            </div>
                        </div>

                         <label for="">Kelompok Barang</label>
                         <div class="form-group">
                            <div class="form-line">
                                <select name="kelompok" class="form-control show-tick">
									<option value="">--Pilih Kelompok--</option>
									<?php
									while($klp=$sql1->fetch_assoc()){
									?>
									<option value="<?php echo $klp['kode'];?>" <?php if($tampil['kelompok']==$klp['kode']) echo "selected";?>><?php echo $klp['kode'].' - '.$klp['nama'];?></option>
									<?php
									}
									?>
									
								</select>
                            </div>
                        </div>

                        
                        
                        <label for="">Tanggal Perolehan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="date" name="dbeli" value="<?php echo $tampil['dbeli'];?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Nilai Perolehan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="harga" value="<?php echo $tampil['harga'];?>" class="form-control" />
                            </div>
                        </div>
                        
                        <label for="">Masa Manfaat</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number" name="masa" value="<?php echo $tampil['masa'];?>" class="form-control" />
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
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    $inventno = $_POST['inventno'];
    $nama = $_POST['nama'];
    $kelompok = $_POST['kelompok'];
    $dbeli = $_POST['dbeli'];
<<<<<<< HEAD
    $harga = str_replace(['.', ','], '', $_POST['harga']);
    $masa = $_POST['masa'];
    $kondisi = $_POST['kondisi'];

    $sql = $koneksi->query("UPDATE inventory 
        SET nama='$nama', kelompok='$kelompok', dbeli='$dbeli', harga='$harga', masa='$masa', latitude='$kondisi' 
        WHERE inventno='$inventno'");

    if ($sql) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil diperbarui!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href='?page=inventory';
            });
        </script>";
    }
}
?>
<script>
    const hargaInput = document.getElementById('harga');

    hargaInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^,\d]/g, '');
        if (!value) {
            e.target.value = '';
            return;
        }

        const formatted = formatRupiah(value);
        e.target.value = formatted;
    });

    function formatRupiah(angka) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            const separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }
</script>
=======
    $harga = $_POST['harga'];
    $masa = $_POST['masa'];
    $kondisi = $_POST['kondisi'];


    $sql=$koneksi->query("update inventory set nama='$nama',kelompok='$kelompok',dbeli='$dbeli',harga='$harga',masa='$masa',latitude='$kondisi' where inventno='$inventno'");
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Ubah");
        window.location.href="?page=inventory";
        </script>
        <?php
    }
}

?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
