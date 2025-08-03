<?php
<<<<<<< HEAD
include 'koneksi.php';
$sql1 = $koneksi->query("SELECT * FROM kelanggaran ORDER BY kodekel");
?>

<div class="container mt-4">
    <!-- Tombol kembali -->
    <div class="mb-3">
        <a href="?page=mataanggaran" class="btn btn-warning shadow-sm">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-form-header text-white text-center rounded-top-4">
                    <h4 class="mb-0">
                        <i></i>Tambah Mata Anggaran
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Mata Anggaran</label>
                            <input type="text" name="kode" id="kode" class="form-control custom-input" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control custom-input" required>
                        </div>

                        <div class="mb-4">
                            <label for="kodekel" class="form-label">Kelompok</label>
                            <select name="kodekel" id="kodekel" class="form-select custom-input" required>
                                <option value="">-- Pilih Kelompok --</option>
                                <?php while ($aset = $sql1->fetch_assoc()) { ?>
                                    <option value="<?= $aset['kodekel']; ?>">
                                        <?= $aset['kodekel'] . ' - ' . $aset['deskripsi']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="text-center">
                            <div class="btn-group gap-2">
                                <a href="?page=mataanggaran" class="btn btn-outline-secondary shadow rounded-3 ">
                                    <i class="fa fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" name="simpan" class="btn btn-success shadow rounded-3  ">
                                    <i class="fa fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $deskripsi = $_POST['deskripsi'];
    $kodekel = $_POST['kodekel'];

    $cek = $koneksi->query("SELECT * FROM mstanggaran WHERE kode = '$kode'");
    if ($cek->num_rows > 0) {
        echo "<script>
Swal.fire({
    icon: 'warning',
    title: 'Kode Sudah Ada!',
    text: 'Kode Mata Anggaran tersebut sudah terdaftar.',
    confirmButtonText: 'OK',
    confirmButtonColor: '#dc3545'
});
</script>";
    } else {
        $sql = $koneksi->query("INSERT INTO mstanggaran (kode, deskripsi, kodekel) VALUES ('$kode', '$deskripsi', '$kodekel')");
        if ($sql) {
            echo "<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Data Mata Anggaran berhasil disimpan.',
    showConfirmButton: false,
    timer: 1800
}).then(() => {
    window.location.href='?page=mataanggaran';
});
</script>";
        }
    }
}
?>

<style>
    .bg-form-header {
        background: #214DD1;
        font-weight: bold;
        padding: 20px;
        box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.1);
    }

    .custom-input {
        border: 1.5px solid #a6a6a6;
        border-radius: 0.6rem;
        padding: 10px 15px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .custom-input:focus {
        border-color: #8e44ad;
        box-shadow: 0 0 0 0.2rem rgba(142, 68, 173, 0.2);
    }

    .btn-group .btn {
        min-width: 100px;
        transition: all 0.2s ease-in-out;
    }

    .btn-group .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card {
        background-color: #fff;
        border-radius: 1rem;
    }
</style>
=======


 
// menghubungkan dengan koneksi database
include 'koneksi.php';
$sql1=$koneksi->query("select * from kelanggaran order by kodekel");
//$sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
//$sql3=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");

 
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
                                TAMBAH DATA MATA ANGGARAN
                            </h2>
                        </div>
						<div class="body">
						<a href="?page=mataanggaran" class="btn btn-warning btn-sm">Kembali</a>                        
						</div>
                        <div class="body">
                        <form method="POST">
                        <label for="">Kode Mata Anggaran</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kode"  class="form-control"  />
                            </div>
                        </div>

                        <label for="">Deskripsi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="deskripsi" class="form-control" />
                            </div>
                        </div>

						<label for="">Kelompok</label>
                        <div class="form-group">
                            <div class="form-line">
                            	<select name="kodekel" class="form-control show-tick">
									<option value="">--Pilih Kelompok--</option>
									<?php
									while($aset=$sql1->fetch_assoc()){
									?>
									<option value="<?php echo $aset['kodekel'];?>"><?php echo $aset['kodekel'].' - '.$aset['deskripsi'];?></option>
									<?php
									}
									?>
									
								</select>
								
                            </div>
                        </div>
						
						
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$kode=$_POST['kode'];
$deskripsi=$_POST['deskripsi'];
$kodekel = $_POST['kodekel'];
$cekanggaran = mysqli_query($koneksi,"select * from mstanggaran where kode='$kode'");
$jumrow = $cekanggaran->num_rows;
if($jumrow>0){
    ?>
    <script type="text/javascript">
    alert ("Kode Anggaran Sudah Ada Dalam Database");
    window.location.href="";
    </script>
    <?php

}else{    

$sql=$koneksi->query("insert into mstanggaran (kode,deskripsi,kodekel) values ('$kode','$deskripsi','$kodekel')");
	
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="?page=mataanggaran";
        </script>
        <?php
    }
}
}

?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
