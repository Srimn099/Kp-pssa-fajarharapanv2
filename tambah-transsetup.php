<<<<<<< HEAD
<title>Penambahan Transaksi Rutin</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    .app-container {
        padding: 2rem 0;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 12px 12px 0 0 !important;
        padding: 1.5rem;
    }

    .form-control,
    .form-select,
    textarea {
        border: 1px solid #a6a3a3;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        outline: none;
    }



    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .alert {
        font-size: 0.95rem;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 2.5rem;
        /* ruang untuk ikon */
    }

    .select-wrapper i {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        pointer-events: none;
        color: #302d2d;
    }

    .custom-btn {
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 14px;
        padding: 7px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }

    .btn-secondary:hover {
        background-color: #adb5bd;
        border-color: #adb5bd;
        color: #212529;
    }
</style>



<div class="app-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h2 class="mb-0">Penambahan Transaksi Rutin</h2>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" enctype="multipart/form-data" id="transactionForm">

                            <!-- Akun Debet -->
                            <div class="mb-4">
                                <label for="accdebet" class="form-label">Akun Debet</label>
                                <div class="select-wrapper">
                                    <select name="accdebet" class="form-control" required>
                                        <option value="" selected disabled>Pilih Akun Debet</option>
                                        <?php
                                        include 'koneksi.php';
                                        $sql1 = $koneksi->query("SELECT CNO_KIRA, CNAMA_KIRA FROM tabkira WHERE CNO_KIRA NOT IN (SELECT CACCTPARENT FROM tabkira) ORDER BY CNO_KIRA");
                                        while ($tabkira = mysqli_fetch_array($sql1)): ?>
                                            <option value="<?= $tabkira['CNO_KIRA'] ?>">
                                                <?= $tabkira['CNO_KIRA'] ?> - <?= $tabkira['CNAMA_KIRA'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                    <i class="fa-solid fa-circle-chevron-down"></i>
                                </div>
                            </div>

                            <!-- Akun Kredit -->
                            <div class="mb-4">
                                <label for="acckredit" class="form-label">Akun Kredit</label>
                                <div class="select-wrapper">
                                    <select name="acckredit" class="form-control" required>
                                        <option value="" selected disabled>Pilih Akun Kredit</option>

                                        <?php
                                        $sql2 = $koneksi->query("SELECT CNO_KIRA, CNAMA_KIRA FROM tabkira WHERE CNO_KIRA NOT IN (SELECT CACCTPARENT FROM tabkira) ORDER BY CNO_KIRA");
                                        while ($tabkira1 = mysqli_fetch_array($sql2)): ?>
                                            <option value="<?= $tabkira1['CNO_KIRA'] ?>">
                                                <?= $tabkira1['CNO_KIRA'] ?> - <?= $tabkira1['CNAMA_KIRA'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                    <i class="fa-solid fa-circle-chevron-down"></i>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label for="cket" class="form-label">Keterangan Transaksi</label>
                                <textarea name="cket" class="form-control" rows="3" required placeholder="Masukkan keterangan transaksi"></textarea>
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                                <a href="home-admin.php?page=transsetup" class="btn btn-secondary btn-sm custom-btn" style="width: 100px;">
                                    Batal
                                </a>
                                <button type="submit" name="simpan" class="btn btn-primary btn-sm custom-btn" style="width: 100px;">
                                    Simpan
                                </button>
                            </div>

                        </form>

                        <!-- PHP Logic -->
                        <?php
                        if (isset($_POST['simpan'])) {
                            date_default_timezone_set('Asia/Jakarta');
                            $accdebet = $_POST['accdebet'];
                            $acckredit = $_POST['acckredit'];
                            $cket = $_POST['cket'];

                            // ambil nama akun
                            $ssl = $koneksi->query("select CNAMA_KIRA from tabkira where CNO_KIRA='$accdebet'");
                            $debet = $ssl->fetch_assoc();
                            $cdebet = $debet['CNAMA_KIRA'];

                            $ssl1 = $koneksi->query("select CNAMA_KIRA from tabkira where CNO_KIRA='$acckredit'");
                            $kredit = $ssl1->fetch_assoc();
                            $ckredit = $kredit['CNAMA_KIRA'];


                            // langsung INSERT (tanpa UPDATE)
                            $sql = $koneksi->query("INSERT INTO transsetup (accdebet, cdebet, acckredit, ckredit, cket) 
                            VALUES ('$accdebet', '$cdebet', '$acckredit', '$ckredit', '$cket')");

                            if ($sql) {
                        ?>
                                <script>
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Data berhasil disimpan.',
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "home-admin.php?page=transsetup";
                                        }
                                    });
                                </script>
                        <?php
                            }
                        }
                        mysqli_close($koneksi);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
=======
<?php

include 'koneksi.php';
 
// menghubungkan dengan koneksi database
 $sql1=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
 $sql2=$koneksi->query("select CNO_KIRA,CNAMA_KIRA from tabkira where CNO_KIRA not in (select CACCTPARENT from tabkira) order by CNO_KIRA");
 
// mengambil data pasien dengan kode paling besar

?>

<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">Penambahan Transaksi Rutin</label></center></h1>
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="multipart/form-data">
                        <label for="">Akun Debet</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="accdebet" class="form-control show-tick">
									<?php
									while($tabkira=mysqli_fetch_array($sql1)){
									?>
									<option value="<?php echo $tabkira['CNO_KIRA'];?>"><?php echo $tabkira['CNO_KIRA'].' - '.$tabkira['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						
						<label for="">Akun Kredit</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="acckredit" class="form-control show-tick">
									<?php
									while($tabkira1=mysqli_fetch_array($sql2)){
									?>
									<option value="<?php echo $tabkira1['CNO_KIRA'];?>" ><?php echo $tabkira1['CNO_KIRA'].' - '.$tabkira1['CNAMA_KIRA'];?></option>
									<?php
									}
									?>
									
								</select>
							</div>
                        </div>
						
                        <label for="">Keterangan Transaksi</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cket" class="form-control" />
                            </div>
                        </div>

                        		
						

                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
date_default_timezone_set('Asia/Jakarta');
$date=date("Y-m-d H:i:s");
$accdebet=$_POST['accdebet'];
$acckredit=$_POST['acckredit'];
$cket=$_POST['cket'];
$ssl=$koneksi->query("select CNAMA_KIRA from tabkira where CNO_KIRA='$accdebet'");
$debet=$ssl->fetch_assoc();
$cdebet=$debet['CNAMA_KIRA'];
$ssl1=$koneksi->query("select CNAMA_KIRA from tabkira where CNO_KIRA='$acckredit'");
$kredit=$ssl1->fetch_assoc();
$ckredit=$kredit['CNAMA_KIRA'];

$nu=$koneksi->query("select * from transsetupp");
$numrow=$nu->num_rows;
if($numrow==0){
    $sql=$koneksi->query("insert into transsetup (accdebet,cdebet,acckredit,ckredit,cket) values ('$accdebet','$cdebet','$acckredit','$ckredit','$cket')");
}else{
	$sql=$koneksi->query("update transsetup set accdebet='$accdebet',acckredit='$acckredit',cdebet='$cdebet',ckredit='$ckredit',cket='$cket'");
}
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Simpan");
        window.location.href="home-admin.php?page=transsetup";
        </script>
        <?php
    }
}
mysqli_close($koneksi);
?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
