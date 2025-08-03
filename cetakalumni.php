<?php
include('koneksi.php');

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM tb_siswa ORDER BY id ASC";
$result = $koneksi->query($sql);

if (!$result) {
    die("Error dalam eksekusi query: " . $koneksi->error);
}

if ($result->num_rows === 0) {
    die("Tidak ada data siswa yang ditemukan.");
}

// Simpan hasil query ke array untuk digunakan kembali
$siswa_data = [];
while ($row = $result->fetch_assoc()) {
    $siswa_data[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alumni - LKSA Fajar Harapan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Gaya Tampilan Browser */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .header {
            background-color: white;
            padding: 7px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 5px;
        }

        .action-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .print-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }

        .print-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .print-button.landscape {
            background-color: #2ecc71;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 10pt;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Gaya untuk Cetakan */
        @media print {
            body {
                padding: 0;
                margin: 0;
                background-color: white;
            }



            .action-buttons {
                display: none;
            }

            .header {
                box-shadow: none;
                border-bottom: 2px solid #3498db;
                margin-bottom: 10px;
            }

            table {
                box-shadow: none;
                font-size: 10pt;
            }

            .footer {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>

    <div class="filter-section" style="margin-bottom: 20px; text-align:center;">
        <label>
            Jenis Kelamin:
            <select id="filter-jk">
                <option value="">Semua</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </label>

        <label style="margin-left: 10px;">
            Tahun Masuk:
            <select id="filter-tahun">
                <option value="">Semua</option>
                <?php
                // Ambil tahun dari data siswa
                $tahun_masuk = array_unique(array_map(function ($s) {
                    return date('Y', strtotime($s['tgl_masuk']));
                }, $siswa_data));
                sort($tahun_masuk);
                foreach ($tahun_masuk as $th) {
                    echo "<option value='$th'>$th</option>";
                }
                ?>
            </select>
        </label>

        <label style="margin-left: 10px;">
            Alamat:
            <input type="text" id="filter-alamat" placeholder="misal: bandung" />
        </label>
    </div>

    <div class="column-select" style="text-align:center; margin-bottom: 20px;">
        <p>
            <strong>Pilih data yang ingin dicetak:</strong>
            <i class="fa-solid fa-check-square" style="color: dodgerblue; margin: 0 5px;"></i>Centang untuk menampilkan,
            <i class="fa-regular fa-square" style="margin: 0 5px;"></i>hapus centang untuk menyembunyikan.
        </p>
        <label><input type="checkbox" class="col-toggle" data-col="nama" checked> Nama</label>
        <label><input type="checkbox" class="col-toggle" data-col="ttl" checked> TTL</label>
        <label><input type="checkbox" class="col-toggle" data-col="jk" checked> JK</label>
        <label><input type="checkbox" class="col-toggle" data-col="pendidikan" checked> Pendidikan</label>
        <label><input type="checkbox" class="col-toggle" data-col="ayah" checked> Ayah</label>
        <label><input type="checkbox" class="col-toggle" data-col="ibu" checked> Ibu</label>
        <label><input type="checkbox" class="col-toggle" data-col="pekerjaan" checked> Pekerjaan Ortu</label>
        <label><input type="checkbox" class="col-toggle" data-col="masuk" checked> Masuk</label>
        <label><input type="checkbox" class="col-toggle" data-col="keluar" checked> Keluar</label>
        <label><input type="checkbox" class="col-toggle" data-col="status" checked> Status Siswa</label>
        <label><input type="checkbox" class="col-toggle" data-col="status_sekolah" checked> Status Sekolah</label>
        <label><input type="checkbox" class="col-toggle" data-col="alamat" checked> Alamat</label>
        <label><input type="checkbox" class="col-toggle" data-col="keterangan" checked> Keterangan </label>
    </div>

    <!-- Tombol Aksi -->
    <div class="action-buttons">
        <button class="print-button" onclick="printPortrait()">
            <i class="fas fa-print"></i> Cetak Portrait
        </button>
        <button class="print-button landscape" onclick="printLandscape()">
            <i class="fas fa-print"></i> Cetak Landscape
        </button>
    </div>

    <!-- Konten Utama -->
    <div class="header">
        <h1 style="text-align:center;">Data Alumni</h1>
        <p style="text-align:center;margin:3px 0;">LEMBAGA KESEJAHTERAAN ANAK (LKSA)</p>
        <p style="text-align:center;margin:3px 0;">PANTI SOSIAL ASUHAN ANAK FAJAR HARAPAN</p>
        <p style="text-align:center;margin:3px 0; font-size:10pt;">Perumnas Sukaluyu Blok E1 No.107 Telp. (022) 25030788 Bandung 40123</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th class="col-nama">Nama</th>
                <th class="col-ttl">TTL</th>
                <th class="col-jk">JK</th>
                <th class="col-pendidikan">Pendidikan</th>
                <th class="col-ayah">Ayah</th>
                <th class="col-ibu">Ibu</th>
                <th class="col-pekerjaan">Pekerjaan Ortu</th>
                <th class="col-masuk">Masuk</th>
                <th class="col-keluar">Keluar</th>
                <th class="col-status">Status Siswa</th>
                <th class="col-status_sekolah">Status Sekolah</th>
                <th class="col-alamat">Alamat </th>
                <th class="col-keterangan">Ket </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($siswa_data as $row) {
                if ($row['status_sekolah'] !== 'Lulus') continue; // hanya cetak yang lulus

                $jk = ($row['jk'] == 'Laki-laki') ? 'L' : 'P';
                $tgl_lahir = date('d-m-Y', strtotime($row['tgl_lahir']));
                $tgl_masuk = date('d-m-Y', strtotime($row['tgl_masuk']));
                $tgl_keluar = !empty($row['tgl_keluar']) ? date('d-m-Y', strtotime($row['tgl_keluar'])) : '-';
                $alamat = strtolower($row['alamat']);
                $tahun_masuk = date('Y', strtotime($row['tgl_masuk']));

                echo "<tr class='data-row'
            data-jk='{$row['jk']}'
            data-tahun='{$tahun_masuk}'
            data-alamat='{$alamat}'>
            <td>{$no}</td>
            <td class='col-nama'>{$row['nama']}</td>
            <td class='col-ttl'>{$row['tmp_lahir']}, {$tgl_lahir}</td>
            <td class='col-jk'>{$jk}</td>
            <td class='col-pendidikan'>{$row['pendidikan_terakhir']}</td>
            <td class='col-ayah'>{$row['nama_ayah']}</td>
            <td class='col-ibu'>{$row['nama_ibu']}</td>
            <td class='col-pekerjaan'>{$row['pk_ortu']}</td>
            <td class='col-masuk'>{$tgl_masuk}</td>
            <td class='col-keluar'>{$tgl_keluar}</td>
            <td class='col-status'>{$row['status']}</td>
            <td class='col-status_sekolah'>{$row['status_sekolah']}</td>
            <td class='col-alamat'>{$row['alamat']}</td>
            <td class='col-keterangan'>{$row['keterangan']}</td>
        </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
    <div class="footer" style="text-align:center;margin-top:32px;">
        <p style="font-size:8pt;color:#777;margin-top:20px;">
            Dokumen ini dicetak secara otomatis pada
            <?php
            date_default_timezone_set('Asia/Jakarta');
            echo date('d/m/Y H:i');
            ?>
        </p>
    </div>
    <!-- Tambahkan di dalam <script> -->
    <script>
        document.querySelectorAll('#filter-jk, #filter-tahun, #filter-alamat').forEach(el => {
            el.addEventListener('input', applyFilter);
        });

        function applyFilter() {
            const jk = document.getElementById('filter-jk').value;
            const tahun = document.getElementById('filter-tahun').value;
            const alamat = document.getElementById('filter-alamat').value.toLowerCase();

            document.querySelectorAll('.data-row').forEach(row => {
                const rowJK = row.getAttribute('data-jk');
                const rowTahun = row.getAttribute('data-tahun');
                const rowAlamat = row.getAttribute('data-alamat');

                const showJK = jk === "" || rowJK === jk;
                const showTahun = tahun === "" || rowTahun === tahun;
                const showAlamat = alamat === "" || rowAlamat.includes(alamat);

                if (showJK && showTahun && showAlamat) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.querySelectorAll('.col-toggle').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const col = this.dataset.col;
                const display = this.checked ? '' : 'none';

                document.querySelectorAll('.col-' + col).forEach(function(cell) {
                    cell.style.display = display;
                });
            });
        });


        function printPortrait() {
            const tableHTML = document.querySelector('table').outerHTML;
            const footerHTML = document.querySelector('.footer').innerHTML;

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
			<!DOCTYPE html>
			<html>
			<head>
				<title>Cetak Data Alumni</title>
				<style>
					@page { size: A4 portrait; margin: 1.5cm; }
					body { font-family: Arial; margin: 0; padding: 0; }
					table { width: 100%; border-collapse: collapse; font-size: 10pt; }
					th, td { padding: 8px; border: 1px solid #ddd; text-align: center;font-size: 7pt; }
					th { background-color: #3498db; color: white; }
					.footer { margin-top: 30px; }
				</style>
			</head>
			<body>
		<div style="text-align:center;margin-bottom:20px;">
	<p style="margin:3px 0;font-weight:bold;">
		LEMBAGA KESEJAHTERAAN ANAK (LKSA)
	</p>
	<p style="margin:3px 0;font-weight:bold;">
		PANTI SOSIAL ASUHAN ANAK FAJAR HARAPAN
	</p>
	<p style="margin:3px 0; font-size:10pt;">
		Perumnas Sukaluyu Blok E1 No.107 Telp. (022) 25030788 Bandung 40123
	</p>
</div>

				${tableHTML}

			<p style="font-size:9pt;color:#777;margin-top:20px;">
	Dokumen ini dicetak secara otomatis pada <?php echo date('d/m/Y H:i'); ?>
</p>

				<script>
					window.onload = function() {
						setTimeout(function() {
							window.print();
							window.close();
						}, 200);
					};
				<\/script>
			</body>
			</html>
		`);
            printWindow.document.close();
        }

        function printLandscape() {
            const tableHTML = document.querySelector('table').outerHTML;
            const footerHTML = document.querySelector('.footer').innerHTML;

            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
			<!DOCTYPE html>
			<html>
			<head>
				<title>Cetak Data Alumni</title>
				<style>
					@page { size: A4 landscape; margin: 1cm; }
					body { font-family: Arial; margin: 0; padding: 0; }
					table { width: 100%; border-collapse: collapse; font-size: 9pt; }
					th, td { padding: 6px; border: 1px solid #ddd; text-align: center; }
					th { background-color: #3498db; color: white; }
					.footer { margin-top: 20px; }
				</style>
			</head>
			<body>
				<div style="text-align:center;margin-bottom:20px;">
	<p style="margin:3px 0;font-weight:bold;">
		LEMBAGA KESEJAHTERAAN ANAK (LKSA)
	</p>
	<p style="margin:3px 0;font-weight:bold;">
		PANTI SOSIAL ASUHAN ANAK FAJAR HARAPAN
	</p>
	<p style="margin:3px 0; font-size:10pt;">
		Perumnas Sukaluyu Blok E1 No.107 Telp. (022) 25030788 Bandung 40123
	</p>
</div>

				${tableHTML}

				<div class="footer" style="text-align:center;margin-top:20px;">
					${footerHTML}
				</div>

				<script>
					window.onload = function() {
						setTimeout(function() {
							window.print();
							window.close();
						}, 200);
					};
				<\/script>
			</body>
			</html>
		`);
            printWindow.document.close();
        }
    </script>