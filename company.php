<?php
<<<<<<< HEAD
include 'koneksi.php';
$sql = $koneksi->query("select * from company");
$tampil = $sql->fetch_assoc();
$nama = $tampil['NAMA'];
$alamat = $tampil['ALAMAT'];
$kota = $tampil['KOTA'];
$telpon = $tampil['PHONE'];
$zipcode = $tampil['ZIPCODE'];
?>

<!-- Add these in your head section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --success: #10b981;
        --warning: #f59e0b;
        --light: #f8f9fa;
        --dark: #212529;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }

    .form-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .form-header {
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
        padding-bottom: 1rem;
        margin-bottom: 2rem;
        position: relative;
    }

    .form-title {
        font-weight: 700;
        color: var(--primary);
        position: relative;
        display: inline-block;
        margin-bottom: 0;
    }

    .form-title::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--primary);
        border-radius: 3px;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    input.form-control {
        border: 1px solid #cccccc;
        /* abu Bootstrap */
        box-shadow: none;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
    }

    input.form-control:focus {
        border-color: #6f42c1;
        /* ungu Bootstrap */
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
    }


    .form-label {
        font-weight: 500;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background: var(--secondary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
    }

    .input-group-text {
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 8px 0 0 8px;
    }

    .action-buttons {
        margin-top: 2rem;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-container">
                <!-- Improved Header with Title -->
                <div class="form-header d-flex justify-content-between align-items-center">
                    <h2 class="form-title">Ubah Data Panti Asuhan</h2>

                </div>

                <form method="POST">
                    <!-- Nama Panti Asuhan -->
                    <div class="mb-4">
                        <label class="form-label">Nama Panti Asuhan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                            <input type="text" name="nama" value="<?php echo $nama; ?>" class="form-control" placeholder="Masukkan nama panti asuhan" required>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label class="form-label">Alamat</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" name="alamat" value="<?php echo $alamat; ?>" class="form-control" placeholder="Masukkan alamat lengkap" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Kota -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Kota</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-city"></i></span>
                                <input type="text" name="kota" value="<?php echo $kota; ?>" class="form-control" placeholder="Masukkan kota" required>
                            </div>
                        </div>

                        <!-- Kode Pos -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Kode Pos</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-mail-bulk"></i></span>
                                <input type="text" name="zipcode" value="<?php echo $zipcode; ?>" class="form-control" placeholder="Masukkan kode pos" required>
                            </div>
                        </div>
                    </div>

                    <!-- No Telpon -->
                    <div class="mb-4">
                        <label class="form-label">No Telpon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="number" name="phone" value="<?php echo $telpon; ?>" class="form-control" placeholder="Masukkan nomor telepon" required>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons d-flex justify-content-end gap-3">
                        <a href="home-admin.php?page=form-master" class="btn btn-secondary">
                            </i> Batal
                        </a>
                        <button type="submit" name="simpan" class="btn btn-primary">
                            </i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $alamat = $_POST['alamat'];
    $nama = $_POST['nama'];
    $telpon = $_POST['phone'];
    $kota = $_POST['kota'];
    $zipcode = $_POST['zipcode'];

    $tanya = $koneksi->query("select * from company");
    $numrow = $tanya->num_rows;

    if ($numrow == 0) {
        $sql = $koneksi->query("insert into company (nama,alamat,kota,phone,zipcode) values ('$nama','$alamat','$kota','$telpon','$zipcode')");
    } else {
        $sql = $koneksi->query("update company set NAMA='$nama',ALAMAT='$alamat',KOTA='$kota',PHONE='$telpon',ZIPCODE='$zipcode'");
    }

    if ($sql) {
?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data Panti Asuhan berhasil diperbarui',
                confirmButtonColor: '#4361ee',
            }).then((result) => {
                window.location.href = "home-admin.php?page=form-master";
            });
        </script>
<?php
=======
	include 'koneksi.php';
    $sql = $koneksi->query("select * from company");
    $tampil=$sql->fetch_assoc();
		$nama=$tampil['NAMA'];
		$alamat=$tampil['ALAMAT'];
		$kota=$tampil['KOTA'];
		$telpon=$tampil['PHONE'];
		$zipcode=$tampil['ZIPCODE'];
	

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Data Panti Asuhan</label></center></h1>
							<a href="home-admin.php?page=form-master" class="btn btn-warning btn-sm">Kembali</a><br><br>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="Multipart/form-control">
                        <label for="">Nama Panti Asuhan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="nama" value="<?php echo $nama;?>" class="form-control"  />
                            </div>
                        </div>

                        <label for="">Alamat</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="alamat" value="<?php echo $alamat;?>" class="form-control" />
                            </div>
                        </div>

                        
                        <label for="">Kota</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="kota" value="<?php echo $kota;?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Kode Pos</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="zipcode" value="<?php echo $zipcode;?>" class="form-control" />
                            </div>
                        </div>

						<label for="">No Telpon</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="number"  name="phone" value="<?php echo $telpon;?>" class="form-control" />
                            </div>
                        </div>
						
						
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$alamat=$_POST['alamat'];
$nama=$_POST['nama'];
$telpon=$_POST['phone'];
$kota=$_POST['kota'];
$zipcode=$_POST['zipcode'];


	$tanya=$koneksi->query("select * from company");
	$numrow=$tanya->num_rows;
	if($numrow==0){
		$sql=$koneksi->query("insert into company (nama,alamat,kota,phone,zipcode) values ('$nama','$alamat','$kota','$telpon','$zipcode')");
	}else{	
		$sql=$koneksi->query("update company set NAMA='$nama',ALAMAT='$alamat',KOTA='$kota',PHONE='$telpon',ZIPCODE='$zipcode'");
	}
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Panti Asuhan Tersimpan!");
        window.location.href="home-admin.php?page=form-master";
        </script>
        <?php
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
    }
}
mysqli_close($koneksi);
?>