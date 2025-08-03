<?php
<<<<<<< HEAD
include 'koneksi.php';

// Validate input and check permissions first
if (!isset($_SESSION['username']) || $_SESSION['hak_akses'] != "Admin") {
    header("HTTP/1.1 403 Forbidden");
    exit("Access Denied");
}

// Sanitize input
$cno_kira = $koneksi->real_escape_string($_GET['cno_kira']);

// Check if account exists
$check_account = $koneksi->query("SELECT CNO_KIRA FROM tabkira WHERE CNO_KIRA='$cno_kira'");
if ($check_account->num_rows == 0) {
    http_response_code(404);
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Akun perkiraan tidak ditemukan',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = 'home-admin.php?page=perkiraan';
        });
    </script>";
    exit();
}

// Check if account has transactions
$check_transactions = $koneksi->query("SELECT CNO_KIRA FROM jurnal WHERE CNO_KIRA='$cno_kira' LIMIT 1");
if ($check_transactions->num_rows > 0) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Tidak Dapat Dihapus',
            html: '<b>Akun perkiraan ini memiliki transaksi!</b><br>Hapus semua transaksi terkait terlebih dahulu.',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = 'home-admin.php?page=perkiraan';
        });
    </script>";
    exit();
}

// Proceed with deletion
$delete = $koneksi->query("DELETE FROM tabkira WHERE CNO_KIRA='$cno_kira'");

if ($delete) {
    // Also delete from balance table if needed
    $koneksi->query("DELETE FROM balance WHERE CNO_KIRA='$cno_kira'");

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil Dihapus',
            text: 'Akun perkiraan telah dihapus dari sistem',
            showConfirmButton: true,
            timer: 2000,
            confirmButtonColor: '#3085d6',
            timerProgressBar: true
        }).then(() => {
            window.location.href = 'home-admin.php?page=perkiraan';
        });
    </script>";
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Terjadi kesalahan saat menghapus akun',
            confirmButtonColor: '#3085d6'
        }).then(() => {
            window.location.href = 'home-admin.php?page=perkiraan';
        });
    </script>";
}
=======
include 'koneksi.php'; 
	$cno_kira = $_GET['cno_kira'];
	$sql = $koneksi->query("select CNO_KIRA from jurnal where CNO_KIRA='$cno_kira'");
	$numrow=$sql->num_rows;
	if($numrow==0){

		$sql = $koneksi->query("delete from tabkira where CNO_KIRA='$cno_kira'");

?>

<script type="text/javascript">
		alert ("Data Berhasil di Hapus");
		window.location.href="?page=perkiraan";
</script>
<?php
	}else{
?>
<script type="text/javascript">
		alert ("Perkiraan Yang Sudah Bertransaksi Tidak Bisa Dihapus!");
		window.location.href="?page=perkiraan";
</script>

	<?php
	}
?>
>>>>>>> 9ba2b8bfcaaa1219ccff39b4189a9ce0d097b94f
