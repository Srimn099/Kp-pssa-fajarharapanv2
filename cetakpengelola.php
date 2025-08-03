<?php

use Dompdf\Css\Color;

require('fpdf/fpdf.php');
include('koneksi.php');
date_default_timezone_set('Asia/Jakarta');

// Ambil parameter pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';

// Query data pengelola - INI YANG DITAMBAHKAN
$sql = "SELECT foto, no_ktp, nama, jk, usia, alamat, jabatan 
        FROM tb_pengelola 
        WHERE 
            LOWER(nama) LIKE LOWER('%$search%')
            OR LOWER(no_ktp) LIKE LOWER('%$search%')
            OR LOWER(jk) LIKE LOWER('%$search%')
            OR LOWER(alamat) LIKE LOWER('%$search%')
            OR LOWER(jabatan) LIKE LOWER('%$search%')
        ORDER BY id DESC";

class PDF extends FPDF
{
    private $showHeader = true; // Flag untuk menampilkan header hanya di halaman pertama
    function Header()
    {
        if ($this->showHeader) {
            // Logo di kiri
            $this->Image('image/logo_muhammadiyah_hijau_new.png', 50, 6, 30);
            $logoWidth = 30;
            $rightMargin = 10;
            // $xRight = 297 - $logoWidth - $rightMargin; // 297mm = lebar A4 landscape
            $xRight = 220;

            $this->Image('image/logo_muhammadiyah_hijau_new.png', $xRight, 6, $logoWidth);
            // Judul utama
            $this->SetFont('Arial', 'B', 17);
            $this->Cell(0, 6, 'LAPORAN DATA PENGELOLA', 0, 1, 'C');
            $this->Ln(1);
            // Subjudul 1
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(0, 6, 'LEMBAGA KESEJAHTERAAN ANAK (LKSA)', 0, 1, 'C');
            $this->Ln(1);
            // Subjudul 2
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(0, 6, 'PANTI SOSIAL ASUHAN ANAK FAJAR HARAPAN', 0, 1, 'C');

            // Alamat
            $this->SetFont('Arial', '', 11);
            $this->Cell(0, 6, 'Perumnas Sukaluyu Blok E1 No.107 Telp. (022) 25030788 Bandung 40123', 0, 1, 'C');

            // Garis pembatas
            $this->SetLineWidth(0.5);
            $this->Line(40, 40, 260, 40); // (x1, y1, x2, y2) - A4 landscape width: 297mm

            // Jarak untuk konten
            $this->Ln(1);

            $this->showHeader = false;
        }
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function ImprovedTable($header, $data)
    {
        // Lebar kolom (sesuaikan dengan kebutuhan)
        $w = array(10, 35, 40, 55, 20, 15, 40, 65);

        // Header dengan border penuh (1)
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(200, 220, 255); // Warna background header
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        // Data
        $no = 1;
        foreach ($data as $row) {
            // Konfigurasi umum
            $lineHeight = 5;

            // Hitung tinggi untuk kolom wrap (Nama & Alamat)
            $ktpHeight = $this->GetMultiCellHeight($w[2], $lineHeight, $row['no_ktp']);
            $namaHeight   = $this->GetMultiCellHeight($w[3], $lineHeight, $row['nama']);
            $alamatHeight = $this->GetMultiCellHeight($w[7], $lineHeight, $row['alamat']);
            $jabatanHeight = $this->GetMultiCellHeight($w[6], $lineHeight, $row['jabatan']);
            // Tentukan tinggi baris (maksimum dari keduanya dan min 40)
            $rowHeight = max($ktpHeight, $namaHeight, $jabatanHeight, $alamatHeight, 40);
            $this->CheckPageBreak($rowHeight);
            // Simpan posisi awal baris
            $x = $this->GetX();
            $y = $this->GetY();

            // ========== KOLOM 1: No ==========
            $this->Cell($w[0], $rowHeight, $no++, 1, 0, 'C');

            // ========== KOLOM 2: Foto ==========
            $fotoPath = 'image/pengelola/' . $row['foto'];
            if (file_exists($fotoPath)) {
                $xFoto = $this->GetX();
                $yFoto = $this->GetY();
                $this->Cell($w[1], $rowHeight, '', 1); // Border
                $this->Image($fotoPath, $xFoto + 2, $yFoto + 2, $w[1] - 4, $rowHeight - 4);
            } else {
                $this->Cell($w[1], $rowHeight, 'No Image', 1, 0, 'C');
            }

            // ========== KOLOM 3: No. KTP (wrap + center) ==========
            $xKTP = $this->GetX();
            $yKTP = $this->GetY();
            $ktpHeight = $this->GetMultiCellHeight($w[2], $lineHeight, $row['no_ktp']);
            $this->SetXY($xKTP, $yKTP + ($rowHeight - $ktpHeight) / 2);
            $this->MultiCell($w[2], $lineHeight, $row['no_ktp'], 0, 'C');
            $this->Rect($xKTP, $yKTP, $w[2], $rowHeight);
            $this->SetXY($xKTP + $w[2], $yKTP); // lanjut ke kanan


            // ========== KOLOM 4: Nama (wrap + center) ==========
            $xNama = $this->GetX();
            $yNama = $this->GetY();
            $this->SetXY($xNama, $yNama + ($rowHeight - $namaHeight) / 2);
            $this->MultiCell($w[3], $lineHeight, $row['nama'], 0, 'C');
            $this->Rect($xNama, $yNama, $w[3], $rowHeight);
            $this->SetXY($xNama + $w[3], $yNama); // Lanjut ke kanan kolom

            // ========== KOLOM 5: JK ==========
            $this->Cell($w[4], $rowHeight, $row['jk'], 1, 0, 'C');

            // ========== KOLOM 6: Usia ==========
            $this->Cell($w[5], $rowHeight, $row['usia'], 1, 0, 'C');

            // ========== KOLOM 7: Jabatan (wrap + center) ==========
            $xJabatan = $this->GetX();
            $yJabatan = $this->GetY();
            $jabatanHeight = $this->GetMultiCellHeight($w[6], $lineHeight, $row['jabatan']);
            $this->SetXY($xJabatan, $yJabatan + ($rowHeight - $jabatanHeight) / 2);
            $this->MultiCell($w[6], $lineHeight, $row['jabatan'], 0, 'C');
            $this->Rect($xJabatan, $yJabatan, $w[6], $rowHeight);
            $this->SetXY($xJabatan + $w[6], $yJabatan); // Lanjut ke kolom berikutnya

            // ========== KOLOM 8: Alamat (wrap + center) ==========
            $xAlamat = $this->GetX();
            $yAlamat = $this->GetY();
            $this->SetXY($xAlamat, $yAlamat + ($rowHeight - $alamatHeight) / 2);
            $this->MultiCell($w[7], $lineHeight, $row['alamat'], 0, 'C');
            $this->Rect($xAlamat, $yAlamat, $w[7], $rowHeight);

            // ======== Akhiri baris ========
            $this->SetXY($x, $y + $rowHeight); // Geser ke awal baris berikutnya
        }

        // Garis penutup tabel
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    function GetMultiCellHeight($w, $h, $txt)
    {
        $nb = $this->NbLines($w, $txt);
        return $nb * $h;
    }

    function NbLines($w, $txt)
    {
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
    function CheckPageBreak($h)
    {
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
        }
    }
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();

if (!empty($search)) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 6, 'Filter pencarian: ' . $search, 0, 1, 'L');
    $pdf->Ln(5);
}
$pdf->SetTextColor(150, 150, 150);
$pdf->SetFont('Arial', '', 9,);
$pdf->Ln(10); // Menambah jarak 15mm ke bawah
$pdf->Cell(0, 6, 'Dicetak pada: ' . date('d/m/Y H:i:s') . ' WIB', 0, 1, 'L');
$pdf->Ln(1); // Jarak setelah teks
$pdf->SetTextColor(0, 0, 0); // Hitam
$header = array('No', 'Foto', 'No. KTP', 'Nama', 'JK', 'Usia', 'Jabatan', 'Alamat');

$data = array();
$result = $koneksi->query($sql); // LINE 81 YANG MEMICU ERROR SEBELUMNYA
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$pdf->SetFont('Arial', '', 10);
$pdf->ImprovedTable($header, $data);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Total Data: ' . count($data), 0, 1, 'L');

$pdf->Output('D', 'Data_Pengelola_' . date('Ymd') . '.pdf');
$koneksi->close();
