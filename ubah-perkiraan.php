<?php
<<<<<<< HEAD
// Secure the input
$cno_kira = $koneksi->real_escape_string($_GET['cno_kira']);
$sql = $koneksi->query("SELECT * FROM tabkira WHERE CNO_KIRA='$cno_kira'");
$tampil = $sql->fetch_assoc();

if (!$tampil) {
    die("Data tidak ditemukan");
}
?>

<!-- Add these in your head section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
    :root {
        --primary-color: #4361ee;
        --primary-hover: #3a56d4;
        --secondary-color: #6c757d;
        --light-color: #f8f9fa;
        --border-color: #dee2e6;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }

    .card {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .card-header {
        background: var(--primary-color);
        color: white;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        border: 1px solid var(--border-color);
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        transition: border-color 0.15s ease-in-out;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
    }

    .btn-outline-secondary {
        border-color: var(--secondary-color);
        color: var(--secondary-color);
    }

    .btn-outline-secondary:hover {
        background-color: var(--secondary-color);
        color: white;
    }

    /* Border styling for form fields */
    .border {
        border: 1px solid var(--border-color) !important;
    }

    .rounded {
        border-radius: 0.375rem !important;
    }

    /* Hover effects */
    .form-control:hover,
    .form-select:hover {
        border-color: #adb5bd;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border-3 shadow-sm">
                <div class="card-header bg-primary text-white text-center border-0">
                    <h3 class="m-0"><i class="fas fa-edit me-2"></i> UBAH DATA PERKIRAAN</h3>
                </div>

                <div class="card-body p-4">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-11s">
                                <!-- Form Field 1 -->
                                <div class=" p-2 border rounded">
                                    <label class="form-label fw-semibold">No. Perkiraan</label>
                                    <input type="text" name="cno_kira" value="<?= htmlspecialchars($tampil['CNO_KIRA']) ?>"
                                        class="form-control border-secondary" readonly>
                                </div>

                                <!-- Form Field 2 -->
                                <div class="p-2 border rounded">
                                    <label class="form-label fw-semibold">Nama Perkiraan</label>
                                    <input type="text" name="cnama_kira" value="<?= htmlspecialchars($tampil['CNAMA_KIRA']) ?>"
                                        class="form-control border-secondary" required>
                                </div>

                                <!-- Form Field 3 -->
                                <div class="p-2 border rounded">
                                    <label class="form-label fw-semibold">Tipe Perkiraan</label>
                                    <select name="chead_det" class="form-select border-secondary" required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="H" <?= $tampil['CHEAD_DET'] == 'H' ? 'selected' : '' ?>>General</option>
                                        <option value="D" <?= $tampil['CHEAD_DET'] == 'D' ? 'selected' : '' ?>>Detail</option>
                                    </select>
                                </div>

                                <!-- Form Field 4 -->
                                <div class="p-2 border rounded">
                                    <label class="form-label fw-semibold">Perkiraan Induk</label>
                                    <input type="text" name="cacctparent" value="<?= htmlspecialchars($tampil['CACCTPARENT']) ?>"
                                        class="form-control border-secondary">
                                </div>

                                <!-- Form Field 5 -->
                                <div class=" p-2 border rounded">
                                    <label class="form-label fw-semibold">Kelompok Perkiraan</label>
                                    <select name="cgroup" class="form-select border-secondary" required>
                                        <option value="">-- Pilih Kelompok --</option>
                                        <option value="A" <?= $tampil['CGROUP'] == 'A' ? 'selected' : '' ?>>Aktiva</option>
                                        <option value="S" <?= $tampil['CGROUP'] == 'S' ? 'selected' : '' ?>>Pasiva</option>
                                        <option value="D" <?= $tampil['CGROUP'] == 'D' ? 'selected' : '' ?>>Pendapatan</option>
                                        <option value="B" <?= $tampil['CGROUP'] == 'B' ? 'selected' : '' ?>>Biaya</option>
                                        <option value="M" <?= $tampil['CGROUP'] == 'M' ? 'selected' : '' ?>>Administratif</option>
                                    </select>
                                </div>

                                <!-- Form Field 6 -->
                                <div class="p-2 border rounded">
                                    <label class="form-label fw-semibold">Sub Kelompok</label>
                                    <select name="ckodebi" class="form-select border-secondary">
                                        <option value="">-- Pilih Sub Kelompok --</option>
                                        <option value="100" <?= $tampil['KODEBI'] == '100' ? 'selected' : '' ?>>Aset Lancar</option>
                                        <option value="200" <?= $tampil['KODEBI'] == '200' ? 'selected' : '' ?>>Aset Tidak Lancar</option>
                                        <option value="301" <?= $tampil['KODEBI'] == '301' ? 'selected' : '' ?>>Hutang Jangka Pendek</option>
                                        <option value="302" <?= $tampil['KODEBI'] == '302' ? 'selected' : '' ?>>Hutang Jangka Panjang</option>
                                        <option value="401" <?= $tampil['KODEBI'] == '401' ? 'selected' : '' ?>>Aset Tidak Terikat</option>
                                        <option value="402" <?= $tampil['KODEBI'] == '402' ? 'selected' : '' ?>>Aset Terikat</option>
                                        <option value="501" <?= $tampil['KODEBI'] == '501' ? 'selected' : '' ?>>Pendapatan Aset Tidak Terikat</option>
                                        <option value="502" <?= $tampil['KODEBI'] == '502' ? 'selected' : '' ?>>Pendapatan Aset Terikat</option>
                                        <option value="601" <?= $tampil['KODEBI'] == '601' ? 'selected' : '' ?>>Beban Aset Tidak Terikat</option>
                                        <option value="602" <?= $tampil['KODEBI'] == '602' ? 'selected' : '' ?>>Beban Aset Terikat</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-center gap-2 pt-4 border-top">
                            <a href="?page=perkiraan" class="btn btn-outline-secondary rounded-3 px-3">
                                <i class="me-2"></i> Batal
                            </a>
                            <button type="submit" name="simpan" class="btn btn-primary rounded-3 px-3">
                                <i class="fas fa-save me-2"></i>Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Form submission handling
        $('form').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi',
                text: "Anda yakin ingin menyimpan perubahan?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form programmatically
                    $.ajax({
                        type: 'POST',
                        url: '',
                        data: $(this).serialize(),
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diperbarui',
                                timer: 1000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = "?page=perkiraan";
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menyimpan data'
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Secure all inputs
    $data = [
        'cno_kira' => $koneksi->real_escape_string($_POST['cno_kira']),
        'cnama_kira' => $koneksi->real_escape_string($_POST['cnama_kira']),
        'chead_det' => $koneksi->real_escape_string($_POST['chead_det']),
        'cgroup' => $koneksi->real_escape_string($_POST['cgroup']),
        'ckodebi' => $koneksi->real_escape_string($_POST['ckodebi']),
        'cacctparent' => $koneksi->real_escape_string($_POST['cacctparent'])
    ];

    // Validate required fields
    if (empty($data['cnama_kira']) || empty($data['chead_det']) || empty($data['cgroup'])) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Harap isi semua field yang wajib diisi!'
            });
        </script>";
    } else {
        $sql = $koneksi->query("UPDATE tabkira SET 
            CNAMA_KIRA='{$data['cnama_kira']}',
            CHEAD_DET='{$data['chead_det']}',
            CGROUP='{$data['cgroup']}',
            CACCTPARENT='{$data['cacctparent']}',
            KODEBI='{$data['ckodebi']}' 
            WHERE CNO_KIRA='{$data['cno_kira']}'");

        if (!$sql) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan database: {$koneksi->error}'
                });
            </script>";
        }
    }
}
=======

    $cno_kira = $_GET['cno_kira'];
    $sql = $koneksi->query("select * from tabkira where CNO_KIRA='$cno_kira'");
    $tampil = $sql->fetch_assoc();

