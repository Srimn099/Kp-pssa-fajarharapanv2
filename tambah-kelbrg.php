<?php
<<<<<<< HEAD
include 'koneksi.php';
$sql1 = $koneksi->query("SELECT CNO_KIRA, CNAMA_KIRA FROM tabkira WHERE CNO_KIRA NOT IN (SELECT CACCTPARENT FROM tabkira) ORDER BY CNO_KIRA");
$sql2 = $koneksi->query("SELECT CNO_KIRA, CNAMA_KIRA FROM tabkira WHERE CNO_KIRA NOT IN (SELECT CACCTPARENT FROM tabkira) ORDER BY CNO_KIRA");
$sql3 = $koneksi->query("SELECT CNO_KIRA, CNAMA_KIRA FROM tabkira WHERE CNO_KIRA NOT IN (SELECT CACCTPARENT FROM tabkira) ORDER BY CNO_KIRA");
?>

<title>Tambah Data Kelompok Aktiva Tetap</title>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4 border-1">
                <div class="card-header bg-primary text-white text-center">
                    <h3><i class="fas fa-plus-circle"></i> Tambah Data Kelompok Aktiva Tetap</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Kelompok</label>
                            <input type="text" name="kode" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Deskripsi</label>
                            <input type="text" name="nama" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label for="accinvent" class="form-label">Perkiraan Aset</label>
                            <select name="accinvent" class="form-select" required>
                                <option value="">-- Pilih Perkiraan --</option>
                                <?php while ($aset = $sql1->fetch_assoc()) { ?>
                                    <option value="<?= $aset['CNO_KIRA']; ?>">
                                        <?= $aset['CNO_KIRA'] . ' - ' . $aset['CNAMA_KIRA']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="accakumsusut" class="form-label">Perkiraan Akumulasi Penyusutan</label>
                            <select name="accakumsusut" class="form-select" required>
                                <option value="">-- Pilih Perkiraan --</option>
                                <?php while ($akum = $sql2->fetch_assoc()) { ?>
                                    <option value="<?= $akum['CNO_KIRA']; ?>">
                                        <?= $akum['CNO_KIRA'] . ' - ' . $akum['CNAMA_KIRA']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="accbiayasusut" class="form-label">Perkiraan Biaya Penyusutan</label>
                            <select name="accbiayasusut" class="form-select" required>
                                <option value="">-- Pilih Perkiraan --</option>
                                <?php while ($bisut = $sql3->fetch_assoc()) { ?>
                                    <option value="<?= $bisut['CNO_KIRA']; ?>">
                                        <?= $bisut['CNO_KIRA'] . ' - ' . $bisut['CNAMA_KIRA']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="lsusut" class="form-label">Status Penyusutan</label>
                            <select name="lsusut" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Y">Disusutkan</option>
                                <option value="N">Tidak Disusutkan</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" name="simpan" class="btn btn-success">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="?page=kelbrg" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['simpan'])) {
                        $kode = $_POST['kode'];
                        $nama = $_POST['nama'];
                        $accinvent = $_POST['accinvent'];
                        $accakumsusut = $_POST['accakumsusut'];
                        $accbiayasusut = $_POST['accbiayasusut'];
                        $lsusut = $_POST['lsusut'];

                        $cekkel = $koneksi->query("SELECT * FROM kelbrg WHERE kode='$kode'");

                        if ($cekkel->num_rows > 0) {
                            echo "<script>alert('Kode Kelompok sudah ada dalam database');</script>";
                        } else {
                            $sql = $koneksi->query("INSERT INTO kelbrg (kode, nama, accbarang, accakumsusut, accbisusut, lflag)
                            VALUES ('$kode','$nama','$accinvent','$accakumsusut','$accbiayasusut','$lsusut')");

                            if ($sql) {
                                echo "<script>alert('Data berhasil disimpan'); window.location.href='?page=kelbrg';</script>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #ccc;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control,
    .form-select {
        border: 1px solid #808080;
        border-radius: 5px;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        border-color: #007bff;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
=======


 
// menghubungkan dengan koneksi database
include 'koneksi.php';
$sql1=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
$sql3=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");

 
// mengambil angka dari nmor pasien terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
 
// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
 
// membentuk nomor pasien baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
 
// mengambil data pasien dengan kode paling besar

?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                TAMBAH DATA KELOMPOK AKTIVA TETAP
                            </h2>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Kode Kelompok</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kode"  class="form-control"  />
                            </div>
                        </div>

                        <label for="">Deskripsi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama" class="form-control" />
                            </div>
                        </div>

						<label for="">Perkiraan Aset</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="accinvent" class="form-control show-tick">
									<option value="">--Pilih Perkiraan--</option>
									<?php
									while($aset=$sql1->fetch_assoc()){
									?>
									<option value="<?php echo $aset['CNO_KIRA'];?>"><?php echo $aset['CNO_KIRA'].' - '.$aset['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
								
                            </div>
                        </div>
						<label for="">Perkiraan Akumulasi Penyusutan</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="accakumsusut" class="form-control show-tick">
									<option value="">--Pilih Perkiraan--</option>
									<?php
									while($akum=$sql2->fetch_assoc()){
									?>
									<option value="<?php echo $akum['CNO_KIRA'];?>"><?php echo $akum['CNO_KIRA'].' - '.$akum['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
								
                            </div>
                        </div>
						<label for="">Perkiraan Biaya Penyusutan</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="accbiayasusut" class="form-control show-tick">
									<option value="">--Pilih Perkiraan--</option>
									<?php
									while($bisut=$sql3->fetch_assoc()){
									?>
									<option value="<?php echo $bisut['CNO_KIRA'];?>"><?php echo $bisut['CNO_KIRA'].' - '.$bisut['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
								
                            </div>
                        </div>
						<label for="">Status Penyusutan</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="lsusut" class="form-control show-tick">
									<option value="">--Pilih Status--</option>
									<option value="Y">Disusutkan</option>
									<option value="N">Tidak Disusutkan</option>
								</select>
								
                            </div>
                        </div>
						
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$kode=$_POST['kode'];
$nama=$_POST['nama'];
$accinvent=$_POST['accinvent'];
$accakumsusut=$_POST['accakumsusut'];
$accbiayasusut=$_POST['accbiayasusut'];
$lsusut=$_POST['lsusut'];
$cekkel = mysqli_query($koneksi,"select * from kelbrg where kode='$kode'");
$jumrow = $cekkel->num_rows;
if($jumrow>0){
    ?>
    <script type="text/javascript">
    alert ("Kode Kelompok Sudah Ada Dalam Database");
    window.location.href="";
    </script>
    <?php

}else{    

$sql=$koneksi->query("insert into kelbrg (kode,nama,accbarang,accakumsusut,accbisusut,lflag) values ('$kode','$nama','$accinvent','$accakumsusut','$accbiayasusut','$lsusut')");
	
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="?page=kelbrg";
        </script>
        <?php
    }
}
}

?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