?>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div >
                            <h1><center><label class="label label-success">UBAH DATA TABEL PERKIRAAN</label></center></h1>
                            
                        </div>
                            
                        <div class="body">
                        <form method="POST" enctype="Multipart/form-control">
                        <label for="">No. Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cno_kira" value="<?php echo $tampil['CNO_KIRA'];?>" class="form-control" readonly />
                            </div>
                        </div>

                        <label for="">Nama Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cnama_kira" value="<?php echo $tampil['CNAMA_KIRA'];?>" class="form-control" />
                            </div>
                        </div>

                         <label for="">Tipe Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="chead_det" class="form-control show-tick">
									<option value="">--Pilih Tipe--</option>
									<option value="H" <?php if($tampil['CHEAD_DET']=='H') echo "selected";?> >General</option>
									<option value="D" <?php if($tampil['CHEAD_DET']=='D') echo "selected";?> >Detail</option>
									
									
								</select>
                            </div>
                        </div>

                        
                        <label for="">Perkiraan Induk</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="cacctparent" value="<?php echo $tampil['CACCTPARENT'];?>" class="form-control" />
                            </div>
                        </div>

                        <label for="">Kelompok Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="cgroup" class="form-control show-tick">
									<option value="">--Pilih Kelompok Perkiraan--</option>
									<option value="A" <?php if($tampil['CGROUP']=='A') echo "selected";?>>Aktiva</option>
									<option value="S" <?php if($tampil['CGROUP']=='S') echo "selected";?>>Pasiva</option>
									<option value="D" <?php if($tampil['CGROUP']=='D') echo "selected";?>>Pendapatan</option>
									<option value="B" <?php if($tampil['CGROUP']=='B') echo "selected";?>>Biaya</option>
									<option value="M" <?php if($tampil['CGROUP']=='M') echo "selected";?>>Administratif</option>
									
									
								</select>
							</div>
                        </div>
						<label for="">Sub Kelompok Perkiraan</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select name="ckodebi" class="form-control show-tick">
									<option value="">--Pilih Sub Kelompok--</option>
									<option value="100" <?php if($tampil['KODEBI']=='100') echo "selected";?>>Aset Lancar</option>
									<option value="200" <?php if($tampil['KODEBI']=='200') echo "selected";?>>Aset Tidak Lancar</option>
									<option value="301" <?php if($tampil['KODEBI']=='301') echo "selected";?>>Hutang Jangka Pendek</option>
									<option value="302" <?php if($tampil['KODEBI']=='302') echo "selected";?>>Hutang Jangka Panjang</option>
									<option value="401" <?php if($tampil['KODEBI']=='401') echo "selected";?>>Aset Tidak Terikat</option>
                                    <option value="402" <?php if($tampil['KODEBI']=='402') echo "selected";?>>Aset Terikat</option>
                                    <option value="501" <?php if($tampil['KODEBI']=='501') echo "selected";?>>Pendapatan Aset Tidak Terikat</option>
                                    <option value="502" <?php if($tampil['KODEBI']=='502') echo "selected";?>>Pendapatan Aset Terikat</option>
                                    <option value="601" <?php if($tampil['KODEBI']=='601') echo "selected";?>>Beban Aset Tidak Terikat</option>
                                    <option value="602" <?php if($tampil['KODEBI']=='602') echo "selected";?>>Beban Aset Terikat</option>

									
									
								</select>
							</div>
                        </div>
						
						
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                        </form>

<?php 
if (isset($_POST['simpan'])){
$cno_kira=$_POST['cno_kira'];
$cnama_kira=$_POST['cnama_kira'];
$chead_det=$_POST['chead_det'];
$cgroup=$_POST['cgroup'];
$ckodebi=$_POST['ckodebi'];
$cacctparent=$_POST['cacctparent'];



    $sql=$koneksi->query("update tabkira set CNAMA_KIRA='$cnama_kira',CHEAD_DET='$chead_det',CGROUP='$cgroup',CACCTPARENT='$cacctparent',KODEBI='$ckodebi' where CNO_KIRA='$cno_kira'");
    if ($sql){
        ?>
        <script type="text/javascript">
        alert ("Data Berhasil di Ubah");
        window.location.href="?page=perkiraan";
        </script>
        <?php
    }
}

>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
?>